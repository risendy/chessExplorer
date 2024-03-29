<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function persist($game) {
        $em = $this->getEntityManager();

        $em->persist($game);
    }

    public function flush() {
        $em = $this->getEntityManager();

        $em->flush();
        $em->clear();
    }

    public function getPaginatedGames($page, $pageSize, $whitePlayer, $blackPlayer, $result, $sort) {
        $query = $this->createQueryBuilder('g');

        if (!$whitePlayer && !$blackPlayer && !$result) {

        }
        else
        {
            $query = $this->createQueryBuilder('g');

            if ($whitePlayer) {
                $query->andWhere('g.white LIKE :white')
                ->setParameter('white', '%'.$whitePlayer.'%');
            }
            if ($blackPlayer) {
                $query->andWhere('g.black LIKE :black')
                    ->setParameter('black', '%'.$blackPlayer.'%');
            }
            if ($result) {
                $query->andWhere('g.result = :result')
                ->setParameter('result', $result);
            }
        }

        if ($sort == 'date_asc') $query->orderBy('g.date', 'ASC');
        if ($sort == 'date_desc') $query->orderBy('g.date', 'DESC');

        $query->getQuery();

        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);

        $totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page-1)) // set the offset
            ->setMaxResults($pageSize); // set the limit

        return $paginator;
    }

    public function getPaginatedFavouriteGames($page, $pageSize, $whitePlayer, $blackPlayer, $result, $sort) {
        $query = $this->createQueryBuilder('g');
        $query->andWhere('g.favourite = :fav')
            ->setParameter('fav', 1);

        if (!$whitePlayer && !$blackPlayer && !$result) {

        }
        else
        {
            if ($whitePlayer) {
                $query->andWhere('g.white LIKE :white')
                    ->setParameter('white', '%'.$whitePlayer.'%');
            }
            if ($blackPlayer) {
                $query->andWhere('g.black LIKE :black')
                    ->setParameter('black', '%'.$blackPlayer.'%');
            }
            if ($result) {
                $query->andWhere('g.result = :result')
                    ->setParameter('result', $result);
            }
        }

        if ($sort == 'date_asc') $query->orderBy('g.date', 'ASC');
        if ($sort == 'date_desc') $query->orderBy('g.date', 'DESC');

        $query->getQuery();

        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);

        $totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page-1)) // set the offset
            ->setMaxResults($pageSize); // set the limit

        return $paginator;
    }

    // /**
    //  * @return Game[] Returns an array of Game objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Game
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
