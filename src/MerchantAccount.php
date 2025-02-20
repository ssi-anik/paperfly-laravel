<?php

namespace Anik\Paperfly\Laravel;

use Anik\Paperfly\Client;
use Anik\Paperfly\Response;
use Anik\Paperfly\Transfers\CreateOrder;

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
}
