<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class RemovedSubscribersType
 * @package Zhmi\ExpertSender\Response
 * @property RemovedSubscriberType[] $RemovedSubscribers
 */
class RemovedSubscribersType extends BaseType
{
    protected $params = array(
        'RemovedSubscribers' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\RemovedSubscriberType',
            'xmlName' => 'RemovedSubscribers',
            'unbound' => true,
            'unboundTag' => 'RemovedSubscriber'
        ),
    );
}