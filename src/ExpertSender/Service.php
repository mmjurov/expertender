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
     * init class
     * @param string $key
     * @param string $uri
     */
    function __construct($key='', $uri='')
    {
        if ($key) {
            $this->setKey( $key );
        }
        if ($uri) {
            $this->setUri( $uri );
        }
    }

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

    /**
     * Производит обращение к сервису с помощью переданного в него заранее сформированного запроса
     * @param Request $request
     * @return Response
     * @throws ServiceException
     */
    function call(Request $request, $debug = false)
    {
        // 接口方法
        $method = $request->getRequestMethod();

        // 接口参数
        $xmlBody = $request->getRequestBody($this->key);
        $queryParams = array();
        if (strlen($xmlBody) == 0) {
            $queryParams['apiKey'] = $this->key;
        }

        // 接口地址
        $url = trim($this->uri, '/') . $request->getRequestUrl($queryParams);

        if ($debug) {
            print_r([
                'url' => $url,
                'method' => $method,
                'xmlBody' => $xmlBody
            ]);
            exit();
        }

        // 请求结果
        $result = Http::query($url, $method, $xmlBody);

        // 解析结果
        $response = new Response($result['body'], $result['headers'], $request->getResponseEntity());

        $entity = $response->getEntity();
        if ($entity instanceof ErrorMessageType) {
            /** @var ErrorMessageType $entity */
            throw new \Exception($entity->Message, $entity->Code);
        } else {
            throw new \Exception(json_encode($result));
        }

        return $response;
    }
}

class ServiceException extends \Exception {}

