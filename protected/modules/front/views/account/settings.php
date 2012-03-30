  	<div id="property_search">
    <h1 class="heading" style="font-size:18px; color:#A40E0E;">Edit Account Details </h1>
    <div class="inner-column">
<div class="left cols1">
<ul class="acc">
	<li class="active"><h3><a href="/settings">Settings</a></h3></li>
	<li class=""><h3><a href="/account/password">Change Password</a></h3></li>
</ul>
</div>
<div class="right cols2"><div id="property_search_results">
<div style="background-color:#F0F0F0; padding:15px 20px; font-size:14px; line-height:22px; margin-top:20px;">
	<h1 style="font-size:18px; margin-bottom:5px;" class="heading">My Settings</h1>
       <?php $form=$this->beginWidget('CActiveForm', array(
			 			'enableAjaxValidation'=>true,
						
						//'htmlOptions'=>array('onSubmit'=>'return checkAgreement()'),
					)); ?>
        <table cellspacing="0" cellpadding="0" border="0" width="85%" align="center">
          <tbody><tr>
                <td valign="top" align="right" style="line-height:28px;"><p>Notification to</p></td>
               <td> <?php 
                echo CHtml::checkBoxList('notification',$notificationId,CHtml::listData(NotificationLabel::model()->findAll(),'id','name'),array()); ?>
       </td>
          </tr>
              <tr>
                <td></td>
                <td align="left"><input type="submit" class="btn-search" value="Modify" name="email"></td>
              </tr>
        </tbody></table>
        
 <?php $this->endWidget(); ?>
      </div>
</div>
<br clear="all">
</div>
<br class="clear">
    </div>
  </div>
