<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ExportProgressType
 * @package Zhmi\ExpertSender\Response
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