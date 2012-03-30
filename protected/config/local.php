<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Wallfeet',
	'theme'=>'wf',
	'defaultController' => 'front/site/home',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.utils.*',
		'application.widgets.*',
		'application.constants.*',
		'application.modules.auditTrail.models.*',
		'application.modules.srbac.controllers.SBaseController',
		'application.modules.srbac.components.*',
		'application.modules.user.models.*',
		'application.modules.user.api.*',
		'application.modules.specialist.models.*',
		'application.modules.specialist.api.*',
		'application.modules.advertise.models.*',
		'application.modules.advertise.api.*',
		'application.modules.agent.models.*',
		'application.modules.agent.api.*',
		'application.modules.builder.models.*',
		'application.modules.builder.api.*',
		'application.modules.email.models.*',
		'application.modules.email.api.*',
		'application.modules.general.models.*',
		'application.modules.general.api.*',
		'application.modules.general.Portlet.*',
		'application.modules.payment.models.*',
		'application.modules.payment.api.*',
		'application.modules.pmb.models.*',
		'application.modules.pmb.api.*',
		'application.modules.project.models.*',
		'application.modules.project.api.*',
		'application.modules.property.*.*',
		'application.modules.property.models.*',
		'application.modules.property.api.*',
		'application.modules.setting.models.*',
		'application.modules.setting.api.*',
		'application.modules.store.models.*',
		'application.modules.front.models.*',
		'application.modules.location.models.*',
		'application.modules.location.api.*',
		'application.modules.jukebox.models.*',
		'application.modules.jukebox.api.*',
		),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'pass',
		// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'auditTrail'=>array(),
		'srbac' => array(
			'userclass'=>'UserCredentials', //default: User
			'userid'=>'id', //default: userid
			'username'=>'email_id', //default:username
			'delimeter'=>'-', //default:-
			'debug'=>false, //default :false
			'pageSize'=>20, // default : 15
			'superUser' =>'Superman', //default: Authorizer
			'css'=>'srbac.css', //default: srbac.css
			'layout'=>'application.views.layouts.main', //default: application.views.layouts.main, //must be an existing alias
			'notAuthorizedView'=> 'srbac.views.authitem.unauthorized', // default: //srbac.views.authitem.unauthorized, must be an existing alias
			'alwaysAllowed'=>array('front-SiteHome','store-SiteLogin','store-SiteLogout','store-SiteIndex','GeneralError','front-PropertySearch','location-LocalityGetList'),
			'userActions'=>array(), //default: array()
			'listBoxNumberOfLines' => 15, //default : 10
			'imagesPath' => 'srbac.images', // default: srbac.images
			'imagesPack'=>'noia', //default: noia
			'iconText'=>true, // default : false
			'header'=>'srbac.views.authitem.header', //default : srbac.views.authitem.header,
			// must be an existing alias
			'footer'=>'srbac.views.authitem.footer', //default: srbac.views.authitem.footer,
			// must be an existing alias
			'showHeader'=>true, // default: false
			'showFooter'=>false, // default: false
			'alwaysAllowedPath'=>'srbac.components', // default: srbac.components
			// must be an existing alias
		),
		'user'=>array(),
		'store'=>array(),
		'front'=>array(),
		'specialist'=>array(),
		'advertise'=>array(),
		'agent'=>array(),
		'builder'=>array(),
		'email'=>array(),
		'general'=>array(),
		'payment'=>array(),
		'pmb'=>array(),
		'project'=>array(),
		'property'=>array(),
		'location'=>array(),
	),

		// application components
	'components'=>array(
		'user'=>array(
			'class'=>'WebUser',
		// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				// User REST patterns
		 /*     array('user/userResource/list', 'pattern'=>'user', 'verb'=>'GET'),
		        array('user/userResource/view', 'pattern'=>'user/<id:\d+>', 'verb'=>'GET'),
		        array('user/userResource/update', 'pattern'=>'user/<id:\d+>', 'verb'=>'PUT'),
		        array('user/userResource/delete', 'pattern'=>'user/<id:\d+>', 'verb'=>'DELETE'),
		        array('user/userResource/create', 'pattern'=>'user', 'verb'=>'POST'),*/
				'<action:(home|members)>' => 'front/site/<action>',
				'<action:(admin)>' => 'store/site/index/<action>',
				
				'<controller:(property)>'=>'front/property/',
				'<controller:(property)>/<action:\w+>'=>'front/property/<action>',
				'<controller:(property)>/<action:(index|create)>'=>'front/property/<action>',
				'<controller:(advertise)>'=>'front/advertise/',
				'<controller:(advertise)>/<action:(index|create)>'=>'front/advertise/<action>',
				'<controller:(agent)>'=>'front/agent/',
				'<controller:(agent)>/<action:(index|create)>'=>'front/agent/<action>',
				'<controller:(builder)>'=>'front/builder/',
				'<controller:(builder)>/<action:(index|create)>'=>'front/builder/<action>',
				'<controller:(email)>'=>'front/email/',
				'<controller:(email)>/<action:(index|create)>'=>'front/email/<action>',
				'<controller:(jukebox)>'=>'front/jukebox/',
				'<controller:(jukebox)>/<action:(index|create)>'=>'front/jukebox/<action>',
				'<controller:(location)>'=>'front/location/',
				'<controller:(location)>/<action:(index|create)>'=>'front/location/<action>',
				'<controller:(payment)>'=>'front/payment/',
				'<controller:(payment)>/<action:(index|create)>'=>'front/payment/<action>',
				'<controller:(pmb)>'=>'front/pmb/',
				'<controller:(pmb)>/<action:(index|create)>'=>'front/pmb/<action>',
				'<controller:(project)>'=>'front/project/',
				'<controller:(project)>/<action:(index|create)>'=>'front/project/<action>',
				'<controller:(property)>'=>'front/property/',
				'<controller:(property)>/<action:(index|create)>'=>'front/property/<action>',
				'<controller:(specialist)>'=>'front/specialist/',
				'<controller:(specialist)>/<action:(index|create)>'=>'front/specialist/<action>',
				
				'<action:(admin)>' => 'store/site/index/<action>',
		
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'authManager'=>array(
		// Path to SDbAuthManager in srbac module if you want to use case insensitive
		// access checking (or CDbAuthManager for case sensitive access checking)
			'class'=>'application.modules.srbac.components.SDbAuthManager',
		//	'class'=>'CDbAuthManager',
		// The database component used
			'connectionID'=>'db',
		// The itemTable name (default:authitem)
			'itemTable'=>'auth_items',
		// The assignmentTable name (default:authassignment)
			'assignmentTable'=>'auth_assignments',
		// The itemChildTable name (default:authitemchild)
			'itemChildTable'=>'auth_itemchildren',
		),

		/*		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			),*/
		// uncomment the following to use a MySQL database
		/*'db'=>array(
			'connectionString' => 'mysql:host=charlie;dbname=wallfeet',
			'emulatePrepare' => true,
			'username' => 'romeo',
			'password' => 'romeo',
			'charset' => 'utf8',
			'enableProfiling'=>'true',
		),*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=wallfeet',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'password',
			'charset' => 'utf8',
			'enableProfiling'=>'true',
		),
		'errorHandler'=>array(
		// use 'site/error' action to display errors
            'errorAction'=>'general/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
				array(
					'class'=>'CProfileLogRoute',
				),
			),
		),
		's3'=>array(
	        'class'=>'application.extensions.s3.ES3',
	        'aKey'=>'AKIAJBZFGYPXPYEALXGA', 
	        'sKey'=>'ffxTKlgPQfAEj+2uFCSPnm38oYhrTB2qWANmvBJd',
    	),
    	'file'=>array(
        	'class'=>'application.extensions.file.CFile',
    	),
    	 'cache'=>array(
            'class'=>'system.caching.CFileCache',
        ),
    	
		),

		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>array(
			// this is used in contact page
			'adminEmail'=>'webmaster@example.com',
			'globalSalt'=>'romeos@work',
			's3BucketName'=>'dev.palsonwheels.com',
		),
		);