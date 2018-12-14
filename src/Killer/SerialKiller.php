<?php

namespace React\Signals\Killer;

use React\EventLoop\LoopInterface;
use React\Signals\Handler;

class SerialKiller implements KillerInterface
{
    /**
     * @var LoopInterface
     */
    protected $loop;

    /**
     * @var Handler
     */
    protected $signalHandler;

    /**
     * @var int[]|array
     */
    protected $signals;

    /**
     * @var callable
     */
    protected $beforeUnload;

    public function __construct(LoopInterface $loop, array $signals)
    {
        $this->loop = $loop;
        $this->signals = $signals;
        $this->signalHandler = new Handler($loop);

        $this->setupSignalHandler();
    }

    public function onExit(callable $callback)
    {
        $this->beforeUnload = $callback;
    }

    private function setupSignalHandler()
    {
        foreach ($this->signals as $signal) {
            $this->signalHandler->on($signal, function ($signo, $errno, $code) {
                if (!is_callable($this->beforeUnload)) {
                    return;
                }

                ($this->beforeUnload)($signo, $errno, $code);
            });
        }
    }
}
