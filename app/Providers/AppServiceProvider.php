<?php

namespace App\Providers;

use App\Models\Application;
use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use App\Observers\ApplicationObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ✅ Register Application Observer
        Application::observe(ApplicationObserver::class);

        //for the notification to be globally available (no controller needed)
        view()->composer('layouts.topbar', function ($view) {
            
            if (Auth::check()) {
                $notifications = Notification::where('user_id', Auth::id())->latest()->get();
            } else {
                $notifications = collect(); 
            }

            // Separate today's and past notifications
            $todayNotifications = $notifications->filter(function ($notif) {
                return Carbon::parse($notif->created_at)->isToday();
            });

            $pastNotifications = $notifications->filter(function ($notif) {
                return !Carbon::parse($notif->created_at)->isToday();
            });

            $view->with(['notifications' => $notifications, 'todayNotifications' => $todayNotifications, 'pastNotifications' => $pastNotifications]);
        });
    }
}
