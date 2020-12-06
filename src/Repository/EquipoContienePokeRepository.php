<?php

namespace App\Repository;

use App\Entity\EquipoContienePokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EquipoContienePokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquipoContienePokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquipoContienePokemon[]    findAll()
 * @method EquipoContienePokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipoContienePokeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipoContienePokemon::class);
    }

     /**
      * @return EquipoContienePokemon[] Returns an array of Pokemon objects
      */
    
    public function findById($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.equipoIdequipo = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    
    
    

}
