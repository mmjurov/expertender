<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Сущность, содержащая необходимые поля для отправки
 *
 * Class TransactionalType
 * @package Zhmi\ExpertSender\Entity
 *
 * @property ReceiverType $receiver
 * @property SnippetType[] $snippets
 * @property AttachmentType[] $attachments
 */
class TransactionalType extends BaseType
{
    protected $params = array(
        'receiver' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\ReceiverType',
            'xmlName' => 'Receiver',
        ),
        'snippets' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\SnippetType',
            'xmlName' => 'Snippet',
            'unbound' => true,
            'unboundTag' => 'Snippets'
        ),
        'attachments' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\AttachmentType',
            'xmlName' => 'Attachment',
            'unbound' => true,
            'unboundTag' => 'Attachments'
        )
    );
}