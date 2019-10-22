<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\Request;

class SuppressionLists extends Request
{
    protected $endPoint = '/Api/SuppressionLists';

    public function __construct($id, $entry)
    {
        $id = intval($id);
        if ($id <= 0)
        {
            throw new \InvalidArgumentException('param id must be a valid integer');
        }

        $this->endPoint .= '/' . $id;
        $this->urlParams['entry'] = $entry;
    }

}