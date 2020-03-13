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
            // TODO: ������� ������
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
            // TODO: ������� ������
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
            // TODO: ������� ������
            return null;
        }

        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * ��������� �������������� ���������
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
     * ��������� � ���������� ������
     *
     * @param string $time
     *
     * @return null|string
     */
    public function sendRequest(string $time = ''):?string
    {
        if (!empty($time)) {
            $params = [];

            // ��������� �� ������� ������������� ���������
            if (empty($this->apiName)) {
                // TODO: ������� ������
                exit('Empty apiName');
            }

            // ��������� �� ������� ������������� ���������
            if (empty($this->apiKey)) {
                // TODO: ������� ������
                exit('Empty apiKey');
            }

            // ��������� �� ������� ������������� ���������
            if (empty($this->apiUrl)) {
                // TODO: ������� ������
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
     * ��������� �������
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