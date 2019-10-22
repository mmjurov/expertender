<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\BaseType;
use Zhmi\ExpertSender\Request;

class Transactionals extends Request
{
    protected $endPoint = '/Api/Transactionals';

    public function __construct($id, BaseType $data)
    {
        $id = intval($id);
        if ($id <= 0)
        {
            throw new \InvalidArgumentException('param id must be a valid integer');
        }

        $this->endPoint .= "/{$id}";
        parent::__construct($data);
    }
}