<div class="dashboard-top">
    <img width="80" height="80" class="left" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/user.jpg">
    <div style="width:800px;" class="right">
    	<p>Welcome <span class="red-txt"><b><?php echo isset($model['first_name']) ? $model['first_name'] : null?></b></span><a class="red-txt right" href="/store/site/logout">Logout</a></p>
        <p class="clear"><span>Last Login</span> : <?php  echo(date("d-M-Y h A",strtotime($model['last_login_time'])));?>  , <span>Login IP</span>: <?php echo CHttpRequest::getUserHostAddress();?><span class="right">Date : <?php echo date('d M Y')?></span></p>
        <p class="clear"><span>Email</span>: <a href="<?php echo $model['email_id']?>"><?php echo $model['email_id']?></a>,
         <span>Contact no</span>: <?php echo isset($model['mobile']) ? $model['mobile'] : null?> </p>
    </div>
    <br class="clear">
</div>
<br class="clear">