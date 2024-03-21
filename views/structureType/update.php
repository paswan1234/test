<?php
/* @var $this StructureTypeController */
/* @var $model StructureType */

$this->breadcrumbs=array(
	'Structure Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id_structure_type),
	'Update',
);

$this->menu=array(
	array('label'=>'Change Password', 'url'=>array('site/changePassword')),
        array('label'=>'Add/Edit Parking Type', 'url'=>array('parkingType/create')),
        array('label'=>'Add/Edit Structure Type', 'url'=>array('structureType/create')),
        array('label'=>'Add/Edit Amenities', 'url'=>array('amenities/create')),
);
?>

<h1>Update Structure Type (<?php echo $model->name; ?>)</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>