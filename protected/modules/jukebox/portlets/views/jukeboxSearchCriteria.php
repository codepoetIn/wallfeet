<div class="left cols1">
<h2>Search</h2>
<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'jukebox-search-form',
			'enableAjaxValidation'=>false,
			'action'=>'/jukebox/search',
			'htmlOptions'=>array('name'=>'thisQuestion'),
)); ?>
<input type="hidden" name="mode" value="property" />
<ul class="acc" id="acc">
	<li>
	<h3>Basic Details</h3>
	<div class="acc-section">
	<table width="92%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td>Keyword(s)<input type="text" name="keyword" class="txt-box1" value="<?php echo isset($_POST['keyword'])? $_POST['keyword'] : '';?>" /></td>
		</tr>
		<tr>
			<td><label>Category</label> <?php echo $form->dropDownList($modelJukeboxQuestions,'category_id',CHtml::listData(JukeboxCategory::model()->findAll(),'id','category'),array('class'=>'select_box','empty'=>'All')); ?>
			</td>
		</tr>
		<tr>
			<td>Time
				<select name="time" class="select_box">
					<option value="">All</option>
					<option value="7">1 Week Ago</option>
					<option value="14">2 Week Ago</option>
					<option value="30">1 Month Ago</option>
					<option value="60">2 Month Ago</option>
					<option value="90">3 Month Ago</option>
					<option value="180">6 Month Ago</option>
				</select>
				<script type="text/javascript">
					document.thisQuestion.time.value =  "<?php echo isset($_POST['time'])? $_POST['time'] : '';?>";
				</script>
			</td>
		</tr>
		</table>
		</div>
	</li>
</ul><br />
<div align="center"><input type="submit" name="submit" value="" class="btn-submit-s" /></div>
<?php $this->endWidget(); ?></div>
