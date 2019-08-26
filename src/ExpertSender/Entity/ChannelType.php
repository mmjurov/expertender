v<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ChannelType
 * @package Zhmi\ExpertSender\Entity
 * @property string $ip
 * @property integer $percentage
 */
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