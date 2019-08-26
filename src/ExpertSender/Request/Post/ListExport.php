<?php

namespace App\Extensions\ExpertSender\Request\Post;

use App\Extensions\ExpertSender\Request;

class ListExport extends Request
{
    protected $endPoint = '/Api/Exports';
    protected $responseEntity = 'integer';
}