<?php
/* @var $this MgmtcompanyController */
/* @var $model Mgmtcompany */

$this->breadcrumbs = array(
    'Mgmtcompanies' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Manage Management Company', 'url' => array('admin')),
    array('label' => 'Add Management Company', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mgmtcompany-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Management Companies</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'type' => 'striped bordered',
    'enablePagination' => true,
    'id' => 'mgmtcompany-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        'address',
        'city',
        'state',
        'zip',
        /* 'zip4',
          'phone',
          'fax',
          'email',
          'url',
          'contact',
          'status',
          'create_time',
          'update_time',
          'author_id',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
));
?>

