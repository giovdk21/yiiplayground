

<div class="example_title">GridView with CArrayDataProvider</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $arrayDataProvider,
	'columns' => array(
		array(
			'name' => 'username',
			'type' => 'raw',
			'value' => 'CHtml::encode($data["username"])'
		),
		array(
			'name' => 'email',
			'type' => 'raw',
			'value' => 'CHtml::link(CHtml::encode($data["email"]), "mailto:".CHtml::encode($data["email"]))',
		),
	),
));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionGridViewArray',
		'protected/modules/UiModule/controllers/DataviewController.php'
	), false, true);

?>
</div>



<?php $this->widget('RightMenu', array('items'=>$this->getExampleSubMenu('grid_view'))); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/1.1/CGridView/'=>'CGridView',
		'http://www.yiiframework.com/doc/api/1.1/CArrayDataProvider'=>'CArrayDataProvider',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>