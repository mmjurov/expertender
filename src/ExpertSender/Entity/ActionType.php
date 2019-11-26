<?php

namespace Zhmi\ExpertSender\Entity;
use Zhmi\ExpertSender\BaseType;

/**
 * Class ActionType
 * @package Zhmi\ExpertSender\Entity
 * @property string $action
 */
class ActionType extends BaseType
{
    /**
     * 在 xml 中的节点位置
     * auto 由属性定义自动关联
     * root 仅次于root
     *
     * @var string
     */
    protected $position = 'root';

    protected $params = array(
        'action' => array(
            'type' => 'string',
            'xmlName' => 'Action',
        ),
    );

    public function __construct($action)
    {
        $this->action = $action;
    }
}