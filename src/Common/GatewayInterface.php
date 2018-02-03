<?php

namespace CryptoMarkets\Common;

interface GatewayInterface
{
    /**
     * Get the supported symbols.
     *
     * @param  array  $params
     * @return array
     */
    public function symbols(array $params = []);

    /**
     * Get the latest indicators for given symbol.
     *
     * @param  array  $params
     * @return array
     */
    public function ticker(array $params = []);

    /**
     * Get a list of bids and asks in the order book (depth) for given symbol.
     *
     * @param  array  $params
     * @return array
     */
    public function orderBook(array $params = []);

    /**
     * Get a list of the most recent trades for the given symbol.
     *
     * @param  array  $params
     * @return array
     */
    public function trades(array $params = []);

    /**
     * Get the user's balance report.
     *
     * @param  array  $params
     * @return array
     */
    public function balances(array $params = []);

    /**
     * Submit a new buy order.
     *
     * @param  array  $params
     * @return array
     */
    public function buy(array $params = []);

    /**
     * Submit a new sell order.
     *
     * @param  array  $params
     * @return array
     */
    public function sell(array $params = []);

    /**
     * Get the order status.
     *
     * @param  array  $params
     * @return array
     */
    public function status(array $params = []);

    /**
     * Cancel an order.
     *
     * @param  array  $params
     * @return array
     */
    public function cancel(array $params = []);

    /**
     * Get the user's open orders.
     *
     * @param  array  $params
     * @return array
     */
    public function openOrders(array $params = []);

    /**
     * Get the user's order histories.
     *
     * @param  array  $params
     * @return array
     */
    public function tradeHistory(array $params = []);
}
