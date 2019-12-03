<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ListImportType
 * @package Zhmi\ExpertSender\Entity
 * @property string $source
 * @property string $target
 */
class ListImportType extends BaseType
{
    protected $params = array(
        'source' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\ListImportSourceType',
            'xmlName' => 'Source',
        ),
        'target' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\ListImportTargetType',
            'xmlName' => 'Target',
        ),
    );
}