<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ListType
 * @package Zhmi\ExpertSender\Response
 * @property integer $Id
 * @property string $Name
 * @property string $FriendlyName
 * @property string $Language
 * @property string $OptInMode
 */
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