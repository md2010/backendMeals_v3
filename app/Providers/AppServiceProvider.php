<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\Translation;
use App\Http\Filter\Loader;
use App\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Translation::class, function($app) {
            return new Translation();
        });
        
        $this->app->singleton(Loader::class, function($app) {
            return new Loader();
        });
    }

    public function boot() {}
}
