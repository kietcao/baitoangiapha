<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Str;

trait MemoryTrait
{
    public function byteToGb($totalRam, $to = "GB")
    {
        $to = Str::lower($to);
        preg_match('/(\d+)/', $totalRam, $matches);
        $totalRam = isset($matches[1]) ? $matches[1] : 'Unknown';
        $totalRam = $totalRam / 1024 / 1024 / 1024;
        return $totalRam;
    }
}