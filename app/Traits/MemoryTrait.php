<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Str;

trait MemoryTrait
{
    public function memoryStrFormat($totalRam, $to = "GB")
    {
        $to = Str::lower($to);
        preg_match('/(\d+)/', $totalRam, $matches);
        $totalRam = isset($matches[1]) ? $matches[1] : 'Unknown';
        switch ($to) {
            case 'gb':
                $totalRam = (int) number_format($totalRam / 1024 / 1024);
                break;
            case 'mb':
                $totalRam = intval($totalRam / (1024 * 1024));
                $totalRam = $this->roundToNearestMultiple($totalRam, 1000);
                break;
        }

        return $totalRam;
    }

    public function roundToNearestMultiple($number, $multiple)
    {
        $rounded = round($number / $multiple) * $multiple;
        return intval($rounded);
    }
}