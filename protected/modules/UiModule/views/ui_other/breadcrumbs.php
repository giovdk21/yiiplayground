<div class="example_title">Breadcrumbs</div>

<?php 
Yii::app()->sc->setStart(__LINE__);

$this->breadcrumbs =array(
	'Interface',
	'Other'=>array('ui_other/index'),
	'Breadcrumbs'=>'http://www.yiiframework.com/doc/api/CBreadcrumbs',
);

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));

Yii::app()->sc->collect('php', Yii::app()->sc->getSnippetFromFile(
	"<?php \$this->widget('zii.widgets.CBreadcrumbs",
	"<!-- breadcrumbs -->",
	"protected/views/layouts/main.php"),
	false, true
);

?>