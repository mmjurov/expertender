<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class ReceiverType
 * @package Zhmi\ExpertSender\Entity
 * @property string $email
 * @property int $id
 * @property int $listId
 */
class ReceiverType extends BaseType
{
    protected $params = array(
        'email' => array(
            'type' => 'string',
            'xmlName' => 'Email',
        ),
        'id' => array(
            'type' => 'integer',
            'xmlName' => 'Id'
        ),
        'listId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId'
        )
    );

    public function __construct($email = null, $id = null, $listId = null)
    {
        if ($email !== null && !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new \InvalidArgumentException('Invalid email');
        }

        if ($email !== null)
        {
            $this->email = $email;
        }

        if ($id !== null)
        {
            $this->id = $id;
        }

        if ($listId !== null)
        {
            $this->listId = $listId;
        }

    }

    private function check()
    {
        if ($this->email === null && $this->id === null && $this->listId === null)
        {
            throw new \InvalidArgumentException('Must be set one or more receiver parameters');
        }
    }

    public function __set($name, $value)
    {
        parent::__set($name, $value);
        $this->check();
    }
}