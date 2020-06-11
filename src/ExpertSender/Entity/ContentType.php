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
        'subject' => array(
            'type' => 'string',
            'xmlName' => 'Subject',
         ),
        'plain' => array(
            'type' => 'string',
            'xmlName' => 'Plain',
        ),
        'html' => array(
            'type' => 'string',
            'xmlName' => 'Html',
            'cdata' => true,
        ),
        'ampHtml' => array(
            'type' => 'string',
            'xmlName' => 'AmpHtml',
            'cdata' => true,
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
        'tags' => array(
            'type' => 'string',
            'xmlName' => 'Tag',
            'unbound' => true,
            'unboundTag' => 'Tags'
        ),
        'contentFromUrl' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\ContentFromUrlType',
            'xmlName' => 'ContentFromUrl',
        ),
        'googleAnalyticsTags' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\GoogleAnalyticsTagsType',
            'xmlName' => 'GoogleAnalyticsTags',
        ),
        'attachments' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\AttachmentType',
            'xmlName' => 'Attachment',
            'unbound' => true,
            'unboundTag' => 'Attachments'
        ),
        'urlIntegrations' => array(
            'type' => 'App\\Extensions\\ExpertSender\\Entity\\UrlIntegrationType',
            'xmlName' => 'UrlIntegration',
            'unbound' => true,
            'unboundTag' => 'UrlIntegrations'
        ),
        'enableOpenTrack' => array(
            'type' => 'boolean',
            'xmlName' => 'EnableClickTrack',
        ),
        'enableOpenTrack' => array(
            'type' => 'boolean',
            'xmlName' => 'EnableOpenTrack',
        ),
    );
}