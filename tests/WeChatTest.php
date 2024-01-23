<?php

namespace Tests;

use Douyuxingchen\PhpAlarm\RemoteRequest\RemoteRequestHandler;
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

    public function testTry(){
        //钉钉接入案例
        $webhook_url = ""; //webhook地址
        $secret = "";
        $timestamp = time() * 1000; // 注意：时间戳需要转换为毫秒级

        $stringToSign = $timestamp . "\n" . $secret;
        $signature = hash_hmac('sha256', $stringToSign,$secret, true);
        $base64Signature = base64_encode($signature);
        $urlEncodedSignature = urlencode($base64Signature);

        $messageData = [
            'msgtype' => 'text',
            'text' => [
                'content' => "123asdfsadf",
            ],
        ];
        $webhook_url .= "&timestamp={$timestamp}&sign={$urlEncodedSignature}";
        RemoteRequestHandler::main('post',$webhook_url,$messageData);
    }
}