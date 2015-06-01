<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

class ContentType extends BaseType
{
    protected $params = array(
        'fromName' => array(
            'type' => 'string',
            'xmlName' => 'FromName'
        ),
        'fromEmail' => array(
            'type' => 'string',
            'xmlName' => 'FromEmail',
        ),
        'replyToName' => array(
            'type' => 'string',
            'xmlName' => 'ReplyToName',
        ),
        'replyToEmail' => array(
            'type' => 'string',
            'xmlName' => 'ReplyToEmail',
        ),
        'html' => array(
            'type' => 'string',
            'xmlName' => 'Html',
        ),
        'plain' => array(
            'type' => 'string',
            'xmlName' => 'Plain',
        ),
        'header' => array(
            'type' => 'integer',
            'xmlName' => 'Header',
        ),
        'footer' => array(
            'type' => 'integer',
            'xmlName' => 'Footer',
        ),
        'contentFromUrl' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\ContentFromUrl',
            'xmlName' => 'ContentFromUrl',
        ),
        'googleAnalyticsTags' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\GoogleAnalyticsTags',
            'xmlName' => 'GoogleAnalyticsTags',
        ),
        'tags' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\Tag',
            'xmlName' => 'Tag',
            'unbound' => true,
            'unboundTag' => 'Tags'
        ),
        'attachments' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\Attachment',
            'xmlName' => 'Attachment',
            'unbound' => true,
            'unboundTag' => 'Attachments'
        ),
    );
}