<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class PropertyType
 * @package Zhmi\ExpertSender\Entity
 * @property integer $id
 * @property PropertyValueType $value
 */
class PropertyType extends BaseType
{
    protected $params = array(
        'id' => array(
            'type' => 'integer',
            'xmlName' => 'Id'
        ),
        'value' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\PropertyValueType',
        ),
    );

    public function __construct($id, PropertyValueType $value)
    {
        $this->id = $id;
        $this->value = $value;
    }
}