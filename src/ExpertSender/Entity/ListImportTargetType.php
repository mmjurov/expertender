<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ListImportTarget
 * @package Zhmi\ExpertSender\Entity
 * @property string $Name
 * @property string $subscriberList
 */
class ListImportTargetType extends BaseType
{
    protected $params = array(
        'name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
        'subscriberList' => array(
            'type' => 'integer',
            'xmlName' => 'SubscriberList',
        ),
    );
}