<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Сущность, содержащая необходимые поля для отправки
 *
 * Class TriggerType
 * @package Zhmi\ExpertSender\Entity
 * @property ReceiverType[] $receivers
 * @property string $type
 */
class TriggerType extends BaseType
{
    protected $xsiType = 'TriggerReceivers';

    protected $params = array(
        'receivers' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\ReceiverType',
            'xmlName' => 'Receiver',
            'unbound' => true,
            'unboundTag' => 'Receivers'
        )
    );
}