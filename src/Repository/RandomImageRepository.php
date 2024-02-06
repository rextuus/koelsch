<?php

namespace App\Repository;

use App\Entity\RandomImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RandomImage>
 *
 * @method RandomImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method RandomImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method RandomImage[]    findAll()
 * @method RandomImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RandomImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RandomImage::class);
    }

    public function save(RandomImage $image): void
    {
        $this->getEntityManager()->persist($image);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return RandomImage[] Returns an array of RandomImage objects
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

//    public function findOneBySomeField($value): ?RandomImage
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
