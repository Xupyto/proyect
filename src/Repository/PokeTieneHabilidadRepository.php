<?php

namespace App\Repository;

use App\Entity\PokeTieneHabilidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PokeTieneHabilidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method PokeTieneHabilidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method PokeTieneHabilidad[]    findAll()
 * @method PokeTieneHabilidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokeTieneHabilidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokeTieneHabilidad::class);
    }

     /**
      * @return PokeTieneHabilidad[] Returns an array of Pokemon objects
      */
    
    public function findById($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.pokemonIdpoke = :val')
            ->setParameter('val', $value)
            ->orderBy('p.porcentajeUso', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByManyFields($format, $poke, $hab)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.formato = :val1')
            ->andWhere('p.pokemonIdpoke = :val2')
            ->andWhere('p.habilidad = :val3')
            ->setParameter('val1', $format)
            ->setParameter('val2', $poke)
            ->setParameter('val3', $hab)
            ->getQuery()
            ->getResult()
            ;    
    }

    /*
    public function findOneBySomeField($value): ?Pokemon
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
