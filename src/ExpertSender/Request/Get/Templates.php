<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class Templates extends Request
{
    protected $endPoint = '/Api/Templates';
    protected $responseEntity = 'App\\Extensions\\ExpertSender\\Response\\TemplatesType';

    function __construct($type = null)
    {
        if ($type) {
            $this->urlParams['type'] = $type;
        }
    }

}