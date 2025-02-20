<?php

namespace Anik\Paperfly\Laravel;

use Illuminate\Support\Facades\Facade;

class Paperfly extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'paperfly';
    }
}
