<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\mata_pelajaran;

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
        View::composer('guru.*', function ($view) {
            if (Auth::check()) {
                $mapelList = mata_pelajaran::where('id_user', Auth::id())->get();
                $view->with('mapelList', $mapelList);
            }
        });

    }
}
