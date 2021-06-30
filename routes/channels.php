<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('wechat.group.main', function ($user) {
    return $user;
});

Broadcast::channel('wechat.group.{id}', function ($user, $id) {
    return ['userId' => mt_rand(1000, 9999)];
});
