<?php

namespace App\Contracts;

use App\App;
use App\Services\Socket;

interface Handler
{
    /**
     * @param \App\App $app
     * @param \App\Services\Socket $socket
     */
    public function __construct(App $app, Socket $socket);

    /**
     * Запускает выполнение обработчика
     */
    public function run(): void;
}