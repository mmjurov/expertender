<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SegmentType
 * @package Zhmi\ExpertSender\Response
 * @property integer $Id
 * @property string $Name
 */
class SegmentType extends BaseType
{
    protected $params = array(
        'Id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
        'Tags' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Response\\SegmentTagType',
            'xmlName' => 'Tags',
            'unbound' => true,
            'unboundTag' => 'Tag'
        ),
    );
}