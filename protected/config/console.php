<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Wallfeet',
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
		'application.modules.user.portlets.*',
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
		'application.modules.sms.models.*',
		'application.modules.sms.api.*',
		'application.modules.general.models.*',
		'application.modules.general.api.*',
		'application.modules.general.Portlet.*',
		'application.modules.payment.models.*',
		'application.modules.payment.api.*',
		'application.modules.pmb.models.*',
		'application.modules.pmb.api.*',
		'application.modules.project.models.*',
		'application.modules.project.api.*',
		'application.modules.project.portlets.*',
		'application.modules.property.portlets.*',
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
		'application.modules.jukebox.portlets.*',
		'application.modules.category.models.*',
		'application.modules.category.api.*',
		'application.modules.daemon.models.*',
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
			'alwaysAllowed'=>array('front-SiteError','front-SiteHome','store-SiteLogin','store-SiteLogout','store-SiteIndex','GeneralError','front-SiteSearch','location-StateGetList','location-CityGetList','location-LocalityGetList','front-SiteAccount','front-JukeboxSearch','front-ProjectSearch','front-PropertyView','front-PropertyPost','front-JukeboxView'),
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
		'sms'=>array(),
		'general'=>array(),
		'payment'=>array(),
		'pmb'=>array(),
		'project'=>array(),
		'property'=>array(),
		'location'=>array(),
		'category'=>array(),
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
		'db'=>array(
			'connectionString' => 'mysql:host=wallfeetmysql.cpncecvbrd0w.us-east-1.rds.amazonaws.com;dbname=wallfeet_master',
			'emulatePrepare' => true,
			'username' => 'wfmyroot',
			'password' => 'Romeos123',
			'charset' => 'utf8',
			'enableProfiling'=>'true',
		),
		'errorHandler'=>array(
		// use 'site/error' action to display errors
            'errorAction'=>'front/site/error',
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
			'rootDir'=>dirname(dirname(dirname(__FILE__))),
			'adminEmail'=>'webmaster@example.com',
			'globalSalt'=>'romeos@work',
			's3Url'=>'https://s3.amazonaws.com/dev.wallfeet.com/',
			's3BucketName'=>'dev.wallfeet.com',
			's3PropImagesFolderName'=>'properties/images/',
			's3ProjImagesFolderName'=>'projects/images/',
			's3SpecialistsImagesFolderName'=>'specialists/images/',
			's3ProfileImagesFolderName'=>'profiles/images/',
			'resultsPerPage'=>10,
			's3ProfilesImagesFolderName'=>'profiles/images/',
			'fbAppId'=>'235972316439236',
			'fbSecret'=>'6fc62cc2c796e13be42f2ee827dc8e60',
			'smtpHostName'=>'smtp.gmail.com',
			'smtpUserName'=>'admin@wallfeet.com',
			'smtpPassword'=>'Password123!',
		),
		);