<?php
//调用事例
use Douyuxingchen\PhpAlarm\Alarm\WeChatAlarm;

class WeChatDemo
{
    //指定群组文本|| markdown 发送 可根据类型传递 目前支持 text markdown 其他格式请用下面自定义模式编写
    public function pushMsg()
    {
        $groupId = "";
        $content = "";
//        $content .= "订单号：" . 123123 . "\n>";
//        $content .= "手机号：" . 1232112312 . "\n>";
//        $content .= "渠道名称：" . '水电费水电11费' . "\n>";
//        $content .= "抖音渠道信息：" . '水电费都是' . "\n>";
//        $content .= "支付时间：" . '213123123' . "\n>";

        //type  makedown格式的写法
        $content .= "实时新增用户反馈<font color=\"warning\">132例</font>，请相关同事注意。\n";
        $content .= "类型:<font color=\"comment\">用户反馈</font>" . "\n>";
        $content .= "sdfs:<font color=\"comment\">sdsdsd</font>" . "\n>";
        $content .= "# 标题1" . "\n>";
        $content .= "## 标题2" . "\n>";
        $content .= "<font color=\"info\">[这是一个链接](http://work.weixin.qq.com/api/doc)</font>" . "\n>";

        (new WeChatAlarm())->groupIdPushMessageAlarm($groupId, 'markdown--title', $content);


    }

    //自定义模版调用
    public function customTemplateDemo()
    {
        $groupId = "";
        //自定义模版 图文模式  可以根据msgtype的类型格式进行数据组装 案例只有模版卡片类型
        //参考企业微信机器人开发文档 https://developer.work.weixin.qq.com/document/path/91770#%E6%96%87%E6%9C%AC%E7%B1%BB%E5%9E%8B
        $sendData = [
            'msgtype' => 'news',
            'news' => [
                "articles" => [
                    "title" => "图文类型",
                    "description" => "图文描述",
                    "url" => "www.jd.com",
                    "picurl" => "http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png"
                ],
            ]
        ];
        (new WeChatAlarm())->customTemplate($groupId, $sendData);
    }
}