<?php

namespace Anik\Paperfly\Laravel;

use Anik\Paperfly\Client as PaperflyClient;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Contracts\Container\Container;

class PaperflyManager
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function config(string $key, $default = null)
    {
        return $this->container->make('config')->get($key, $default);
    }

    public function account(?string $account = null): MerchantAccount
    {
        $account ??= config('paperfly.default');
        $config = $this->config('paperfly.accounts.'.$account);

        if (false === ($binding = $config['client_resolver'] ?? false)) {
            return new MerchantAccount(PaperflyClient::useDefaultGuzzleClient(
                $config['username'],
                $config['password'],
                $config['required_header_value'],
                $config['required_header_key'],
                $config['base_url']
            ));
        }

        $guzzleClient = $this->container->make($binding, ['config' => $config]);

        if (!$guzzleClient instanceof GuzzleClient) {
            throw new PaperflyException(sprintf(
                'Returned instance of "paperfly.accounts.%s.client_resolver" is not an instance of "%s"',
                $account,
                GuzzleClient::class
            ));
        }

        return new MerchantAccount(new PaperflyClient($guzzleClient));
    }

    public function __call($method, $parameters)
    {
        return $this->account()->$method(...$parameters);
    }
}
