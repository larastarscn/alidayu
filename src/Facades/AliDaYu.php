<?php
namespace Larastarscn\AliDaYu\Facades;

use Illuminate\Support\Facades\Facade;
use Larastarscn\AliDaYu\Contracts\Factory;


class AliDaYu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
