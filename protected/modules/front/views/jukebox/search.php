
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/script.js"></script>
<div id="property_search">
<h1 class="heading" id="heading">Q & A Search <span>Searching for questions
 Search Now</span></h1>
<div class="inner-column" id="search_property_content"><?php $this->widget('JukeboxSearch',array('modelJukeboxQuestions'=>$modelJukeboxQuestions,'questions'=>$questions,'pages'=>$pages,'jukeboxCount'=>$jukeboxCount)); ?>
<br class="clear" />
</div>
</div>