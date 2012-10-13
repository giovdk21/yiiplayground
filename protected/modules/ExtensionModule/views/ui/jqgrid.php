<?php $this->breadcrumbs =array('User Interface'=>array('ui/index'), 'JQGrid'); ?>


<div class="example_title">JQGrid extension demo</div>

<p>
	With this extension you can use an interactive grid from JQuery Plugin
</p>
<p>
	Please, go to <a href="http://www.yiiframework.com/extension/jqgrid/">jqgrid extension page</a> for further information.
</p>


<div class="demo_box">

<?php
Yii::app()->sc->setStart(__LINE__); ?>
<?
$this->widget('application.modules.ExtensionModule.extensions.jqgrid.EJqGrid',
	array(
		'name'=>'jqgrid1',
		'compression'=>'none',
		'theme'=>'redmond',
		'useNavBar'=>false,
		'options'=>array(
			'datatype'=>'xml',
			'url'=>Yii::app()->createUrl('ExtensionModule/JQGrid/run'),
			'colNames'=>array('Index','Aircraft','BuiltBy'),
			'colModel'=>array(
				array('name'=>'id','index'=>'id','width'=>'55','name'=>'invdate','index'=>'invdate','width'=>90),
				array('name'=>'aircraft','index'=>'aircraft','width'=>90),
				array('name'=>'factory','index'=>'factory','width'=>100)
			),
			'sortname'=>'id',
			'viewrecords'=>true,
			'sortorder'=>"desc",
			'caption'=>"Airplanes from XML"
		)
	)
);
?>
	<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->

<?
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
	'public function actionJQGrid',
	'protected/modules/ExtensionModule/controllers/UiController.php'
), false, true);
?>

<?
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
	'public function run',
	'protected/modules/ExtensionModule/controllers/JQGridController.php'
), false, true);
?>


<?php Yii::app()->sc->renderSourceBox(); ?>



<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/extension/jqgrid/'=>'JQGrid extension',
	),
	//'see_also'=>array(),
	'external_links'=>array(
		'http://www.trirand.com/blog/'=>'JQGrid resource page',
		'http://trirand.com/blog/jqgrid/jqgrid.html'=>'JQGrid demo',
	),
)); ?>