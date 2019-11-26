<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SnoozedSubscribersType
 * @package Zhmi\ExpertSender\Response
 * @property SnoozedSubscriberType[] $SnoozedSubscribers
 */
class SnoozedSubscribersType extends BaseType
{
    protected $params = array(
        'SnoozedSubscribers' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Response\\SnoozedSubscriberType',
            'xmlName' => 'SnoozedSubscribers',
            'unbound' => true,
            'unboundTag' => 'SnoozedSubscriber'
        ),
    );
}