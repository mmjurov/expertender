<?php

namespace Zhmi;

use Zhmi\ExpertSender;

/**
 * 方法封装
 * @author huangnie
 * @email 980484578@qq.com
 * @date 2019-08-20
 */
class ExpertSenderProxy
{
    /**
     * ExpertSender service
     * @var null
     */
    private $service = null;

    /**
     * Execute the console command.
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-05
     * @return mixed
     */
    public function __construct($apiKey='', $apiUri='')
    { 
        $this->service = new ExpertSender\Service($apiKey, $apiUri);        
    }

    /**
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @return string
     */
    public function getUri()
    {
        return $this->service->getUri();
    }

    /**
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->service->setUri($uri);
    }

    /**
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @return string
     */
    public function getKey()
    {
        return $this->service->getKey();
    }

    /**
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param string $key
     */
    public function setKey($key)
    {
        $this->service->setKey($key);
    }

    /**
     * 导出进度
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-22
     * @param  inter $importId
     * @return mixed
     */
    public function exportProgress($exportId)
    {
        // 查询导入进度
        $request = new ExpertSender\Request\Get\ExportProgress($exportId);

        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("importSubscriberListProgress error: {$error}", $response->getCode());
        }

        return $response->getEntity();
    }

     /**
     * 导出明细
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-22
     * @param  inter $importId
     * @return mixed
     */
    public function exportSegmentList($segmentId)
    {
        $segmentFieldArr = [
            'Id',           // 明细ID
            'Name',         // 明细名称
        ];

        $exportFields = [];
        foreach ($subscriberFieldArr as $name) {
            $exportFields[] = new ExpertSender\Entity\FieldType($name);
        }

        $segmentPropertyArr = [];

        $exportProperties = [];
        foreach ($segmentPropertyArr as $value) {
            $exportProperties[] = new ExpertSender\Entity\SegmentPropertyType($value);
        }

        $listExportType = new ExpertSender\Entity\ListExportType();
        $listExportType->Type = 'Segment';
        $listExportType->SegmentId = intval($segmentId);
        $listExportType->Fields = $exportFields;
        if (count($exportProperties) > 0) {
            $listExportType->Properties = $exportProperties;
        }

        $request =  new ExpertSender\Request\Post\ListExport( $listExportType );

        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("exportSegmentList error: {$error}", $response->getCode());
        }

        return $response->getEntity();
    }

    /**
     * 导出列表
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-22
     * @param  inter $importId
     * @return mixed
     */
    public function exportSubscriberList($listId)
    {
       $subscriberFieldArr = [
            'Email',        // 收件人email
            'FirstName',    // 收件人名字
            'LastName',     // 收件人姓氏
            'Vendor',       // 收件人来源
            'TrackingCode', // 收件人加入列表中时追踪代码
        ];

        $exportFields = [];
        foreach ($subscriberFieldArr as $name) {
            $exportFields[] = new ExpertSender\Entity\FieldType($name);
        }

        $listExportType = new ExpertSender\Entity\ListExportType();
        $listExportType->Type = 'List';
        $listExportType->ListId = intval($listId);
        $listExportType->Fields = $exportFields;

        $request =  new ExpertSender\Request\Post\ListExport( $listExportType );

        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("exportSubscriberList error: {$error}", $response->getCode());
        }

        return $response->getEntity();
    }

    /**
     * 导入收件列表进度
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-22
     * @param  inter $importId
     * @return mixed
     */
    public function importSubscriberListProgress($importId)
    {
        // 查询导入进度
        $request = new ExpertSender\Request\Get\ListImportProgress($importId);

        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("importSubscriberListProgress error: {$error}", $response->getCode());
        }

        return $response->getEntity();
    }

    /**
     * 导入列表到新列
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param  string $downloadUrl
     * @param  string $targetListId
     * @param  string $targetListName
     * @return mixed
     */
    public function importSubscriberList($downloadUrl, $targetListId, $targetListName)
    {
        $listSource = new ExpertSender\Entity\ListImportSourceType();
        $listSource->Url = $downloadUrl;
        
        $listTarget = new ExpertSender\Entity\ListImportTargetType();
        $listTarget->Name = $targetListName;
        $listTarget->SubscriberList = $targetListId;

        $listImportType = new ExpertSender\Entity\ListImportType();
        $listImportType->Source = $listSource;
        $listImportType->Target = $listTarget;

        // Initialize request with Data wrapper with entity
        $request = new ExpertSender\Request\Post\ListImport( $listImportType );

        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("importParentSubscriberList error: {$error}", $response->getCode());
        }

        return $response->getEntity();
    }

    /**
     * 收件人信息实体
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param  inter $listId
     * @param  string $email
     * @param  array  $option
     * @return mixed
     */
    public function buildSubscriberListEntity($listId, $email, array $option=[])
    {
        // Create entity with it fields
        // If want set phone, the SMS channel has to be activated to use element'Phone'
        $entity = new ExpertSender\Entity\SubscriberType();
        $entity->listId = $listId;
        $entity->email = $email;
        $entity->force = true;
        $entity->mode = ExpertSender\Enum\SubscribersMode::ADD_AND_UPDATE;

        // name can include space
        if (isset($option['lastname']) && $option['lastname']) {
            $entity->lastname = $option['lastname'];
        }

        if (isset($option['firstname']) && $option['firstname']) {
            $entity->firstname = $option['firstname'];
        }

        if ($entity->lastname && $entity->firstname) {
            $entity->name = "{$entity->firstname} {$entity->lastname}";
        }

        if (isset($option['trackingCode']) && $option['trackingCode']) {
            $entity->trackingCode = $option['trackingCode'];
        }

        if (isset($option['vendor']) && $option['vendor']) {
            $entity->vendor = $option['vendor'];
        }

        return $entity;        
    }

    /**
     * 添加一个收件人
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param  inter $listId
     * @param  string $email
     * @param  array  $option
     * @return mixed
     */
    public function pushSubscriberData($listId, $email, array $option)
    {
        if (!$listId || !$email) {
            throw new \Exception("param error: listId or email is none", 400);
        }

        $subscriberEntity = $this->buildSubscriberListEntity($listId, $email, $option);

        // Initialize request with Data wrapper with entity
        $request = new ExpertSender\Request\Post\Subscribers( $subscriberEntity );

        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("pushSubscriberData error: {$error}", $response->getCode());
        }

        return true;
    }

    /**
     * 添加多个个收件人
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param  array $subscriberArr
     * @return mixed
     */
    public function pushSubscriberMultiData(array $subscriberArr)
    {
        $subscriberMultiData = new ExpertSender\Entity\SubscriberMultiDataType();
        $subscriberMultiData->subscribers = $subscriberArr;

        // Initialize request with Data wrapper with entity
        $request = new ExpertSender\Request\Post\Subscribers( $subscriberMultiData );

        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("pushSubscriberMultiData error: {$error}", $response->getCode());
        }

        return true;
    }

    /**
     * 新建收件列表
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param  string $listName
     * @param  string $friendlyName
     * @param  string $description
     * @return inter
     */
    public function createSubscriberList($listName, $friendlyName='', $description='')
    {
        // 休眠10毫秒
        usleep(10000);

        $listSetting = new ExpertSender\Entity\ListSettingsType();
        $generalSetting = new ExpertSender\Entity\GeneralSettingsType();
        $generalSetting->name = $listName;
        $generalSetting->friendlyName = $friendlyName;
        $generalSetting->description = $description;
        $generalSetting->language = 'en-US';
        $generalSetting->charset = 'UTF-8';
        $generalSetting->defaultFromName = '';
        $generalSetting->defaultFromEmail = '';

        $listSetting->generalSettings = $generalSetting;

        $request = new ExpertSender\Request\Post\Lists( $listSetting );

        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("createSubscriberList error: {$error}", $response->getCode());
        }

        return $response->getEntity();
    }

    /**
     * 获取收件列表
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @return array
     */
    public function getSubscriberList()
    {
        $request = new ExpertSender\Request\Get\Lists();
        
        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("getSubscriberList error: {$error}", $response->getCode());
        }

        return $response->getEntity();
    }
}