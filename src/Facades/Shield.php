<?php

namespace Artesaos\Shield\Facades;

use Illuminate\Support\Facades\Facade;

class Shield extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'shield';
    }
}
