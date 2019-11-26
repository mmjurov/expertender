<?php

namespace Zhmi\ExpertSender\Response;

use Zhmi\ExpertSender\BaseType;

/**
 * Class MessageStatisticsType
 * 
 * @package Zhmi\ExpertSender\Response
 * @property MessageType[] $Messages
 * @property integer $Sent
 * @property integer $Bounced
 * @property integer $Delivered
 * @property integer $Opens
 * @property integer $UniqueOpens
 * @property integer $Clicks
 * @property integer $UniqueClicks
 * @property integer $Clickers
 * @property integer $Complaints
 * @property integer $Unsubscribes
 */
class MessageStatisticsType extends BaseType
{
    protected $params = array(
        'Sent' => array(
            'type' => 'integer',
            'xmlName' => 'Sent'
        ),
        'Bounced' => array(
            'type' => 'integer',
            'xmlName' => 'Bounced'
        ),
        'Delivered' => array(
            'type' => 'integer',
            'xmlName' => 'Delivered'
        ),
        'Opens' => array(
            'type' => 'integer',
            'xmlName' => 'Opens'
        ),
        'UniqueOpens' => array(
            'type' => 'integer',
            'xmlName' => 'UniqueOpens'
        ),
        'Clicks' => array(
            'type' => 'integer',
            'xmlName' => 'Clicks'
        ),
        'UniqueClicks' => array(
            'type' => 'integer',
            'xmlName' => 'UniqueClicks'
        ),
        'Clickers' => array(
            'type' => 'integer',
            'xmlName' => 'Clickers'
        ),
        'Complaints' => array(
            'type' => 'integer',
            'xmlName' => 'Complaints'
        ),
        'Unsubscribes' => array(
            'type' => 'integer',
            'xmlName' => 'Unsubscribes'
        ),
    );
}