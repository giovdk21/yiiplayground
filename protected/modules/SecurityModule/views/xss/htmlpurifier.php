<?php $this->breadcrumbs =array('Security'=>array('xss/index'), 'CHtmlPurifier',); ?>

<div class="example_title">CHtmlPurifier</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

echo "Try to input some html tags and see what tag does it filter : ";
echo CHtml::beginForm();
echo CHtml::textArea('user_input');
echo "<br/>";
echo CHtml::submitButton();
echo CHtml::endForm();

echo "<br/><br/>The result: <br/>";
echo $user_input;

echo "<br/><br/>The result in html: <br/>";
echo CHtml::encode($user_input);

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionHtmlPurifier',
		'protected/modules/SecurityModule/controllers/XssController.php'
	), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<?php $this->widget('MoreInfoBox', array(
	'references'=>array('http://www.yiiframework.com/doc/api/CHtmlPurifier'=>'CHtmlPurifier',
                                                        'http://www.yiiframework.com/doc/guide/1.1/en/topics.security'=>'Yii Guide : Security'),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>