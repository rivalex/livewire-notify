<?php

namespace Rivalex\LivewireNotify\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Rivalex\LivewireNotify\LivewireNotifyServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        
        parent::setUp();
        // Factory::guessFactoryNamesUsing(
        //     fn (string $modelName) => 'Rivalex\\LivewireNotify\\Database\\Factories\\'.class_basename($modelName).'Factory'
        // );
        // $this->viewsDirectory = __DIR__.'/views';
    }
    
    protected function getPackageProviders($app)
    {
        return [
            LivewireNotifyServiceProvider::class,
            LivewireServiceProvider::class
        ];
    }
    // protected function overrideApplicationProviders($app)
    // {
    //     return [
    //         'Livewire' => 'Livewire\Livewire',
    //     ];
    // }
    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
        include_once __DIR__.'/../database/migrations/create_livewire_notify_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
