<?php

namespace App\Controller;

use App\Service\GameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    private $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function getGameInfo(Request $request): JsonResponse
    {
        $gameId = $request->request->get('gameId');
        $game = $this->gameService->getGameInfo($gameId);

        return new JsonResponse(["pgn" => $game->getPgn()]);
    }

    public function getGames(Request $request): JsonResponse
    {
        $gamesResponse = [];
        $games = $this->gameService->getLastGames();

        foreach ($games as $key => $game) {
            $gamesResponse[$key] = [
                "pgn" => $game->getPgn(),
                "white" => $game->getWhite(),
                "black" => $game->getBlack(),
                "whiteElo" => $game->getWhiteElo(),
                "blackElo" => $game->getBlackElo(),
                "result" => $game->getResult(),
                "date" => $game->getDate()->format('Y-m-d'),
            ];
        }

        return new JsonResponse(["games" => $gamesResponse]);
    }

    public function getGamesPaginated(Request $request): JsonResponse
    {
        $page = $request->query->get('page');
        $limit = $request->query->get('limit');

        $result = $this->gameService->getGamesInfoRange($page, $limit);

        $games = [];

        $gamesResponse['items'] = $games;
        $gamesResponse['total'] = 1000;

        return new JsonResponse([$result]);
    }
}
