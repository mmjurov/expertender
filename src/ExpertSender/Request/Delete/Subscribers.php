<?php

namespace Zhmi\ExpertSender\Request\Delete;

use Zhmi\ExpertSender\Request;

class Subscribers extends Request
{
    protected $endPoint = '/Api/Subscribers';

    public function __construct($identifier, $listId = null)
    {
        if (is_int($identifier))
        {
            $this->endPoint .= '/' . (int)$identifier;
        }
        elseif (filter_var($identifier, FILTER_VALIDATE_EMAIL))
        {
            $this->urlParams['email'] = $identifier;
        }
        else
        {
            throw new \InvalidArgumentException('Identifier must be a valid email or integer');
        }

        if ($listId !== null)
        {
            $this->urlParams['listId'] = $listId;
        }
    }

}