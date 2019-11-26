<?php

namespace Zhmi\ExpertSender\Response;

use Zhmi\ExpertSender\BaseType;

/**
 * Class ErrorMessageType
 * @package Zhmi\ExpertSender\Response
 * @property integer $Code
 * @property string $Message
 */
class ErrorMessageType extends BaseType
{
    protected $params = array(
        'Code' => array(
            'type' => 'integer',
            'xmlName' => 'Code'
        ),
        'Message' => array(
            'type' => 'string',
            'xmlName' => 'Message',
        )
    );
}