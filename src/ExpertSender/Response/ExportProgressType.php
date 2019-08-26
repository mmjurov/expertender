<?php

namespace App\Extensions\ExpertSender\Response;
use App\Extensions\ExpertSender\BaseType;

/**
 * Class ExportProgressType
 * @package App\Extensions\ExpertSender\Response
 * @property string $Status
 * @property string $DownloadUrl 
 */
class ExportProgressType extends BaseType
{
    protected $params = array(
        'Status' => array(
            'type' => 'string',
            'xmlName' => 'Status',
        ),
        'DownloadUrl' => array(
            'type' => 'string',
            'xmlName' => 'DownloadUrl',
        ),
    );
}