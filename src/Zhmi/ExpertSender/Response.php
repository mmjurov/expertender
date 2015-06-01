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
        $responseCode = null;
        foreach ($headers as $header)
        {
            if (preg_match('~HTTP.+ ([0-9]+).+~', $header, $matches))
            {
                $responseCode = $matches[1];
            }
        }

        $this->responseBody = $body;
        $expectedEntity = strpos($body, 'ErrorMessage') !== false ?
            'Zhmi\\ExpertSender\\Response\\ErrorMessageType' :
            $responseEntityType;

        $entity = null;
        if ($body !== null)
        {
            $parser = new XmlParser( $expectedEntity );
            $entity = $parser->parse( $body );
        }

        $this->responseCode = $responseCode;
        $this->responseEntity = $entity;
        $this->responseHeaders = $headers;
    }

    public function getResponseCode()
    {
        return $this->responseCode;
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * Проверяет успешность отработанного запроса. Проверяет, начинается ли код статуса ответа на 2
     * @return bool
     */
    public function isOk()
    {
        return strpos($this->responseCode, '2') === 0;
    }

    public function getEntity()
    {
        return $this->responseEntity;
    }
}