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
