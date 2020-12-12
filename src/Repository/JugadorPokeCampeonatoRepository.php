<?php

namespace App\Repository;

use App\Entity\JugadorPokesCampeonato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JugadorPokesCampeonato|null find($id, $lockMode = null, $lockVersion = null)
 * @method JugadorPokesCampeonato|null findOneBy(array $criteria, array $orderBy = null)
 * @method JugadorPokesCampeonato[]    findAll()
 * @method JugadorPokesCampeonato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JugadorPokeCampeonatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JugadorPokesCampeonato::class);
    }

     /**
      * @return JugadorPokesCampeonato[] Returns an array of JugadorPokesCampeonato objects
      */
    
    public function findByCampeonato($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.campeonatoIdcampeonato = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByManyFields($camp, $jug, $poke)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.campeonatoIdcampeonato = :val1')
            ->andWhere('p.jugadorIdjugador = :val2')
            ->andWhere('p.pokemonIdpoke = :val3')
            ->setParameter('val1', $camp)
            ->setParameter('val2', $jug)
            ->setParameter('val3', $poke)
            ->getQuery()
            ->getResult()
            ;    
    }

    public function findPlayersbyCamp($value)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT p FROM App\Entity\JugadorPokesCampeonato p WHERE p.campeonatoIdcampeonato = :nombre'
            )
            ->setParameter('nombre', $value)
            ->getResult()
        ;
    }
    
    

}
