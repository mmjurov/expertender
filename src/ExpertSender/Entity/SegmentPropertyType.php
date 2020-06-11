<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class SegmentPropertyType
 * @package Zhmi\ExpertSender\Entity
 * @property integer $Property
 */
class SegmentPropertyType extends BaseType
{
    protected $params = array(
        'Property' => array(
            'type' => 'integer',
            'xmlName' => 'Property'
        ),
    );

    public function __construct($property)
    {
        $this->Property = $property;
    }
}