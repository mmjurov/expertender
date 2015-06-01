<?php

namespace Zhmi\ExpertSender\Enum;

/**
 * Тип, содержащий допустимые значения опции для получения информации о подписчике (Get/Subscribers)
 * Class SubscribersOption
 * @package Zhme\ExpertSender\Enum
 */
class SubscribersOption
{
    const SHORT = 'Short';
    const LONG = 'Long';
    const FULL = 'Full';
    const EVENTS_HISTORY = 'EventsHistory';
}