<?php

namespace Zhmi\Services;

use Zhmi\ExpertSender;

/**
 * 方法封装
 * @author huangnie
 * @email 980484578@qq.com
 * @date 2019-08-20
 */
abstract class AbstractService
{
    /**
     * ExpertSender service
     * @var null
     */
    protected $service = null;


    /**
     * Execute the console command.
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-05
     * @return mixed
     */
    public function __construct($apiKey='', $apiUri='')
    { 
        $this->service = new ExpertSender\Service($apiKey, $apiUri);        
    }

    /**
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @return string
     */
    public function getUri()
    {
        return $this->service->getUri();
    }

    /**
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->service->setUri($uri);
    }

    /**
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @return string
     */
    public function getKey()
    {
        return $this->service->getKey();
    }

    /**
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param string $key
     */
    public function setKey($key)
    {
        $this->service->setKey($key);
    }
}