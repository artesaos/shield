<?php

namespace Artesaos\Shield\Contracts;

interface Rules
{
    /**
     * Get default rules.
     *
     * @return array
     */
    public function getDefaultRules();

    /**
     * Get creating rules.
     *
     * @return array
     */
    public function getCreatingRules();

    /**
     * Get updating rules.
     *
     * @return array
     */
    public function getUpdatingRules();

    /**
     * @return array
     */
    public function getMessages();

    /**
     * @param string $type
     *
     * @return array
     */
    public function byRequestType($type);
}
