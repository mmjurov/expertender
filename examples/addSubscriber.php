<?php

require_once(__DIR__ . '/../vendor/autoload.php');
use \Zhmi\ExpertSender as ES;

//Making a service
$service = new ES\Service();
$service->setKey('YOUR_API_KEY');

try
{
    //Create entity with it fields
    $entity = new ES\Entity\SubscriberType();
    $entity->email = 'user.email@to.add';
    $entity->lastname = 'Smith';
    $entity->firstname = 'John';
    $entity->listId = 1;
    $entity->ip = '127.0.0.1';
    $entity->force = true;
    $entity->mode = ES\Enum\SubscribersMode::ADD_AND_UPDATE;
    $entity->trackingCode = 'subscription_form';
    $entity->vendor = 'Google';
    $entity->properties = array(
      new ES\Entity\PropertyType(1, new ES\Entity\PropertyValueType( 'myStringValue' )),
      new ES\Entity\PropertyType(2, new ES\Entity\PropertyValueType( 1 )),
      new ES\Entity\PropertyType(3, new ES\Entity\PropertyValueType( 1.2 )),
      new ES\Entity\PropertyType(4, new ES\Entity\PropertyValueType( new \DateTime() )),
      new ES\Entity\PropertyType(5, new ES\Entity\PropertyValueType( true )),
    );

    //Initialize request with Data wrapper with entity
    $request = new ES\Request\Post\Subscribers( new ES\Entity\DataType($entity) );

    //Making a request call
    $response = $service->call( $request );
    $entity = $request->getResponseEntity();
    echo 'success';
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
