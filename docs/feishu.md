## 调用示例

以下是详细的代码示例：

1. 下面是调用方法的抽象类：
    - public function defaultPushMessageAlarm(string $title, string $content, string $type): void;  默认发送消息
    - public function groupIdPushMessageAlarm(string $groupId, string $title, string $content, string $type): void; 群组发送
    - public function customTemplate(string $groupId,array $sendData): void;  自定义模版


#### 签名自定义模版调用方式示例
```php
    https://open.feishu.cn/open-apis/bot/v2/hook/cxsdffsdf06e-46b3-4402-aafd5-ce6e30125092
    $groupId = 'cxsdffsdf06e-46b3-4402-aafd5-ce6e30125092'; 
    $group_id = '';//飞书群组id
    $signstr = '';//签名校验
    $content = [
    "环境: 自定义",
    "标题: 商品合规检测通知-123123",
    "错误信息: 梳理考点福利卡上的"
    ]; //发送内容
    $content = implode("\n", $content); //只支持字符串
    $time = time();
    $str = $time . "\n" . $signstr; 
    $sign = base64_encode(hash_hmac("sha256", '',$str, true));//生成签名
    
    //设置签名的文本调用方法
    $parame = [
        'timestamp' => $time,
        'sign' => $sign,
        'msg_type' => 'text',
        'content' => ['text' => $content],
    ];
    (new FeiShuAlarm())->customTemplate($group_id,$parame); //调用自定义模版方法
```