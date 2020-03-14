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
     * @param string $apiUrl
     * @param string $apiName
     * @param string $apiKey
     * @param string|null $time
     *
     * @return null|string
     */
    public static function getApiDocumentsList(
        string $apiUrl = '',
        string $apiName = '',
        string $apiKey = '',
        string $time = null
    )
    {
        $params = [
            'action' => 'list',
        ];

        $time = $time ?? date('Y-m-d H:i:s');

        $apiUrl = $apiUrl.'/api/documents';

        return ApiConnect::get()
            ->setApiName($apiName)
            ->setApiKey($apiKey)
            ->setUrl($apiUrl)
            ->setParams($params)
            ->sendRequest($time);
    }

    /**
     * @param int $docObjId
     * @param string $apiUrl
     * @param string $apiName
     * @param string $apiKey
     * @param string|null $time
     *
     * @return null|string
     */
    public static function getApiDocumentProducts(
        int $docObjId = 0,
        string $apiUrl = '',
        string $apiName = '',
        string $apiKey = '',
        string $time = null
    )
    {
        $params = [
            'action' => 'products',
            'docObjId' => $docObjId
        ];

        $time = $time ?? date('Y-m-d H:i:s');

        $apiUrl = $apiUrl.'/api/document';

        return ApiConnect::get()
            ->setApiName($apiName)
            ->setApiKey($apiKey)
            ->setUrl($apiUrl)
            ->setParams($params)
            ->sendRequest($time);
    }

    /**
     * @param string $apiUrl
     * @param string $apiName
     * @param string $apiKey
     * @param string|null $time
     *
     * @return null|string
     */
    public static function getApiCurrencyList(
        string $apiUrl = '',
        string $apiName = '',
        string $apiKey = '',
        string $time = null
    )
    {
        $params = [
            'action' => 'list',
        ];

        $time = $time ?? date('Y-m-d H:i:s');

        $apiUrl = $apiUrl.'/api/currency';

        return ApiConnect::get()
            ->setApiName($apiName)
            ->setApiKey($apiKey)
            ->setUrl($apiUrl)
            ->setParams($params)
            ->sendRequest($time);
    }

    /**
     * @param array $currencyCode
     * @param string $apiUrl
     * @param string $apiName
     * @param string $apiKey
     * @param string|null $time
     *
     * @return null|string
     */
    public static function getApiCurrencyExchange(
        array $currencyCode = ['USD', 'EUR', 'RUB', 'PLN', 'GBP', 'CHF'],
        string $apiUrl = '',
        string $apiName = '',
        string $apiKey = '',
        string $time = null)
    {
        $params = [
            'action' => 'exchange',
            'currencyCode' => $currencyCode,
        ];

        $time = $time ?? date('Y-m-d H:i:s');

        $apiUrl = $apiUrl.'/api/currency';
        return ApiConnect::get()
            ->setApiName($apiName)
            ->setApiKey($apiKey)
            ->setUrl($apiUrl)
            ->setParams($params)
            ->sendRequest($time);
    }
}