<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Add your scheduled task
Schedule::command('training:check-no-shows')
        ->dailyAt('01:00')
        ->timezone('Asia/Manila');
