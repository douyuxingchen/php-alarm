<?php
namespace Tests;
use PHPUnit\Framework\TestCase;

use Douyuxingchen\PhpAlarm\Alarm\FeiShuAlarm;
class FeiShuTest extends TestCase
{

    public function testPushMessage()
    {
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
       $feishuPusherMock = $this->createMock(FeiShuAlarm::class);

        $feishuPusherMock->expects($this->once())
            ->method('defaultPushMessageAlarm')
            ->with(
                $this->equalTo('Test title'),
                $this->equalTo($content),
                $this->equalTo('text')
            );

        // 调用 pushMessage 方法
        $feishuPusherMock->defaultPushMessageAlarm('Test title', $content, 'text');
    }

    public function testTry(){
        $content = [
            "环境: 123213",
            "标题: 商品合规检测通知-123123",
            "错误信息: 梳理考点福利卡上的",
            "渠道: 渠道名字",
            "店铺: 店铺",
            "触发时间:  11",
        ];
        $content = implode("\n", $content);

        (new FeiShuAlarm())->defaultPushMessageAlarm('Test title', $content,'post');die;
    }
}
