<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\paginator;
use Illuminate\Support\Facades;
use Illuminate\View\View;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Report;

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
        Vite::prefetch(concurrency: 3);
        Paginator::useBootstrapFour();

        Facades\View::composer('admin.*', function (View $view) {

            $oneHourAgo = Carbon::now()->subHour();
            $reports_count = Report::where('created_at', '>=', $oneHourAgo)->count();

            $oneWeekAgo = Carbon::now()->subDays(7);
            $clients_count = Client::where('created_at', '>=', $oneWeekAgo)->count();

            $oneDayAgo = Carbon::now()->subDay();
            $messages_count = Contact::where('created_at', '>=', $oneDayAgo)->count();

            $view->with([
                'reports_count' => $reports_count,
                'clients_count' => $clients_count,
                'messages_count' => $messages_count,

            ]);
        });

        Facades\View::composer('website.*', function (View $view) {
            if (Auth::guard('client')->check()) {
                $client = Auth('client')->user();
                $notifications_count = $client->notifications()->wherePivot('is_read', 0)->count();
                $view->with([
                    'notifications_count' => $notifications_count,
                ]);
            }
            $view->with([
                'settings' => Setting::firstOrNew(),
            ]);
        });
    }
}
