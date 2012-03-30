<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php 
Yii::app()->clientScript->scriptMap=array(
        'jquery.js'=>false,
);
?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- blueprint CSS framework -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<script type="text/JavaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/curvycorners.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/JavaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/curvycorners.js"></script>	
	<script type="text/JavaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/tabs.js"></script>	
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/cufon-yui.js"> </script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/myriad-pro.cufonfonts.js" type="text/javascript"></script>
	<script type="text/javascript">
	Cufon.replace('', { fontFamily: 'Myriad Pro Regular', hover: true }); 
	</script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/includes/wow/slider.css"/>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/wow/jquery.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/wow/wowslider.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/includes/styles.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/accordion.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/includes/stylesheet.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/extra.css" />
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scrolltopcontrol.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/basic.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico">
</head>
<body>

<?php include("topMenu.php"); ?>
<div id="wrapper">
  <div class="header">
    <h1 class="left"><a href="<?php echo Yii::app()->createAbsoluteUrl('/');?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo-beta1.jpg" alt="" /></a></h1>
    <div class="right toll">
     <br/><br/>
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/toll.png" alt="" /></div>
  </div>
 <?php 
  		$session=new CHttpSession;
		$session->open();
  		
		if(isset($_POST) && isset($_POST['top-city']) && $_POST['top-city']!==""){
  			$city = $_POST['top-city'];	
  			$session['top-city'] = $city;
  		}else {
  			$city = $session['top-location'];	
  		}
  		
  		if(isset($_POST) && isset($_POST['top-country']) && $_POST['top-country']!==""){
  			$country = $_POST['top-country'];	
  			$session['top-country'] = $country;
  		}else {
			$country = $session['top-country'];	
  		}
  		
  		if(isset($_POST) && isset($_POST['top-current'])){
  			$current = $_POST['top-current'];	
  			$session['top-current'] = $current;
  		}else {
  			$current = $session['top-current'];	
  		}
  	//	echo $country;die();
  		//echo $location . '1' . $country;die();
  
  ?>
  <?php  $this->widget('TopLocation',array('newCity'=>$city,'newCountry'=>$country,'current'=>$current));?>
  <?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
	if ($key=='counters') {continue;}
	echo "<div style='cursor:pointer; margin:10px 5px 0px 5px;' id='{$key}' class='flash-{$key}' onClick='$(this).slideToggle(\"fast\");' >{$message}<span style='float:right'>X</span></div>";
} ?> <br clear="all" />
  <div class="wrap_layout">
  		
		<?php echo $content; ?>
		
 		<br class="clear" />
  </div>
  <script language="javascript" type="text/javascript">
function popitup(url) {
	newwindow=window.open(url,'name','height=550,width=700');
	if (window.focus) {newwindow.focus()}
	return false;
}
</script>
  <div style="bottom: 0; cursor: pointer;opacity: 1;position: fixed;left: 0;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/feedback.png" onclick="return popitup('/feedback/')"></div>
</div>
<div class="clear"></div>
<?php include("footer.php"); ?>
</body>
</html>