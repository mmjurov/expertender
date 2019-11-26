<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class MessageStatistics extends Request
{
    protected $endPoint = '/Api/MessageStatistics';
    protected $responseEntity = 'App\\Extensions\\ExpertSender\\Response\\MessageStatisticsType';

    function __construct($id = null, \DateTime $startDate = null, \DateTime $endDate = null)
    {
        $id = intval($id);
        if ($id <= 0) {
            throw new \InvalidArgumentException('param id must be a valid integer');
        }

        $this->endPoint = '/Api/MessageStatistics/' . $id;

        if (!is_null($startDate)) {
            $this->urlParams['startDate'] = $startDate->format('Y-m-d');
        }

        if (!is_null($endDate)) {
            $this->urlParams['endDate'] = $startDate->format('Y-m-d');
        }
    }

}