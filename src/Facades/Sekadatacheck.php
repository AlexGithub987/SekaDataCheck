<?php

namespace AlexGithub987\Sekadatacheck\Facades;

use Illuminate\Support\Facades\Facade;

class Sekadatacheck extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sekadatacheck';
    }
}
