<?php

namespace Zhmi\ExpertSender\Request\Put;

use Zhmi\ExpertSender\BaseType;
use Zhmi\ExpertSender\Request;

class Lists extends Request
{
    protected $endPoint = '/Api/Lists';
    protected $responseEntity = 'integer';

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