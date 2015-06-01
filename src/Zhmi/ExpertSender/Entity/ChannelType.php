<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

class ChannelType extends BaseType
{
    protected $params = array(
        'ip' => array(
            'type' => 'string',
            'xmlName' => 'Ip'
        ),
        'percentage' => array(
            'type' => 'integer',
            'xmlName' => 'Percentage',
        )
    );
}