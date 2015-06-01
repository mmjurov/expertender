<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

class PropertyType extends BaseType
{
    protected $params = array(
        'id' => array(
            'type' => 'integer',
            'xmlName' => 'Id'
        ),
        'value' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\PropertyValueType',
        ),
    );

    public function __construct($id, PropertyValueType $value)
    {
        $this->id = $id;
        $this->value = $value;
    }
}