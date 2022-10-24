<?php

namespace App\Services;

use App\App;
use App\Contracts\Handler;

class Receiver implements Handler
{
    /**
     * @var \App\App
     */
    private App $app;
    /**
     * @var \App\Services\Socket
     */
    private Socket $socket;

    /**
     * @inheritdoc
     */
    public function __construct(App $app, Socket $socket)
    {
        $this->app = $app;
        $this->socket = $socket;
    }

    /**
     * @inheritdoc
     */
    public function run(): void
    {
        print($this->socket->get());
    }
}