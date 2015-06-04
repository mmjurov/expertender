<?php
date_default_timezone_set('Europe/Moscow');
require_once('../vendor/autoload.php');
use \Zhmi\ExpertSender as ES;

$a = microtime();
$service = new ES\Service;
$service->setKey('YOUR_API_KEY');

try
{
    $entity = new ES\Entity\SnoozedSubscriberType();
    $entity->email = 'user.email@email.com';
    $entity->snoozeWeeks = 1;

    $request = new ES\Request\Post\SnoozedSubscribers( $entity );
    $response = $service->call($request);
    var_dump($response);
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
