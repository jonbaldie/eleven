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
# To restart the worker threads:
php start.php restart -d

# To stop the worker threads:
php start.php stop

# To get a pretty status table:
php start.php status

# To see a list of active connections:
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
### Caveats

Storing your application in memory is a great way to get a massive speed boost and unbelievable resource efficiency. 

But if you don't manage your application's state well, then you will start to see weird issues from data in one session leaking into another session.

This is why I try to avoid shared state and the use of static variables in PHP. These are very convenient when trying to rapidly build a project, but they will bite you in the rear at a later date, usually when you are least prepared for it!

You will write your best code when following the concept of a pure, deterministic state in your application, even if you don't subscribe fully to the paradigm of functional programming.

I love functional programming and think it is a great way to keep your code testable and maintainable - I even created a [separate PHP micro-framework](https://github.com/jonbaldie/functions) around those principles.
