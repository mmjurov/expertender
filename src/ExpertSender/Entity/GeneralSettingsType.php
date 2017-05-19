<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class GeneralSettingsType
 * @package Zhmi\ExpertSender\Entity
 * @property string $name
 * @property string $friendlyName
 * @property string $description
 * @property string $language
 * @property string $optInMode
 * @property string $defaultFromName
 * @property string $defaultFromEmail
 * @property string $defaultReplyToName
 * @property string $charset
 * @property string $subscriptionConfirmPageUrl
 * @property string $subscriptionThankYouPageUrl
 * @property string $removalPageUrl
 * @property string $preferencesChangeUrl
 */
class GeneralSettingsType extends BaseType
{
    protected $params = array(
        'name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
        'friendlyName' => array(
            'type' => 'string',
            'xmlName' => 'FriendlyName',
        ),
        'description' => array(
            'type' => 'string',
            'xmlName' => 'Description',
        ),
        'language' => array(
            'type' => 'string',
            'xmlName' => 'Language',
        ),
        'optInMode' => array(
            'type' => 'string',
            'xmlName' => 'OptInMode',
        ),
        'defaultFromName' => array(
            'type' => 'string',
            'xmlName' => 'DefaultFromName',
        ),
        'defaultFromEmail' => array(
            'type' => 'string',
            'xmlName' => 'DefaultFromEmail',
        ),
        'defaultReplyToName' => array(
            'type' => 'string',
            'xmlName' => 'DefaultReplyToName',
        ),
        'charset' => array(
            'type' => 'string',
            'xmlName' => 'Charset',
        ),
        'subscriptionConfirmPageUrl' => array(
            'type' => 'string',
            'xmlName' => 'SubscriptionConfirmPageUrl',
        ),
        'subscriptionThankYouPageUrl' => array(
            'type' => 'string',
            'xmlName' => 'SubscriptionThankYouPageUrl',
        ),
        'removalPageUrl' => array(
            'type' => 'string',
            'xmlName' => 'RemovalPageUrl',
        ),
        'preferencesChangeUrl' => array(
            'type' => 'string',
            'xmlName' => 'PreferencesChangeUrl',
        ),
    );
}