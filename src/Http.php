<?php

namespace Zhmi;

/**
 * Класс, который реализует доступ к Http протоколу
 * @package Zhme
 */
class Http {

    const CONNECTION_ERROR = 100;

    public static function query($url, $method = 'GET', $content = null, $timeout=600)
    {
        $method = strtoupper($method);

        $http = array(
            'method' => $method,
            'header' => '',
            'timeout' => $timeout,
            'ignore_errors' => true
        );

        if ($content && $method === 'POST') {
            $http['content'] = $content;
            $http['header'] = "Content-Type: application/xml;charset=UTF-8\r\n";
        }

        $context = stream_context_create(array('http' => $http));

        $start_microtime = microtime(true);

        $body = @file_get_contents($url, false, $context);

        $used_microtime = microtime(true) - $start_microtime;

        if ($body === false) {
            throw new \Exception("Request ExpertSender Failure, used_microtime={$used_microtime}", self::CONNECTION_ERROR);
        }

        // http_response_header is php autoregister var
        return [
            'body' => $body,
            'headers' => $http_response_header,
            'used_microtime' => $used_microtime
        ];
    }

    public static function post($url, $body, $timeout=600)
    {
        return self::query($url, 'POST', $body, $timeout);
    }

    public static function get($url, $data, $timeout=600)
    {
        return self::query($url . '?' . http_build_query($data), 'GET', null, $timeout);
    }

    public static function delete($url, $data, $timeout=600)
    {
        return self::query($url . '?' . http_build_query($data), 'DELETE', null, $timeout);
    }
}