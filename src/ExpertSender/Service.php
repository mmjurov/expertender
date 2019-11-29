<?php

namespace Zhmi\ExpertSender;

use Zhmi\ExpertSender\Response\ErrorMessageType;

/**
 * Класс, определяющий работу веб-сервиса
 * @package Zhmi\ExpertSender
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

        // 若接口返回警告(或错误)
        $entity = $response->getResponseEntity();
        if ($entity instanceof ErrorMessageType) {
            if ($entity->Message) {
                throw new \Exception($entity->Message, $entity->Code);
            } else {
                throw new \Exception("ApiWarning: Unknown, RequestBody={$xmlBody}, ResposeBody={$result['body']}", $response->getCode());
            }
        }

        // 若请求返回失败(或异常)
        if (!$response->isOk()) {
            $warning = is_object($entity) ? get_object_vars($entity) : $entity;
            if (is_array($warning)) {
                $warning = json_encode($warning);
            }
            throw new \Exception("ReqFailure: {$warning}", $response->getCode());
        }

        return $response;
    }
}