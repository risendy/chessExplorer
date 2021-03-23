<?php

namespace App\Controller;

use App\Entity\Move;
use App\Service\GameService;
use App\Service\MoveService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    private $gameService;
    /**
     * @var MoveService
     */
    private $moveService;

    public function __construct(GameService $gameService, MoveService $moveService)
    {
        $this->gameService = $gameService;
        $this->moveService = $moveService;
    }

    public function getGameInfo(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $contentDecoded = json_decode($content, true);
        $gameId = $contentDecoded['gameId'];
        $game = $this->gameService->getGameInfo($gameId);

        return new JsonResponse(
            [
                "white" => $game->getWhite(),
                "black" => $game->getBlack(),
                "whiteElo" => $game->getWhiteElo(),
                "blackElo" => $game->getBlackElo(),
                "result" => $game->getResult(),
                "event" => $game->getEvent(),
                "date" => $game->getDate()->format('Y-m-d'),
                "eventDate" => $game->getEventDate()->format('Y-m-d'),
                "pgn" => $game->getPgn()
            ]
        );
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
        $whitePlayer = $request->query->get('whitePlayerFilter');
        $blackPlayer = $request->query->get('blackPlayerFilter');
        $result = $request->query->get('resultFilter');
        $sort = $request->query->get('sort');

        $result = $this->gameService->getGamesInfoRange($page, $limit, $whitePlayer, $blackPlayer, $result, $sort);

        return new JsonResponse([$result]);
    }

    public function getFavouriteGamesPaginated(Request $request): JsonResponse
    {
        $page = $request->query->get('page');
        $limit = $request->query->get('limit');
        $whitePlayer = $request->query->get('whitePlayerFilter');
        $blackPlayer = $request->query->get('blackPlayerFilter');
        $result = $request->query->get('resultFilter');
        $sort = $request->query->get('sort');

        $result = $this->gameService->getFavouriteGamesInfoRange($page, $limit, $whitePlayer, $blackPlayer, $result, $sort);

        return new JsonResponse([$result]);
    }

    public function getPopularMoves(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $contentDecoded = json_decode($content, true);

        $fen = $contentDecoded['fenString'];

        $result = $this->moveService->getPopularMovesInThePosition($fen);

        return new JsonResponse($result);
    }

    public function updateGame(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $contentDecoded = json_decode($content, true);

        $id = $contentDecoded['id'];
        $flag = $contentDecoded['flag'];

        $result = $this->gameService->updateGame($id, $flag);

        if ($result) {
            return new JsonResponse(['status' => 'ok']);
        }

        return new JsonResponse(['status' => 'error']);
    }
}
