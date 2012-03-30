<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/script.js"></script>
<div id="property_search">

<?php $this->widget('SearchType',array('type'=>'project'));?>
<div class="inner-column" id="search_project_content" style="display:block">
<?php  $this->widget('ProjectCriteria',array('modelProject'=>$modelProject,'modelCity'=>$modelCity,'projectAmenities'=>$projectAmenities,
												   'amenities'=>$projectAmenities,
												   'modelState'=>$modelState)); ?>
												   
												   
<?php  $this->widget('ProjectResults',array('projects'=>$projects,
												'pages'=>$pages,
												'projectsCount'=>$projectsCount,

													)); ?>
<br class="clear" />
</div>

</div>
