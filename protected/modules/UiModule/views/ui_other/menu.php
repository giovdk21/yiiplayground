<?php $this->breadcrumbs =array('Interface'=>array('ui_other/index'), 'Menu',); ?>

<a name="menu"></a>
<div class="example_title">Menu</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);
//put some little css so it's more beautiful
$css = '
	#my-menu ul{list-style-type:none;}
	#my-menu li {float:left;display:block;margin-right:20px;}
	#my-menu li.active a{color:#f00}
	';
Yii::app()->clientScript->registerCss('css-place-1',$css);

$this->widget('zii.widgets.CMenu', array(
        'id'=>'my-menu',
        'items'=>$menu,
));


Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
	'public function actionMenu',
	'protected/modules/UiModule/controllers/Ui_otherController.php'
), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CMenu'=>'CMenu',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>