<?php $this->breadcrumbs =array('Interface'=>array('ui_other/index'), 'CTreeview',); ?>

<a name="tree_view"></a>
<div class="example_title">CTreeview</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('CTreeView',array(
        'data'=>$dataTree,
        'animated'=>'fast', //quick animation
        'collapsed'=>'false',//remember must giving quote for boolean value in here
        'htmlOptions'=>array(
                'class'=>'treeview-red',//there are some classes that ready to use
        ),
));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionTreeView',
		'protected/modules/UiModule/controllers/Ui_otherController.php'
	), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>




<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CTreeView'=>'CTreeView',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>