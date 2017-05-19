<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SuppressionListType
 * @package Zhmi\ExpertSender\Response
 * @property integer $Id
 * @property string $Name
 */
class SuppressionListType extends BaseType
{
    protected $params = array(
        'Id' => array(
            'type' => 'integer',
            'xmlName' => 'Status',
        ),
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),

    );
}