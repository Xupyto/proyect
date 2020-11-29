<?php

namespace App\Repository;

use App\Entity\PokemonEstaEnFormato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PokemonEstaEnFormato|null find($id, $lockMode = null, $lockVersion = null)
 * @method PokemonEstaEnFormato|null findOneBy(array $criteria, array $orderBy = null)
 * @method PokemonEstaEnFormato[]    findAll()
 * @method PokemonEstaEnFormato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Pokemon_esta_en_formatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokemonEstaEnFormato::class);
    }

     /**
      * @return PokemonEstaEnFormato[] Returns an array of Pokemon objects
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

    public function findByIdFormat($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.formato = :val')
            ->setParameter('val', $value)
            ->orderBy('p.porcentajeUso', 'DESC')
            ->getQuery()
            ->getResult();

            
    }

    public function findByManyFields($format, $poke)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.formato = :val1')
            ->andWhere('p.pokemonIdpoke = :val2')
            ->setParameter('val1', $format)
            ->setParameter('val2', $poke)
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
