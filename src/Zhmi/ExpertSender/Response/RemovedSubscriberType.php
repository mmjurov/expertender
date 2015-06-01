<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class RemovedSubscriberType
 * @package Zhmi\ExpertSender\Response
 * @property string $Email
 * @property integer $ListId
 * @property \DateTime $UnsubscribedOn
 */
class RemovedSubscriberType extends BaseType
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
        'UnsubscribedOn' => array(
            'type' => 'DateTime',
            'xmlName' => 'UnsubscribedOn'
        ),
    );
}