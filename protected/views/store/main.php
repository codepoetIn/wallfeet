<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />

<!-- blueprint CSS framework -->
<link rel="stylesheet" type="text/css"
	href="<?php
	echo Yii::app ()->request->baseUrl;
	?>/css/screen.css"
	media="screen, projection" />
<link rel="stylesheet" type="text/css"
	href="<?php
	echo Yii::app ()->request->baseUrl;
	?>/css/print.css"
	media="print" />
<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php
	echo Yii::app ()->request->baseUrl;
	?>/css/ie.css" media="screen, projection" />
	<![endif]-->

<link rel="stylesheet" type="text/css"
	href="<?php
	echo Yii::app ()->request->baseUrl;
	?>/css/main.css" />
<link rel="stylesheet" type="text/css"
	href="<?php
	echo Yii::app ()->request->baseUrl;
	?>/css/form.css" />
	<?php
	Yii::app ()->getClientScript ()->registerCoreScript ( 'jquery' );
	?>
	<?php
	Yii::app ()->clientScript->registerScriptFile ( Yii::app ()->request->baseUrl . "/js/ddsmoothmenu.js" );
	?>
	<?php
	Yii::app ()->clientScript->registerCssFile ( Yii::app ()->request->baseUrl . "/css/ddsmoothmenu.css" );
	?>
	<?php
	Yii::app ()->clientScript->registerScriptFile ( Yii::app ()->request->baseUrl . "/js/initddsmoothmenu.js" );
	?>
	
	<title><?php
	echo CHtml::encode ( $this->pageTitle );
	?></title>
</head>

<body>

<div class="container" id="page">

<div id="header">
<div id="logo"><?php
echo CHtml::encode ( Yii::app ()->name );
?></div>
</div>
<!-- header -->`

<div id="smoothmenu1" class="ddsmoothmenu">
	<?php
	$this->widget ( 'zii.widgets.CMenu', array ('items' => array (array ('label' => 'Home', 'url' => array ('/store/site/index' ) ), 

	array ('label' => 'Property', 'url' => '#', 
		'items' => array (array ('label' => 'Manage Property', 'url' => array ('/store/property/admin' )),
		array ('label' => 'Manage Instant Properties', 'url' => array ('/store/property/instant' )),
		array ('label' => 'Manage Jackpot Properties', 'url' => array ('/store/property/jackpot' )),
		array ('label' => 'Manage Premium Properties', 'url' => array ('/store/property/premium' )),		
    	array ('label' => 'Manage Property Images', 'url' => array ('/store/propertyImages/admin' )), 
    	array ('label' => 'View Property Ratings', 'url' => array ('/store/propertyRating/admin' )),
    	array ('label' => 'View Property Wishlist', 'url' => array ('/store/propertyWishlist/admin' ) ) ),'visible' => Yii::app ()->user->checkAccess ( 'store-PropertyAdministrating' )), 

	/*array ('label' => 'Project', 'url' => '#', 
		'items' => array (array ('label' => 'Manage Project', 'url' => array ('/store/projects/admin' )),
		array ('label' => 'Manage Project Images', 'url' => array ('/store/projectImages/admin' ) ), 
		array ('label' => 'View Project Ratings', 'url' => array ('/store/projectRating/admin' ) ), 
		array ('label' => 'View Project Wishlist', 'url' => array ('/store/projectWishlist/admin' ) ) ) ,'visible' => Yii::app ()->user->checkAccess ( 'store-ProjectsAdministrating' )), 
	
		array ('label' => 'Requirements', 'url' => array ('/store/requirement/admin' ),'visible' => Yii::app ()->user->checkAccess ( 'store-RequirementAdministrating' ) ), 
*/

/*	array ('label' => 'Advertise', 'url' => '#', 
		'items' => array (array ('label' => 'Manage Advertisement', 'url' => array ('/index' ) ), 
		array ('label' => 'Manage Advertisement Plans', 'url' => array ('/index' ) ), 
		array ('label' => 'Manage Pages', 'url' => array ('/index' ) ) )), 
*/
	array ('label' => 'JukeBox', 'url' => '#',
		'items' => array (
		array ('label' => 'Manage Questions', 'url' => array ('/store/jukeboxQuestions/admin' ) ), 
		array ('label' => 'Manage Answers', 'url' => array ('/store/jukeboxAnswers/admin' ) ), 
		array ('label' => 'Manage Question Ratings', 'url' => array ('/store/jukeboxRating/admin' ) ) ) ,'visible' => Yii::app ()->user->checkAccess ( 'store-JukeboxQuestionsAdministrating' )), 
		
	array ('label' => 'Users', 'url' => '#', 
		'items' => array (array ('label' => 'Users', 'url' => '#',
			'items' => array (array ('label' => 'Manage Users', 'url' => array ('/store/user/admin' ) ) ) ), 
		array ('label' => 'Agent', 'url' => '#', 
			'items' => array (array ('label' => 'Manage Agent', 'url' => array ('/store/agent/admin' ) ) ) ), 
		array ('label' => 'Builder', 'url' => '#', 
			'items' => array (array ('label' => 'Manage Builder', 'url' => array ('/store/builder/admin' ) ) ) ), 
		array ('label' => 'Specialist', 'url' => '#',
			'items' => array (array ('label' => 'Manage Specialist', 'url' => array ('/store/specialist/admin' ) ), 
		array ('label' => 'Manage Specialist Projects', 'url' => array ('/store/specialistProjects/admin' ) ) ) ) ), 'visible' => Yii::app ()->user->checkAccess ( 'store-UserAdministrating' ) ), 

		
	array ('label' => 'Locations', 'url' => array ('/' ), 
		'items' => array (array ('label' => 'Manage Countries', 'url' => array ('/store/locationCountry/admin' ) ), 
	array ('label' => 'Manage States', 'url' => array ('/store/locationState/admin' ) ), 
	array ('label' => 'Manage Domestic Cities', 'url' => array ('/store/locationCity/adminDomestic' ) ), 
	array ('label' => 'Manage International Cities', 'url' => array ('/store/locationCity/adminInternational' ) ) ), 'visible' => Yii::app ()->user->checkAccess ( 'store-LocationAdministrating' )),
	 
	array ('label' => 'Feedback', 'url' => array ('/' ), 
	'items' => array (array ('label' => 'Manage Feedback', 'url' => array ('/store/feedback/admin' ) ), 
	
	 ), 'visible' => Yii::app ()->user->checkAccess ( 'store-FeedbackAdministrating' )),
		array ('label' => 'Loan', 'url' => array ('/' ), 
	'items' => array (array ('label' => 'Manage Loan', 'url' => array ('/store/loan/admin' ) ), 
	
	 ), 'visible' => Yii::app ()->user->checkAccess ( 'store-LoanAdministrating' )),
	array ('label' => 'Messages', 'url' => '#', 
		'items' => array (array ('label' => 'Manage Inbox', 'url' => array ('/index' ) ), 
		array ('label' => 'View Sent', 'url' => array ('/index' ) ) ) ), 

	array ('label' => 'Email Templates', 'url' => array ('/store/emailTemplates/admin' ), 'visible' => Yii::app ()->user->checkAccess ( 'store-EmailTemplatesAdministrating' ) ), 
	
	array ('label' => 'RBAC', 'url' => array ('/srbac/authitem/frontpage' ), 'visible' => Yii::app ()->user->checkAccess ( 'Superman' ) ), 
	
	/*array ('label' => 'Testimonials', 'url' => array ('/index' ) ), */
	array ('label' => 'Settings', 'url' => '#', 
		'items' => array (array ('label' => 'User Settings', 'url' => array ('/store/userSettings/admin' ) ), 
	//	array ('label' => 'Global Settings', 'url' => array ('/store/globalSettings/admin' ) ), 
		array ('label' => 'Manage Property Types', 'url' => array ('/store/propertyTypes/admin' ) ), 
		array ('label' => 'Manage Property Transaction Types', 'url' => array ('/store/propertyTransactionTypes/admin' ) ), 
		array ('label' => 'Manage Project Types', 'url' => array ('/store/projectTypes/admin' ) ), 
		array ('label' => 'Manage Age Of Construction', 'url' => array ('/store/propertyAgeOfConstruction/admin' ) ), 
		array ('label' => 'Manage JukeBox Category', 'url' => array ('/store/jukeboxCategory/admin' ) ), 
		array ('label' => 'Manage Amenities', 'url' => array ('/store/amenities/admin' ) ), 
		array ('label' => 'Ownership Types', 'url' => array ('/store/ownershipTypes/admin' ) ), 
		array ('label' => 'Manage Specialization', 'url' => array ('/store/specializations/admin' ) ) ) , 'visible' => Yii::app ()->user->checkAccess ( 'store-UserSettingsAdministrating' ) ), 

	array ('label' => 'Login', 'url' => array ('/store/site/login' ), 'visible' => Yii::app ()->user->isGuest ), 
	array ('label' => 'Logout (' . Yii::app ()->user->name . ')', 'url' => array ('/store/site/logout' ), 'visible' => ! Yii::app ()->user->isGuest ) ) ) );
	?>
	<br style="clear: left" />
</div>
	
	<?php
	if (isset ( $this->breadcrumbs )) :
		?>
		<?php
		$this->widget ( 'zii.widgets.CBreadcrumbs', array ('homeLink' => CHtml::link ( 'Home', '/store/site/index' ), 'links' => $this->breadcrumbs ) );
		?><!-- breadcrumbs -->
	
	
	<?php endif?>

	<?php
	echo $content;
	?>

	<div id="footer">
		Copyright &copy; 
		<?php
		echo date ( 'Y' );
		?>
		by My Company.<br />
All Rights Reserved.<br />
		<?php
		echo Yii::powered ();
		?>
	</div>
<!-- footer --></div>
<!-- page -->

</body>
</html>