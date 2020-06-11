<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class AddressSettingsType
 * @package Zhmi\ExpertSender\Entity
 * @property string $company
 * @property string $city
 * @property string $zipPostalCode
 * @property string $address
 * @property string $address2
 */
class AddressSettingsType extends BaseType
{
    protected $params = array(
        'company' => array(
            'type' => 'string',
            'xmlName' => 'Company',
        ),
        'city' => array(
            'type' => 'string',
            'xmlName' => 'City',
        ),
        'zipPostalCode' => array(
            'type' => 'string',
            'xmlName' => 'ZipPostalCode',
        ),
        'address' => array(
            'type' => 'string',
            'xmlName' => 'Address',
        ),
        'address2' => array(
            'type' => 'string',
            'xmlName' => 'Address2',
        ),
    );
}