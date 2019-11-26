<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SubscriberType
 * @package Zhmi\ExpertSender\Response
 * @property boolean $BlackList
 * @property StateOnListType[] $StateOnLists
 * @property SuppressionListType[] $SuppressionLists
 * @property integer $Id
 * @property string $Lastname
 * @property string $Vendor
 * @property string $Ip
 * @property PropertyType[] $Properties
 */
class SubscriberType extends BaseType
{
    protected $params = array(
        'BlackList' => array(
            'type' => 'boolean',
            'xmlName' => 'BlackList'
        ),
        'StateOnLists' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Response\\StateOnListType',
            'xmlName' => 'StateOnLists',
            'unbound' => true,
            'unboundTag' => 'StateOnList'
        ),
        'SuppressionLists' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Response\\SuppressionListType',
            'xmlName' => 'SuppressionLists',
            'unbound' => true,
            'unboundTag' => 'SuppressionList'
        ),
        'Id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'Lastname' => array(
            'type' => 'string',
            'xmlName' => 'Lastname',
        ),
        'Vendor' => array(
            'type' => 'string',
            'xmlName' => 'Vendor',
        ),
        'Ip' => array(
            'type' => 'string',
            'xmlName' => 'Ip',
        ),
        'Properties' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Response\\PropertyType',
            'xmlName' => 'Properties',
            'unbound' => true,
            'unboundTag' => 'Property'
        ),
    );
}