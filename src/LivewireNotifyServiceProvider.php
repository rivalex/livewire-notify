<?php

namespace Rivalex\LivewireNotify;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Rivalex\LivewireNotify\Console\Commands\LivewireNotifyInstall;
use Rivalex\LivewireNotify\Http\Livewire\Notify;
use Rivalex\LivewireNotify\Http\Livewire\NotifyMessage;

class LivewireNotifyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        Livewire::component('notify', Notify::class);
        Livewire::component('notify-message', NotifyMessage::class);
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-notify');
 
    }
    
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/livewire-notify.php', 'livewire-notify');
    }

    // /**
    //  * Get the services provided by the provider.
    //  *
    //  * @return array
    //  */
    // public function provides()
    // {
    //     return ['livewire-notify'];
    // }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/livewire-notify.php' => config_path('livewire-notify.php'),
        ], 'livewire-notify.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/livewire-notify'),
        ], 'livewire-notify.views');

        // Registering package commands.
        $this->commands([LivewireNotifyInstall::class]);
    }
}
