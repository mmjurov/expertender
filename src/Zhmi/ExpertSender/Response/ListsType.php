<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ListsType
 * @package Zhmi\ExpertSender\Response
 * @property ListType $Lists
 */
class ListsType extends BaseType
{
    protected $params = array(
        'Lists' => array(
            'type' => 'Zhmi\\ExpertSender\\Response\\ListType',
            'xmlName' => 'Lists',
            'unbound' => true,
            'unboundTag' => 'List'
        ),
    );
}