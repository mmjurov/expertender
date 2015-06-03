<?php

namespace Zhmi\ExpertSender;

/**
 * Базовый класс для всех запросов
 * @package Zhme\ExpertSender
 */
class Request
{
    /**
     * @var string Конечная точка веб-сервиса для запроса
     */
    protected $endPoint         = '/Api';

    /**
     * @var array Массив параметров, которые попадут в URL
     */
    protected $urlParams        = array();
    //protected $propertyTypes    = array();
    private   $requestEntity    = null;
    protected $responseEntity   = null;

    public function getResponseEntity()
    {
        return $this->responseEntity;
    }

    /**
     * @param BaseType $entity Сущность, которую нужно исопльзовать при построении запроса с xml
     */
    function __construct(BaseType $entity)
    {
        $this->requestEntity = $entity;
    }

    /**
     * Получает адрес запроса на основании текущего состояния класса
     * @param array $additionalParams
     * @return string Адрес запроса
     */
    public function getRequestUrl(array $additionalParams = array())
    {
        if (!empty($additionalParams))
            $this->urlParams = array_merge($additionalParams, $this->urlParams);

        $query = http_build_query($this->urlParams);
        if (strlen($query) > 0)
        {
            $query = "?{$query}";
        }
        return $this->endPoint . $query;
    }

    /**
     * Получает тело запроса
     * @param string $apiKey Api ключ, который нужно исопльзовать при построении тела запроса
     * @return string
     */
    public function getRequestBody($apiKey)
    {
        $xml = '';
        if (!is_null($this->requestEntity))
        {
            $xml .= "<ApiRequest xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xs=\"http://www.w3.org/2001/XMLSchema\"><ApiKey>{$apiKey}</ApiKey>";
            $xsi = $this->requestEntity->getXsiType();
            $xml .= "<Data";
            $xml .= strlen($xsi) > 0 ? " xsi:type=\"{$xsi}\">" : ">";
            $xml .= $this->requestEntity->toXml();
            $xml .= "</Data>";
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
        $method = strtoupper($ns[ count($ns)-2 ]);
        return $method;
    }

}