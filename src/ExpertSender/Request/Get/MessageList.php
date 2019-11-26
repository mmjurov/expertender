<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class MessageList extends Request
{
    protected $endPoint = '/Api/Messages';
    protected $responseEntity = 'App\\Extensions\\ExpertSender\\Response\\MessagesType';

    function __construct($type = null, $tag = null, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        if ($type) {
            $this->urlParams['type'] = $type;
        }

        if ($tag) {
            $this->urlParams['tag'] = $tag;
        }

        if (!is_null($startDate)) {
            $this->urlParams['startDate'] = $startDate->format('Y-m-d');
        }

        if (!is_null($endDate)) {
            $this->urlParams['endDate'] = $startDate->format('Y-m-d');
        }
    }
}