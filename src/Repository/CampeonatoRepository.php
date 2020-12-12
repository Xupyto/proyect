<?php

namespace App\Repository;

use App\Entity\Campeonato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Campeonato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campeonato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campeonato[]    findAll()
 * @method Campeonato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampeonatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campeonato::class);
    }

     /**
      * @return Campeonato[] Returns an array of Campeonato objects
      */
    
    public function findByFormat($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.formato = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }  

}
