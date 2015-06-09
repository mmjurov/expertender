<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class PropertyType
 * @package Zhmi\ExpertSender\Response
 * @property integer $Id
 * @property string $Source
 * @property \DateTime $DateTimeValue
 * @property integer $IntValue
 * @property string $StringValue
 * @property string $Type
 * @property string $FriendlyName
 * @property string $Name
 * @property string $DefaultStringValue
 * @property integer $DefaultIntValue
 * @property \DateTime $DefaultDateTimeValue
 */
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