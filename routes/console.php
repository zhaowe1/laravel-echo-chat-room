<?php

use App\User;
use Illuminate\Foundation\Inspiring;

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
})->describe('Display an inspiring quote');

Artisan::command('send:private:msg', function () {
    broadcast(new \App\Events\UserSendMessage(User::find(1), 'console msg', 'main'));
//    broadcast(new \App\Events\UserEnterGroup(1, 1));
});

Artisan::command('send:public:msg', function () {
    broadcast(new \App\Events\ExampleEvent);
});
