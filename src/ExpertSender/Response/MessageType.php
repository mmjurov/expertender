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
 * @property ListsType[] $Lists
 * @property SegmentsType[] $Segments
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
        'FromName' => array(
            'type' => 'string',
            'xmlName' => 'FromName'
        ),
        'FromEmail' => array(
            'type' => 'string',
            'xmlName' => 'FromEmail',
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
        'YandexListId' => array(
            'type' => 'integer',
            'xmlName' => 'YandexListId',
        ),
        'Channels' => array(
            'type' => 'string',
            'xmlName' => 'Channels',
        ),
        'ThrottlingMethod' => array(
            'type' => 'string',
            'xmlName' => 'ThrottlingMethod',
        ),
        'Throttling' => array(
            'type' => 'integer',
            'xmlName' => 'Throttling',
        ),
        'Status' => array(
            'type' => 'string',
            'xmlName' => 'Status',
        ),
        'Lists' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Response\\ListType',
            'xmlName' => 'Lists',
            'unbound' => true,
            'unboundTag' => 'List'
        ),
        'Segments' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Response\\SegmentType',
            'xmlName' => 'Segments',
            'unbound' => true,
            'unboundTag' => 'Segment'
        ),
        'GoogleAnalyticsTags' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Response\\GoogleAnalyticsTagType',
            'xmlName' => 'GoogleAnalyticsTags',
            'unbound' => true,
            'unboundTag' => 'GoogleAnalyticsTag'
        ),
    );
}