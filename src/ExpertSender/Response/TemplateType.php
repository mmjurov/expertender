<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class TemplateType
 * @package Zhmi\ExpertSender\Response
 * @property integer $Id
 * @property string $Type
 * @property string $Name
 */
class TemplateType extends BaseType
{
    protected $params = array(
        'Id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'Type' => array(
            'type' => 'string',
            'xmlName' => 'Type',
        ),
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
    );
}