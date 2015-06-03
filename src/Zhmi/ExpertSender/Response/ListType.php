<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

class ListType extends BaseType
{
    protected $params = array(
        'Id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
        'FriendlyName' => array(
            'type' => 'string',
            'xmlName' => 'FriendlyName',
        ),
        'Language' => array(
            'type' => 'string',
            'xmlName' => 'Language',
        ),
        'OptInMode' => array(
            'type' => 'string',
            'xmlName' => 'OptInMode',
        ),
    );
}