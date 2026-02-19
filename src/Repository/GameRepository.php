<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    //    /**
    //     * @return Game[] Returns an array of Game objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Game
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findGamesByCriteria(float $minPrice, string $namePart): array
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.editor', 'e') // jointure avec l'éditeur
            ->andWhere('g.price > :minPrice')
            ->andWhere('g.name LIKE :namePart')
            ->andWhere('e.pc = :postalCode')
            ->setParameter('minPrice', $minPrice)
            ->setParameter('namePart', '%' . $namePart . '%')
            ->setParameter('postalCode', '33000')
            ->orderBy('g.price', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}