<?php

namespace App\Service;

use App\Helper\MathHelper;
use App\Repository\MoveRepository;

class MoveService
{
    /**
     * @var MoveRepository
     */
    private $moveRepository;
    /**
     * @var MathHelper
     */
    private $mathHelper;

    public function __construct(MoveRepository $moveRepository, MathHelper $mathHelper)
    {
        $this->moveRepository = $moveRepository;
        $this->mathHelper = $mathHelper;
    }

    public function saveMove($move)
    {
        $this->moveRepository->persist($move);
    }

    public function flushMoves() {
        $this->moveRepository->flush();
    }

    public function transformMoveArray($moves) {
        $arr = [];
        foreach ($moves as $record) {
            $next_move = $record['next_move_san'];
            $move_count = $record['numer_of_moves'];
            $game_result = $record['result'];

            if (!isset($arr[$next_move]['count_sum'])) $arr[$next_move]['count_sum'] = 0;
            $arr[$next_move]['count_sum']=$arr[$next_move]['count_sum']+$move_count;

            if ($game_result == '1-0') {
                if (!isset($arr[$next_move]['count_white_win'])) $arr[$next_move]['count_white_win'] = 0;
                $arr[$next_move]['count_white_win']=$arr[$next_move]['count_white_win']+$move_count;
            }
            else if ($game_result == '0-1') {
                if (!isset($arr[$next_move]['count_black_win'])) $arr[$next_move]['count_black_win'] = 0;

                $arr[$next_move]['count_black_win']=$arr[$next_move]['count_black_win']+$move_count;
            }
            else if ($game_result == '1/2-1/2') {
                if (!isset($arr[$next_move]['count_draw'])) $arr[$next_move]['count_draw'] = 0;

                $arr[$next_move]['count_draw']=$arr[$next_move]['count_draw']+$move_count;
            }
        }

        return $arr;
    }

    public function calculatePercentValues($moves) {
        foreach ($moves as $key => $record) {
            $count_sum = $record['count_sum'];

            if (isset($moves[$key]['count_white_win'])) {
                $count_white_win = $record['count_white_win'];
                $moves[$key]['count_white_win'] = $this->mathHelper->calculatePercent($count_sum, $count_white_win);
            }

            if (isset($moves[$key]['count_black_win'])) {
                $count_black_win = $record['count_black_win'];
                $moves[$key]['count_black_win'] = $this->mathHelper->calculatePercent($count_sum, $count_black_win);
            }

            if (isset($moves[$key]['count_draw'])) {
                $count_draw = $record['count_draw'];
                $moves[$key]['count_draw'] = $this->mathHelper->calculatePercent($count_sum, $count_draw);
            }
        }

        return $moves;
    }

    public function getPopularMovesInThePosition($fen) {
        $getMoves = $this->moveRepository->countPopularMoves($fen);
        $getMoves = $this->transformMoveArray($getMoves);
        $getMoves = $this->calculatePercentValues($getMoves);

        return $getMoves;
    }
}
