<?php $this->breadcrumbs =array('Interface'=>array('ui_other/index'), 'CTabView',); ?>

<a name="tab_view"></a>
<div class="example_title">CTabView</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('CTabView',array(
        'tabs'=>array(
		'tab1' => array(
			'title'=>'Profile',
			'content'=>'Name : Albert <br/>Profession : Doctor',
		),
		'tab2'=>array(
			'title'=>'Cart',
			'view'=>'_content',
			'data'=>array('products'=>2, 'prices'=>35.30),
		),
		'tab3'=>array(
			'title'=>'External Link',
			'url'=>'http://www.yiiframework.com/',
		)
		
	),

));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionTabView',
		'protected/modules/UiModule/controllers/Ui_otherController.php'
	), false, true);
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceFromFile(
	'protected/modules/UiModule/views/ui_other/_content.php'), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CTabView'=>'CTabView',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>