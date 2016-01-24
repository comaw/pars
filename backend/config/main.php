<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'sourceLanguage'=>'en_US',
    'language' => 'ru',
    'charset' => 'UTF-8',
    'name' => Yii::t('app', 'Админка'),
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1']
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RUB',
        ],
        'i18n'=> [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru_RU',
                ]
            ],
        ],
        'request' => [
            'baseUrl' => '/admin'
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname='.(($_SERVER['REMOTE_ADDR'] == '127.0.0.1')?'pars':'yexit'),
            'username' => ($_SERVER['REMOTE_ADDR'] == '127.0.0.1')?'root':'yexit',
            'password' => ($_SERVER['REMOTE_ADDR'] == '127.0.0.1')?'':'1yexit2',
            'charset' => 'utf8',
            'tablePrefix' => 'ps_',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'baseUrl' => '/admin/',
            'suffix' => '/',
            'rules' => [
                '/' => 'settings/index',
                'site/index' => 'settings/index',
                'users' => 'users/index',
                '<controller:\w+>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>' => '<controller>/index',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
