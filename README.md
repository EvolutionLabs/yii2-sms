# yii2-sms

This is a component used to send sms, mimic the yii mailer component behaviour


#### Installation

via composer.json

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@gitlab.cartu.ro:components/yii-sms.git"
        }
    ]
}
```

```shell script
composer require evolutionlabs/yii2-sms
```

#### Usage

Add the component to your main.php.
```php
[
    'components' => [
        'sms' => [
            'class'         => \evo\sms\providers\sendsmsro\SendSmsRo::class,
            'viewPath'      => '@common/sms',
            'messageConfig' => [
                'class' => \evo\sms\providers\sendsmsro\Message::class,
                'from'  => '0040766123456',           // From number to send from
            ],
            // send all sms to a file by default.
            'useFileTransport' => true, // false for real sending
            'username'         => '{USERNAME}',
            'password'         => '{PASSWORD}',
        ],
    ]
];
```

Use as follow:

```php
Yii::$app->sms->compose()
    ->setTo('+40766123456')
    ->setMessage("Hey Receiver this is a message sent with SendSms.ro!\n\nThanks!Sender")
    ->send();
```

This is made using this yii2-extension:

https://www.yiiframework.com/extension/wadeshuler/yii2-sms

More details following the link

#### Extend

Just add your implementation into a new folder in the providers folder. 
Make sure you extend the AbstractBaseMessage and AbstractSms classes.


