<?php

namespace App\Repository;

use App\Entity\Move;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Move|null find($id, $lockMode = null, $lockVersion = null)
 * @method Move|null findOneBy(array $criteria, array $orderBy = null)
 * @method Move[]    findAll()
 * @method Move[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Move::class);
    }

    public function persist($move) {
        $em = $this->getEntityManager();

        $em->persist($move);
    }

    public function flush() {
        $em = $this->getEntityManager();

        $em->flush();
        $em->clear();
    }

    public function countPopularMoves($fen)
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        //start position
        if ($fen == 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1') {
            $sql = "
                SELECT COUNT(*) AS numer_of_moves, m1.move_san AS next_move_san FROM move m1
                WHERE m1.move_number = 1
                GROUP BY m1.move_san
                ORDER BY numer_of_moves DESC            
            ";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        else
        {
            $sql = "
        SELECT COUNT(*) as numer_of_moves, m1.move_san AS first_move_san, m2.move_san AS next_move_san FROM move m1, move m2
        WHERE m1.fen = :fen
        AND m1.next_move_id=m2.id
        GROUP BY m2.move_san
        ORDER BY numer_of_moves DESC
        ";

            $stmt = $conn->prepare($sql);
            $stmt->execute(
                array('fen' => $fen)
            );
        }

        $result = $stmt->fetchAllAssociative();

        return $result;
    }

    // /**
    //  * @return Move[] Returns an array of Move objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Move
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
