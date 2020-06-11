<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ListImportSourceType
 * @package Zhmi\ExpertSender\Entity
 * @property string $url
 */
class ListImportSourceType extends BaseType
{
    protected $params = array(
        'url' => array(
            'type' => 'string',
            'xmlName' => 'Url',
        )
    );
}