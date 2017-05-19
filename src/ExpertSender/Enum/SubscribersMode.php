<?php

namespace Zhmi\ExpertSender\Enum;

/**
 * Тип, содержащий допустимые значения метода обновления для постинга информации о подписчике (Post/Subscribers)
 * Class SubscribersOption
 * @package Zhme\ExpertSender\Enum
 */
class SubscribersMode
{
    const ADD_AND_UPDATE = 'AddAndUpdate';
    const ADD_AND_REPLACE = 'AddAndReplace';
    const ADD_AND_IGNORE = 'AddAndIgnore';
    const IGNORE_AND_UPDATE = 'IgnoreAndUpdate';
    const IGNORE_AND_REPLACE = 'IgnoreAndReplace';
    const SYNCHRONIZE = 'Synchronize';
}