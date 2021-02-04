<?php

namespace App\Command;

use App\Entity\Game;
use App\Entity\Move;
use App\Repository\GameRepository;
use App\Service\GameService;
use App\Service\MoveService;
use Ryanhs\Chess\Chess;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Risendy\ChessPgnParser\Service\ChessParser;

class ImportGamesCommand extends Command
{
    protected static $defaultName = 'app:import-games';

    protected $filePath;
    protected $gameService;
    /**
     * @var MoveService
     */
    private $moveService;
    private $public_path;

public function __construct(string $path, GameService $gameService, MoveService $moveService)
{
    parent::__construct();
    $this->gameService = $gameService;
    $this->moveService = $moveService;
    $this->public_path = $path.'/public/';
}

protected function configure()
{
    $this
        // ...
        ->addArgument('fileName', InputArgument::REQUIRED, 'Please give path to pgn file with chess games to begin import');
}

protected function execute(InputInterface $input, OutputInterface $output)
{
        $fileName = $input->getArgument('fileName');
        $filePath = $this->public_path.$fileName;

        $games = file_get_contents($filePath);

        //explode
        $exploded_games = explode('[Event ', $games);

        $batchSizeGames = 100;
        for ($i = 1; $i < sizeof($exploded_games) + 1; $i++) {
            $chess = new Chess();
            $moves = [];

            $game = new Game();

            $singlePgn = "[Event " . $exploded_games[$i];

            $parser = new ChessParser();
            $parser->parsePgn($singlePgn);

            $date = new \DateTime(str_replace('.', '-', $parser->getTagValueByName('Date')));
            $eventDate = new \DateTime(str_replace('.', '-', $parser->getTagValueByName('EventDate')));

            $event = $parser->getTagValueByName('Event');

            if (!$event) {
                continue;
            }

            $game->setDate($date);
            $game->setEventDate($eventDate);
            $game->setEvent($parser->getTagValueByName('Event'));
            $game->setSite($parser->getTagValueByName('Site'));
            $game->setRound($parser->getTagValueByName('Round'));
            $game->setWhite($parser->getTagValueByName('White'));
            $game->setBlack($parser->getTagValueByName('Black'));
            $game->setResult($parser->getTagValueByName('Result'));
            $game->setWhiteElo($parser->getTagValueByName('WhiteElo'));
            $game->setBlackElo($parser->getTagValueByName('BlackElo'));
            $game->setEco($parser->getTagValueByName('ECO'));
            $game->setPgn($singlePgn);

            $this->gameService->saveGame($game);

            //load pgn into chessjsphp library
            $chess->loadPgn($singlePgn);

            //get list of moves
            $moves = $chess->history();

            $prevMoveEntity = '';

            $chessTmp = new Chess();

            for ($j = 0; $j < sizeof($moves); $j++){
                $move = new Move();
                $chessTmp->move($moves[$j]);

                if ($j % 2 == 0) {
                    $turn = 'w';
                }
                else
                {
                    $turn = 'b';
                }

                $fen = $chessTmp->fen();
                $move->setMoveSan($moves[$j]);
                $move->setColor($turn);
                $move->setMoveNumber($j+1);
                $move->setFen($fen);

                $move->setGameFk($game);

                $this->moveService->saveMove($move);

                if (isset($moves[$j - 1])) {
                    $prevMoveEntity->setNextMove($move);
                }

                $prevMoveEntity = $move;

                if ($j == sizeof($moves)) {
                    $this->moveService->flushMoves();
                }
            }

            if (($i % $batchSizeGames) === 0) {
                $this->gameService->flushGames();
            }

            print("game count: ".$i."/".sizeof($exploded_games)."\n");
        }

        return 1;
    }
}