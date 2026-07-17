<?php

namespace App\Providers;
use App\Models\Pelatihan;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {

    $favoritPelatihans = Pelatihan::where('favorit', true)
        ->orderBy('nama_pelatihan')
        ->get();

    $view->with('favoritPelatihans', $favoritPelatihans);

});
    }
}
