<?php

namespace App\Extensions\ExpertSender\Request\Post;

use App\Extensions\ExpertSender\Request;

class ListImport extends Request
{
    protected $endPoint = '/Api/ImportToListTasks';
    protected $responseEntity = 'integer';
}