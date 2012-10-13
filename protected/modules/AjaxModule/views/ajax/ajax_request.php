<!-- CSS to show the Ajax Loading Image, Better to keep it in a separate CSS file -->
<!-- We keep it here, just for demonstration and learning -->
<style type="text/css">
div.loading {
    background-color: #eee;
    background-image: url('images/ajax-loader.gif');
    background-position:  center center;
    background-repeat: no-repeat;
    opacity: 1;
}
div.loading * {
    opacity: .8;
}
</style>


<div id="maindiv">
<?php $this->breadcrumbs =array('XMLHttpRequest'=>array('ajax/index'), 'Ajax request'=>'http://www.yiiframework.com/doc/api/CHtml#ajax-detail',); ?>


<!-- Example1: Ajax Link Example -->
<a name="ajaxLink"></a>
<div class="example_title">Example1: Ajax request using ajaxLink</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

echo CHtml::ajaxLink(
	'Test request',          // the link body (it will NOT be HTML-encoded.)
	array('ajax/reqTest01'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
	array(
		'update'=>'#req_res'
	)
);
?>

<div id="req_res">...</div>

<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionReqTest01',
		'protected/modules/AjaxModule/controllers/AjaxController.php'
	), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<!-- Example2: Ajax Link Example with a loading image -->
<a name="ajaxLinkLoadingImage"></a>
<div class="example_title">Example2: Ajax request using ajaxLink with loading image</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

echo CHtml::ajaxLink(
	'Test request',          // the link body (it will NOT be HTML-encoded.)
	array('ajax/reqTest01Loading'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
	array(
		'update'=>'#req_res_loading',
        'beforeSend' => 'function() {           
           $("#maindiv").addClass("loading");
        }',
        'complete' => 'function() {
          $("#maindiv").removeClass("loading");
        }',        
	)
);
?>

<div id="req_res_loading">...</div>

<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionReqTest01Loading',
		'protected/modules/AjaxModule/controllers/AjaxController.php'
	), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<!-- Example3: Ajax Button Example -->
<a name="ajaxButton"></a>
<div class="example_title">Example3: Ajax request using ajaxButton</div>

<div class="demo_box">
<?php Yii::app()->sc->setStart(__LINE__); ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>

<div class="row">
<?php echo CHtml::label('Some text', 'some_text'); ?>
<?php echo CHtml::textField('some_text', date('H:i:s')); ?>
</div>

<?php
echo CHtml::ajaxSubmitButton(
	'Submit request',
	array('ajax/reqTest03'),
	array(
		'update'=>'#req_res02',
	)
);
?>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->

<div id="req_res02">...</div>

<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionReqTest03',
		'protected/modules/AjaxModule/controllers/AjaxController.php'
	), false, true);
?>
</div><!-- demo box -->


<?php $this->widget('RightMenu', array('items'=>$this->getExampleSubMenu('ajax_request'))); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CHtml#ajax-detail'=>'CHtml: ajax',
		'http://www.yiiframework.com/doc/api/CHtml#ajaxLink-detail'=>'ajaxLink',
		'http://www.yiiframework.com/doc/api/CHtml#ajaxButton-detail'=>'ajaxButton',
		'http://www.yiiframework.com/doc/api/CHtml#ajaxSubmitButton-detail'=>'ajaxSubmitButton',
	),
	'see_also'=>array($this->createUrl('/UiModule/jui/ziiAutocomplete')=>'Autocomplete with Ajax example'),
	//'external_links'=>array(),
)); ?>
</div> <!-- maindiv -->