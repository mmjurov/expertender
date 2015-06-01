<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

class DataType extends BaseType
{
    protected $params = array(
        'data' => array(
            'type' => 'Zhmi\\ExpertSender\\BaseType',
            'xmlName' => 'Data',
        ),
        'type' => array(
            'type' => 'string',
            'attribute' => true,
            'attributeName' => 'xsi:type'
        )
    );

    public function __construct(BaseType $entity)
    {
        $this->data = $entity;

        $xsi = $entity->getXsiType();
        if ($xsi !== null)
        {
            $this->type = $xsi;
        }
    }
}