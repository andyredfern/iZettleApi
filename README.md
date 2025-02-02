iZettle Api
===============
The iZettle Api provides a simple integration of the [iZettle Api][izettleapi] for your PHP project.

[![Build Status](https://travis-ci.org/LauLamanApps/iZettleApi.svg?branch=master)](https://travis-ci.org/LauLamanApps/iZettleApi)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LauLamanApps/iZettleApi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LauLamanApps/iZettleApi/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/LauLamanApps/iZettleApi/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/LauLamanApps/iZettleApi/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/laulamanapps/Izettle-api/v/stable)](https://packagist.org/packages/laulamanapps/izettle-api)
[![License](https://poser.pugx.org/laulamanapps/Izettle-api/license)](https://packagist.org/packages/laulamanapps/izettle-api)

Installation
------------
With [composer](http://packagist.org), add:

```bash
$ composer require laulamanapps/izettle-api
```

Run Tests
------------
To make sure everyting works you can run tests:

```bash
$ make unit-tests 
$ make integration-tests 
```

Usage
-----

Get yourself an access token. you'll need an `clientId` and `clientSecret` for this (to get one apply [here](https://www.izettle.com/api-access/))
for performance benefits, it might be wise to store the access token in a cache like [Redis](https://redis.io/).
```php
use GuzzleHttp\Client;
use LauLamanApps\IzettleApi\GuzzleIzettleClient;
use LauLamanApps\IzettleApi\IzettleClientFactory;

$izettleClient = new GuzzleIzettleClient(new Client(), 'clientId', 'clientSecret');
$accessToken = $izettleClient->getAccessTokenFromUserLogin('john.doe@example.com', 'password');

//-- store $accessToken in cache

$productClient = IzettleClientFactory::getProductClient($iZettleClient);
$library = $productClient->getLibrary();
```

### Make call with existing AccessToken

```php
use GuzzleHttp\Client;
use LauLamanApps\IzettleApi\GuzzleIzettleClient;
use LauLamanApps\IzettleApi\IzettleClientFactory;

$accessToken = ...; //-- Get from cache

$izettleClient = new GuzzleIzettleClient(new Client(), 'clientId', 'clientSecret');
$izettleClient->setAccessToken($accessToken);

$purchaseClient = IzettleClientFactory::getPurchaseClient($iZettleClient);
$library = $purchaseClient->getPurchaseHistory();
```

### Make call with an admin created Assertion
For a single merchant account access, create a token in the Inetgrations > Api section and use that as the supplied Assertion to access permitted end points.
```php
use GuzzleHttp\Client;
use LauLamanApps\IzettleApi\GuzzleIzettleClient;
use LauLamanApps\IzettleApi\IzettleClientFactory;

$iZettleClient = new GuzzleIzettleClient(new Client(), 'clientId','clientSecret');

$accessToken = $iZettleClient->getAccessTokenFromApiTokenAssertion('SECRET_API_KEY');

$purchaseClient = IzettleClientFactory::getPurchaseClient($iZettleClient);

$library = $purchaseClient->getPurchaseHistory();
```




Credits
-------

iZettle Api has been developed by [LauLaman][LauLaman].

[izettleapi]: https://github.com/iZettle/api-documentation
[LauLaman]: https://github.com/LauLaman
