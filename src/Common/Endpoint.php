<?php

namespace CryptoMarkets\Common;

use Psr\Http\Message\ResponseInterface;

abstract class Endpoint
{
    /**
     * The request parameters.
     *
     * @var array
     */
    protected $params;

    /**
     * The HTTP client instance.
     *
     * @var \CryptoMarkets\Common\Client
     */
    protected $httpClient;

    /**
     * Determine if the request need authorized.
     *
     * @var bool
     */
    protected $authorize = false;

    /**
     * Create a new Endpoint instance.
     *
     * @param  \CryptoMarkets\Common\Client  $httpClient
     * @return void
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Configure the request parameters.
     *
     * @param  array  $params
     * @return $this
     */
    public function configure(array $params = [])
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Send a new request.
     *
     * @return array
     */
    public function send()
    {
        $request = $this->createRequest();

        $response = $this->httpClient->sendRequest($request);

        return $this->mapResponse((array) $this->parseResponse($response));
    }

    /**
     * Create a new request object.
     *
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createRequest()
    {
        return $this->httpClient->createRequest(
            $this->getMethod(),
            $this->getUrl(),
            $this->getPreparedHeaders(),
            $this->getPreparedData()
        );
    }

    /**
     * Get the request method.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'POST';
    }

    /**
     * Get the request url.
     *
     * @return string
     */
    abstract public function getUrl();

    /**
     * Get the request headers for authorized or not.
     *
     * @return array
     */
    public function getPreparedHeaders()
    {
        return $this->getHeaders();
    }

    /**
     * Get the request headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return [];
    }

    /**
     * Get the request data for authorized or not.
     *
     * @return string
     */
    public function getPreparedData()
    {
        $params = $this->getData();

        if ($this->authorize) {
            $params = array_merge($params, $this->authenticationData($params));
        }

        return $params;
    }

    /**
     * Get the request data.
     *
     * @return array
     */
    public function getData()
    {
        return [];
    }

    /**
     * Get the authentication request data.
     *
     * @return array
     */
    protected function authenticationData()
    {
        return [];
    }

    /**
     * Parse and normalize the raw response.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     * @return array
     */
    public function parseResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody(), true);
    }

    /**
     * Map the given array to create a response object.
     *
     * @param  array  $data
     * @return array
     */
    abstract public function mapResponse(array $data = []);
}
