<?php
/* @var $this NewsletterSubscriptionController */
/* @var $model NewsletterSubscription */

$this->breadcrumbs = array(
    'Newsletter Subscriptions' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Manager Subscription', 'url' => array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#newsletter-subscription-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Newsletter Subscriptions</h1>

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
    'id' => 'newsletter-subscription-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'type' => 'striped bordered',
    'enablePagination' => true,
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id_newsletter',
        'email',
        array('name' => 'created_date', 'header' => 'Date', 'value' => 'date("m-d-Y",strtotime($data->created_date))'),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
        ),
    ),
));
?>

