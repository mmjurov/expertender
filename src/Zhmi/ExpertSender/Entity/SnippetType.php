<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

class SnippetType extends BaseType
{
    protected $params = array(
        'name' => array(
            'type' => 'string',
            'xmlName' => 'Name'
        ),
        'value' => array(
            'type' => 'string',
            'xmlName' => 'Value',
            'cdata' => true
        ),
    );

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}