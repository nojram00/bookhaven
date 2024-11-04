<?php

use App\Models\ActivityLog;
use App\Models\User;
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


Artisan::command('user-list', function(){

    $users = User::all();

    $this->comment($users);

})->purpose("Display All Users saved in the database");

Artisan::command('insert-log', function(){
    ActivityLog::create([
        'log' => 'created a sample log',
        'datetime' => now()
    ]);
});

Artisan::command('add-su', function(){
    User::factory()->create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('changeme'),
        'role' => 'admin'
    ]);

    $this->comment('Superuser created! \nname: Admin\nemail: admin@example.com\npassword: changeme');
})->purpose('Create a superuser');

