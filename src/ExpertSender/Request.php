<?php

namespace Zhmi\ExpertSender;

/**
 * Базовый класс для всех запросов
 * @package Zhmi\ExpertSender
 */
class Request
{
    /**
     * @var string Конечная точка веб-сервиса для запроса
     */
    protected $endPoint = '/Api';

    /**
     * @var array Массив параметров, которые попадут в URL
     */
    protected $urlParams = array();

    /**
     * 提交数据结构
     *
     * @var null
     */
    protected $responseEntity = null;

    /**
     * 返回数据结构
     *
     * @var null
     */
    private $requestEntity = null;


    /**
     * @param BaseType $entity Сущность, которую нужно исопльзовать при построении запроса с xml
     */
    function __construct(BaseType $entity)
    {
        $this->requestEntity = $entity;
    }

    /**
     * 请求数据结构
     *
     * @return [type] [description]
     */
    public function getResponseEntity()
    {
        return $this->responseEntity;
    }

    /**
     * Получает адрес запроса на основании текущего состояния класса
     * @param array $additionalParams
     * @return string Адрес запроса
     */
    public function getRequestUrl(array $additionalParams = array())
    {
        if (!empty($additionalParams)) {
            $this->urlParams = array_merge($additionalParams, $this->urlParams);
        }

        if (count($this->urlParams) > 0) {
            return $this->endPoint . '?' . http_build_query($this->urlParams);
        } else {
            return $this->endPoint;
        }
    }

    /**
     * Получает тело запроса
     * @param string $apiKey Api ключ, который нужно исопльзовать при построении тела запроса
     * @return string
     */
    public function getRequestBody($apiKey)
    {
        $xml = '';
        if (!is_null($this->requestEntity)) {
            $xml .= '<ApiRequest xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xs="http://www.w3.org/2001/XMLSchema"><ApiKey>' . $apiKey . '</ApiKey>';

            $xmlContent = $this->requestEntity->toXml();
            if ($this->requestEntity->getPosition() == 'root') {
                $xml .= $xmlContent;
            } else {
                $xsi = $this->requestEntity->getXsiType();
                if ($xsi) {
                    $xml .= '<Data xsi:type="'. $xsi .'">';
                } else {
                    $xml .= '<Data>';
                }

                $xml .= $this->requestEntity->toXml();
                $xml .= '</Data>';
            }

            $xml .= '</ApiRequest>';
        }
        return $xml;
    }

    /**
     * Получает имя метода запроса по его пространству имен
     * @return string
     */
    public function getRequestMethod()
    {
        $ns = explode('\\', get_class($this));
        return strtoupper($ns[ count($ns)-2 ]);
    }

}