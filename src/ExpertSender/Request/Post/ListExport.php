<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\Request;

class ListExport extends Request
{
    protected $endPoint = '/Api/Exports';
    protected $responseEntity = 'integer';
}