<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\IUsersRepo',
            'App\Repositories\UsersRepo');

        $this->app->bind(
            'App\Repositories\Interfaces\IIdentityRepo',
            'App\Repositories\IdentityRepo');

        $this->app->bind(
            'App\Repositories\Interfaces\IRecordRepo',
            'App\Repositories\RecordRepo');
    }
}
