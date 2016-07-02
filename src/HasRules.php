<?php

namespace Artesaos\Shield;

use Artesaos\Shield\Exceptions\RulesNotDefined;
use Artesaos\Shield\Contracts\Rules;

trait HasRules
{
    /**
     * @return Rules
     */
    public static function rules()
    {
        $className = self::$rulesFrom;

        if (class_exists($className)) {
            return new $className();
        }

        throw new RulesNotDefined("Rules class {$className} do not exists.");
    }
}
