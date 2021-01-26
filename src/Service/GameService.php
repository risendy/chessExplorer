<?php

namespace App\Service;

use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GameService
{
    /**
     * @var GameRepository
     */
    private $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function getGameInfo($id)
    {
        return $this->gameRepository->findOneBy(["id" => $id]);
    }

    public function getLastGames()
    {
        return $this->gameRepository->findBy([],[], 10);
    }
}
