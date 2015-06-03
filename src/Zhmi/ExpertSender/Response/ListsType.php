<?php

namespace Zhmi\ExpertSender\Response;
use Zhmi\ExpertSender\BaseType;

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