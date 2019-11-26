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
	/**
     * 在 xml 中的节点位置
     * auto 由属性定义自动关联
     * root 仅次于root
     *
     * @var string
     */
	protected $position = 'root';

    protected $params = array(
        'subscribers' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\SubscriberType',
            'xmlName' => 'Subscriber',
            'unbound' => true,
            'unboundTag' => 'MultiData'
        ),
    );
}