<?php

namespace Artesaos\Shield\Traits;

use Artesaos\Shield\Rules;

trait HasRules
{
    /**
     * @return Rules
     */
    public static function getRules()
    {
        return app('shield')->getRules(self::rulesKey);
    }
}
