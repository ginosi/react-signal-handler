<?php

namespace React\Signals\Killer;

class DummyKiller implements KillerInterface
{
    public function onExit(callable $callback)
    {
        $callback();
    }
}
