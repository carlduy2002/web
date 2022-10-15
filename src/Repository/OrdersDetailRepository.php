<?php

namespace App\Repository;

use App\Entity\OrdersDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrdersDetail>
 *
 * @method OrdersDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdersDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdersDetail[]    findAll()
 * @method OrdersDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdersDetail::class);
    }

    public function add(OrdersDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrdersDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OrdersDetail[] Returns an array of OrdersDetail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrdersDetail
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
/**
    * @return OrderDetail[] Returns an array of OrderDetail objects
    */
    public function showOrderdetail($id): array
    {
        return $this->createQueryBuilder('o')
             ->select('o.id as ID, o.Qty_Pro as Quantity, od.id as OrderID, p.id as ProID')
             ->innerJoin('o.product', 'p')
             ->innerJoin('o.Order_ID', 'od')
             ->where('o.Order_ID = :id')
             ->setParameter('id', $id)
             ->getQuery()
             ->getResult()
        ;
    }
}
