<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('build-app', function () {
    $this->call('key:generate');
    dd(env('APP_KEY'));
    if(!File::exists(database_path('database.sqlite'))){
        touch(database_path('database.sqlite'));
        $this->info('The empty sqlite file has been created.');
    }
    else $this->info('database.sqlite exists.');

    if(!File::exists(base_path('.env'))){
        touch(base_path('.env'));
        $this->info('An empty .env file has been created. This is to allow the configured defaults in repo to take presedence over the values in .env.example');
        $this->info('This allows CI deployments to selectively cycle app keys');

        if(!env('APP_KEY')){
            $this->info("The app key hasn'nt been set. Confirm below if you'd like to set it.");
            $this->call('key:generate');
        }
    }

    $this->info('You may now run:');
    $this->line('php artisan migrate --seed');
    $this->line('composer run-script post-create-project-cmd');
    $this->info('');

})->purpose('Build the app initially for testing');

