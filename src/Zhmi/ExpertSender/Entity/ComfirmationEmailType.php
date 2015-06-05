<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class ConfirmationEmailType
 * @package Zhmi\ExpertSender\Entity
 * @property string $fromName
 * @property string $fromEmail
 * @property string $subject
 * @property string $html
 * @property string $plain
 */
class ConfirmationEmailType extends BaseType
{
    protected $params = array(
        'fromName' => array(
            'type' => 'string',
            'xmlName' => 'FromName',
        ),
        'fromEmail' => array(
            'type' => 'string',
            'xmlName' => 'FromEmail',
        ),
        'subject' => array(
            'type' => 'string',
            'xmlName' => 'Subject',
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
    );
}