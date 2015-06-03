<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Класс, описывающий сущность Subscriber (подписчик)
 * Class SubscriberType
 * @package Zhmi\ExpertSender\Entity
 * @property string $mode
 * @property boolean $force
 * @property integer $listId
 * @property integer $id
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $trackingCode
 * @property string $name
 * @property string $vendor
 * @property string $ip
 * @property array $properties
 */
class SubscriberType extends BaseType
{
    protected $xsiType = 'Subscriber';

    protected $params = array(
        'mode' => array(
            'type' => 'string',
            'xmlName' => 'Mode'
        ),
        'force' => array(
            'type' => 'boolean',
            'xmlName' => 'Force',
        ),
        'listId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId',
        ),
        'id' => array(
            'type' => 'integer',
            'xmlName' => 'Id',
        ),
        'email' => array(
            'type' => 'string',
            'xmlName' => 'Email',
        ),
        'firstname' => array(
            'type' => 'string',
            'xmlName' => 'Firstname',
        ),
        'lastname' => array(
            'type' => 'string',
            'xmlName' => 'Lastname',
        ),
        'trackingCode' => array(
            'type' => 'string',
            'xmlName' => 'TrackingCode',
        ),
        'name' => array(
            'type' => 'string',
            'xmlName' => 'Name',
        ),
        'vendor' => array(
            'type' => 'string',
            'xmlName' => 'Vendor',
        ),
        'ip' => array(
            'type' => 'string',
            'xmlName' => 'Ip',
        ),
        'properties' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\PropertyType',
            'xmlName' => 'Property',
            'unbound' => true,
            'unboundTag' => 'Properties'
        ),
    );
}