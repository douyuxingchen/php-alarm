<?php
//调用事例
use Douyuxingchen\PhpAlarm\Alarm\FeiShuAlarm;

class test{
    //自定义模版签名调用
    public function testTemplate()
    {
        $group_id = '';
        $signstr = '';
        $content = [
            "环境: 自定义",
            "标题: 商品合规检测通知-123123",
            "错误信息: 梳理考点福利卡上的"
        ];
        $content = implode("\n", $content);
        $time = time();
        $str = $time . "\n" . $signstr;
        $sign = base64_encode(hash_hmac("sha256", '',$str, true));

        //设置签名的文本调用方法
//        $parame = [
//            'timestamp' => $time,
//            'sign' => $sign,
//            'msg_type' => 'text',
//            'content' => ['text' => $content],
//        ];

        //设置签名的富文本调用方法
        $parame = [
            'msg_type' => 'post',
            'timestamp' => $time,
            'sign' => $sign,
            'content' => [
                'post' => [
                    'zh_cn' => [
                        "title" => 'sd',
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

        (new FeiShuAlarm())->customTemplate($group_id,$parame);
    }

    public function tests()
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

        (new FeiShuAlarm())->defaultPushMessageAlarm('Test title', $content);
        (new FeiShuAlarm())->groupIdPushMessageAlarm('groupId','Test title', $content);

    }
}