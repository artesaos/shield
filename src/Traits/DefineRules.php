<?php

namespace Artesaos\Shield\Traits;

use Artesaos\Shield\Contracts\Manager;

trait DefineRules
{
    /**
     * @param string $path
     * @param string $namespace
     *
     * @return Manager
     */
    protected function addRulesNamespace($path, $namespace)
    {
        return $this->getShield()
                    ->addRulesNamespace($path, $namespace);
    }

    /**
     * @return Manager;
     */
    protected function getShield()
    {
        return $this->app->make(Manager::class);
    }
}
