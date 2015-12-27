# React-Signals

Unix signals handler for [React PHP](https://github.com/reactphp).

##Install

The best way to install this library is through [composer](http://getcomposer.org):

```Bash
$ composer require pahenrus/react-signals
```

## Usage

This library provides the PCNTL class which taskes an event loop and optionally the timer interval in which the PCNTL signals should be read as constructor arguments.
After initializing the class, you can use the on() method to register event listeners to PCNTL signals.

```php
$loop = React\EventLoop\Factory::create();
$signalsHandler = new Reac\Signals\Handler($loop);

$signalsHandler->on(SIGTERM, function () {
    // Clear some queue
    // Write syslog
    // Do ALL the stuff
    echo 'Bye'.PHP_EOL;
    die();
});

$signalsHandler->on(SIGINT, function () {
    echo 'Terminated by console'.PHP_EOL;
    die();
});

echo 'Started as PID '.getmypid().PHP_EOL;
$loop->run();

```

