<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
defined('SINA_API_HOST') or define('SINA_API_HOST', 'http://api.t.sina.com.cn');
defined('QQ_API_HOST') or define('QQ_API_HOST', 'https://open.t.qq.com');
defined('SOHU_API_HOST') or define('SOHU_API_HOST', 'http://api.t.sohu.com');


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'蒙牛未来星',

	// preloading 'log' component
	'preload'=>array('log'),
    'language' => 'zh_cn',
    'timeZone'=>'Asia/Chongqing',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.components.oauth.*',
                'application.components.opent.*',
                'application.components.opent.oauth1.*',
                'application.modules.user.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','localhost'),
		),
		'admin',
                'user'=>array(
                    'sendActivationMail' =>false,
                    'activeAfterRegister'=>true,
                ),
	),
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=10.11.5.7;dbname=db_weilaixing',
			'emulatePrepare' => true,
			'username' => 'dbuser',
			'password' => 'WdrCnR9MQj',
			'charset' => 'utf8',
			'tablePrefix' => 'mn_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'trace',     //级别为trace  
                    'categories'=>'system.db.*', //只显示关于数据库信息,包括数据库连接,数据库执行语句
                    'showInFireBug' => true,
                   // 'levels'=>'trace',     //级别为trace  
                 //   'categories'=>'system.db.*' //只显示关于数据库信息,包括数据库连接,数据库执行语句 
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),
        
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        'oauth' => array(
            'sina' => array(
                'consumer' => array(
                    '864544662' => 'cf8b87f4d3535f7587b0447b1bb176f2',
                ),
                'server_uri' => SINA_API_HOST,
                'request_token_uri' => SINA_API_HOST . '/oauth/request_token',
                'authorize_uri' => SINA_API_HOST . '/oauth/authorize',
                'access_token_uri' => SINA_API_HOST . '/oauth/access_token',
                'authenticate_uri' => SINA_API_HOST . '/oauth/authenticate',
                'version'=>2,
                'authorize_uri_2'=>'https://api.weibo.com/oauth2/authorize',//如果需要2.0 需要此处
                'access_token_uri_2'=>'https://api.weibo.com/oauth2/access_token',
            ),
            'qq' => array(
                'consumer' => array(
                    '748b95b5e36a4a18b03f2eb05fd6903c' => '4d5b0b652f6240d5c5a1d5b62c71d6a5',
                ),
                'server_uri' => QQ_API_HOST,
                'request_token_uri' => QQ_API_HOST . '/cgi-bin/request_token',
                'authorize_uri' => QQ_API_HOST . '/cgi-bin/authorize',
                'access_token_uri' => QQ_API_HOST . '/cgi-bin/access_token',
                 'authenticate_uri' => QQ_API_HOST . '/cgi-bin/authenticate',
            ),
            'sohu' => array(
                'consumer' => array(
                    'nEzjtXCw7qnGnPRsJeo9' => 'JEhk8ULm3w6buBPkv00V8I#Z69kKtDyzBrm2TA5W',
                ),
                'server_uri' => SOHU_API_HOST,
                'request_token_uri' => SOHU_API_HOST . '/oauth/request_token',
                'authorize_uri' => SOHU_API_HOST . '/oauth/authorize',
                'access_token_uri' => SOHU_API_HOST . '/oauth/access_token',
                'authenticate_uri' => SOHU_API_HOST . '/oauth/authenticate',
            ),
        ),
	),
);