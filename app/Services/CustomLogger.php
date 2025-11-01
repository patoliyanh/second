<?php

namespace App\Services;

use App\Contracts\LoggerInterface;
use Illuminate\Support\Facades\Log;

class CustomLogger implements LoggerInterface
{
    public function log(string $message):void
    {
        Log::info('[CustomLogger] ' . $message);
        Log::channel('custom')->info('Custom log entry.');

    }
}
