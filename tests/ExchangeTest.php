<?php

namespace CryptoMarkets;

use Mockery as m;
use CryptoMarkets\Tests\TestCase;

class ExchangeTest extends TestCase
{
    public function tearDown()
    {
        Exchange::setFactory(null);
    }

    public function testGetFactory()
    {
        $factory = Exchange::getFactory();

        $this->assertInstanceOf(Common\GatewayFactory::class, $factory);
    }

    public function testSetFactory()
    {
        $factory = m::mock(Common\GatewayFactory::class);

        Exchange::setFactory($factory);

        $this->assertSame($factory, Exchange::getFactory());
    }

    public function testCallStatic()
    {
        $factory = m::mock(Common\GatewayFactory::class);

        $factory->shouldReceive('create')->with('foo')->once()->andReturn('bar');

        Exchange::setFactory($factory);

        $result = Exchange::create('foo');

        $this->assertSame('bar', $result);
    }
}
