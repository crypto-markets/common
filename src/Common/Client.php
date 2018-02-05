<?php

namespace CryptoMarkets\Common;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;

class Client implements RequestFactory
{
    /**
     * The implemented HTTP client instance.
     *
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * Create a new Client instance.
     *
     * @param  \Http\Client\HttpClient|null  $httpClient
     * @param  \Http\Message\RequestFactory|null  $requestFactory
     * @return void
     */
    public function __construct(HttpClient $httpClient = null, RequestFactory $requestFactory = null)
    {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * Creates a new PSR-7 request.
     *
     * @param  string  $method
     * @param  mixed  $uri
     * @param  array  $headers
     * @param  mixed  $body
     * @param  string  $protocol
     * @return \Psr\Http\Message\RequestInterface
     */
    public function createRequest($method, $uri, array $headers = [], $body = null, $protocol = '1.1')
    {
        if (is_array($body)) {
            $body = http_build_query($body, '', '&');
        }

        if ($method == 'GET') {
            $uri .= ((strpos('?', $uri) === false) ? '?' : '&').$body;
            $body = '';
        }

        return $this->requestFactory->createRequest($method, $uri, $headers, $body, $protocol);
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->httpClient->{$method}(...$parameters);
    }
}
