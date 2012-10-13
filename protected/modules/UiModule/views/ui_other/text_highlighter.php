<?php $this->breadcrumbs =array('Interface'=>array('ui_other/index'), 'CTextHighlighter',); ?>

<a name="tree_view"></a>
<div class="example_title">CTextHightlighter</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

echo CHtml::beginForm();
echo 'You may input the text below and choose the language to see the highlighting difference : <br/>';
echo CHtml::dropDownList('language',$language,$listLanguage);
echo "<br/>";

echo CHtml::checkBox('show-line-numbers',$showLineNumbers);
echo CHtml::label("Line Number", 'show-line-numbers');
echo "<br/>";

echo CHtml::textArea('code',$code,array('rows'=>10,'cols'=>80));
echo "<br/>";
echo CHtml::submitButton();
echo CHtml::endForm();

echo "<br/><br/>";
echo "<h3>Result :</h3>";
echo "<hr/>";
$this->beginWidget('system.web.widgets.CTextHighlighter',array(
	'language'=>$language,
	'showLineNumbers'=>$showLineNumbers,
));
echo $code;
$this->endWidget();

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionTextHighlighter',
		'protected/modules/UiModule/controllers/Ui_otherController.php'
	), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>




<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CTextHighlighter'=>'CTextHighlighter',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>