<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/script.js"></script>
<div id="property_search">

<?php $this->widget('SearchType',array('type'=>'people'));?>
<div class="inner-column" id="search_project_content" style="display:block">
<?php  $this->widget('PeopleCriteria',array('modelUser'=>$modelUser,
											'modelCity'=>$modelCity,
											'modelState'=>$modelState,
											'modelLocality'=>$modelLocality,
											'modelSpecialistType'=>$modelSpecialistType,
											'modelProfile'=>$modelProfile,
											)); ?>
												   
												   
<?php  $this->widget('PeopleResults',array('users'=>$users,
												'pages'=>$pages,
												'totalResults'=>$totalResults,
												'userType'=>$userType
													)); ?>
<br class="clear" />
</div>

</div>
