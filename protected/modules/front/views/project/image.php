<?php
	Yii::import('ext.jqPrettyPhoto');
	$options = array(
		    'slideshow'=>5000,
		    'autoplay_slideshow'=>false, 
		    'show_title'=>false
	);
	jqPrettyPhoto::addPretty('.gallery_prettyphoto a',jqPrettyPhoto::PRETTY_GALLERY,jqPrettyPhoto::THEME_FACEBOOK, $options); 
?>
<div id="property_search">
<h1 class="heading">Project Images :: <a href="#"><?php echo $project->project_name; ?></a></h1>
<div class="upload_img">
<h2 class="head-tab">Upload Photo</h2>
<div class="pad20">
	<?php 
		$form=$this->beginWidget('CActiveForm', array(
		    'id'=>'property-form',
		    'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		)); 
		$this->widget('CMultiFileUpload', array('model'=>$model,'attribute'=>'image',));
	?>
	<input type="submit" name="submit" value="" class="btn-upload" border="0" /> 
	<?php 
		$this->endWidget(); 
		if($images){
			echo '<div class="gallery_prettyphoto">';
			echo '<ul>';
			foreach($images as $image){
				echo '<li><a href="'.$image.'"><img src="'.$image.'" alt="" width="100" /></li>';
			}
			echo '</ul>';
			echo '</div>';					
		}		
	?>
<br class="clear" />
</div>
</div>
</div>
