<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class DeliverySettingsType
 * @package Zhmi\ExpertSender\Entity
 * @property \DateTime deliveryDate
 * @property string $timeZone
 * @property boolean $overrideDeliveryCap
 * @property string $throttlingMethod
 * @property integer $manualThrottlingTime
 * @property string $timeOptimizationPeriod
 * @property \Zhmi\ExpertSender\Entity\ChannelType $channels
 */
class DeliverySettingsType extends BaseType
{
    protected $params = array(
        'deliveryDate' => array(
            'type' => 'DateTime',
            'xmlName' => 'DeliveryDate'
        ),
        'timeZone' => array(
            'type' => 'string',
            'xmlName' => 'TimeZone',
        ),
        'overrideDeliveryCap' => array(
            'type' => 'boolean',
            'xmlName' => 'OverrideDeliveryCap',
        ),
        'throttlingMethod' => array(
            'type' => 'string',
            'xmlName' => 'ThrottlingMethod',
        ),
        'manualThrottlingTime' => array(
            'type' => 'integer',
            'xmlName' => 'ManualThrottlingTime',
        ),
        'timeOptimizationPeriod' => array(
            'type' => 'string',
            'xmlName' => 'TimeOptimizationPeriod',
        ),
        'channels' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\ChannelType',
            'xmlName' => 'Channel',
            'unbound' => true,
            'unboundTag' => 'Channels'
        ),
    );
}