<?php

declare(strict_types=1);

namespace LauLamanApps\IzettleApi\Client;

use LauLamanApps\IzettleApi\API\Purchase\Purchase;
use LauLamanApps\IzettleApi\API\Purchase\PurchaseHistory;
use LauLamanApps\IzettleApi\Client\Exception\NotFoundException;
use LauLamanApps\IzettleApi\Client\Purchase\Exception\PurchaseNotFoundException;
use LauLamanApps\IzettleApi\Client\Purchase\PurchaseBuilderInterface;
use LauLamanApps\IzettleApi\Client\Purchase\PurchaseHistoryBuilderInterface;
use LauLamanApps\IzettleApi\IzettleClientInterface;
use Ramsey\Uuid\UuidInterface;

final class PurchaseClient
{
    const BASE_URL = 'https://purchase.izettle.com';

    const GET_PURCHASE = self::BASE_URL . '/purchase/v2/%s';
    const GET_PURCHASES = self::BASE_URL . '/purchases/v2';

    private $client;
    private $purchaseHistoryBuilder;
    private $purchaseBuilder;
    private $parameters = [];

    public function __construct(
        IzettleClientInterface $client,
        PurchaseHistoryBuilderInterface $purchaseHistoryBuilder,
        PurchaseBuilderInterface $purchaseBuilder
    ) {
        $this->client = $client;
        $this->purchaseHistoryBuilder = $purchaseHistoryBuilder;
        $this->purchaseBuilder = $purchaseBuilder;
    }

    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    public function limit(int $limit)
    {
        $this->setParameter('limit', $limit);
        return $this;
    }

    public function descending()
    {
        $this->setParameter('descending', 'true');
        return $this;
    }
    
    public function ascending()
    {
        $this->setParameter('descending', 'false');
        return $this;
    }

    public function getPurchasesUrl()
    {
        return self::GET_PURCHASES . '?' . http_build_query($this->parameters);
    }


    public function getPurchaseHistory(): PurchaseHistory
    {
        $json = $this->client->getJson($this->client->get($this->getPurchasesUrl()));
        return $this->purchaseHistoryBuilder->buildFromJson($json);
    }

    public function getPurchase(UuidInterface $uuid): Purchase
    {
        try {
            $response = $this->client->get(sprintf(self::GET_PURCHASE, (string) $uuid));
        } catch (NotFoundException $e) {
            throw new PurchaseNotFoundException($e->getMessage());
        }

        $json = $this->client->getJson($response);

        return $this->purchaseBuilder->buildFromJson($json);
    }
}
