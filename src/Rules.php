<?php

namespace Artesaos\Shield;

use Artesaos\Shield\Contracts\Rules as RulesContract;

class Rules implements RulesContract
{
    public function defaultRules()
    {
        return [];
    }

    protected function returnRules(array $rules = [])
    {
        return array_merge($this->defaultRules(), $rules);
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
                return method_exists($this, 'creating') ? $this->creating() : [];
                break;
            case 'put':
                return method_exists($this, 'updating') ? $this->updating() : [];
                break;
            default:
                return $this->defaultRules();
        }
    }
}
