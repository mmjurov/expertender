<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Enum\SubscribersOption;
use Zhmi\ExpertSender\Request;

/**
 * Class Subscribers
 * @package Zhme\ExpertSender\Resource\Get
 */
class Subscribers extends Request
{
    protected $endPoint = '/Api/Subscribers';
    protected $responseEntity = 'Zhmi\\ExpertSender\\Response\\SubscriberType';

    /**
     * @param string $email Email подписчика, о котором нужно получить информацию
     * @param null|string $option Значения из перечисляемого типа SubscribersOption
     */
    public function __construct($email, $option = null)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new \InvalidArgumentException('Email is incorrect');
        }

        $this->urlParams['email'] = $email;
        $this->urlParams['option'] = $option !== null ? $option : SubscribersOption::FULL;

        if ($this->urlParams['option'] == SubscribersOption::EVENTS_HISTORY)
        {
            $this->responseEntity = 'Zhmi\\ExpertSender\\Response\\EventsType';
        }
    }

}