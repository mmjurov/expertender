<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SegmentsType
 * @package Zhmi\ExpertSender\Response
 * @property SegmentType[] $Segments
 */
class SegmentsType extends BaseType
{
    protected $params = array(
        'Segments' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\SegmentType',
            'xmlName' => 'Segments',
            'unbound' => true,
            'unboundTag' => 'Segment'
        ),
    );
}