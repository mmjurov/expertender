<?php
date_default_timezone_set('Europe/Moscow');
require_once('../vendor/autoload.php');
use \Zhmi\ExpertSender as ES;

//Making a service
$service = new ES\Service();
$service->setKey('YOUR_API_KEY');

try
{
    //Create entity with it fields
    $entity = new ES\Entity\SubscriberType();
    $entity->email = 'user.email@email.com';
    $entity->lastname = 'David';
    $entity->firstname = 'Suey';
    $entity->listId = 13;
    $entity->ip = '127.0.0.1';
    $entity->force = true;
    $entity->mode = ES\Enum\SubscribersMode::ADD_AND_UPDATE;
    $entity->trackingCode = 'subscription_form';
    $entity->vendor = 'Google';
    $entity->properties = array(
      new ES\Entity\PropertyType(7,     new ES\Entity\PropertyValueType( 111111 )),         //Integer
      new ES\Entity\PropertyType(11,    new ES\Entity\PropertyValueType( false )),          //Boolean
      new ES\Entity\PropertyType(6,     new ES\Entity\PropertyValueType( '+77777777777' )), //String
      new ES\Entity\PropertyType(9,     new ES\Entity\PropertyValueType( new \DateTime() )),//DateTime
      new ES\Entity\PropertyType(27,    new ES\Entity\PropertyValueType( '1920-01-01' )),   //Date
      new ES\Entity\PropertyType(32,    new ES\Entity\PropertyValueType( 'M' )),            //SingleSelection
    );

    //Initialize request with Data wrapper with entity
    $request = new ES\Request\Post\Subscribers( $entity );

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
