<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class EventType
 * @package Zhme\ExpertSender\Response
 * @property \DateTime $StartDate
 * @property \DateTime $EndDate
 * @property string $MessageType
 * @property string $EventType
 * @property integer $EventCount
 * @property string $MessageSubject
 * @property integer $MessageId
 */
class EventType extends BaseType
{
    protected $params = array(
        'StartDate' => array(
            'type' => 'DateTime',
            'xmlName' => 'StartDate',
        ),
        'EndDate' => array(
            'type' => 'DateTime',
            'xmlName' => 'EndDate',
        ),
        'MessageType' => array(
            'type' => 'string',
            'xmlName' => 'MessageType'
        ),
        'EventType' => array(
            'type' => 'string',
            'xmlName' => 'EventType',
        ),
        'EventCount' => array(
            'type' => 'integer',
            'xmlName' => 'EventCount',
        ),
        'MessageSubject' => array(
            'type' => 'string',
            'xmlName' => 'MessageSubject',
        ),
        'MessageId' => array(
            'type' => 'integer',
            'xmlName' => 'MessageId',
        ),
    );
}