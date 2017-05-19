<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class NewsletterType
 * @package Zhmi\ExpertSender\Entity
 * @property RecipientsType $recipients
 * @property ContentType $content
 * @property DeliverySettingsType $deliverySettings
 */
class NewsletterType extends BaseType
{
    protected $params = array(
        'recipients' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\RecipientsType',
            'xmlName' => 'Recipients',
        ),
        'content' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\ContentType',
            'xmlName' => 'Content',
        ),
        'deliverySettings' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\DeliverySettingsType',
            'xmlName' => 'DeliverySettings',
        )
    );
}