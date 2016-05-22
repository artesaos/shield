<?php

namespace Artesaos\Shield\Contracts;

use Artesaos\Shield\Rules;

interface Manager
{
    const HINT_PATH_DELIMITER = '::';

    /**
     * @param $name
     *
     * @return Rules
     */
    public function getRules($name);

    /**
     * @param string $path
     * @param string $namespace
     *
     * @return Manager
     */
    public function addRulesNamespace($path, $namespace);
}
