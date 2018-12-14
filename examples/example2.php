<?php

require __DIR__ . '/../vendor/autoload.php';

$loop = React\EventLoop\Factory::create();
$signalHandler = new React\Signals\Handler($loop);

$signalHandler->on(SIGTERM, function ($signo, $errno, $code) {
    echo 'Terminated by SIGTERM' . PHP_EOL;
    echo 'Signo ' . $signo. PHP_EOL;
    echo 'Errno ' . $errno . PHP_EOL;
    echo 'Code ' . $code . PHP_EOL;

    exit;
});

$signalHandler->on(SIGINT, function ($signo, $errno, $code) {
    echo 'Terminated by console' . PHP_EOL;
    echo 'Signo ' . $signo. PHP_EOL;
    echo 'Errno ' . $errno . PHP_EOL;
    echo 'Code ' . $code . PHP_EOL;

    exit;
});

echo 'Started as PID ' . getmypid() . PHP_EOL;
$loop->run();
