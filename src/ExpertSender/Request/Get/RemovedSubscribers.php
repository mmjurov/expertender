<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

class RemovedSubscribers extends Request
{
    protected $endPoint = '/Api/RemovedSubscribers';
    protected $responseEntity = 'App\\Extensions\\ExpertSender\\Response\\RemovedSubscribersType';

    function __construct(array $listIds = array(), $removeTypes = array(), \DateTime $startDate = null, \DateTime $endDate = null)
    {
        if (!empty($listIds))
        {
            $this->urlParams['ListIds'] = implode(',', $listIds);
        }

        if (!empty($removeTypes))
        {
            $this->urlParams['removeTypes'] = implode(',', $removeTypes);
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