<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

class SuppressionListType extends BaseType
{
    protected $params = array(
        'Id' => array(
            'type' => 'integer',
            'xmlName' => 'Status',
        ),
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),

    );
}