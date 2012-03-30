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
/*		'application.extensions.*',
		'ext.widgets.*',*/
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
		'application.modules.general.portlets.*',
		'application.modules.payment.models.*',
		'application.modules.payment.api.*',
		'application.modules.pmb.models.*',
		'application.modules.pmb.api.*',
		'application.modules.pmb.portlets.*',
		'application.modules.project.models.*',
		'application.modules.project.api.*',
		'application.modules.project.portlets.*',
		'application.modules.property.portlets.*',
		'application.modules.requirement.portlets.*',
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
		'application.modules.requirement.models.*',
		'application.modules.requirement.api.*',
		'application.modules.setting.portlets.*',
		'application.modules.search.api.*',
		'application.modules.search.portlets.*',
		'application.modules.search.models.*',
		'application.modules.loan.models.*',
		'application.modules.notificationlabel.models.*',
		'application.modules.notificationlabel.api.*',
		'application.modules.feedback.models.*',
		'application.modules.feedback.api.*',
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
			'alwaysAllowed'=>array('front-SiteContactUs','general-AjaxNumberConvert','front-SitePrice','front-SiteAreaCal','front-SiteWhyWallFeet','front-PropertyGetPropertyCriteriaType','front-PropertyGetPropertyFeatures','front-SiteTerms','front-SiteEmi','store-FeedbackAdmin','front-AccountUpdate','front-FeedbackThanks','front-FeedbackIndex','front-AccountResendEmail','front-AccountForgotPassword','location-MapRender','front-AccountRegister','front-AccountLogin','front-SearchProperty','front-SearchProject','front-SearchPeople', 'front-SiteError','front-PropertySearchProperty','front-ProjectSearchProject','front-SiteHome','store-SiteLogin','store-SiteLogout','store-SiteIndex','GeneralError','front-SiteSearch','location-StateGetList','location-CityGetCityList','location-StateGetStateList','location-CityGetList','location-CityGetMultiList','location-LocalityGetList','front-SiteAccount','front-SiteAboutUs','front-JukeboxSearch','front-ProjectSearch','front-AccountIndex','front-AccountThanks','front-AccountActivate'),
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
		'requirement'=>array(),
		'search'=>array(),
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
		     /* array('user/userResource/list', 'pattern'=>'user', 'verb'=>'GET'),
		        array('user/userResource/view', 'pattern'=>'user/<id:\d+>', 'verb'=>'GET'),
		        array('user/userResource/update', 'pattern'=>'user/<id:\d+>', 'verb'=>'PUT'),
		        array('user/userResource/delete', 'pattern'=>'user/<id:\d+>', 'verb'=>'DELETE'),
		        array('user/userResource/create', 'pattern'=>'user', 'verb'=>'POST'),*/
		
		
				//front action
				'<action:(home|members|emi|AboutUs|Terms|WhyWallFeet|AreaCal|Price|contactUs)>' => 'front/site/<action>',
				'<action:(login|register|update|settings)>' => 'front/account/<action>',
				'<controller:(profile)>/<id:\d+>'=>'front/account/profile',
				'<controller:(message)>/<id:\d+>'=>'front/pmb/view',
				'<controller:(message)>/<action:(reply)>/<userId:\d+>'=>'front/pmb/reply',
				'<controller:(messages)>'=>'front/pmb/index',
				'<controller:(messages)>/<action:(sent|reply)>'=>'front/pmb/<action>',
				'<controller:(properties)>'=>'front/property/index',
				'<controller:(projects)>'=>'front/project/index',
				'<controller:(feedback)>'=>'front/feedback/index',
				'<controller:(feedback)>/<action>'=>'front/feedback/<action>',
				'<controller:(requirements)>'=>'front/requirement/index',
		
				'<controller:(jukebox)>'=>'front/jukebox/index',
				'<controller:(wishlists)>'=>'front/wishlist/index',
				'<controller:(wishlist)>/<action:(delete)>/<id:\d+>'=>'front/wishlist/delete',
				
				//front controller action
				'<controller:(property)>'=>'front/property/',
				'<controller:(property)>/<id:\d+>'=>'front/property/view',
				'<controller:(property)>/<action:(post)>/<projectId:\d+>'=>'front/property/post',
				'<controller:(property)>/<action:\w+>'=>'front/property/<action>',
				'<controller:(property)>/<action:(index|create|view|image)>'=>'front/property/<action>',
				'<controller:(property)>/<action:(update)>/<id:\d+>'=>'front/property/update',
				'<controller:(property)>/<action:(update)>/<id:\d+>/<imageId:\d+>'=>'front/property/update',
				'<controller:(property)>/<action:(deleteProperty)>/<id:\d+>'=>'front/property/deleteProperty',
		
				'<controller:(advertise)>'=>'front/advertise/', 									
				'<controller:(advertise)>/<action:(index|create)>'=>'front/advertise/<action>', //property action page
				
				'<controller:(agent)>'=>'front/agent/',
				'<controller:(agent)>/<action:(index|create|update|delete)>'=>'front/agent/<action>',			//advertise action page
				'<controller:(agent)>/<userId:\d+>'=>'front/agent/view',				
				
				'<controller:(builder)>'=>'front/builder/',
				'<controller:(builder)>/<action:(index|create|update|delete)>'=>'front/builder/<action>',		//agent action page
				'<controller:(builder)>/<userId:\d+>'=>'front/builder/view',
				
				'<controller:(email)>'=>'front/email/',
				'<controller:(email)>/<action:(index|create)>'=>'front/email/<action>',			//builder action page
				
				'<controller:(jukebox)>'=>'front/jukebox/',
				'<controller:(jukebox)>/<action:(index|search|post)>'=>'front/jukebox/<action>',
				'<controller:(jukebox)>/<id:\d+>'=>'front/jukebox/view',						//juckbox action page
				'<controller:(jukebox)>/<action:(delete)>/<id:\d+>'=>'front/jukebox/delete',
				
				'<controller:(location)>'=>'front/location/',
				'<controller:(location)>/<action:(index|create)>'=>'front/location/<action>',	// location action page
				
				'<controller:(payment)>'=>'front/payment/',
				'<controller:(payment)>/<action:(index|create)>'=>'front/payment/<action>',		//payment action page
				
				'<controller:(pmb)>'=>'front/pmb/',
				'<controller:(pmb)>/<action:(index|create)>'=>'front/pmb/<action>',				// message action page
				
				'<controller:(project)>'=>'front/project/',
				'<controller:(project)>/<id:\d+>'=>'front/project/view',
				'<controller:(project)>/<action:\w+>'=>'front/project/<action>',
				'<controller:(project)>/<action:(index|create|search|image|view)>'=>'front/project/<action>',// project action page
				
				'<controller:(specialist)>'=>'front/specialist/',
				'<controller:(specialist)>/<action:(index|create|update|delete)>'=>'front/specialist/<action>', //specialist action page
				'<controller:(specialist)>/<userId:\d+>'=>'front/specialist/view',
				
				'<controller:(dashboard)>'=>'front/account/index',
		
				'<controller:(account)>/<action:\w+>'=>'front/account/<action>',
		
				'<controller:(requirement)>'=>'front/requirement/',
				'<controller:(requirement)>/<id:\d+>'=>'front/requirement/view',
				'<controller:(requirement)>/<action:\w+>'=>'front/requirement/<action>',
				'<controller:(requirement)>/<action:(index|create)>'=>'front/specialist/<action>',
				'<controller:(requirement)>/<action:(delete|similar)>/<id:\d+>'=>'front/requirement/<action>',
				'<controller:(search)>/<action:(property|project|people)>'=>'front/search/<action>',// project action page
		
				//store action
				'<action:(admin)>' => 'store/site/index/<action>',//admin url		
				'<action:(admin)>' => 'store/site/index/<action>',
				'<controller:(specialist)>/<action:(index|create)>'=>'front/specialist/<action>',
				//specialist action page*/
				
				//	'<action:(admin)>' => 'store/site/index/<action>',
				//admin url
		
				//general controller action
				'<controller:(general)>/<action:\w+>'=>'general/<action>',				
				
				'property/image/<id:\d+>'=>'front/property/image',
				'project/image/<id:\d+>'=>'front/project/image',
		
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
/*				array(
					'class'=>'CWebLogRoute',
				),
				array(
					'class'=>'CProfileLogRoute',
				),*/
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
			'adminEmail'=>'webmaster@wallfeet.us',
			'globalSalt'=>'romeos@work',
			's3Url'=>'https://s3.amazonaws.com/dev.wallfeet.com/',
			's3BucketName'=>'dev.wallfeet.com',
			's3PropImagesFolderName'=>'properties/images/',
			's3ProjImagesFolderName'=>'projects/images/',
			's3SpecialistsImagesFolderName'=>'specialists/images/',
			's3AgentImagesFolderName'=>'agents/images/',
			's3BuilderImagesFolderName'=>'builders/images/',
			's3ProfileImagesFolderName'=>'profiles/images/',
			's3FeedImagesFolderName'=>'feedback/images/',
			'resultsPerPage'=>10,
			'dashboardResultsPerPage'=>5,
			's3ProfilesImagesFolderName'=>'profiles/images/',
			'fbAppId'=>'235972316439236',
			'fbSecret'=>'6fc62cc2c796e13be42f2ee827dc8e60',
			'smtpHostName'=>'mail.wallfeet.us',
			'smtpUserName'=>'webmaster@wallfeet.com',
			'smtpPassword'=>'Password123!',
			'newLaunchNoOfDays'=>10,
			'uploadImagesLimit'=>10,
			'adminPageSize'=>20,
		),
		);