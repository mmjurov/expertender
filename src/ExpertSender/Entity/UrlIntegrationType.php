<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class UrlIntegrationType
 * @package Zhmi\ExpertSender\Entity
 * @property integer $id
 */
class UrlIntegrationType extends BaseType
{
    protected $params = array(
        'id' => array(
            'type' => 'integer',
            'xmlName' => 'Id'
        )
    );

    public function __construct($id)
    {
        $this->id = $id;
    }
}