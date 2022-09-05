<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
Yii::setAlias('@modules', dirname(dirname(__FILE__)) . '/modules/');
$config = [
    'id' => 'ASL-Inventory',
    'name' => 'Axial Inventory',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'assetsAutoCompress', 'queue'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],

    'components' => [

//        'assetsAutoCompress' => [
//            'class'   => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
//            'enabled' => true,
////
////            'readFileTimeout' => 5,           //Time in seconds for reading each asset file
////
////            'jsCompress'                => true,        //Enable minification js in html code
////            'jsCompressFlaggedComments' => true,        //Cut comments during processing js
//            'cssCompress' => true,        //Enable minification css in html code
////
//            'cssFileCompile'        => true,        //Turning association css files
//            'cssFileRemouteCompile' => false,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
//            'cssFileCompress'       => true,        //Enable compression and processing before being stored in the css file
//            'cssFileBottom'         => false,       //Moving down the page css files
//            'cssFileBottomLoadOnJs' => false,       //Transfer css file down the page and uploading them using js
////
////            'jsFileCompile'                 => true,        //Turning association js files
////            'jsFileRemouteCompile'          => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
////            'jsFileCompress'                => true,        //Enable compression and processing js before saving a file
////            'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js
////
////            'noIncludeJsFilesOnPjax' => true,        //Do not connect the js files when all pjax requests
////
////            'htmlFormatter' => [
////                //Enable compression html
//////                'class'         => 'skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
//////                'extra'         => false,       //use more compact algorithm
//////                'noComments'    => true,        //cut all the html comments
//////                'maxNumberRows' => 50000,       //The maximum number of rows that the formatter runs on
////
////                //or
////
//                'class' => 'skeeks\yii2\assetsAuto\formatters\html\MrclayHtmlCompressor',
////
////                //or any other your handler implements skeeks\yii2\assetsAuto\IFormatter interface
////
////                //or false
////            ],
//        ],

        'asm' => [
            'class' => 'app\modules\asm\components\ASM',
        ],

        'view' => [
            'theme' => [
                'basePath' => '@app/themes/adminlte',
                'baseUrl' => '@web/themes/adminlte',
                'pathMap' => [
                    '@app/views' => '@app/themes/adminlte',
                ]
            ]
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'mNBNb3SDKL5Iqbi__fukexv7zR8sknJx',
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,

        ],

        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],

        'session' => [
            'class' => 'yii\redis\Session',
        ],

        'cache' => [
            'class' => 'yii\redis\Cache',
            //'class' => 'yii\caching\FileCache',
        ],

        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            // send all mails to a file by default. You have to set
//            // 'useFileTransport' to false and configure a transport
//            // for the mailer to send real emails.
//            'useFileTransport' => true,
//        ],


        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            //'timeZone' => 'Asia/Dhaka',
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y h:i A',
            'timeFormat' => 'php:h:i A',

            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'currencyCode' => null,
            //'numberFormatterSymbols'=>[\NumberFormatter::CURRENCY_SYMBOL => null],
//            'numberFormatterOptions' => [
//                \NumberFormatter::MIN_FRACTION_DIGITS => 0,
//                \NumberFormatter::MAX_FRACTION_DIGITS => 0,
//            ]
        ],

        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath' => '@backend/mail',
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'axialsolutionltd@gmail.com',
                'password' => '10tamimi',
                'port' => '587',
                'encryption' => 'tls',
            ]
        ],

        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue'
                ],
            ],
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
                // your rules go here
            ],
        ],

        'queue' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => $db, // DB connection component or its config
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex used to sync queries
        ],

    ],

    'modules' => [

        'asm' => [
            'class' => 'app\modules\asm\Module',
            'defaultRoute' => 'modules',
            'redis' => true,
        ],

        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],

        'dynagrid' => [
            'class' => '\kartik\dynagrid\Module',
            // other module settings
        ],
//        'admin' => [
//            'class' => 'app\modules\admin\Module',
//            //'layout'=>'@app/themes/adminlte/layouts/main'
//        ]
    ],

//    'as access' => [
//        'class' => 'mdm\admin\components\AccessControl',
//        'allowActions' => $allowedRoutes,
//    ],

    'params' => $params,


];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'] = ['debug', 'gii'];
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    function dd($var, $flag = true)
    {
        echo '<pre>';
        if ($flag) {
            print_r($var);
        } else {
            var_dump($var);
        }
        echo '</pre>';
        die();
    }
}

return $config;
