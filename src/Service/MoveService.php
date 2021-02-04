<?php

namespace App\Service;

use App\Repository\MoveRepository;

class MoveService
{
    /**
     * @var MoveRepository
     */
    private $moveRepository;

    public function __construct(MoveRepository $moveRepository)
    {
        $this->moveRepository = $moveRepository;
    }

    public function saveMove($move)
    {
        $this->moveRepository->persist($move);
    }

    public function flushMoves() {
        $this->moveRepository->flush();
    }

    public function getPopularMovesInThePosition($fen) {
        return $this->moveRepository->countPopularMoves($fen);
    }
}
