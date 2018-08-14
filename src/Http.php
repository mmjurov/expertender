<?php

namespace Zhmi;


/**
 * Класс, который реализует доступ к Http протоколу
 * @package Zhme
 */
class Http {

    const CONNECTION_ERROR = 1;

    function __construct()
    {

    }

    public function query($url, $method = 'GET', $content = null, &$response_header = [])
    {
        $method = strtoupper($method);

        $http = array(
            'method' => $method,
            'header' => '',
            'timeout' => 5,
            'ignore_errors' => true
        );
        if ($content !== null && $method === 'POST')
        {
            $http['content'] = $content;
            $http['header'] = "Content-Type: application/xml;charset=UTF-8\r\n";
        }

        $context = stream_context_create(array('http' => $http));

        $result = @file_get_contents($url, false, $context);
        if ($result === false)
        {
            throw new \Exception("Couldn't connect to service", self::CONNECTION_ERROR);
        }
        $response_header = $http_response_header;
        return $result;
    }

    public function post($url, $body)
    {
        return $this->query($url, 'POST', $body);
    }
    public function get($url, $data)
    {
        return $this->query($url . '?' . http_build_query($data), 'GET');
    }
    public function delete($url, $data)
    {
        return $this->query($url . '?' . http_build_query($data), 'DELETE');
    }
}