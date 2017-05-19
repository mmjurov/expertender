<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class EventsType
 * @package Zhmi\ExpertSender\Response
 * @property EventType[] $Events
 */
class EventsType extends BaseType
{
    protected $params = array(
        'Events' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\EventType',
            'xmlName' => 'Events',
            'unbound' => true,
            'unboundTag' => 'Event'
        ),
    );
}