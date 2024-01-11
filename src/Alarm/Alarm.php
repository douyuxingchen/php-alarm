<?php

namespace Douyuxingchen\PhpAlarm\Alarm;

interface Alarm
{
    /**
     * 默认消息推送接口
     * 请求参数
     * @param string $title 标题
     * @param string $content 推送内容
     * @param string $type 类型  text文本 post 富文本
     */
    public function defaultPushMessageAlarm(string $title, string $content, string $type): void;

    /**
     * 根据指定群组推送报警信息
     * 请求参数
     * @param string $groupId 群组id
     * @param string $title 标题
     * @param string $content 推送内容
     * @param string $type 类型  text文本 post 富文本
     */
    public function groupIdPushMessageAlarm(string $groupId, string $title, string $content, string $type): void;

    /**
     * 根据指定模版发送
     * 请求参数
     * @param string $groupId 群组id
     * @param array $sendData 模版
     */
    public function customTemplate(string $groupId,array $sendData): void;
}