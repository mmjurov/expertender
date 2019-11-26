<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class GoogleAnalyticsTagType
 * @package Zhmi\ExpertSender\Response
 * @property string $campaign
 * @property string $source
 * @property string $content
 */
class GoogleAnalyticsTagType extends BaseType
{
    protected $params = array(
        'Name' => array(
            'type' => 'string',
            'xmlName' => 'Name'
        ),
        'Value' => array(
            'type' => 'string',
            'xmlName' => 'Value',
        ),
    );
}