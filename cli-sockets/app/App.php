<?php

namespace App;

use App\Contracts\Handler;
use App\Exceptions\AmoIntegration\ExpectedCliOnly;
use App\Exceptions\AmoIntegration\UnresolvableTypeHandler;
use App\Services\Receiver;
use App\Services\Socket;
use App\Services\Transmitter;

class App
{
    /**
     * @var false|mixed|string
     */
    private $socketName;

    /**
     * @var \App\Services\Socket
     */
    private Socket $socket;

    /**
     * @var false|mixed|string
     */
    private $isReceiver;

    /**
     * @var false|mixed|string
     */
    private $isTransmitter;
    /**
     * @var \App\Services\Receiver
     */
    private Handler $handler;


    /**
     * @throws \App\Exceptions\AmoIntegration\ExpectedCliOnly
     * @throws \App\Exceptions\AmoIntegration\CantCreateSocket
     */
    public function __construct()
    {
        $phpSapiName = php_sapi_name();
        if ($phpSapiName !== 'cli') {
            throw new ExpectedCliOnly("Expected CLI call only, {$phpSapiName} received");
        }

        $this->initArgv();
        $this->initSigHandlers();

        // todo использовать DI-контейнер, если буду расширять любу(пока не буду)
        $this->socket = new Socket($this->socketName);

        if ($this->isReceiver && $this->isTransmitter) {
            throw new UnresolvableTypeHandler('I have both handlers type, but need only one');
        } elseif ($this->isReceiver) {
            $this->handler = new Receiver($this, $this->socket);
        } elseif ($this->isTransmitter) {
            $this->handler = new Transmitter($this, $this->socket);
        } else {
            throw new UnresolvableTypeHandler('I have no one handlers type, but need only one');
        }

        $this->handler->run();
    }

    /**
     *
     */
    private function initArgv()
    {
        $shortOpts = 's:rt';

        $longOpts = [
            "socket:",
            "receiver",
            "transmitter",
        ];


        $options = getopt($shortOpts, $longOpts);

        var_dump($options);
        $this->socketName = $options['s'] ?? ($options['socket'] ?? '');
        $this->isReceiver = (isset($options['r']) || isset($options['receiver']));
        $this->isTransmitter = (isset($options['t']) || isset($options['transmitter']));
    }

    /**
     *
     */
    private function initSigHandlers()
    {
        pcntl_async_signals(true);

        pcntl_signal(SIGTERM, [&$this, "sigHandler"]);
        pcntl_signal(SIGHUP, [&$this, "sigHandler"]);
        pcntl_signal(SIGUSR1, [&$this, "sigHandler"]);
    }

    /**
     * @param $sigCode
     */
    public static function sigHandler($sigCode)
    {
        switch ($sigCode) {
            case SIGTERM:
                echo "SIGTERM" . PHP_EOL;
                break;
            case SIGHUP:
                echo "SIGHUP" . PHP_EOL;
                break;
            case SIGUSR1:
                echo "SIGUSR1" . PHP_EOL;
                break;
            case SIGKILL:
                echo "SIGKILL" . PHP_EOL;
                break;
            default:
                echo "1" . PHP_EOL;
                break;
        }
    }


}