<?php

namespace App\Repository;

use App\Entity\Formato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formato[]    findAll()
 * @method Formato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formato::class);
    }

     /**
      * @return Formato[] Returns an array of Pokemon objects
      */
    
    public function findById($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
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
