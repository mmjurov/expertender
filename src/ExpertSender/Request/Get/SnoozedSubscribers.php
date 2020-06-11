<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

/**
 *
 * Class SnoozedSubscribers
 * @package Zhmi\ExpertSender\Resource\Get
 */
class SnoozedSubscribers extends Request
{
    protected $endPoint = '/Api/SnoozedSubscribers';
    protected $responseEntity = 'App\\Extensions\\ExpertSender\\Response\\SnoozedSubscribersType';

    /**
     * @param array     $listIds Id листов. Необязательно. Если узазаны, то будут возвращены подписчики только из указанных листов
     * @param \DateTime $startDate Дата начала. Необязательный. Если указано, то подписчики, у которых дата приостновки подписки истекает до этой даты, возвращены не будут. Может быть использована с endDate, что бы задать период времени.
     * @param \DateTime $endDate Аналогично $startDate
     */
    function __construct(array $listIds = array(), \DateTime $startDate = null, \DateTime $endDate = null)
    {
        if (!empty($listIds))
        {
            $this->urlParams['ListIds'] = implode(',', $listIds);
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