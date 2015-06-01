<?php

namespace Zhmi\ExpertSender\Request\Post;

use Zhmi\ExpertSender\Request;
use Zhmi\ExpertSender\Entity\Container\NewslettersType as NewslettersEntity;

class Newsletters extends Request
{
    protected $endPoint = '/Api/Newsletters';
}