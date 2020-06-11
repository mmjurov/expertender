<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SnoozedSubscriberType
 * @package Zhmi\ExpertSender\Entity
 * @property integer $id
 * @property string $email
 * @property integer $listId
 * @property integer $snoozeWeeks
 */
class SnoozedSubscriberType extends BaseType
{
    protected $params = array(
        'id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'email' => array(
            'type' => 'string',
            'xmlName' => 'Email'
        ),
        'listId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId',
        ),
        'snoozeWeeks' => array(
            'type' => 'integer',
            'xmlName' => 'SnoozeWeeks',
        ),
    );
}