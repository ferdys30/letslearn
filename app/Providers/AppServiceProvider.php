<?php

namespace App\Providers;

use App\Models\Mapel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
                $mapelList = Mapel::where('id_user', Auth::id())->get();
                $view->with('mapelList', $mapelList);
            }
        });
        Blade::if('role', function ($role) {
            $roleMap = [
                1 => 'admin',
                2 => 'guru',
                3 => 'siswa',
            ];

            return Auth::check() && $roleMap[Auth::user()->id_role] === $role;
        });

    }
}
