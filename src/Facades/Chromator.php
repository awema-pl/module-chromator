<?php

namespace AwemaPL\Chromator\Facades;

use AwemaPL\Chromator\Contracts\Chromator as ChromatorContract;
use Illuminate\Support\Facades\Facade;

class Chromator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ChromatorContract::class;
    }
}
