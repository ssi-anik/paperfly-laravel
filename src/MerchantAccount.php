<?php

namespace Anik\Paperfly\Laravel;

use Anik\Paperfly\Client;
use Anik\Paperfly\Response;
use Anik\Paperfly\Transfers\CancelOrder;
use Anik\Paperfly\Transfers\CreateOrder;
use Anik\Paperfly\Transfers\TrackOrder;

class MerchantAccount
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \Anik\Paperfly\Laravel\PaperflyException
     */
    public function createOrder($order): Response
    {
        if ($order instanceof CreateOrder) {
            return $this->client->gracefulTransfer($order);
        } elseif (is_array($order)) {
            return $this->client->gracefulTransfer(CreateOrder::buildFrom($order));
        }

        throw new PaperflyException(sprintf(
            'Create order accepts either an array or a "%s" object',
            CreateOrder::class
        ));
    }

    public function trackOrder(string $orderId): Response
    {
        return $this->client->gracefulTransfer(new TrackOrder($orderId));
    }
}
