<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class MessageType
 * @package Zhmi\ExpertSender\Response
 * @property integer $Id
 * @property string $Type
 * @property string $Subject
 * @property \DateTime $SentDate
 * @property string $Tags
 * @property string $ThrottlingMethod
 * @property string $Channels
 * @property ListsType $Lists
 * @property SegmentsType $Segments
 * @property integer $Channels
 */
class MessageType extends BaseType
{
    protected $params = array(
        'Id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'Type' => array(
            'type' => 'string',
            'xmlName' => 'Type',
        ),
        'Subject' => array(
            'type' => 'string',
            'xmlName' => 'Subject',
        ),
        'SentDate' => array(
            'type' => 'DateTime',
            'xmlName' => 'SentDate',
        ),
        'Tags' => array(
            'type' => 'string',
            'xmlName' => 'Tags',
        ),
        'ThrottlingMethod' => array(
            'type' => 'string',
            'xmlName' => 'ThrottlingMethod',
        ),
        'Channels' => array(
            'type' => 'string',
            'xmlName' => 'Channels',
        ),
        'Lists' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\ListType',
            'xmlName' => 'Lists',
            'unbound' => true,
            'unboundTag' => 'List'
        ),
        'Segments' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\SegmentType',
            'xmlName' => 'Segments',
            'unbound' => true,
            'unboundTag' => 'Segment'
        ),
    );
}