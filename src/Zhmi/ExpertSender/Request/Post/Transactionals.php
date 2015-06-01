<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\BaseType;
use Zhmi\ExpertSender\Request;

class Transactionals extends Request
{
    protected $endPoint = '/Api/Transactionals';

    public function __construct($id, BaseType $data)
    {
        if (!is_int($id))
        {
            throw new \InvalidArgumentException('Incorrect transactional id');
        }

        if ($id <= 0)
        {
            throw new \InvalidArgumentException('Incorrect transactional id');
        }

        $this->endPoint .= "/{$id}";
        parent::__construct($data);
    }
}