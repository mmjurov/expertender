<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class Templates extends Request
{
    protected $endPoint = '/Api/Templates';
    protected $responseEntity = 'Zhmi\\ExpertSender\\Response\\TemplatesType';
    function __construct($type = null)
    {
        if ($type !== null)
        {
            $this->urlParams['type'] = $type;
        }
    }

}