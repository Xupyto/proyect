<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pokemon[]    findAll()
 * @method Pokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    // /**
    //  * @return Pokemon[] Returns an array of Pokemon objects
    //  */
    
    public function findById($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.idpoke = :val')
            ->setParameter('val', $value)
            ->orderBy('p.idpoke', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByName($value)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM App\Entity\Pokemon p WHERE p.nombre like :nombre ORDER BY p.nombre ASC'
            )
            ->setParameter('nombre', '%'.$value.'%')
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
