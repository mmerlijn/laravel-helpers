<?php

namespace mmerlijn\laravelHelpers\Facades;


class Flash extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'flash';
    }
}