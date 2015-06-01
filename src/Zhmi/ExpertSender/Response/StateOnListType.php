<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

class StateOnListType extends BaseType
{
    protected $params = array(
        'ListId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId',
        ),
        'Status' => array(
            'type' => 'string',
            'xmlName' => 'Status',
        ),
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),

    );
}