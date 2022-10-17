<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function add(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Cart[] Returns an array of Cart objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cart
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
/**
    * @return Cart[] Returns an array of Cart objects
    */
    public function showCart($user, $cid): array
    {
        return $this->createQueryBuilder('c')
             ->select('p.Pro_Image, p.Name, cd.Qty_Pro as Quantity, p.Sale_Price, cd.id as id')
             ->innerJoin('c.Username', 'u')
             ->innerJoin('c.cartDetails', 'cd')
             ->innerJoin('cd.Product_ID', 'p')
             ->Where('c.Username = :uid')
             ->setParameter('uid', $user)
             ->andWhere('c.id = :cid')
             ->setParameter('cid', $cid)
             ->getQuery()
             ->getArrayResult()
        ;
    }
 
        /**
     * @return Cart[] Returns an array of Cart objects
     */
     public function sumPrice($user, $cid): array
     {
         return $this->createQueryBuilder('c')
              ->select('Sum(p.Sale_Price * cd.Qty_Pro) as Total')
              ->innerJoin('c.Username', 'u')
              ->innerJoin('c.cartDetails', 'cd')
              ->innerJoin('cd.Product_ID', 'p')
              ->Where('c.Username = :uid')
              ->setParameter('uid', $user)
              ->andWhere('c.id = :cid')
              ->setParameter('cid', $cid)
              ->getQuery()
              ->getArrayResult()
         ;
     }
 
 
            /**
     * @return Cart[] Returns an array of Cart objects
     */
     public function getUserID($cid): array
     {
         return $this->createQueryBuilder('c')
              ->select('u.id as ID')
              ->innerJoin('c.Username', 'u')
              ->where('c.id = :cid')
              ->setParameter('cid', $cid)
              ->getQuery()
              ->getArrayResult()
         ;
     }
}
