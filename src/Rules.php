<?php

namespace Artesaos\Shield;

use Artesaos\Shield\Contracts\Rules as RulesContract;

class Rules implements RulesContract
{
    /**
     * @var array
     */
    private $rules;

    /**
     * @var array
     */
    private $messages;

    /**
     * Rules constructor.
     *
     * @param array $rules
     * @param array $messages
     */
    public function __construct(array $rules, array $messages = [])
    {
        $this->rules = $rules;
        $this->messages = $messages;
    }

    /**
     * Get default rules.
     *
     * @return array
     */
    public function getDefaultRules()
    {
        return array_get($this->rules, 'default', []);
    }

    /**
     * Get creating rules.
     *
     * @return array
     */
    public function getCreatingRules()
    {
        $creating = array_get($this->rules, 'creating', []);

        return array_merge($this->getDefaultRules(), $creating);
    }

    /**
     * Get updating rules.
     *
     * @return array
     */
    public function getUpdatingRules()
    {
        $creating = array_get($this->rules, 'updating', []);

        return array_merge($this->getDefaultRules(), $creating);
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param string $type
     *
     * @return array
     */
    public function byRequestType($type)
    {
        $type = mb_strtolower($type);

        switch ($type) {
            case 'post':
                return $this->getCreatingRules();
                break;
            case 'put':
                return $this->getUpdatingRules();
                break;
            default:
                return $this->getDefaultRules();
        }
    }
}
