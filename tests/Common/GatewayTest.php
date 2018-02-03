<?php

namespace CryptoMarkets\Common;

use Mockery as m;
use CryptoMarkets\Tests\TestCase;

class GatewayTest extends TestCase
{
    public function testConstructEmpty()
    {
        $gateway = new MockGateway;

        $this->assertSame([], $gateway->getOptions());
        $this->assertSame([], $gateway->getDefaultOptions());
    }

    public function testConstructWithOptions()
    {
        $options = ['api_key' => 'foo', 'secret' => 'bar'];

        $gateway = new MockGateway($options);

        $this->assertSame($options, $gateway->getOptions());
        $this->assertSame('bar', $gateway->getOption('secret'));
    }

    public function testDefaultOptions()
    {
        $options = ['api_key' => 'foo', 'secret' => 'bar'];

        $gateway = m::mock(MockGateway::class)->makePartial();
        $gateway->shouldReceive('getDefaultOptions')
                      ->once()
                      ->andReturn($options);

        $gateway->setOptions();

        $this->assertSame($options, $gateway->getOptions());
        $this->assertSame('bar', $gateway->getOption('secret'));
    }

    public function testSetOptions()
    {
        $options = ['api_key' => 'foo', 'secret' => 'bar'];

        $gateway = new MockGateway;
        $gateway->setOptions($options);

        $this->assertSame($options, $gateway->getOptions());
        $this->assertSame('bar', $gateway->getOption('secret'));
    }

    public function testCreateRequest()
    {
        $gateway = new MockGateway;
        $request = $gateway->example(['symbol' => 'ETHUSDT', 'amount' => 0.2]);

        $this->assertSame(['symbol' => 'ETHUSDT'], $request->getData());
    }

    public function testHttpClient()
    {
        $gateway = new MockGateway;

        $this->assertInstanceOf(Client::class, $gateway->getHttpClient());
    }

    public function testName()
    {
        $gateway = new MockGateway;

        $this->assertSame('Mock', $gateway->getName());
    }
}

class MockGateway extends Gateway
{
    public function getName()
    {
        return 'Mock';
    }

    public function example(array $params = [])
    {
        return $this->createRequest(MockEndpoint::class, $params);
    }
}

class MockEndpoint extends Endpoint
{
    public function getUrl()
    {
        return 'localhost';
    }

    public function mapResponse(array $data = [])
    {
        return $data;
    }

    public function getData()
    {
        return ['symbol' => $this->params['symbol']];
    }
}
