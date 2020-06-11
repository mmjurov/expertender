<?php

namespace Zhmi\Services;

use Zhmi\ExpertSender;

/**
 * 方法封装
 * @author huangnie
 * @email 980484578@qq.com
 * @date 2019-08-20
 */
class SubscriberService extends AbstractService
{ 
    /**
     * 导出进度
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-22
     * @param  integer $importId
     * @return mixed
     */
    public function exportProgress($exportId)
    {
        // 查询导入进度
        $request = new ExpertSender\Request\Get\ExportProgress($exportId);

        // Making a request call
        $response = $this->service->call($request);

        return $response->getResponseEntity();
    }

     /**
     * 导出明细
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-22
     * @param  integer $importId
     * @return mixed
     */
    public function exportSegment($segmentId, array $properties=[])
    {
        $listExportType = new ExpertSender\Entity\ListExportType();
        $listExportType->type = 'Segment';
        $listExportType->segmentId = intval($segmentId);
        $listExportType->fields = [
            'Id',           // 明细ID
            'Name',         // 明细名称
        ];

        $properties = array_unique(array_filter($properties));
        if (count($properties) > 0) {
            $listExportType->properties = $properties;
        }

        $request =  new ExpertSender\Request\Post\ListExport( $listExportType );

        // Making a request call
        $response = $this->service->call($request);

        return $response->getResponseEntity();
    }

    /**
     * 导出列表
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-22
     * @param  integer $importId
     * @return mixed
     */
    public function exportList($listId)
    {
        $listExportType = new ExpertSender\Entity\ListExportType();
        $listExportType->type = 'List';
        $listExportType->listId = intval($listId);
        $listExportType->fields = [
            'Email',        // 收件人email
            'FirstName',    // 收件人名字
            'LastName',     // 收件人姓氏
            'Vendor',       // 收件人来源
            'TrackingCode', // 收件人加入列表中时追踪代码
            'GeoCountry',   // 收件人上次动作/行为 IP地址所对应的国家
            'GeoState',     // 收件人上次动作/行为 IP地址所对应的省市自治区
            'GeoCity',      // 收件人上次动作/行为 IP地址所对应的城市
            'GeoZipCode',   // 收件人上次动作/行为 IP地址所对应的邮编
            'LastActivity', // 收件人上次动作/行为 发生的时间 (点击, 打开, 进入个人中心等等)
            'LastMessage',  // 上次发送给收件人消息的时间
            'LastEmail',    // 上次发送给收件人消息的日期
            'LastOpenEmail',    // 收件人上次打开邮件的时间
            'LastClickEmail',   // 收件人上次点击邮件某一链接
            'SubscriptionDate', // 收件人被添加至列表的日期(如果导出的类型是收件人细分，那么此处就是收件人被加入后台数据库的时间).
        ];

        $request =  new ExpertSender\Request\Post\ListExport( $listExportType );

        // Making a request call
        $response = $this->service->call($request);

        return $response->getResponseEntity();
    }

    /**
     * 导入收件列表进度
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-22
     * @param  integer $importId
     * @return mixed
     */
    public function importListProgress($importId)
    {
        // 查询导入进度
        $request = new ExpertSender\Request\Get\ListImportProgress($importId);

        // Making a request call
        $response = $this->service->call($request);

        return $response->getResponseEntity();
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
    public function importList($downloadUrl, $targetListId, $targetListName)
    {
        $listSource = new ExpertSender\Entity\ListImportSourceType();
        $listSource->url = $downloadUrl;
        
        $listTarget = new ExpertSender\Entity\ListImportTargetType();
        $listTarget->name = $targetListName;
        $listTarget->subscriberList = $targetListId;

        $listImportType = new ExpertSender\Entity\ListImportType();
        $listImportType->source = $listSource;
        $listImportType->target = $listTarget;

        // Initialize request with Data wrapper with entity
        $request = new ExpertSender\Request\Post\ListImport( $listImportType );

        // Making a request call
        $response = $this->service->call($request);

        return $response->getResponseEntity();
    }

    /**
     * 收件人信息实体
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param  integer $listId
     * @param  string $email
     * @param  array  $option
     * @return mixed
     */
    public function buildSubscriberEntity($listId, $email, array $option=[])
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
     * @date 2019-11-22
     * 
     * @param  string $identifier 收件人ID 或 收件人email 
     * @param  integer $listId
     * @return mixed
     */
    public function deleteOneSubscriber($identifier, $listId=0)
    {
        if (!$identifier) {
            throw new \Exception("param error: identifier must not be empty", 400);
        }

        // Initialize request with Data wrapper with entity
        $request = new ExpertSender\Request\Delete\Subscribers( $identifier, $listId );

        // Making a request call
        $response = $this->service->call($request);

        return true;
    }

    /**
     * 添加一个收件人
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param  integer $listId
     * @param  string $email
     * @param  array  $option
     * @return mixed
     */
    public function addOneSubscriber($listId, $email, array $option)
    {
        if (!$listId || !$email) {
            throw new \Exception("param error: listId or email is none", 400);
        }

        $subscriberEntity = $this->buildSubscriberEntity($listId, $email, $option);

        // Initialize request with Data wrapper with entity
        $request = new ExpertSender\Request\Post\Subscribers( $subscriberEntity );

        // Making a request call
        $response = $this->service->call($request);

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
    public function addMultiSubscribers(array $subscriberArr)
    {
        $subscriberMultiData = new ExpertSender\Entity\SubscriberMultiDataType();
        $subscriberMultiData->subscribers = $subscriberArr;

        // Initialize request with Data wrapper with entity
        $request = new ExpertSender\Request\Post\Subscribers( $subscriberMultiData );

        // Making a request call
        $response = $this->service->call($request);

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
     * @return integer
     */
    public function createList($listName, $friendlyName='', $description='')
    {
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

        return $response->getResponseEntity();
    }

    /**
     * 新建收件列表
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @param  integer $listId
     * @param  string $listName
     * @param  string $friendlyName
     * @param  string $description
     * @return integer
     */
    public function updateList($listId, $listName, $friendlyName='', $description='')
    {
        $listSetting = new ExpertSender\Entity\ListSettingsType();
        $generalSetting = new ExpertSender\Entity\GeneralSettingsType();
        $generalSetting->name = $listName;
        $generalSetting->friendlyName = $friendlyName;
        $generalSetting->description = $description;
        $generalSetting->language = 'en-US';
        $generalSetting->charset = 'UTF-8';

        $listSetting->generalSettings = $generalSetting;
 
        $request = new ExpertSender\Request\Put\Lists( $listId, $listSetting );

        // Making a request call
        $response = $this->service->call($request);

        return $response->getResponseEntity();
    }

    /**
     * 获取收件列表
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-08-20
     * @return array
     */
    public function getList()
    {
        $request = new ExpertSender\Request\Get\Lists();
        
        // Making a request call
        $response = $this->service->call($request);

        if (!$response->isOk()) {
            $entity = $response->getResponseEntity();
            $error = is_object($entity) ? get_object_vars($entity) : $entity;
            throw new \Exception("Subscriber:getList error: {$error}", $response->getCode());
        }

        return $response->getResponseEntity();
    }

    /**
     * 获取明细列表
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-09-03
     * @return array
     */
    public function getSegment()
    {
        $request = new ExpertSender\Request\Get\Segments();

        // Making a request call
        $response = $this->service->call($request);

        return $response->getResponseEntity();
    }
}