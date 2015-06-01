<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

class PropertyType extends BaseType
{
    protected $params = array(
        'Id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'Source' => array(
            'type' => 'string',
            'xmlName' => 'Source'
        ),
        'DateTimeValue' => array(
            'type' => 'DateTime',
            'xmlName' => 'DateTimeValue',
        ),
        'IntValue' => array(
            'type' => 'integer',
            'xmlName' => 'IntValue',
        ),
        'StringValue' => array(
            'type' => 'string',
            'xmlName' => 'StringValue',
        ),
        'Type' => array(
            'type' => 'string',
            'xmlName' => 'Type',
        ),
        'FriendlyName' => array(
            'type' => 'string',
            'xmlName' => 'FriendlyName',
        ),
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
        'DefaultStringValue' => array(
            'type' => 'string',
            'xmlName' => 'DefaultStringValue',
        ),
        'DefaultIntValue' => array(
            'type' => 'integer',
            'xmlName' => 'DefaultIntValue',
        ),
        'DefaultDateTimeValue' => array(
            'type' => 'DateTime',
            'xmlName' => 'DefaultDateTimeValue',
        ),
    );
}