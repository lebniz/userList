<?php

namespace App\Providers;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('uppercase', function () {
            return collect($this->items)->map(function ($item) {
                return strtoupper($item);
            });
        });
    }
}
