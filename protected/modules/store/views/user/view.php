<?php

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>
<hr/>
<h4>Account Information</h4>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email_id',
		'status',
		'verified_by',
		'warnings',
		'registered_ip',
		'last_login_ip',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
		'last_login_time',
	),
)); ?>
<br/><hr/>
<h4>Profile Information</h4>
<?php
$profile = UserApi::getUserProfileDetails($model->id);
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$profile,
    'attributes'=>array(
        'first_name',
        'last_name',
        'gender',
        'address_line1',
        'address_line2',
        'city.city',
        'state.state',
        'zip',
        'country.country',
        'mobile',
        'telephone',
    ),
)); ?>
<br/><hr/><br/>
<?php 
$this->widget(
    'application.modules.auditTrail.widgets.portlets.ShowAuditTrail',
    array(
        'model' => $model,
    )
);
?>
<br/><hr/><br/>
<?php 
$this->widget(
    'application.modules.auditTrail.widgets.portlets.ShowAuditTrail',
    array(
        'model' => $profile,
    )
);
?>