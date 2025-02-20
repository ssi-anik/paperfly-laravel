<?php

namespace Anik\Paperfly\Laravel;

use Anik\Paperfly\Client;

class MerchantAccount
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
