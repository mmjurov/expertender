<?php
date_default_timezone_set('Europe/Moscow');
require_once('../vendor/autoload.php');
use \Zhmi\ExpertSender as ES;

$a = microtime();
$service = new ES\Service;
$service->setKey('YOUR_API_KEY');

try
{
    $request = new ES\Request\Get\Templates();
    $response = $service->call($request);
    $e = $response->getEntity();
    foreach ($e->Templates as $template)
    {
        /** @var ES\Response\TemplateType $template */
        echo $template->Name . '<br>';
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
