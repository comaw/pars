<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname='.((mb_substr_count(__DIR__, 'e:', 'UTF-8') > 0 || mb_substr_count(__DIR__, 'E:', 'UTF-8') > 0)?'pars':'yexit'),
            'username' => ((mb_substr_count(__DIR__, 'e:', 'UTF-8') > 0 || mb_substr_count(__DIR__, 'E:', 'UTF-8') > 0)?'root':'yexit'),
            'password' => ((mb_substr_count(__DIR__, 'e:', 'UTF-8') > 0 || mb_substr_count(__DIR__, 'E:', 'UTF-8') > 0)?'':'1yexit2'),
            'charset' => 'utf8',
            'tablePrefix' => 'ps_',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
