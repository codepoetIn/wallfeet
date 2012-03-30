<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/script.js"></script>
<?php 
	if(!isset($_POST['mode'])){
		$_POST['mode'] = isset($_POST['Search_Type'])? $_POST['Search_Type'] : 'property';
		$_POST['user_type'] = isset($_POST['user_type'])? $_POST['user_type'] : 'agent';
	}
	$checked_people = "";
	$checked_project = "";
	$display_property = "block";
	$display_people = "none";
	$display_project = "none";
	if(isset($_POST['mode'])){
		if($_POST['mode']=="people"){
			$checked_people = 'checked="checked"';
			$display_property = "none";
			$display_people = "block";
			$display_project = "none";
		}
		elseif($_POST['mode']=="project"){
			$checked_project = 'checked="checked"';
			$display_property = "none";
			$display_people = "none";
			$display_project = "block";
		}
	}
	$this->widget(
	      'application.extensions.emultiselect.EMultiSelect',
	      array('sortable'=>true, 'searchable'=>true)
	);
?>
<div id="property_search">
<div class="search-for-property">
<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'search-type',
			'action'=>'/search',
			'htmlOptions'=>array('name'=>'thisSearchType'),
)); 
?>
<table width="60%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="middle"><h2>Search For</h2> </td>
    <td valign="middle"><a href="javascript:fnSearchType('property')" id="property_lnk"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icon-property.png" alt="" width="42" height="42" class="left" />Property </a></td>
    <td valign="middle"><a href="javascript:fnSearchType('project')" id="project_lnk"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icon-project.png" alt="" class="left" />Projects</a></td>
    <td valign="middle"><a href="javascript:fnSearchType('people')" id="people_lnk"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icon-user.png" alt="" class="left" />People</a></td>
  </tr>
</table>
<input type="hidden" name="Search_Type" id="search_type" />
<?php $this->endWidget(); ?>
</div>
<?php if($_POST['mode']=='property'){ ?>
<div class="inner-column" id="search_property_content" style="display:<?php echo $display_property; ?>"><?php $this->widget('PropertySearch',array('pages'=>$pages,'modelProperty'=>$modelProperty,'modelCity'=>$modelCity,'propertyAmenities'=>$propertyAmenities,'properties'=>$properties,'amenities'=>$amenities,'propertiesCount'=>$propertiesCount,'modelState'=>$modelState)); ?>
<br class="clear" />
</div>
<?php } ?>
<?php if($_POST['mode']=='people'){ ?>
<div class="inner-column" id="search_people_content" style="display:<?php echo $display_people; ?>"><?php $this->widget('PeopleSearch',array('modelProperty'=>$modelProperty,'modelUser'=>$modelUser,'modelProfile'=>$modelProfile,'modelSpecialistType'=>$modelSpecialistType,'users'=>$users,'pagesUser'=>$pagesUser,'pagesAgent'=>$pagesAgent,'pagesBuilder'=>$pagesBuilder,'pagesSpecialists'=>$pagesSpecialists)); ?>
<br class="clear" />
</div>
<?php } ?>
<?php if($_POST['mode']=='project'){ ?>
<div class="inner-column" id="search_project_content" style="display:<?php echo $display_project; ?>"><?php $this->widget('ProjectSearch',array('modelProject'=>$modelProject,'modelCity'=>$modelCity,'projectAmenities'=>$projectAmenities,'projects'=>$projects,'amenities'=>$amenities,'pagesProject'=>$pagesProject)); ?>
<br class="clear" />
</div>
<?php } ?>
</div>
<script type="text/javascript">
	function fnSearchType(arg){
		document.getElementById('search_type').value = arg;
		document.thisSearchType.submit();
	}
	function fnActive(arg){
		document.getElementById(arg+'_lnk').className = 'act';
	}
	<?php 
		if(isset($_POST['mode'])){
			echo 'fnActive("'.$_POST['mode'].'")';			
		}
	?>
</script>
