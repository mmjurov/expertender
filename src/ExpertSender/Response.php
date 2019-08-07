<?php

namespace Zhmi\ExpertSender;

/**
 * Базовый класс для всех ответов
 * @package Zhme\ExpertSender
 */
class Response
{
    /**
     * @var array Массив заголовков http ответа
     */
    private $responseHeaders = array();

    /**
     * @var null|integer HTTP код ответа от сервера
     */
    private $responseCode = null;

    /**
     * @var mixed Экземпляр сущности, десериализованной из xml
     */
    private $responseEntity = null;

    /**
     * @var null|string Тело ответа
     */
    private $responseBody = null;

    /**
     * @param string|null $body Тело ответа от сервера
     * @param  array|null $headers Заголовки ответа от сервера
     * @param string|null $responseEntityType Ожидаемый тип сущности ответа
     */
    function __construct($body, $headers, $responseEntityType = null)
    {
        $this->responseBody = $body;
        $this->responseHeaders = $headers;
        
        $responseCode = null;
        foreach ($headers as $header)
        {
            if (preg_match('~HTTP.+ ([0-9]+).+~', $header, $matches))
            {
                $responseCode = trim($matches[1]);
            }
        }

        $responseEntity = null;
        if ($body !== null)
        {
            $expectedEntity = strpos($body, 'ErrorMessage') !== false ? 'Zhmi\\ExpertSender\\Response\\ErrorMessageType' : $responseEntityType;
            $responseEntity = (new XmlParser( $expectedEntity ))->parse( $body );
        }

        $this->responseCode = $responseCode;
        $this->responseEntity = $responseEntity;
    }

    public function getHeades()
    {
        return $this->responseHeaders;
    }

    public function getBody()
    {
        return $this->responseBody;
    }

    public function getCode()
    {
        return $this->responseCode;
    }

    public function getEntity()
    {
        return $this->responseEntity;
    }

    /**
     * request state
     * @return bool
     */
    public function isOk()
    {
        return strpos($this->responseCode, '2') === 0;
    }
}