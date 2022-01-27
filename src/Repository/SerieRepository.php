<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function findGoodSeries() {
        /*DQL
        $em = $this->getEntityManager();
        $dql = 'SELECT s
                FROM App\Entity\Serie s
                WHERE s.vote >= 8.5
                ORDER BY s.vote DESC';
        $query =$em->createQuery($dql);*/
        //QueryBuilder
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere('s.vote >= 8.5')->addOrderBy('s.vote', 'DESC');
        $query = $qb->getQuery();
        return $query->getResult();
        }
}
