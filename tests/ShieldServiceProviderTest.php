<?php

namespace Artesaos\Shield\Tests;

class ShieldServiceProviderTest extends BaseTest
{
    /**
     * Verify if classes are in service container.
     *
     * @dataProvider bindsListProvider
     *
     * @param string $contract
     * @param string $concreteClass
     */
    public function test_container_are_provided($contract, $concreteClass)
    {
        $this->assertInstanceOf(
            $contract,
            $this->app[$concreteClass]
        );
    }

    /**
     * @return array
     */
    public function bindsListProvider()
    {
        return [
            [
                \Artesaos\Shield\Contracts\Manager::class,
                \Artesaos\Shield\Manager::class,
            ], [
                \Artesaos\Shield\Manager::class,
                \Artesaos\Shield\Contracts\Manager::class,
            ],
            [
                \Artesaos\Shield\Manager::class,
                'shield',
            ],
            [
                \Artesaos\Shield\Contracts\Manager::class,
                'shield',
            ],
        ];
    }
}
