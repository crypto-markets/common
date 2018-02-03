<?php

namespace CryptoMarkets\Common;

use InvalidArgumentException;

class GatewayFactory
{
    /**
     * Create an instance of the specified market driver.
     *
     * @param  string  $abstract
     * @param  array  $options
     * @return \CryptoMarkets\Common\Gateway
     *
     * @throws \InvalidArgumentException
     */
    public function create($abstract, array $options = [])
    {
        $concrete = $this->getConcrete($abstract);

        if (class_exists($concrete)) {
            return new $concrete($options);
        }

        throw new InvalidArgumentException("The gateway of [$abstract] not supported.");
    }

    /**
     * Get the concrete type for a given abstract.
     *
     * @param  string  $abstract
     * @return string
     */
    public function getConcrete($abstract)
    {
        if (0 === strpos($abstract, '\\')) {
            return $abstract;
        }

        $abstract = str_replace('_', '\\', $abstract);

        if (false === strpos($abstract, '\\')) {
            $abstract .= '\\';
        }

        return '\\CryptoMarkets\\'.$abstract.'Gateway';
    }
}
