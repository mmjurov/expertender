<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class MessagesType
 * @package Zhmi\ExpertSender\Response
 * @property MessageType[] $Messages
 */
class MessagesType extends BaseType
{
    protected $params = array(
        'Messages' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\MessageType',
            'xmlName' => 'Messages',
            'unbound' => true,
            'unboundTag' => 'Message'
        ),
    );
}