
<a name="basic_gridview"></a>
<div class="example_title">Basic GridView example</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		array(
			'name' => 'username',
			'type' => 'raw',
			'value' => 'CHtml::encode($data->username)'
		),
		array(
			'name' => 'email',
			'type' => 'raw',
			'value' => 'CHtml::link(CHtml::encode($data->email), "mailto:".CHtml::encode($data->email))',
		),
	),
));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function search',
		'protected/models/User.php'
	), false, true);
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionGridView',
		'protected/modules/UiModule/controllers/DataviewController.php'
	), false, true);
?>
</div><!-- demo box -->


<?php $this->widget('RightMenu', array('items'=>$this->getExampleSubMenu('grid_view'))); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/1.1/CGridView/'=>'CGridView',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>