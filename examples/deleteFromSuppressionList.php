<?php
date_default_timezone_set('Europe/Moscow');
require_once('../vendor/autoload.php');
use \Zhmi\ExpertSender as ES;

//Making a service
$service = new ES\Service();
$service->setKey('YOUR_API_KEY');

try
{
    $request = new ES\Request\Delete\SuppressionLists(12, 'user.email@email.com');

    //Making a request call
    $response = $service->call( $request );
    if ($response->isOk())
    {
        echo 'success';
    }
    else
    {
        echo $response->getCode();
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
