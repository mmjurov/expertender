<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class StateOnListType
 * @package Zhmi\ExpertSender\Response
 * @property integer $ListId
 * @property string $Status
 * @property string $Name
 */
class StateOnListType extends BaseType
{
    protected $params = array(
        'ListId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId',
        ),
        'Status' => array(
            'type' => 'string',
            'xmlName' => 'Status',
        ),
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),

    );
}