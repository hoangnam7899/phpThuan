<?php
namespace System;
class App extends route
{
    public function __construct()
    {
        parent::__construct();
        var_dump($this->controller);
    }
}