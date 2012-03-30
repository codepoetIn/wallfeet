<?php 
// put this somewhere on top
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']); ?>

<?php
$this->breadcrumbs=array(
	'Geo Cities'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List GeoCity', 'url'=>array('index')),
	array('label'=>'Create GeoCity', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('geo-city-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php Yii::app()->clientScript->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');?>
<h1>Manage Geo Cities</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
    $str_js = "
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
        $('#geo-city-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            update : function () {
                serial = $('#geo-city-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                $.ajax({
                    'url': '" . $this->createUrl('//store/locationCity/sort') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    },
                    'error': function(request, status, error){
                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    ";
 
    Yii::app()->clientScript->registerScript('sortable-project', $str_js);
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'geo-city-grid',
	'rowCssClassExpression'=>'"items[]_{$data->id}"',
	'dataProvider'=>$model->searchTop(false),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'city',
		array('name'=>'metro','value'=>'$data->metro ? "Yes" : "No"'),
		//'metro',
		array('name'=>'state_id','value'=>'$data->state->state'),
		'priority',
	//	'state_id',
		//'updated_time',
		/*
		'updated_by',
		'created_time',
		'created_by',
		*/
	array(
	    'class'=>'CButtonColumn',
	    'header'=>CHtml::dropDownList('pageSize',$pageSize,array(20=>20,50=>50,100=>100),array(
	        // change 'user-grid' to the actual id of your grid!!
	        'onchange'=>"$.fn.yiiGridView.update('geo-city-grid',{ data:{pageSize: $(this).val() }})",
	    )),
	),
	),
)); ?>
