## Eleven PHP micro-framework

Eleven is a high-performance micro-framework for rapidly developing APIs in PHP. It's inspired by `passwalls/mark` but takes a slightly different approach.

### Install

`composer require jonbaldie/eleven`

### Usage

start.php

```php
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
```

Run command `php start.php start -d` 

Going to http://127.0.0.1:3000/hello/world will now display "Hello world".

### Available commands
```
php start.php restart -d
php start.php stop
php start.php status
php start.php connections
```
### Docker

I've used this package in thecodingmachine's excellent [PHP images](https://github.com/thecodingmachine/docker-images-php):

```
docker run -it -p 3000:3000 -e PHP_EXTENSION_REDIS=1 -v (pwd):/usr/src/app thecodingmachine/php:8.1-v4-cli bash

root@a6a4143b05cb:/usr/src/app# php start.php start -d
Workerman[start.php] start in DAEMON mode
----------------------------------------- WORKERMAN -----------------------------------------
Workerman version:4.0.26          PHP version:8.1.1
------------------------------------------ WORKERS ------------------------------------------
proto   user            worker          listen                 processes    status
tcp     root            none            http://0.0.0.0:3000    4             [OK]
---------------------------------------------------------------------------------------------
Input "php start.php stop" to stop. Start success.
```

