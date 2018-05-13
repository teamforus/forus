<?php

namespace App\Services\MailBus;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class MailBusProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            
            $schedule->command('mail_bus:process')
            ->everyMinute();
            
            $schedule->command('mail_bus:clear')
            ->hourly();
        });
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mail_bus', function () {
            return new MailBus();
        });

        $this->commands([
            Commands\ProcessMailBusCommand::class,
            Commands\ClearMailBusCommand::class
        ]);
    }
}