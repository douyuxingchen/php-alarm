<?php

namespace Douyuxingchen\PhpAlarm\Service;

use Douyuxingchen\PhpAlarm\RemoteRequest\RemoteRequestHandler;

class FeiShuService
{
    const FEI_SHU_URL = 'https://open.feishu.cn/open-apis/bot/v2/hook/';

    //调用SDK错误飞书告警群
    const SDK_ERROR_GROUP_ID = 'c1dd306e-46b3-4402-add5-ce6e30125092';

    //默认SDK报警群
    const DEFAULT_GROUP_ID = '988b1b69-2257-4d5f-9742-2937130dfde1';

    const MESSAGE_TYPE = [
        'text', //文本
        'post'  //富文本
    ];

    const DEFAULT_TYPE = 'post';


    public function defaultPushMessageAlarm(string $title, string $content, string $type,string $groupId = "")
    {
        switch ($type) {
            case 'text':
                $sendData = self::textDataTemplate($content);
                break;
            default:
                $sendData = self::postDataTemplate($title,$content);
                break;
        }
        $groupId = !$groupId  ? self::DEFAULT_GROUP_ID : $groupId;
        RemoteRequestHandler::main('post',self::FEI_SHU_URL.$groupId,$sendData);
    }

    public function errorMessages(string $content){
        $sendData = self::textDataTemplate($content);
        RemoteRequestHandler::main('post',self::FEI_SHU_URL.self::SDK_ERROR_GROUP_ID,$sendData);
    }

    public function customTemplate(string $groupId,array $sendData)
    {
        RemoteRequestHandler::main('post',self::FEI_SHU_URL.$groupId,$sendData);
    }

    protected static function postDataTemplate(string $title, string $content): array
    {
        return [
            'msg_type' => 'post',
            'content' => [
                'post' => [
                    'zh_cn' => [
                        "title" => self::getProjectName() . $title,
                        'content' => [
                            [
                                [
                                    'tag' => 'text',
                                    'un_escape' => true,
                                    "text" => $content,
                                ]
                            ],
                        ]
                    ]
                ]
            ],
        ];
    }

    protected static function textDataTemplate(string $content)
    {
        return [
            'msg_type' => 'text',
            'content' => ['text' => self::getProjectName() ."\n". $content],
        ];
    }

    protected static function getProjectName()
    {
        switch (env('APP_NAME')) {
            case 'mapi':
                return "mapi  ";
            case 'admin_api':
                return "admin_api  ";
            case 'channel_platform':
                return "channel_platform  ";
            case 'channel_api':
                return "channel_api  ";
            default:
                return "";
        }
    }
}