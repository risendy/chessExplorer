<?php


namespace App\Helper;


class MathHelper
{
    public function calculatePercent($total, $partial) {
        $percent = ($partial / $total) * 100;

        return number_format($percent);
    }
}
