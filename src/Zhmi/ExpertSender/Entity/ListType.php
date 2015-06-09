<?php

namespace Zhmi\ExpertSender\Entity\Container;

use Zhmi\ExpertSender\BaseType;

/**
 * Class ListType
 * @package Zhmi\ExpertSender\Entity\Container
 * @property integer $id
 * @property string $name
 * @property string $friendlyName
 * @property string $language
 * @property string $optInMode
 */
class ListType extends BaseType
{
    protected $params = array(
        'id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
        'friendlyName' => array(
            'type' => 'string',
            'xmlName' => 'FriendlyName',
        ),
        'language' => array(
            'type' => 'string',
            'xmlName' => 'Language',
        ),
        'optInMode' => array(
            'type' => 'string',
            'xmlName' => 'OptInMode',
        ),
    );
}