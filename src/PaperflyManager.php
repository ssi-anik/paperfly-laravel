<?php

namespace Anik\Paperfly\Laravel;

use Illuminate\Contracts\Container\Container;

class PaperflyManager
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
