<?php

namespace App\Extensions\ExpertSender\Entity;
use App\Extensions\ExpertSender\BaseType;

/**
 * Class ListImportTarget
 * @package App\Extensions\ExpertSender\Entity
 * @property integer $Id
 * @property string $Name
 * @property string $FriendlyName
 * @property string $Language
 * @property string $OptInMode
 */
class ListImportTargetType extends BaseType
{
    protected $params = array(
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
        'SubscriberList' => array(
            'type' => 'integer',
            'xmlName' => 'SubscriberList',
        ),
    );
}