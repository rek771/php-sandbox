<?php
namespace App;

class App
{
    private HttpController $controller;

    public function __construct()
    {
        $this->controller = new HttpController();
    }

    public function run()
    {
        // Maybe later be another runner
        $this->controller->run();
    }
}