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
    if(!File::exists(database_path('database.sqlite'))){
        touch(database_path('database.sqlite'));
        $this->info('The empty sqlite file has been created. You may now run:');
        $this->line('php artisan migrate --seed');
        $this->info('');
    }
    else $this->info('database.sqlite exists.');
})->purpose('Build the app initially for testing');

