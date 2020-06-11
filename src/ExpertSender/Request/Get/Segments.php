<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class Segments extends Request
{
    protected $endPoint = '/Api/Segments';
    protected $responseEntity = 'App\\Extensions\\ExpertSender\\Response\\SegmentsType';

    function __construct()
    {
        // 空构造函数， 只为改变传参约束
    }
}