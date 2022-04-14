<?php

it('has console/command/install page', function () {
    $artisan = $this->artisan('livewire-notify:install');
    // $artisan->expectsOutput("Livewire Notify is installed");
    $artisan->assertExitCode(1);
    
});
