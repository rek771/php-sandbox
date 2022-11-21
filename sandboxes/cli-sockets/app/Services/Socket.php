<?php

namespace App\Services;

use App\Exceptions\AmoIntegration\CantCreateSocket;

class Socket
{
    /**
     * @var false|resource
     */
    private $sock;
    private $socketName;

    /**
     * @param $socketName
     * @throws \App\Exceptions\AmoIntegration\CantCreateSocket
     */
    public function __construct($socketName)
    {
        // todo сделать обработку создания и менеджинга сокета
        $this->socketName = $socketName;
        $this->sock = $socketName;
    }

    /**
     * @param $message
     */
    public function send($message)
    {
        // todo realise
    }

    /**
     * @return false|string
     */
    public function get()
    {
        // todo realise

        return 'message';
    }
}