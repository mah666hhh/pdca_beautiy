<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        // 本番環境(Heroku)でhttpsを強制する
        
        dump((\App::isLocal()));

        dump(app()->runningUnitTests());

        dump(env('APP_ENV_PRODUCTION') == 'true');

        if (env('APP_ENV_PRODUCTION') == 'true')
        {
            \URL::forceScheme('https');
        }
        elseif (\App::isLocal()) {
        }
        elseif (app()->runningUnitTests()) {
        }
    }
}
