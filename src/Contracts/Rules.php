<?php

namespace Artesaos\Shield\Contracts;

interface Rules
{
    /**
     * @return mixed
     */
    public function defaultRules();

    /**
     * @param string $type
     *
     * @return array
     */
    public function byRequestType($type);
}
