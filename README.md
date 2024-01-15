# PHP飞书报警
欢迎使用飞书的php报警服务库，本库旨在为公司的项目提供一个方便、高效且易于使用的工具。

### 安装 
```bash
composer require "douyuxingchen/php-alarm"
```

### 更新
```bash
composer update "douyuxingchen/php-alarm" --ignore-platform-reqs
```

## 使用指南
### 默认机器人群组
```php
  $content = [
      "环境: 123213",
      "标题: 商品合规检测通知-123123",
      "错误信息: 梳理考点福利卡上的",
      "渠道: 渠道名字",
      "店铺: 店铺",
  ];
  $content = implode("\n", $content);
  (new FeiShuAlarm())->defaultPushMessageAlarm('Test title', $content);
```

### 指定机器人群组发送
``` php
https://open.feishu.cn/open-apis/bot/v2/hook/cxsdffsdf06e-46b3-4402-aafd5-ce6e30125092
$groupId = 'cxsdffsdf06e-46b3-4402-aafd5-ce6e30125092';
(new FeiShuAlarm())->groupIdPushMessageAlarm($groupId,'标题', $content);
```

## 使用指南
请参阅我们的完整[文档](docs)。
