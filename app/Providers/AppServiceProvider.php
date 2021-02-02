<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Direttiva con  @grassetto  TestoTestoTesto @endgrassetto
        Blade::directive('grassetto', function($string){
            return "<strong>" . $string . "</strong>";
        });

        Blade::directive('bold', function(){
            return "<strong>";
        });

        //direttiva con @grassetto(TestoTestoTesto)
        Blade::directive('endbold', function(){
            return "</strong>";
        });


        //Direttiva con if: se l'argomento è un numero, il risultato è true e quindi mostra il testo della direttiva (si comporta come una funzione show di js)
        Blade::if('isnumero', function($num){
            return is_numeric($num);
        });
    }

}
