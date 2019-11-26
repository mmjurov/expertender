<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class MessageInfo extends Request
{
    protected $endPoint = '/Api/Messages';
    protected $responseEntity = 'App\\Extensions\\ExpertSender\\Response\\MessageType';

    function __construct($id)
    {
        $id = intval($id);
        if ($id <= 0) {
            throw new \InvalidArgumentException('param id must be a valid integer');
        }

        $this->endPoint = '/Api/Messages/' . $id;
    }
}