<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SegmentTagType
 * @package Zhmi\ExpertSender\Response
 * @property string $Tag
 */
class SegmentTagType extends BaseType
{
    protected $params = array(
        'Tag' => array(
            'type' => 'string',
            'xmlName' => 'Tag',
        ),
    );
}