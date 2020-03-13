<?php

namespace DevelopingW\WTrade\Classes;

/**
 * Class ApiConnect
 *
 * @property string $apiName
 * @property string $apiKey
 * @property string $apiUrl
 *
 * @property array $params
 *
 * @package DevelopingW\WTrade\Classes
 */
class ApiConnect
{
    use \DevelopingW\CoreClass\Abstracts\Traits\TraitSetGetForClass;

    /**
     * @return ApiConnect
     */
    public static function get():ApiConnect
    {
        return new self();
    }

    /**
     * @param string $apiName
     *
     * @return ApiConnect|null
     */
    public function setApiName(string $apiName = ''):?ApiConnect
    {
        if (empty($apiName)) {
            // TODO: Описать ошибку
            return null;
        }

        $this->apiName = $apiName;

        return $this;
    }

    /**
     * @param string $apiKey
     *
     * @return ApiConnect|null
     */
    public function setApiKey(string $apiKey = ''):?ApiConnect
    {
        if (empty($apiKey)) {
            // TODO: Описать ошибку
            return null;
        }

        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param string $apiUrl
     *
     * @return ApiConnect|null
     */
    public function setUrl(string $apiUrl = ''):?ApiConnect
    {
        if (empty($apiUrl)) {
            // TODO: Описать ошибку
            return null;
        }

        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * Принимаем дополнительные параметры
     *
     * @param array $params
     *
     * @return ApiConnect
     */
    public function setParams(array $params = []):ApiConnect
    {
        $this->params = $this->params ?? [];
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    /**
     * Формируем и отправляем запрос
     *
     * @param string $time
     *
     * @return null|string
     */
    public function sendRequest(string $time = ''):?string
    {
        if (!empty($time)) {
            $params = [];

            // Проверяем на наличие обязательного параметра
            if (empty($this->apiName)) {
                // TODO: Описать ошибку
                exit('Empty apiName');
            }

            // Проверяем на наличие обязательного параметра
            if (empty($this->apiKey)) {
                // TODO: Описать ошибку
                exit('Empty apiKey');
            }

            // Проверяем на наличие обязательного параметра
            if (empty($this->apiUrl)) {
                // TODO: Описать ошибку
                exit('Empty url');
            }

            //
            $authParams = [
                'request' => [
                    'apiName' => $this->apiName,
                    'apiSalt' => $this->getSig($this->apiName, $this->apiKey, $time),
                    'time' => $time,
                ],
            ];

            $params['request'] = array_merge($authParams['request'], $this->params);

            $result = $this->sendCurl(json_encode($params, JSON_UNESCAPED_UNICODE));

            return $result;
        }

        return null;
    }

    /**
     * Вычесляем подпись
     *
     * @param string $apiName
     * @param string $apiKey
     * @param $time
     *
     * @return string
     */
    protected function getSig(string $apiName, string $apiKey, $time):string
    {
        return md5($apiName.$apiKey.$time);
    }

    /**
     * @param string $paramsJson
     *
     * @return string
     */
    protected function sendCurl(string $paramsJson):string
    {
        $curl = new \Curl\Curl();

        $curl = $curl->post($this->apiUrl, $paramsJson);

        return $curl->response;
    }
}