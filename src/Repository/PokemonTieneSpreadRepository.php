<?php

namespace App\Repository;

use App\Entity\PokemonTieneSpread;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PokemonTieneSpread|null find($id, $lockMode = null, $lockVersion = null)
 * @method PokemonTieneSpread|null findOneBy(array $criteria, array $orderBy = null)
 * @method PokemonTieneSpread[]    findAll()
 * @method PokemonTieneSpread[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonTieneSpreadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokemonTieneSpread::class);
    }

     /**
      * @return PokemonTieneSpread[] Returns an array of Pokemon objects
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
    
    public function findByManyFields($format, $poke, $spread)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.formato = :val1')
            ->andWhere('p.pokemonIdpoke = :val2')
            ->andWhere('p.spreadIdspread = :val3')
            ->setParameter('val1', $format)
            ->setParameter('val2', $poke)
            ->setParameter('val3', $spread)
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
