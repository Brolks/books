<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ],
        'books' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\books\Module'
        ]
    ],
    'components' => [        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
					'pluralize'=>false,
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => ['v1/country'],
                ],
                [
					'pluralize'=>false,
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => [
						'books/list',
						'books/by-id',
						'books/update',
						'books/id',
					],
					'extraPatterns' => [
						'GET /' => 'new',
					],
                ]
            ],        
        ]
    ],
    'params' => $params,
];



