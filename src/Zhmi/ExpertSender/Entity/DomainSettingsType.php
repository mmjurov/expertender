<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class DomainSettingsType
 * @package Zhmi\ExpertSender\Entity
 * @property string clickTrackingDomain
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property string $zipPostalCode
 */
class DomainSettingsType extends BaseType
{
    protected $params = array(
        'clickTrackingDomain' => array(
            'type' => 'string',
            'xmlName' => 'ClickTrackingDomain',
        ),
        'address' => array(
            'type' => 'string',
            'xmlName' => 'Address',
        ),
        'address2' => array(
            'type' => 'string',
            'xmlName' => 'Address2',
        ),
        'city' => array(
            'type' => 'string',
            'xmlName' => 'City',
        ),
        'zipPostalCode' => array(
            'type' => 'string',
            'xmlName' => 'ZipPostalCode',
        ),
    );
}