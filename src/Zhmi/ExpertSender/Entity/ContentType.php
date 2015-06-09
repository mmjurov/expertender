<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ContentType
 * @package Zhmi\ExpertSender\Entity
 * @property string $fromName
 * @property string $fromEmail
 * @property string $replyToName
 * @property string $replyToEmail
 * @property string $html
 * @property string $plain
 * @property integer $header
 * @property integer $footer
 * @property ContentFromUrlType $contentFromUrl
 * @property GoogleAnalyticsTagsType $googleAnalyticsTags
 * @property string[] $tags
 * @property AttachmentType[] $attachments
 */
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
            'cdata' => true,
        ),
        'plain' => array(
            'type' => 'string',
            'xmlName' => 'Plain',
        ),
        'header' => array(
            'type' => 'integer',
            'xmlName' => 'Header',
            'cdata' => true,
        ),
        'footer' => array(
            'type' => 'integer',
            'xmlName' => 'Footer',
        ),
        'contentFromUrl' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\ContentFromUrlType',
            'xmlName' => 'ContentFromUrl',
        ),
        'googleAnalyticsTags' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\GoogleAnalyticsTagsType',
            'xmlName' => 'GoogleAnalyticsTags',
        ),
        'tags' => array(
            'type' => 'string',
            'xmlName' => 'Tag',
            'unbound' => true,
            'unboundTag' => 'Tags'
        ),
        'attachments' => array(
            'type' => 'Zhmi\\ExpertSender\\Entity\\AttachmentType',
            'xmlName' => 'Attachment',
            'unbound' => true,
            'unboundTag' => 'Attachments'
        ),
    );
}