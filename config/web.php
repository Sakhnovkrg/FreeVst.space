<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', \app\modules\admin\Module::class],
    'name' => 'FreeVst.space',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => env('YII_COOKIE_VALIDATION_KEY'),
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/admin/default/login']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                [
                    'class' => 'app\rules\TagUrlRule',
                ],
                [
                    'class' => 'app\rules\CategoryUrlRule',
                ],
                [
                    'class' => 'app\rules\StuffUrlRule',
                ],

            ],
        ],
        'settings' => [
            'class' => \sakhnovkrg\yii2\settings\components\Settings::class,
        ],
        'i18n' => [
            'translations' => [
                'yii2-settings*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@settings/messages',
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'richardfan\sortable\SortableGridViewAsset' => [
                    'basePath' => '@webroot'
                ]
            ]
        ],
    ],
    'container' => [
        'definitions' => [
            \yii\widgets\LinkPager::class => \yii\bootstrap5\LinkPager::class,
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => '@admin/views/layouts/main.php',
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'except' => ['default/login'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'modules' => [
                'settings' => [
                    'class' => \sakhnovkrg\yii2\settings\Module::class
                ],
            ]
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'bootstrap5' => '@app/gii-templates/bootstrap5/crud/default',
                ],
            ],
        ],
    ];
}

return $config;
