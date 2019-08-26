<?php

namespace App\Extensions\ExpertSender\Entity;

use App\Extensions\ExpertSender\BaseType;

/**
 * Class SegmentPropertyType
 * @package App\Extensions\ExpertSender\Entity
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