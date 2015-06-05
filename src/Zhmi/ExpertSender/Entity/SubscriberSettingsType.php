<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class SubscriberSettingsType
 * @package Zhmi\ExpertSender\Entity
 * @property integer $frequencyCappingTime
 * @property boolean $disableStandardMessageFooter
 * @property boolean $disableListUnsubscribeHeader
 * @property boolean $askBeforeUnsubscribing
 */
class SubscriberSettingsType extends BaseType
{
    protected $params = array(
        'frequencyCappingTime' => array(
            'type' => 'integer',
            'xmlName' => 'FrequencyCappingTime',
        ),
        'disableStandardMessageFooter' => array(
            'type' => 'boolean',
            'xmlName' => 'DisableStandardMessageFooter',
        ),
        'disableListUnsubscribeHeader' => array(
            'type' => 'boolean',
            'xmlName' => 'DisableListUnsubscribeHeader',
        ),
        'askBeforeUnsubscribing' => array(
            'type' => 'boolean',
            'xmlName' => 'AskBeforeUnsubscribing',
        ),
    );
}