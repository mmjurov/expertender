<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

/**
 * Class Time
 * @package Zhmi\ExpertSender\Resource\Get
 */
class Time extends Request
{
    protected $endPoint = '/Api/Time';
    protected $responseEntity = 'DateTime';

    function __construct()
    {
        // 空构造函数， 只为改变传参约束
    }
}