<?php
namespace Larastarscn\AliDaYu\Facades;

use Illuminate\Support\Facades\Facade;
use Larastarscn\AliDaYu\Contracts\Factory;

class AliDaYu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
