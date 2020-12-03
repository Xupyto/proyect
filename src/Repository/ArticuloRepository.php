<?php

namespace App\Repository;

use App\Entity\Articulo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articulo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articulo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articulo[]    findAll()
 * @method Articulo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticuloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articulo::class);
    }

     /**
      * @return Articulo[] Returns an array of Pokemon objects
      */
    
    public function findById($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.idarticulo = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
    

}
