<?php

namespace App\Extensions\ExpertSender\Response;
use App\Extensions\ExpertSender\BaseType;

/**
 * Class ListImportType
 * @package App\Extensions\ExpertSender\Response
 * @property string $StartedAt example 2019-08-21T11:01:18
 * @property string $UpdatedAt example 2019-08-21T22:03:23
 * @property string $Status    example Completed
 * @property string $Details   example ftp://ftp.expertsender.com/Lists/test.csv
 */
class ListImportType extends BaseType
{
    protected $params = array(
        'StartedAt' => array(
            'type' => 'string',
            'xmlName' => 'StartedAt',
        ),
        'UpdatedAt' => array(
            'type' => 'string',
            'xmlName' => 'UpdatedAt',
        ),
        'Status' => array(
            'type' => 'string',
            'xmlName' => 'Status',
        ),
        'Details' => array(
            'type' => 'string',
            'xmlName' => 'Details',
        ),
    );
}