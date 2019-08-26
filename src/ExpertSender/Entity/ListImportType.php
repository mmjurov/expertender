<?php

namespace App\Extensions\ExpertSender\Entity;
use App\Extensions\ExpertSender\BaseType;

/**
 * Class ListImportType
 * @package App\Extensions\ExpertSender\Entity
 * @property integer $Id
 * @property string $Name
 * @property string $FriendlyName
 * @property string $Language
 * @property string $OptInMode
 */
class ListImportType extends BaseType
{
    protected $params = array(
        'Source' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\ListImportSourceType',
            'xmlName' => 'Source',
        ),
        'Target' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\ListImportTargetType',
            'xmlName' => 'Target',
        ),
    );
}