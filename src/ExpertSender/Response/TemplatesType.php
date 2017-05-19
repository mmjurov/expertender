<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class TemplatesType
 * @package Zhmi\ExpertSender\Response
 * @property TemplateType[] $Templates
 */
class TemplatesType extends BaseType
{
    protected $params = array(
        'Templates' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\TemplateType',
            'xmlName' => 'Templates',
            'unbound' => true,
            'unboundTag' => 'Template'
        ),
    );
}