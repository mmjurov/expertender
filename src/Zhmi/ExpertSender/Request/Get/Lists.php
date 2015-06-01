<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class Lists extends Request
{
    protected $endPoint = '/Api/Lists';

    function __construct($seedLists = null)
    {
        if ($seedLists !== null)
        {
            $this->urlParams['seedLists'] = $seedLists === true ? 'true' : 'false';
        }
    }

}