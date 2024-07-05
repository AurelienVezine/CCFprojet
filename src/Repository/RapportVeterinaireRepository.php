<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\RapportVeterinaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<RapportVeterinaire>
 */
class RapportVeterinaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, RapportVeterinaire::class);
    }

    public function paginateRapports(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('r')
                ->leftJoin('r.animal', 'a')
                ->orderBy('a.prenom', 'ASC'),
            $page,
            10
        );
    }

    //    /**
    //     * @return RapportVeterinaire[] Returns an array of RapportVeterinaire objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RapportVeterinaire
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
