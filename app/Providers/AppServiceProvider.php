<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\view;
use App\Models\Categoria;
use App\Models\Oferta;

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
        View::composer('partials.categorias', function ($view){
            $view->with('categorias', Categoria::all());
        });

        View::composer('*', function ($view) {
        $ofertas = Oferta::all();
        $view->with('ofertas', $ofertas);
        });

    }
}
