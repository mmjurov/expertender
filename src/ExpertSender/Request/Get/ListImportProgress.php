<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class ListImportProgress extends Request
{
    protected $endPoint = '/Api/ImportToListTasks';

    protected $responseEntity = 'App\\Extensions\\ExpertSender\\Response\\ListImportProgressType';

    public function __construct($importId)
    {
    	$importId = intval($importId);
        if ($importId <= 0) {
            throw new \InvalidArgumentException('import id must be an nor zero number');
        }

        $this->endPoint .= "/{$importId}";
    }
}