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
    $request = new ES\Request\Get\Subscribers('harry@potter.com', ES\Enum\SubscribersOption::EVENTS_HISTORY);

    //Making a request call
    $response = $service->call($request);
    $entity = $response->getEntity();

    foreach ($entity->Events as $event)
    {
        /** @var ES\Response\EventType $event */
        echo $event->StartDate->format('d.m.Y H:i:s') . ' - ' . $event->MessageSubject . '<br>';
    }
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
