<?php
return [
    [
        'name' => 'home',
        'path' => '/',
        'middleware' => App\Action\HomePageAction::class,
        'method' => ['GET']
    ],
    [
        'name' => 'home.ping',
        'path' => '/ping',
        'middleware' => App\Action\PingAction::class,
        'method' => ['GET']
    ],
];