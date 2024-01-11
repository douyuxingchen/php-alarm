<?php

namespace Douyuxingchen\PhpAlarm\Alarm;

use Douyuxingchen\PhpAlarm\Service\FeiShuService;
use Illuminate\Auth\Events\Validated;

class FeiShuAlarm implements Alarm
{
    public function defaultPushMessageAlarm(string $title, string $content, string $type = FeiShuService::DEFAULT_TYPE): void
    {
        try {
            (new FeiShuService())->defaultPushMessageAlarm($title, $content, $type);
        } catch (\Exception $exception) {
            $data = json_encode([
                'parameter' => [
                    'title' => $title,
                    'content' => $content,
                    'type' => $type
                ],
                'error' => [
                    'msg' => $exception->getMessage(),
                    'line' => $exception->getLine(),
                    'code' => $exception->getCode(),
                    'file' => $exception->getFile(),
                ]
            ],JSON_UNESCAPED_UNICODE);
            (new FeiShuService())->errorMessages('默认调用飞书错误：' . $data);
        }

    }

    public function groupIdPushMessageAlarm(string $groupId, string $title, string $content, string $type = FeiShuService::DEFAULT_TYPE): void
    {
        try {
            (new FeiShuService())->defaultPushMessageAlarm($title, $content, $type, $groupId);
        } catch (\Exception $exception) {
            $data = json_encode([
                'parameter' => [
                    'title' => $title,
                    'group_id' => $groupId,
                    'content' => $content,
                    'type' => $type
                ],
                'error' => [
                    'msg' => $exception->getMessage(),
                    'line' => $exception->getLine(),
                    'code' => $exception->getCode(),
                    'file' => $exception->getFile(),
                ]
            ],JSON_UNESCAPED_UNICODE);
            (new FeiShuService())->errorMessages('自定义群组调用飞书错误：' . $data);
        }
    }

    public function customTemplate(string $groupId, array $sendData): void
    {
        try {
            (new FeiShuService())->customTemplate($groupId, $sendData);
        } catch (\Exception $exception) {
            $data = json_encode([
                'parameter' => [
                    'group_id' => $groupId,
                    'send_data' => $sendData,
                ],
                'error' => [
                    'msg' => $exception->getMessage(),
                    'line' => $exception->getLine(),
                    'code' => $exception->getCode(),
                    'file' => $exception->getFile(),
                ]
            ],JSON_UNESCAPED_UNICODE);
            (new FeiShuService())->errorMessages('自定义模版调用飞书错误：' . $data);
        }
    }
}
