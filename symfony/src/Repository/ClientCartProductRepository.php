<?php

namespace App\Repository;

use App\Entity\ClientCartProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClientCartProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientCartProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientCartProduct[]    findAll()
 * @method ClientCartProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientCartProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClientCartProduct::class);
    }

//    /**
//     * @return ClientCartProduct[] Returns an array of ClientCartProduct objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClientCartProduct
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
