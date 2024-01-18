<?php

namespace Douyuxingchen\PhpAlarm\Service;

use Douyuxingchen\PhpAlarm\RemoteRequest\RemoteRequestHandler;

class WeChatService
{
    const WECHAT_URL = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=';
    const DEFAULT_TYPE = 'markdown';

    public function pushMessageAlarm(string $title, string $content, string $type, string $groupId = "")
    {
        switch ($type) {
            case 'text':
                $sendData = self::textDataTemplate($content, $title);
                break;
            default:
                $sendData = self::markDownDataTemplate($title, $content);
                break;
        }
        RemoteRequestHandler::main('post', self::WECHAT_URL . $groupId, $sendData);
    }

    public static function textDataTemplate($content, $title)
    {
        $title = empty($title) ? $title : $title . "\n>";
        return [
            'msgtype' => 'text',
            'text' => [
                "content" => $title . $content,
            ]
        ];
    }

    public static function markDownDataTemplate($title, $content)
    {
        $title = empty($title) ? $title : $title . "\n>";
        return [
            'msgtype' => 'markdown',
            'markdown' => [
                "content" => $title . $content,
            ]
        ];
    }

    public function customTemplate($groupId,$sendData)
    {
        RemoteRequestHandler::main('post',self::WECHAT_URL.$groupId,$sendData);
    }
}