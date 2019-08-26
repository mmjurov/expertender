<?php

namespace App\Extensions\ExpertSender\Entity;

use App\Extensions\ExpertSender\BaseType;

/**
 * Class FieldType
 * @package App\Extensions\ExpertSender\Entity
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