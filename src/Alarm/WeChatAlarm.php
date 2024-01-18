<?php

namespace Douyuxingchen\PhpAlarm\Alarm;

use Douyuxingchen\PhpAlarm\Service\WeChatService;
use Illuminate\Auth\Events\Validated;

class WeChatAlarm implements Alarm
{
    public function defaultPushMessageAlarm(string $title, string $content, string $type = WeChatService::DEFAULT_TYPE): void
    {

    }

    public function groupIdPushMessageAlarm(string $groupId, string $title, string $content, string $type = WeChatService::DEFAULT_TYPE): void
    {
        (new WeChatService)->pushMessageAlarm($title,$content,$type,$groupId);
    }

    public function customTemplate(string $groupId, array $sendData): void
    {
        (new WeChatService)->customTemplate($groupId,$sendData);
    }
}