<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class ListSettingsType
 * @package Zhmi\ExpertSender\Entity
 * @property \Zhmi\ExpertSender\Entity\GeneralSettingsType $generalSettings
 * @property \Zhmi\ExpertSender\Entity\AddressSettingsType $addressSettings
 * @property \Zhmi\ExpertSender\Entity\SubscriberSettingsType $subscriberSettings
 * @property \Zhmi\ExpertSender\Entity\DomainSettingsType $domainSettings
 * @property \Zhmi\ExpertSender\Entity\ConfirmationEmailType $confirmationEmail
 */
class ListSettingsType extends BaseType
{
    protected $params = array(
        'generalSettings' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\GeneralSettingsType',
            'xmlName' => 'GeneralSettings',
        ),
        'addressSettings' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\AddressSettingsType',
            'xmlName' => 'AddressSettings',
        ),
        'subscriberSettings' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\SubscriberSettingsType',
            'xmlName' => 'SubscriberSettings',
        ),
        'domainSettings' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\DomainSettingsType',
            'xmlName' => 'DomainSettings',
        ),
        'confirmationEmail' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\ConfirmationEmailType',
            'xmlName' => 'ConfirmationEmail',
        ),
    );
}