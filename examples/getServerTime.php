<?php

require_once(__DIR__ . '/../vendor/autoload.php');
use \Zhmi\ExpertSender as ES;
date_default_timezone_set('Europe/Moscow');

//Making a service
$service = new ES\Service();
$service->setKey('YOUR_API_KEY');

try
{
    //Initialize request
    $request = new ES\Request\Get\Time;

    //Making a request call
    $response = $service->call($request);
    $entity = $response->getEntity();
    if ($response->isOk())
    {
        /** @var DateTime $entity */
        echo $entity->format('d.m.Y H:i:s');
    }
    else
    {
        /** @var ES\Response\ErrorMessageType $entity */
        $error = $entity->Message;
        echo $error;
    }
}
catch (Exception $e)
{
    echo $e->getMessage();
}
