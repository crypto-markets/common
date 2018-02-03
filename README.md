# Common

[![Latest Version on Packagist](https://img.shields.io/packagist/v/crypto-markets/common.svg?style=flat-square)](https://packagist.org/packages/crypto-markets/common)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/crypto-markets/common/master.svg?style=flat-square)](https://travis-ci.org/crypto-markets/common)
[![Quality Score](https://img.shields.io/scrutinizer/g/crypto-markets/common.svg?style=flat-square)](https://scrutinizer-ci.com/g/crypto-markets/common)
[![StyleCI](https://styleci.io/repos/119222585/shield?branch=master)](https://styleci.io/repos/119222585)
[![Total Downloads](https://img.shields.io/packagist/dt/crypto-markets/common.svg?style=flat-square)](https://packagist.org/packages/crypto-markets/common)

## Introduction

We are accepting new adapters.

## Documentation

The "Common" package is without a function in its own right. The package keep and manage the common functionality for other market libraries.

Let's pick a random market package to figure out how to use it. I choose the Binance package for this. You are feel free to use what you want.

```bash
composer require crypto-markets/binance
```

All market packages contains the same request and response to maintain consistency. Only the configuration and some parameter values may be different.

Let's start by creating a new instance:

```php
use CryptoMarkets\Exchange;

$market = Exchange::create('Binance', [
    'api_key' => 'YOUR-APIKEY',
    'secret'  => 'YOUR-SECRET',
]);
```

In the above example, the Binance instance was created by configuring.

### Supported Common Methods

In this section, we will explain the supported methods that the market instance:

| Method        | Description                                                  |
| ------------- | ------------------------------------------------------------ |
| getName       | Get the market name.                                         |
| symbols       | Get the supported symbols.                                   |
| ticker        | Get the latest indicators.                                   |
| orderBook     | Get a list of bids and asks in the order book (depth).       |
| trades        | Get a list of the most recent trades.                        |
| balances      | Get the user's balance informations.                         |
| buy           | Create a new buy trade.                                      |
| sell          | Create a new sell trade.                                     |
| status        | Get the order status.                                        |
| cancel        | Cancel an order.                                             |
| openOrders    | Get the user's open orders.                                  |
| tradeHistory  | Get the user's order histories.                              |

## Testing

You will need an install of [Composer](https://getcomposer.org/) before continuing.

First, install the dependencies:

```bash
$ composer install
```

Then run PHPUnit:

```bash
$ vendor/bin/phpunit
```

If the test suite passes on your local machine you should be good to go.

When you make a pull request, the tests will automatically be run again by [Travis CI](https://travis-ci.org/).

We also have [StyleCI](https://styleci.io/) setup to automatically fix any code style issues.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

If you discover any security related issues, please create a new issue with using the "Bug" label. All security vulnerabilities will be promptly addressed.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
