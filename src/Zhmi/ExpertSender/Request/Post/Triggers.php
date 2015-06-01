<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\BaseType;
use Zhmi\ExpertSender\Request;

class Triggers extends Request
{
    protected $endPoint = '/Api/Triggers';

    public function __construct($id, BaseType $data)
    {
        if (!is_int($id))
        {
            throw new \InvalidArgumentException('Incorrect trigger id');
        }

        if ($id <= 0)
        {
            throw new \InvalidArgumentException('Incorrect trigger id');
        }

        $this->endPoint .= "/{$id}";
        parent::__construct($data);
    }
}