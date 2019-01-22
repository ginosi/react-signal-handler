# React-Signals

Unix signals handler for [React PHP](https://github.com/reactphp).

## Install

Add code snippet below to your composer.json file.

```
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/ginosi/react-signal-handler"
    }
  ]
```

And choose version you want to use

```
"ginosi/react-signal-handler": "^1.2"
```

## Usage

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();
$killer = new React\Signals\Killer\SerialKiller($loop, [SIGTERM, SIGINT]);

$loop->addPeriodicTimer(1, function () {
    echo '.';
});

$killer->onExit(function ($signo, $errno, $code) use ($loop) {
    echo sprintf('[%s] signal received. Waiting 5 seconds.', $signo) . PHP_EOL;
    // ...
    // Do some important stuff
    // ...

    shell_exec('exec sleep 5s');

    $loop->stop();
});

$loop->run();

```

