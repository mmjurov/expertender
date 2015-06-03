<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class Segments extends Request
{
    protected $endPoint = '/Api/Segments';
    protected $responseEntity = 'Zhmi\\ExpertSender\\Response\\SegmentsType';
    function __construct()
    {

    }

}