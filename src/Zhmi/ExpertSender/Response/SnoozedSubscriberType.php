<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class SnoozedSubscriberType
 * @package Zhmi\ExpertSender\Response
 * @property string $Email
 * @property integer $ListId
 * @property \DateTime $SnoozedUntil
 */
class SnoozedSubscriberType extends BaseType
{
    protected $params = array(
        'Email' => array(
            'type' => 'string',
            'xmlName' => 'Email',
        ),
        'ListId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId',
        ),
        'SnoozedUntil' => array(
            'type' => 'DateTime',
            'xmlName' => 'SnoozedUntil'
        ),
    );
}