<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

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
        'Channels' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\ChannelType',
            'xmlName' => 'Channel',
            'unbound' => true,
            'unboundTag' => 'Channels'
        ),
    );
}