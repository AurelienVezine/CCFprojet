<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\Habitat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @extends ServiceEntityRepository<Animal>
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Animal::class);

    }

    public function paginateAnimals(int $page, ): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('r'),
            $page,
            4
        );
    }

    public function findByHabitat(int $page, Habitat $habitat): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('a')
                ->where('a.habitat = :habitat')
                ->setParameter('habitat', $habitat)
                ->getQuery(),
            $page,
            4
        );
    }

    public function findMostViewed()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.VueCount', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function findMostViewedArray(int $page)
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('a')
            ->orderBy('a.VueCount', 'DESC')
            ->getQuery()
            ->getResult(),
            $page,
            5,
    );
    }

        /*
        return new Paginator($this
            ->createQueryBuilder('r')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->setHint(Paginator::HINT_ENABLE_DISTINCT, false),
        );
        */

    //    /**
    //     * @return Animal[] Returns an array of Animal objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Animal
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
