<?php

namespace App\Service;

use App\Entity\Game;
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

    public function saveGame($game)
    {
        $this->gameRepository->persist($game);
    }

    public function flushGames()
    {
        $this->gameRepository->flush();
    }

    public function getGamesInfoRange($page, $pageSize = 10, $whitePlayer, $blackPlayer, $result, $sort)
    {
        $games = [];
        $items = $this->gameRepository->getPaginatedGames($page, $pageSize, $whitePlayer, $blackPlayer, $result, $sort);

        foreach ($items as $pageItem) {
            $games[] = [
                "id" => $pageItem->getId(),
                "pgn" => $pageItem->getPgn(),
                "white" => $pageItem->getWhite(),
                "black" => $pageItem->getBlack(),
                "whiteElo" => $pageItem->getWhiteElo(),
                "blackElo" => $pageItem->getBlackElo(),
                "favourite" => $pageItem->getFavourite(),
                "result" => $pageItem->getResult(),
                "date" => $pageItem->getDate()->format('Y-m-d'),
            ];
        }

        return ['items' => $games, 'total' => count($games)];
    }

    public function getFavouriteGamesInfoRange($page, $pageSize = 10, $whitePlayer, $blackPlayer, $result, $sort)
    {
        $games = [];
        $items = $this->gameRepository->getPaginatedFavouriteGames($page, $pageSize, $whitePlayer, $blackPlayer, $result, $sort);

        foreach ($items as $pageItem) {
            $games[] = [
                "id" => $pageItem->getId(),
                "pgn" => $pageItem->getPgn(),
                "white" => $pageItem->getWhite(),
                "black" => $pageItem->getBlack(),
                "whiteElo" => $pageItem->getWhiteElo(),
                "blackElo" => $pageItem->getBlackElo(),
                "favourite" => $pageItem->getFavourite(),
                "result" => $pageItem->getResult(),
                "date" => $pageItem->getDate()->format('Y-m-d'),
            ];
        }

        return ['items' => $games, 'total' => count($games)];
    }

    public function getLastGames()
    {
        return $this->gameRepository->findBy([],[], 10);
    }

    public function updateGame($id, $flag) {
        $record = $this->gameRepository->find($id);

        if ($record instanceof Game) {
            $record->setFavourite(!$flag);
            $this->gameRepository->persist($record);
            $this->gameRepository->flush();
        }

        return $record;
    }
}
