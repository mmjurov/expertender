<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class ListSettingsType
 * @package Zhmi\ExpertSender\Entity
 * @property GeneralSettingsType $generalSettings
 * @property AddressSettingsType $addressSettings
 * @property SubscriberSettingsType $subscriberSettings
 * @property DomainSettingsType $domainSettings
 * @property ConfirmationEmailType $confirmationEmail
 */
class ListSettingsType extends BaseType
{
    protected $params = array(
        'generalSettings' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\GeneralSettingsType',
            'xmlName' => 'GeneralSettings',
        ),
        'addressSettings' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\AddressSettingsType',
            'xmlName' => 'AddressSettings',
        ),
        'subscriberSettings' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\SubscriberSettingsType',
            'xmlName' => 'SubscriberSettings',
        ),
        'domainSettings' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\DomainSettingsType',
            'xmlName' => 'DomainSettings',
        ),
        'confirmationEmail' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\ConfirmationEmailType',
            'xmlName' => 'ConfirmationEmail',
        ),
    );
}