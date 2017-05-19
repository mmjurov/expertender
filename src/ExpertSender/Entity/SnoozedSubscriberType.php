<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SnoozedSubscriberType
 * @package Zhmi\ExpertSender\Entity
 * @property string $email
 * @property integer $listId
 * @property integer $id
 * @property integer $snoozeWeeks
 */
class SnoozedSubscriberType extends BaseType
{
    protected $params = array(
        'email' => array(
            'type' => 'string',
            'xmlName' => 'Email'
        ),
        'listId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId',
        ),
        'id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'snoozeWeeks' => array(
            'type' => 'integer',
            'xmlName' => 'SnoozeWeeks',
        ),
    );
}