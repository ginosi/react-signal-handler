<?php

namespace React\Signals\Killer;

interface KillerInterface
{
    public function onExit(callable $callback);
}
