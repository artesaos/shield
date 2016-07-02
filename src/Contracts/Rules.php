<?php

namespace Artesaos\Shield\Contracts;

interface Rules
{
    /**
     * @return mixed
     */
    public function defaultRules();

    /**
     * @return mixed
     */
    public function returnRules();

    /**
     * @param string $type
     *
     * @return array
     */
    public function byRequestType($type);
}
