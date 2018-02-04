<?php

namespace CryptoMarkets\Common;

interface GatewayInterface
{
    /**
     * Get the supported symbols.
     *
     * @return array
     */
    public function symbols();

    /**
     * Get the latest indicators for given symbol.
     *
     * @param  string  $symbol
     * @return array
     */
    public function ticker($symbol);

    /**
     * Get a list of bids and asks in the order book (depth) for given symbol.
     *
     * @param  string  $symbol
     * @param  int  $limit
     * @return array
     */
    public function orderBook($symbol, $limit = 50);

    /**
     * Get a list of the most recent trades for the given symbol.
     *
     * @param  string  $symbol
     * @param  int  $limit
     * @return array
     */
    public function trades($symbol, $limit = 50);

    /**
     * Get the user's balance report.
     *
     * @return array
     */
    public function balances();

    /**
     * Submit a new buy order.
     *
     * @param  string  $symbol
     * @param  float  $amount
     * @param  float  $price
     * @return array
     */
    public function buy($symbol, $amount, $price);

    /**
     * Submit a new sell order.
     *
     * @param  string  $symbol
     * @param  float  $amount
     * @param  float  $price
     * @return array
     */
    public function sell($symbol, $amount, $price);

    /**
     * Get the order status.
     *
     * @param  string  $symbol
     * @param  string  $id
     * @return array
     */
    public function status($symbol, $id);

    /**
     * Cancel an order.
     *
     * @param  string  $symbol
     * @param  string  $id
     * @return array
     */
    public function cancel($symbol, $id);

    /**
     * Get the user's open orders.
     *
     * @param  string|null  $symbol
     * @return array
     */
    public function openOrders($symbol = null);

    /**
     * Get the user's order histories.
     *
     * @param  string|null  $symbol
     * @return array
     */
    public function tradeHistory($symbol = null);
}
