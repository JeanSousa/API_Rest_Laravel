<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use PHPUnit\Util\Json;

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
    {   //se chamar o metodo da classe aqui ele retira o wrapping de todo retorno json da api
        //no caso tira a chave data
        JsonResource::withoutWrapping();

       //para trocar o nome da chave default 'data'
       //JsonResource::wrap('view');

    }
}
