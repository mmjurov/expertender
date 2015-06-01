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
        ),
    );

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->setValue($value);
    }

    public function __set($name, $value)
    {
        if ($name === 'value')
        {
            $this->setValue($value);
        }
        else
        {
            parent::__set($name, $value);
        }
    }

    private function setValue($value)
    {
        parent::__set('value', "<![CDATA[$value]]>");
    }
}