<?php

namespace App\Repository;

use App\Entity\Modifparagraphe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Modifparagraphe>
 *
 * @method Modifparagraphe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modifparagraphe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modifparagraphe[]    findAll()
 * @method Modifparagraphe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModifparagrapheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modifparagraphe::class);
    }

    public function save(Modifparagraphe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Modifparagraphe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Modifparagraphe[] Returns an array of Modifparagraphe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Modifparagraphe
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
