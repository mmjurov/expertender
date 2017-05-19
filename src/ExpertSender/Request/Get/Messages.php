<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class Messages extends Request
{
    protected $endPoint = '/Api/Messages';
    protected $responseEntity = 'Zhmi\\ExpertSender\\Response\\MessagesType';
    function __construct($id = null, $tag = null, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        if ($id !== null)
        {
            if (!is_int($id) || $id <= 0)
            {
                throw new \InvalidArgumentException('Incorrect id provided');
            }
            $this->endPoint = '/Api/Messages/' . $id;
            $this->responseEntity = 'Zhmi\\ExpertSender\\Response\\MessageType';
        }
        else
        {
            if ($tag !== null)
            {
                $this->urlParams['tag'] = $tag;
            }

            if (!is_null($startDate))
            {
                $this->urlParams['startDate'] = $startDate->format('Y-m-d');
            }

            if (!is_null($endDate))
            {
                $this->urlParams['endDate'] = $startDate->format('Y-m-d');
            }
        }

    }

}