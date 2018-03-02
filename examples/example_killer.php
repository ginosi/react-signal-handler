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
