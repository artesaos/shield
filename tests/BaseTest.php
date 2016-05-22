<?php

namespace Artesaos\Shield\Tests;

use Orchestra\Testbench\TestCase;
use Mockery as m;

abstract class BaseTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    public function setUp()
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [\Artesaos\Shield\ShieldServiceProvider::class];
    }
}
