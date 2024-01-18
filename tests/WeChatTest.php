<?php

namespace Tests;

use Douyuxingchen\PhpAlarm\Service\WeChatService;
use PHPUnit\Framework\TestCase;

use Douyuxingchen\PhpAlarm\Alarm\WeChatAlarm;

class WeChatTest extends TestCase
{
    public function testPushMessage()
    {
        $groupId= "";
        $time = time();
        $content = [
            "环境: 123213",
            "标题: 商品合规检测通知-123123",
            "错误信息: 梳理考点福利卡上的",
            "渠道: 渠道名字",
            "店铺: 店铺",
            "触发时间:  {$time}",
        ];
        $content = implode("\n", $content);
        $pusherMock = $this->createMock(WeChatAlarm::class);

        $pusherMock->expects($this->once())
            ->method('groupIdPushMessageAlarm')
            ->with(
                $this->equalTo($groupId),
                $this->equalTo($content),
                $this->equalTo('text')
            );

        // 调用 pushMessage 方法
        $pusherMock->groupIdPushMessageAlarm($groupId, $content, 'text');
    }
}