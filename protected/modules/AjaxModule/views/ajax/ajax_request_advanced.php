<?php $this->breadcrumbs =array('XMLHttpRequest'=>array('ajax/index'), 'Ajax request (advanced)'=>'http://www.yiiframework.com/doc/api/CHtml#ajax-detail',); ?>

<div class="example_title">Advanced ajax request using ajaxLink</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

echo CHtml::ajaxLink(
	'Test request',          // the link body (it will NOT be HTML-encoded.)
	array('ajax/reqTest02'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
	array(
		'update'=>'#req_res'
	)
);
?>

<div id="req_res">...</div>



<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionReqTest02',
		'protected/modules/AjaxModule/controllers/AjaxController.php'
	), false, true);

Yii::app()->sc->collect('php',Yii::app()->sc->getSourceFromFile(dirname(__FILE__).'/actionReqTest02.php'));



?>
</div><!-- demo box -->


<?php $this->widget('RightMenu', array('items'=>$this->getExampleSubMenu('ajax_request'))); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CHtml#ajax-detail'=>'CHtml: ajax',
		'http://www.yiiframework.com/doc/api/CController#renderPartial-detail'=>'renderPartial',
	),
	'see_also'=>array($this->createUrl('/UiModule/jui/ziiAutocomplete')=>'Autocomplete with Ajax example'),
	//'external_links'=>array(),
)); ?>