<?php

namespace App\Repository;

use App\Entity\ImageAccueil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageAccueil>
 *
 * @method ImageAccueil|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageAccueil|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageAccueil[]    findAll()
 * @method ImageAccueil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageAccueilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageAccueil::class);
    }

    public function save(ImageAccueil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ImageAccueil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ImageAccueil[] Returns an array of ImageAccueil objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImageAccueil
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
