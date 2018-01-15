<?php

$config = [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
    ],
    'components' => [
        'assetManager' => [
            'basePath' => '@yiiunit/assets',
            'baseUrl' => '/',
        ],
        'request' => [
            'class' => 'yii\web\Request',
            'url' => '/test',
            'enableCsrfValidation' => false,
            'cookieValidationKey' => 'wefJDF8sfdsfSDefwqdxj9oq',
            'scriptFile' => __DIR__ .'/index.php',
            'scriptUrl' => '/index.php',
        ],
        'response' => [
            'class' => 'yii\web\Response',
        ],
    ]
];


if (is_file(__DIR__ . '/main-local.php')) {
    include(__DIR__ . '/main-local.php');
}

return $config;
