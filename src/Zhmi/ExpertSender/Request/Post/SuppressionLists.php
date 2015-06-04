<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\Request;

class SuppressionLists extends Request
{
    protected $endPoint = '/Api/SuppressionLists';

    public function __construct($id, $entry)
    {
        if (!is_int($id))
        {
            throw new \InvalidArgumentException('Identifier must be a valid integer');
        }
        $this->endPoint .= '/' . $id;

        $this->urlParams['entry'] = $entry;
    }

}