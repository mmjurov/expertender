<?php

namespace App\Services\ExpertSender;

use Zhmi\ExpertSender;

/**
 * 方法封装
 * @author huangnie
 * @email 980484578@qq.com
 * @date 2019-11-22
 */
class EmailService extends AbstractService
{
    /**
     * 邮件发送控制阀方式, 默认为 “None”.
     * 
     * None	不启用邮件发送控制阀.Newsletter会被以最快速度发送出. 这是默认方式, 但不推荐用于大量发送.
     * Auto	自动邮件发送控制阀.基于收件人数量及业务单元中的设置自动计算发送时间.
     * Manual	手动邮件发送控制阀.  以小时为单位，手动设置完整发送完邮件所要用的时间.
     * TimeOptimized	发送时间优化 (STO). 发送时间将根据之前每个收件人的表现而被计算出，优化的范畴可以选择24小时或1星期.
     * TimeTravel	时区自适应. 发送时间会根据每个收件人所在的时区而分别被计算出.
     *
     * @var array
     */
    private $throttling_method_supports = [
        'none' => 'None',
        'auto' => 'Auto',
        'manual' => 'Manual',
        'timetravel' => 'TimeTravel',
        'timeoptimized' => 'TimeOptimized',
    ];

    /**
     * 
     * @var array
     */
    private $states = [
        'PauseMessage',
        'ResumeMessage'
    ];

    /**
     * 数组是否存在非整型元素
     *
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-11-25
     *
     * @param  array  $arr [description]
     * @return [type]      [description]
     */
    private function notWholeIntegerArray(array $arr)
    {
        if (count($arr) == 0) {
            return false;
        }
        return preg_match('/[^\d]/', implode('', array_map('intval', $arr)));
    }

    /**
     * 创建和发送邮件
     * 附件等信息，暂无需处理，需有需要变更，需参考文档进行特殊转化
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-11-22
     *
     * @param   array  $recieves           目标收件人参数[列表或明细或测试对象或禁止]
     * @param   string $fromName          发送方名称
     * @param   string $fromEmail         发送方邮箱
     * @param   string $subject           主题
     * @param   string $html              内容
     * @param   string $tags              标签
     * @param   string $header            页眉
     * @param   string $footer            页脚
     * @param   string $throttlingMethod  发送控制方式， 默认立即发送
     *
     * @return  integer
     */
    public function create(array $recieves, string $fromName, string $fromEmail, string $subject, string $html, $tags='', int $header=0, int $footer=0, $throttlingMethod='')
    {
        $subscriberListIds = array_unique(array_filter(array_get($recieves,'subscriberListIds', [])));
        $subscriberSegmentIds = array_unique(array_filter(array_get($recieves,'subscriberSegmentIds', [])));
        $suppressionListIds = array_unique(array_filter(array_get($recieves,'suppressionListIds',[])));
        $seedListIds = array_unique(array_filter(array_get($recieves,'seedListIds', [])));

        // 收件列表，收件明细，测试列表三者不可同时为空
        if ($this->notWholeIntegerArray($subscriberListIds) || $this->notWholeIntegerArray($subscriberSegmentIds) || $this->notWholeIntegerArray($seedListIds)) {
            throw new \Exception("email::create param:recieves.subscriberList, recieves.subscriberSegmentIds, recieves.seedListIds all empty or some one not integer array");
        }
        else if (!$fromName) {
            throw new \Exception("email::create param:fromName must not be empty");
        }
        else if (strpos($fromEmail, '@') === false) {
            throw new \Exception("email::create param:fromEmail={$fromEmail} is wrong");
        }
        else if (!$subject) {
            throw new \Exception("email::create param:subject must not be empty");
        }
        else if (!$html) {
            throw new \Exception("email::create param:html must not be empty");
        }

        // 邮件内容
        $content = new ExpertSender\Entity\ContentType();
        $content->fromName = $fromName;
        $content->fromEmail = $fromEmail;
        $content->subject = $subject;
        $content->html = $html;
        if ($header > 0) {
            $content->header = $header;
        }
        if ($footer > 0) {
            $content->footer = $footer;
        }

        // 接收列表
        $recipients = new ExpertSender\Entity\RecipientsType();
        if (count($subscriberListIds) > 0) {
            $recipients->subscriberLists = $subscriberListIds;
        }
        if (count($subscriberSegmentIds) > 0) {
            $recipients->subscriberSegments = $subscriberSegmentIds;
        }
        if (count($suppressionListIds) > 0) {
            $recipients->suppressionLists = $suppressionListIds;
        }
        if (count($seedListIds) > 0) {
            $recipients->seedLists = $seedListIds;
        }

        $newsletterType = new ExpertSender\Entity\NewsletterType();
        $newsletterType->content = $content;
        $newsletterType->recipients = $recipients;

        // 寄件配置，默认立即发送
        if ($throttlingMethod) {
            $throttlingMethodkey = ucfirst(strtolower($throttlingMethod));
            if (!array_key_exists($throttlingMethodkey, $this->throttling_method_supports)) {
                throw new \Exception("email::create throttlingMethod={$throttlingMethod} must be of [" . implode(' , ', $this->throttling_method_supports) . "]");
            }

            $deliverySettings = new ExpertSender\Entity\DeliverySettingsType();
            $deliverySettings->throttlingMethod = $this->throttling_method_supports[$throttlingMethodkey];

            $newsletterType->deliverySettings = $deliverySettings; 
        }

        // Initialize request with Data wrapper with entity
        $request =  new ExpertSender\Request\Post\Newsletters( $newsletterType);

        // Making a request call
        $response = $this->service->call( $request );

        return $response->getResponseEntity();
    }

    /**
     * 查询单条发件记录
     *
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-11-25
     * @param  string $listName
     * @param  string $friendlyName
     * @param  string $description
     * @return integer
     */
    public function getInfo($newsletterId)
    {
        // Initialize request with Data wrapper with entity
        $request =  new ExpertSender\Request\Get\MessageInfo( $newsletterId );

        // Making a request call
        $response = $this->service->call( $request );

        // id          integer  唯一ID
        // from_name   string   发送方名称
        // from_email  string   发送方邮箱
        // subject     string   主题
        // status      string   状态
        // sent_data   DateTime 发送时间
        // lists       array[[id=>0, name=>'']] 收件列表
        // tags        string   标签
        return $response->getResponseEntity()->useUnderlineFieldName(true)->toArray();
    }

    /**
     * 查询多条发件记录
     *
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-11-25
     *
     * @param  string|null    $tag
     * @param  \DateTime|null $startDate
     * @param  \DateTime|null $endDate
     * @return array
     */
    public function getList(string $tag=null, \DateTime $startDate=null, \DateTime $endDate=null)
    {
        // Initialize request with Data wrapper with entity
        $request =  new ExpertSender\Request\Get\MessageList('Newsletter', $tag, $startDate, $endDate);

        // Making a request call
        $response = $this->service->call( $request );

        $result = $response->getResponseEntity()->useUnderlineFieldName(true)->toArray();

        $messages = array_get($result, 'messages', []);

        if (count($messages) > 0) {
            // id          integer  唯一ID
            // from_name   string   发送方名称
            // from_email  string   发送方邮箱
            // subject     string   主题
            // status      string   状态
            // sent_data   DateTime 发送时间
            // lists       array[[id=>0, name=>'']] 收件列表
            // tags        string   标签
            $messages = array_combine(array_column($messages, 'id'), $messages);

            ksort($messages);

            return $messages;
        } else {
            return [];
        }
    }

    /**
     * 查询收件投递状态
     *
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-11-22
     * @param  string $listName
     * @param  string $friendlyName
     * @param  string $description
     * @return integer
     */
    public function getProgress($newsletterId)
    {
        // Initialize request with Data wrapper with entity
        $request =  new ExpertSender\Request\Get\MessageStatistics( $newsletterId );

        // Making a request call
        $response = $this->service->call( $request );

        // sent              已发送邮件数目
        // bounced           退信邮件数目
        // delivered         已送达邮件数目 (已发送减去信)'
        // opens             已打开邮件数目.
        // unique_opens      打开邮件的收件人数目.
        // clicks            链接点击数目.
        // unique_clicks     各个链接被不同收件人第一次点击的总次数.
        // clickers          点击链接的收件人数目.
        // complaints        垃圾邮件投诉数目.
        // unsubscribes      退订链接点击数目.
        return $response->getResponseEntity()->useUnderlineFieldName(true)->toArray();
    }

    /**
     * 暂停Newsletter
     *
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-11-22
     * @param  string $listName
     * @param  string $friendlyName
     * @param  string $description
     * @return integer
     */
    public function pause($newsletterId)
    {
        return $this->pauseOrResume($newsletterId, 'PauseMessage');
    }

    /**
     * 继续Newsletter
     *
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-11-22
     * @param  string $listName
     * @param  string $friendlyName
     * @param  string $description
     * @return integer
     */
    public function resume($newsletterId)
    {
        return $this->pauseOrResume($newsletterId, 'ResumeMessage');
    }

    /**
     * 暂停和继续Newsletter
     *
     * @author huangnie
     * @email 980484578@qq.com
     * @date 2019-11-22
     * @param  string $listName
     * @param  string $friendlyName
     * @param  string $description
     * @return integer
     */
    private function pauseOrResume($newsletterId, $action)
    {
        if (!in_array($action, $this->states)) {
            throw new \Exception("email::pauseOrResume action={$action} must be of [" . implode(' , ', $this->states) . "]");
        }

        $actionType = new ExpertSender\Entity\ActionType($action);

        // Initialize request with Data wrapper with entity
        $request =  new ExpertSender\Request\Put\Newsletters( $newsletterId, $actionType );

        // Making a request call
        $response = $this->service->call( $request );

        return $response->getResponseEntity();
    }

}