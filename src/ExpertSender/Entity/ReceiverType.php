<?php

namespace Zhmi\ExpertSender\Entity;

use Zhmi\ExpertSender\BaseType;

/**
 * Class ReceiverType
 * @package Zhmi\ExpertSender\Entity
 * @property int $id
 * @property string $email
 * @property int $listId
 */
class ReceiverType extends BaseType
{
    protected $params = array(
        'id' => array(
            'type' => 'integer',
            'xmlName' => 'Id'
        ),
        'email' => array(
            'type' => 'string',
            'xmlName' => 'Email',
        ),
        'listId' => array(
            'type' => 'integer',
            'xmlName' => 'ListId'
        )
    );

    public function __construct($id = null, $email = null, $listId = null)
    {
        if ($email !== null && !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new \InvalidArgumentException('Invalid email');
        }

        if ($id !== null)
        {
            $this->id = $id;
        }

        if ($email !== null)
        {
            $this->email = $email;
        }

        if ($listId !== null)
        {
            $this->listId = $listId;
        }
    }

    private function check()
    {
        if (&& $this->id === null $this->email === null && $this->listId === null)
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