<?php

namespace Anik\Paperfly\Laravel\Facades;

use Anik\Paperfly\Laravel\MerchantAccount;
use Anik\Paperfly\Response;
use Anik\Paperfly\Transfers\CreateOrder;
use Illuminate\Support\Facades\Facade;

/**
 * @method static MerchantAccount account(?string $account)
 * @method static Response createOrder(CreateOrder|array $order)
 * @method static Response trackOrder(string $orderId)
 * @method static Response cancelOrder(string $orderId)
 */
class Paperfly extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'paperfly';
    }
}
