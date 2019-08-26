<?php

namespace App\Extensions\ExpertSender\Entity;
use App\Extensions\ExpertSender\BaseType;

/**
 * Class ListImportSourceType
 * @package App\Extensions\ExpertSender\Entity
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