<?php

namespace App\Repository;

use App\Entity\PokemonTienePartner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PokemonTienePartner|null find($id, $lockMode = null, $lockVersion = null)
 * @method PokemonTienePartner|null findOneBy(array $criteria, array $orderBy = null)
 * @method PokemonTienePartner[]    findAll()
 * @method PokemonTienePartner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonTienePartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokemonTienePartner::class);
    }

     /**
      * @return PokemonTienePartner[] Returns an array of Pokemon objects
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
    
    public function findByManyFields($format, $poke, $poke1)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.formato = :val1')
            ->andWhere('p.pokemonIdpoke = :val2')
            ->andWhere('p.pokemonIdpoke1 = :val3')
            ->setParameter('val1', $format)
            ->setParameter('val2', $poke)
            ->setParameter('val3', $poke1)
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
