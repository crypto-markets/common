<?php

namespace CryptoMarkets;

use CryptoMarkets\Common\GatewayFactory;

class Exchange
{
    /**
     * The gateway factory instance.
     *
     * @var GatewayFactory
     */
    private static $factory;

    /**
     * Get the gateway factory instance.
     *
     * @return GatewayFactory
     */
    public static function getFactory()
    {
        if (is_null(self::$factory)) {
            self::$factory = new GatewayFactory;
        }

        return self::$factory;
    }

    /**
     * Set the gateway factory instance.
     *
     * @param  GatewayFactory
     * @return void
     */
    public static function setFactory(GatewayFactory $factory = null)
    {
        self::$factory = $factory;
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (self::getFactory())->$method(...$parameters);
    }
}
