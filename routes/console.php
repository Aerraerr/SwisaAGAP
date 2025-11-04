<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Add your scheduled task
Schedule::command('training:check-no-shows')
        ->dailyAt('01:00')
        ->timezone('Asia/Manila');
