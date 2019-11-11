<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ListImportSourceType
 * @package Zhmi\ExpertSender\Entity
 * @property integer $Id
 * @property string $Name
 * @property string $FriendlyName
 * @property string $Language
 * @property string $OptInMode
 */
class ListImportSourceType extends BaseType
{
    protected $params = array(
        'Url' => array(
            'type' => 'string',
            'xmlName' => 'Url',
        )
    );
}