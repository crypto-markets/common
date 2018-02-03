<?php

namespace CryptoMarkets\Common;

use CryptoMarkets\Tests\TestCase;

class EndpointTest extends TestCase
{
    public function setUp()
    {
        $this->publicEndpoint = new PublicEndpoint($this->getHttpClient());
        $this->protectedEndpoint = new ProtectedEndpoint($this->getHttpClient());
    }

    public function testMethod()
    {
        $this->assertSame('POST', $this->publicEndpoint->getMethod());
        $this->assertSame('POST', $this->protectedEndpoint->getMethod());
    }

    public function testUrl()
    {
        $this->assertSame('localhost', $this->publicEndpoint->getUrl());
        $this->assertSame('localhost', $this->protectedEndpoint->getUrl());
    }

    public function testHeaders()
    {
        $this->assertSame(['foo' => 'bar'], $this->publicEndpoint->getHeaders());
        $this->assertSame(['foo' => 'bar'], $this->protectedEndpoint->getHeaders());
    }

    public function testPreparedHeaders()
    {
        $this->assertSame(['foo' => 'bar'], $this->publicEndpoint->getPreparedHeaders());
        $this->assertSame(['foo' => 'bar'], $this->protectedEndpoint->getPreparedHeaders());
    }

    public function testData()
    {
        $this->assertSame(['symbol' => 'ETHUSDT'], $this->publicEndpoint->getData());
        $this->assertSame(['symbol' => 'ETHUSDT'], $this->protectedEndpoint->getData());
    }

    public function testPreparedData()
    {
        $this->assertSame(['symbol' => 'ETHUSDT'], $this->publicEndpoint->getPreparedData());
        $this->assertSame(['symbol' => 'ETHUSDT', 'token' => 'secret'], $this->protectedEndpoint->getPreparedData());
    }

    public function testResponse()
    {
        $this->setMockHttpResponse('Example.txt');

        $response = $this->publicEndpoint->send();

        $this->assertSame(['foo' => 'bar'], $response);
    }
}

abstract class BaseEndpoint extends Endpoint
{
    public function getUrl()
    {
        return 'localhost';
    }

    public function getHeaders()
    {
        return array_replace(parent::getHeaders(), [
            'foo' => 'bar',
        ]);
    }

    protected function authenticationData()
    {
        return array_merge(parent::authenticationData(), ['token' => 'secret']);
    }

    public function mapResponse(array $data = [])
    {
        return $data;
    }

    public function getData()
    {
        return array_merge(parent::getData(), ['symbol' => 'ETHUSDT']);
    }
}

class PublicEndpoint extends BaseEndpoint
{
    protected $authorize = false;
}

class ProtectedEndpoint extends BaseEndpoint
{
    protected $authorize = true;
}
