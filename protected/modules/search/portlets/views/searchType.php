
<div class="search-for-property">
<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'search-type',
			'action'=>'/search/property',
			'htmlOptions'=>array('name'=>'thisSearchType'),
)); 
?>
<table width="60%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="middle"><h2>Search For</h2> </td>
    <td valign="middle"><a href="javascript:fnSearchType('property')" id="property_lnk"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icon-property.png" alt="" width="42" height="42" class="left" />Property </a></td>
    
    <td valign="middle"><a href="javascript:fnSearchType('people')" id="people_lnk"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icon-user.png" alt="" class="left" />People</a></td>
  </tr>
</table>
<?php $this->endWidget(); ?>
</div>


<script type="text/javascript">
	function fnSearchType(arg){
		if(arg=='property'){
			document.getElementById('search-type').action = '<?php echo $propertySearchUrl;?>';
			document.thisSearchType.submit();
		}
		else if(arg=='project'){
			document.getElementById('search-type').action = '<?php echo $projectSearchUrl;?>';
			document.thisSearchType.submit();
		}
		else if(arg=='people'){
			document.getElementById('search-type').action = '<?php echo $peopleSearchUrl;?>';
			document.thisSearchType.submit();
		}
		
	}
	function fnActive(arg){
		document.getElementById(arg+'_lnk').className = 'act';
	}

	fnActive('<?php echo $type;?>');
</script>