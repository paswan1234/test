<?php
/* @var $this PropertyTypeController */
/* @var $model PropertyType */

$this->breadcrumbs=array(
	'Property Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PropertyType', 'url'=>array('index')),
	array('label'=>'Create PropertyType', 'url'=>array('create')),
	array('label'=>'Update PropertyType', 'url'=>array('update', 'id'=>$model->id_property_type)),
	array('label'=>'Delete PropertyType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_property_type),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PropertyType', 'url'=>array('admin')),
);
?>

<h1>View PropertyType #<?php echo $model->id_property_type; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_property_type',
		'name',
		'value',
	),
)); ?>
