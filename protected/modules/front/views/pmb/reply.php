<div id="property_search">
<div class="right">

</div>
<h1 class="heading" id="heading">My Message</h1>

<div class="inner-column">
<?php $this->widget('MyAccountMenu')?>
<?php
	 $form=$this->beginWidget('CActiveForm', array(
    'id'=>'property-form',
    'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	 
)); 
	echo '<div class="right cols2">
    	<div id="property_search_results">
        	<h1 class="property_search_results_top">You to <a href=/profile/'.$pmbMessage->to_user_id.'>'.ucwords($userName).' </a><span class="right new"></span> </h1>';
	echo '<div class="message_view">';
	echo '<h3><span>Subject :: </span></h3>';
	echo $form->textField($pmbMessage,'subject',array('class'=>'answer-ref_mail'));	
	echo '<h3><span>Message :: </span></h3>';
	echo $form->textArea($pmbMessage,'content',array('class'=>'answer-textarea'));
	
	echo '</div>';
	echo '<div class="pad10">';

	echo '<div class="right reply-submit"><input type="submit" name="submit" value="Reply" class="gry_bg_lnk" border="0" /></div>';
	echo '</div>';
	echo '<br clear="all" />';
	echo '</div></div>';
	 $this->endWidget(); 
?>
<br clear="all" />
</div>
</div>