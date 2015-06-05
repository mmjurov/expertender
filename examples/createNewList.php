<?php
date_default_timezone_set('Europe/Moscow');
require_once('../vendor/autoload.php');
use \Zhmi\ExpertSender as ES;

$a = microtime();
$service = new ES\Service;
$service->setKey('YOUR_API_KEY');

try
{
    $setting = new ES\Entity\ListSettingsType();
    $g = new ES\Entity\GeneralSettingsType();
    $g->name = 'API Created';
    $g->defaultFromName = 'Johnny';
    $g->defaultFromEmail = 'user.email@email.com';
    $setting->generalSettings = $g;

    $request = new ES\Request\Post\Lists( $setting );

    $response = $service->call($request);
    echo 'Идентификатор нового листа - ' . $response->getEntity();
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
