<?php

require __DIR__ . '/../vendor/autoload.php';

$loop = React\EventLoop\Factory::create();
$signalHandler = new React\Signals\Handler($loop);

$signalHandler->on(SIGTERM, function () {
    // Clear some queue
    // Write syslog
    // Do ALL the stuff
    echo 'Bye' . PHP_EOL;
    exit;
});

$signalHandler->on(SIGINT, function () {
    echo 'Terminated by console' . PHP_EOL;
    exit;
});

echo 'Started as PID ' . getmypid() . PHP_EOL;
$loop->run();
