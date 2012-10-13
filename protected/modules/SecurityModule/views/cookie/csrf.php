<?php $this->breadcrumbs =array('Security'=>array('csrf/index'), 'enabledCsrfValidation',); ?>

<div class="example_title">enableCsrfValidation</div>

<div class="demo_box">

<?php
Yii::app()->sc->setStart(__LINE__);

echo CHtml::beginForm();
echo CHtml::textField('username');
echo CHtml::submitButton('Send');
echo CHtml::endForm();

echo "<br/><br/>Following is the html generated after csrfenabled in Yii's config : ";
echo "<br/><br/>";
echo CHtml::encode(CHtml::beginForm());
echo "<br/>";
echo CHtml::encode(CHtml::textField('username'));
echo "<br/>";
echo CHtml::encode(CHtml::submitButton('Send'));
echo "<br/>";
echo CHtml::encode(CHtml::endForm());

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getSnippetFromFile(
	"			'request'=>array(",
	"//end of request",
	"protected/config/development.php"),
	false, true
);
?>

</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>

<?php $this->widget('MoreInfoBox', array(
		'references'=>array('http://www.yiiframework.com/doc/guide/1.1/en/topics.security#cross-site-request-forgery-prevention'=>'Cross-site Request Forgery Prevention',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>
