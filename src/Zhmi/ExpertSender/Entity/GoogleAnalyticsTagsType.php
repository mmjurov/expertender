<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

class GoogleAnalyticsTagsType extends BaseType
{
    protected $params = array(
        'campaign' => array(
            'type' => 'string',
            'xmlName' => 'Campaign'
        ),
        'source' => array(
            'type' => 'string',
            'xmlName' => 'Source',
        ),
        'content' => array(
            'type' => 'string',
            'xmlName' => 'Content',
        )
    );
}