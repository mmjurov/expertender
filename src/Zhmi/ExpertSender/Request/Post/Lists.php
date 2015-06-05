<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\Request;

class Lists extends Request
{
    protected $endPoint = '/Api/Lists';
    protected $responseEntity = 'integer';
}