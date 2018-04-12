<?php

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;

class TestCase extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $app = new Container;
        $app->singleton('request', 'Illuminate\Http\Request');
        Facade::setFacadeApplication($app);
    }
}
