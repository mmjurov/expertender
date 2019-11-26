<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ListImportType
 * @package Zhmi\ExpertSender\Entity
 * @property integer $Id
 * @property string $Name
 * @property string $FriendlyName
 * @property string $Language
 * @property string $OptInMode
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