<?php

namespace DevelopingW\WTrade\Classes;

/**
 * Class ApiCommand
 *
 * @package DevelopingW\WTrade\Classes
 */
class ApiCommand
{
    /**
     * @param string $apiName
     * @param string $apiKey
     * @param string|null $time
     *
     * @return null|string
     */
    public static function getApiCurrencyList(
        string $apiName = '',
        string $apiKey = '',
        string $time = null
    )
    {
        $params = [
            'action' => 'list',
        ];

        $time = $time ?? date('Y-m-d H:i:s');

        $apiUrl = 'http://wtrade-backend.w-develop.com/api/currency';

        return ApiConnect::get()
            ->setApiName($apiName)
            ->setApiKey($apiKey)
            ->setUrl($apiUrl)
            ->setParams($params)
            ->sendRequest($time);
    }

    /**
     * @param array $currencyCode
     * @param string $apiName
     * @param string $apiKey
     * @param string|null $time
     *
     * @return null|string
     */
    public static function getApiCurrencyExchange(
        array $currencyCode = ['USD', 'EUR', 'RUB', 'PLN', 'GBP', 'CHF'],
        string $apiName = '',
        string $apiKey = '',
        string $time = null)
    {
        $params = [
            'action' => 'exchange',
            'currencyCode' => $currencyCode,
        ];

        $time = $time ?? date('Y-m-d H:i:s');

        $apiUrl = 'http://wtrade-backend.w-develop.com/api/currency';
        return ApiConnect::get()
            ->setApiName($apiName)
            ->setApiKey($apiKey)
            ->setUrl($apiUrl)
            ->setParams($params)
            ->sendRequest($time);
    }
}