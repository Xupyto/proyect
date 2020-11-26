<?php

namespace App\Repository;

use App\Entity\PokePuedeAprenderMov;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PokePuedeAprenderMov|null find($id, $lockMode = null, $lockVersion = null)
 * @method PokePuedeAprenderMov|null findOneBy(array $criteria, array $orderBy = null)
 * @method PokePuedeAprenderMov[]    findAll()
 * @method PokePuedeAprenderMov[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Pokemon_aprende_movRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokePuedeAprenderMov::class);
    }

     /**
      * @return PokePuedeAprenderMov[] Returns an array of Pokemon objects
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

    public function findByManyFields($format, $poke, $mov, $porcentaje)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.formato = :val1')
            ->andWhere('p.pokemonIdpoke = :val2')
            ->andWhere('p.movimiento = :val3')
            ->andWhere('p.porcentajeUso = :val4')
            ->setParameter('val1', $format)
            ->setParameter('val2', $poke)
            ->setParameter('val3', $mov)
            ->setParameter('val4', $porcentaje)
            ->getQuery()
            ->getResult()
            ;    s
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
