<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\Request;

class Newsletters extends Request
{
    protected $endPoint = '/Api/Newsletters';
    protected $responseEntity = 'integer';
}