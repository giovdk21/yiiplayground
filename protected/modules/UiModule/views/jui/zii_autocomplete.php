<?php $this->breadcrumbs =array('Interface'=>array('jui/index'), 'Zii autocomplete',); ?>

<a name="ajax_datasource"></a>
<div class="example_title">Autocomplete with Ajax datasource</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
	'name'=>'test1',
	'value'=>'test21',
	'source'=>$this->createUrl('jui/autocompleteTest'),
	// additional javascript options for the autocomplete plugin
	'options'=>array(
			'showAnim'=>'fold',
	),
));


Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionAutocompleteTest',
		'protected/modules/UiModule/controllers/JuiController.php'
	), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<a name="array_datasource"></a>
<div class="example_title">Autocomplete with Array datasource</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
	'name'=>'test2',
	'source'=>array('ac1', 'ac2', 'ac3'),
));


Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->


<?php $this->widget('RightMenu', array('items'=>$this->getExampleSubMenu('zii_autocomplete'))); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CJuiAutoComplete'=>'CJuiAutoComplete',
		'http://jqueryui.com/demos/autocomplete/'=>'jQuery UI - Autocomplete',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>