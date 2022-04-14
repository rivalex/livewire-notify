<?php

namespace Rivalex\LivewireNotify\Console\Commands;

use Illuminate\Console\Command;

class LivewireNotifyInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'livewire-notify:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Livewire Notify installation.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->table(['Livewire Notify'], [
            ['Simple notifications system with zero dependencies above TALL-stack.'],
            ["\nVisit site:\nhttps://github.com/rivalex/livewire-notify"]
        ]);
        $this->info('😎 Installing Livewire Notify …');
        if (!strpos(file_get_contents('./composer.json'), 'livewire/livewire')) {
            $this->comment('Please, make sure that livewire/livewire package is installed!');
            return 1;
        }
        $tailwind_config_path = './tailwind.config.js';
        if (!file_exists($tailwind_config_path)) {
            $this->comment('Please, make sure that Tailwind CSS is installed and tailwind.config.js file is in the project root folder!');
            return 1;
        } else {
            $tailwind_config = file_get_contents($tailwind_config_path);
            if (!strpos($tailwind_config, 'livewire-notify')) {
                $tailwind_config = preg_replace("#purge:\s*\[\n(.+)\]#imsU", "purge: [\n        \"./config/livewire-notify.php\",\n$1]", $tailwind_config);
                file_put_contents($tailwind_config_path, $tailwind_config);
            }
        }
        $this->call('vendor:publish', ['--tag'=>'livewire-notify.config']);
        $this->call('vendor:publish', ['--tag'=>'livewire-notify.views']);
        $this->info('🥳 Livewire Notify is installed!');
        return 0;
    }
}
