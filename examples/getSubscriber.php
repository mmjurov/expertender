<?php

require_once(__DIR__ . '/../vendor/autoload.php');
use \Zhmi\ExpertSender as ES;

//Making a service
$service = new ES\Service();
$service->setKey('YOUR_API_KEY');

try
{
    //Initialize request
    $request = new ES\Request\Get\Subscribers('harry@potter.com', ES\Enum\SubscribersOption::FULL);

    //Making a request call
    $response = $service->call($request);
    $entity = $response->getEntity();
    if ($response->isOk())
    {
        /** @var ES\Response\SubscriberType $entity */
        echo "{$entity->Lastname} {$entity->Ip}";
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
