<?php

namespace App\Extensions\ExpertSender\Response;
use App\Extensions\ExpertSender\BaseType;

/**
 * Class ListImportProgressType
 * @package App\Extensions\ExpertSender\Response
 * @property string $Name
 * @property string $List
 * @property string $Url
 * @property ListImportType $History
 */
class ListImportProgressType extends BaseType
{
    protected $params = array(
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
        'List' => array(
            'type' => 'string',
            'xmlName' => 'List',
        ),
        'Url' => array(
            'type' => 'string',
            'xmlName' => 'Url',
        ),
        'History' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Response\\ListImportType',
            'xmlName' => 'History',
            'unbound' => true,
            'unboundTag' => 'Import'
        ),
    );
}