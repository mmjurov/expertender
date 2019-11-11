<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\Request;

class ListImport extends Request
{
    protected $endPoint = '/Api/ImportToListTasks';
    protected $responseEntity = 'integer';
}