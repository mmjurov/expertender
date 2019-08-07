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
    private $uri = 'https://api4.esv2.com/v2';

    /**
     * @var string Ключ клиента для работы API
     */
    private $key = '';

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
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
        $this->setUri( $this->uri );
        $this->setKey( $this->key );
    }

    /**
     * Производит обращение к сервису с помощью переданного в него заранее сформированного запроса
     * @param Request $request
     * @return Response
     * @throws ServiceException
     */
    function call( Request $request , $debug = false)
    {
        $method     = $request->getRequestMethod();
        $xmlBody      = $request->getRequestBody($this->key);
        $urlPath    = $request->getRequestUrl(strlen($xmlBody) > 0 ? array() : array('apiKey' => $this->key));
        $entity     = null;
        $transport  = new Http();

        if ($debug) {
            echo $xmlBody;
            die();
        }

        $url = trim($this->uri, '/') . '/' . trim($urlPath, '/');

        $responseBody = $transport->query($url, $method, $xmlBody, $http_response_header);
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

