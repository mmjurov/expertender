<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SubscriberMultiDataType
 * @package Zhmi\ExpertSender\Entity
 * @property SubscriberType[] $subscribers
 */
class SubscriberMultiDataType extends BaseType
{
    protected $params = array(
        'subscribers' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\SubscriberType',
            'xmlName' => 'Subscriber',
            'unbound' => true,
            'unboundTag' => 'MultiData'
        ),
    );
}