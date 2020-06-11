<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class FieldType
 * @package Zhmi\ExpertSender\Entity
 * @property integer $id
 * @property string $value
 */
class FieldType extends BaseType
{
    protected $params = array(
        'Field' => array(
            'type' => 'string',
            'xmlName' => 'Field'
        ),
    );

    public function __construct($field)
    {
        $this->Field = $field;
    }
}