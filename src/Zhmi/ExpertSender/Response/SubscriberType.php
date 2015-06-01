<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SubscriberType
 * @package Zhme\ExpertSender\Response
 * @property boolean BlackList
 * @property array StateOnLists
 * @property array SuppressionLists
 * @property integer Id
 * @property string Lastname
 * @property string Vendor
 * @property string Ip
 * @property array Properties
 */
class SubscriberType extends BaseType
{
    protected $params = array(
        'BlackList' => array(
            'type' => 'boolean',
            'xmlName' => 'BlackList'
        ),
        'StateOnLists' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\StateOnListType',
            'xmlName' => 'StateOnLists',
            'unbound' => true,
            'unboundTag' => 'StateOnList'
        ),
        'SuppressionLists' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\SuppressionListType',
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
            'type' => 'Zhmi\\ExpertSender\\Response\\PropertyType',
            'xmlName' => 'Properties',
            'unbound' => true,
            'unboundTag' => 'Property'
        ),
    );
}