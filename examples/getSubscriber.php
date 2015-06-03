<?php

require_once('../vendor/autoload.php');
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

    /** @var ES\Response\SubscriberType $entity */
    echo "{$entity->Lastname} {$entity->Ip}";

}
catch (ES\ServiceException $e)
{
    print_r('Ошибка выполнения запроса к сервису:' . "\n");
    echo $e->getCode() . " - " . $e->getMessage();
}
catch (\Exception $e)
{
    var_dump($e);
}