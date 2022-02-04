<?php

use Eleven\App;

require 'vendor/autoload.php';

$api = new App('http://0.0.0.0:3000');

$api->count = 4; // process count

$api->any('/', function ($request) {
    return 'Hello world';
});

$api->get('/hello/{name}', function ($request, $name) {
    return "Hello $name";
});

$api->post('/user/create', function ($request) {
    return json_encode(['code' => 200 ,'message' => 'OKAY'], JSON_PRETTY_PRINT);
});

$api->start();
