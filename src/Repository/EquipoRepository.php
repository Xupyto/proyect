<?php

namespace App\Repository;

use App\Entity\Equipo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Equipo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipo[]    findAll()
 * @method Equipo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipo::class);
    }

     /**
      * @return Equipo[] Returns an array of Pokemon objects
      */
    
    public function findById($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.idequipo = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByEmail($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.usuarioEmail = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
    

}
