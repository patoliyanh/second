<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule::command('log:minute')->everyMinute();
Schedule::command('log:minute')->dailyAt('16:52');
Schedule::command('log:minutes1')->dailyAt('17:23');
