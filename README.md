## Eleven PHP micro-framework

Eleven is a high-performance micro-framework for rapidly developing APIs in PHP. It's inspired by `passwalls/mark` but takes a slightly different approach.

### Install

```
composer require jonbaldie/eleven
```
### Usage

start.php

```php
<?php

use Eleven\App;

require 'vendor/autoload.php';

$api = new App('http://0.0.0.0:3000');

$api->count = 4; // process count

$api->any('/', function ($requst) {
    return 'Hello world';
});

$api->get('/hello/{name}', function ($requst, $name) {
    return "Hello $name";
});

$api->post('/user/create', function ($requst) {
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

