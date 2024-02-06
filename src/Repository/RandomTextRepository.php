<?php

namespace App\Repository;

use App\Entity\RandomImage;
use App\Entity\RandomText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RandomText>
 *
 * @method RandomText|null find($id, $lockMode = null, $lockVersion = null)
 * @method RandomText|null findOneBy(array $criteria, array $orderBy = null)
 * @method RandomText[]    findAll()
 * @method RandomText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RandomTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RandomText::class);
    }

    public function save(RandomText $text): void
    {
        $this->getEntityManager()->persist($text);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return RandomText[] Returns an array of RandomText objects
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

//    public function findOneBySomeField($value): ?RandomText
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
