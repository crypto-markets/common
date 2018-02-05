<?php

namespace CryptoMarkets\Common;

abstract class Gateway implements GatewayInterface
{
    /**
     * The HTTP client instance.
     *
     * @var \CryptoMarkets\Common\Client
     */
    protected $httpClient;

    /**
     * The gateway's options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * Create a new Gateway instance.
     *
     * @param  array  $options
     * @return void
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Merge the custom options with the defaults.
     *
     * @param  array  $options
     * @return void
     */
    public function setOptions(array $options = [])
    {
        $this->options = array_replace($this->getDefaultOptions(), $options);
    }

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * et the specified option value (if any).
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function getOption($key, $default = null)
    {
        return $this->options[$key];
    }

    /**
     * Get the default options.
     *
     * @return array
     */
    public function getDefaultOptions()
    {
        return [];
    }

    /**
     * Get the gateway name.
     *
     * @return string
     */
    abstract public function getName();

    /**
     * Create a new request object.
     *
     * @param  string  $class
     * @param  array  $params
     * @return \CryptoMarkets\Common\Http\Request
     */
    public function createRequest($class, array $params = [])
    {
        $instance = new $class($this->getHttpClient());

        return $instance->configure(array_replace($this->getOptions(), $params));
    }

    /**
     * Get a instance of the HTTP client.
     *
     * @return \CryptoMarkets\Common\Client
     */
    public function getHttpClient()
    {
        if (is_null($this->httpClient)) {
            $this->setHttpClient(new Client);
        }

        return $this->httpClient;
    }

    /**
     * Set the HTTP client instance.
     *
     * @param  \CryptoMarkets\Common\Client  $client
     * @return $this
     */
    public function setHttpClient(Client $client)
    {
        $this->httpClient = $client;

        return $this;
    }
}
