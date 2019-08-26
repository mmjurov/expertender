<?php

namespace App\Extensions\ExpertSender\Request\Get;

use App\Extensions\ExpertSender\Request;

class ListImportProgress extends Request
{
    protected $endPoint = '/Api/ImportToListTasks';

    protected $responseEntity = 'App\\Extensions\\ExpertSender\\Response\\ListImportProgressType';

    public function __construct($importId)
    {
    	$importId = intval($importId);
        
        if (!$importId) {
            throw new \InvalidArgumentException('import id must be an nor zero number');
        }

        $this->endPoint .= "/{$importId}";
    }
}