<?php

namespace CryptoMarkets\Common;

use Mockery as m;
use CryptoMarkets\Tests\TestCase;

class GatewayFactoryTest extends TestCase
{
    public function setUp()
    {
        $this->factory = new GatewayFactory;
    }

    public function testCreateFullyQualified()
    {
        m::mock('alias:\\CryptoMarkets\\Mock\\Gateway');

        $gateway = $this->factory->create('Mock');

        $this->assertInstanceOf('\\CryptoMarkets\\Mock\\Gateway', $gateway);
    }

    public function testCreateSpecifiedPath()
    {
        m::mock('alias:\\Mock');

        $gateway = $this->factory->create('\Mock');

        $this->assertInstanceOf('\\Mock', $gateway);
    }

    public function testCreatePsrZero()
    {
        m::mock('alias:\\CryptoMarkets\\Mock\\SocketGateway');

        $gateway = $this->factory->create('Mock_Socket');

        $this->assertInstanceOf('\\CryptoMarkets\\Mock\\SocketGateway', $gateway);
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The gateway of [Unknown] not supported.
     */
    public function testCreateInvalid()
    {
        $gateway = $this->factory->create('Unknown');
    }
}
