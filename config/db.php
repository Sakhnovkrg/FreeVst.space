<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => env('DB_PDO_DRIVER') . ':host=' . env('DB_HOST') . ';port=' . env('DB_PORT') . ';dbname=' . env('DB_NAME'),
    'username' => env('DB_USER'),
    'password' => env('DB_PASS'),
    'charset' => 'utf8',

    'enableSchemaCache' => YII_ENV_PROD,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
