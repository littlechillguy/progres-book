<?php

namespace App\Providers;
use App\Models\Pelatihan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

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
    View::composer('*', function ($view) {

        $favoritPelatihans = collect();

        if (Auth::check()) {

            $favoritPelatihans = Favorite::with('pelatihan')
                ->where('user_id', Auth::id())
                ->latest()
                ->get()
                ->pluck('pelatihan');

        }

        $view->with('favoritPelatihans', $favoritPelatihans);

    });
}}
