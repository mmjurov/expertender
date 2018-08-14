<?php

namespace Zhmi\ExpertSender;

use Zhmi\ExpertSender\Response\ErrorMessageType;
use Zhmi\Http;

/**
 * Класс, определяющий работу веб-сервиса
 * @package Zhme\ExpertSender
 */
class Service {

    /**
     * @var string адрес сервера веб-сервиса
     */
    private $url = 'https://api2.esv2.com/v2';

    /**
     * @var string Ключ клиента для работы API
     */
    private $key = '';

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    function __construct()
    {
        //TODO Сделать выборку настроек из опций CMS
        $this->setUrl( $this->url );
        $this->setKey( $this->key );
    }

    /**
     * Производит обращение к сервису с помощью переданного в него заранее сформированного запроса
     * @param Request $request
     * @return Response
     * @throws ServiceException
     */
    function call( Request $request )
    {
        $method     = $request->getRequestMethod();
        $query      = $request->getRequestBody($this->key);
        $urlPart    = $request->getRequestUrl(strlen($query) > 0 ? array() : array('apiKey' => $this->key));
        $entity     = null;
        $transport  = new Http();

        $responseBody = $transport->query($this->url . $urlPart, $method, $query, $http_response_header);
        $responseEntity = $request->getResponseEntity();
        $response = new Response($responseBody, $http_response_header, $responseEntity);
        $entity = $response->getEntity();
        if ($entity instanceof ErrorMessageType)
        {
            /** @var ErrorMessageType $entity */
            throw new ServiceException($entity->Message, $entity->Code);
        }

        return $response;
    }
}

class ServiceException extends \Exception {}

