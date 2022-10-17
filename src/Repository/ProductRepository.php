<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    //  /**
    // * @return Product[] Returns an array of Product objects
    // */
    // public function findAll(): array
    // {
    //     return $this->createQueryBuilder('p')
    //      ->select('p.Image, p.Name, p.Price, p.Quantity, p.Detail')
    //      ->getQuery()
    //      ->getResult()
    //     ;
    // }

    /**
    * @return Product[] Returns an array of Product objects
    */
    public function getProduct(): array
    {
        return $this->createQueryBuilder('p')
         ->select('p.Image, p.Name, p.Price, p.Quantity, p.Detail')
         ->getQuery()
         ->getResult()
        ;
    }


    /**
    * @return Product[] Returns an array of Product objects
    */
    public function getProductById($id): array
    {
        return $this->createQueryBuilder('p')
         ->select('p.Image, p.Name, p.Price, p.Detail')
         ->where('id : = id')
         ->setParameter('id', $id)
         ->getQuery()
         ->getResult()
        ;
    }


    /**
    * @return Product[] Returns an array of Product objects
    */
    public function getProductByName($search): array
    {
        return $this->createQueryBuilder('p')
         ->select('p.id, p.Pro_Image, p.Name, p.Sale_Price')
         ->where('p.Name like :search')
         ->setParameter('search', "%".$search."%")
         ->getQuery()
         ->getArrayResult()
        ;
    }

    /**
    * @return Product[] Returns an array of Product objects
    */
    public function getPro($proID): array
    {
        return $this->createQueryBuilder('p')
         ->select('p.id as ProductID')
         ->innerJoin('p.CastDetail', 'cont')
         ->where('cont.product = :proID')
         ->setParameter('proID', $proID)
         ->getQuery()
         ->getArrayResult()
        ;
    }
}
