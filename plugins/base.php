<?php

namespace Docnet\Plugins;

abstract class Base
{
    /**
     * Use this variable to get to key parts of the app.
     * Ex: $this->app->database()
     *
     * @var $app Object Instance of the application
     */
    protected $app;

    final public function __construct(\App $app)
    {
        $this->app = $app;

        $this->init();
    }

    /**
     * Base function which child classes can use to run things after the main constructor has run
     */
    protected function _init()
    {
    }
}