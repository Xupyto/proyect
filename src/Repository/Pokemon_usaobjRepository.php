<?php

namespace App\Repository;

use App\Entity\PokeUsaObj;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PokeUsaObj|null find($id, $lockMode = null, $lockVersion = null)
 * @method PokeUsaObj|null findOneBy(array $criteria, array $orderBy = null)
 * @method PokeUsaObj[]    findAll()
 * @method PokeUsaObj[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Pokemon_usaobjRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokeUsaObj::class);
    }

     /**
      * @return PokeUsaObj[] Returns an array of Pokemon objects
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
    
    public function findByManyFields($format, $poke, $obj)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.formato = :val1')
            ->andWhere('p.pokemonIdpoke = :val2')
            ->andWhere('p.objetoIdobjeto = :val3')
            ->setParameter('val1', $format)
            ->setParameter('val2', $poke)
            ->setParameter('val3', $obj)
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
