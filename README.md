# React-Signals

Unix signals handler for [React PHP](https://github.com/reactphp).

## Install

The best way to install this library is through [composer](http://getcomposer.org):

```Bash
$ composer require jiromm/react-signal-handler
```

## Usage

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();
$killer = new React\Signals\Killer\SerialKiller($loop, [SIGTERM, SIGINT]);

$loop->addPeriodicTimer(1,function () {
    echo '.';
});

$killer->onExit(function ($signal) use ($loop) {
    echo sprintf('[%s] signal received. Waiting 5 seconds.', $signal) . PHP_EOL;
    // ...
    // Do some important stuff
    // ...

    shell_exec('exec sleep 5s');

    $loop->stop();
});

$loop->run();

```

