<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

class RecipientsType extends BaseType
{
    protected $params = array(
        'subscriberLists' => array(
            'type' => 'integer',
            'xmlName' => 'SubscriberList',
            'unbound' => true,
            'unboundTag' => 'SubscriberLists'
        ),
        'subscriberSegments' => array(
            'type' => 'integer',
            'xmlName' => 'SubscriberSegment',
            'unbound' => true,
            'unboundTag' => 'SubscriberSegments'
        ),
        'seedLists' => array(
            'type' => 'integer',
            'xmlName' => 'SeedList',
            'unbound' => true,
            'unboundTag' => 'SeedLists'
        ),
        'supressionLists' => array(
            'type' => 'integer',
            'xmlName' => 'SuppressionList',
            'unbound' => true,
            'unboundTag' => 'SuppressionLists'
        )
    );

    public function __construct()
    {

    }
}