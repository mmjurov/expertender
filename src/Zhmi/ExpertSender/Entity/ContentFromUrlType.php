<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

class ContentFromUrlType extends BaseType
{
    protected $params = array(
        'url' => array(
            'type' => 'string',
            'xmlName' => 'Url'
        ),
        'username' => array(
            'type' => 'string',
            'xmlName' => 'Username',
        ),
        'password' => array(
            'type' => 'string',
            'xmlName' => 'Password',
        ),
        'ftpAuth' => array(
            'type' => 'string',
            'xmlName' => 'FtpAuth',
        )
    );
}