<?php

namespace Zhmi\ExpertSender\Request\Get;

use Zhmi\ExpertSender\Request;

/**
 * Class Time
 * @package Zhme\ExpertSender\Resource\Get
 */
class Time extends Request
{
    protected $endPoint = '/Api/Time';
    protected $responseEntity = 'DateTime';

    function __construct() {}
}