<?php

namespace ShineYork\LaravelExtend\Database\Providers;

use Illuminate\Support\ServiceProvider;

class SDatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/datebase.php', 'extend.database'
        );
    }

    public function boot()
    {
    }
}
