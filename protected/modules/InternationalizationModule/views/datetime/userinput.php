<?php $this->breadcrumbs =array('Date & time'=>array('datetime/index'), 'User input'); ?>

<?php $this->widget('LangSelector'); ?>

<div class="example_title">User input advanced example</div>

<div class="demo_box">

<p>Click a row to edit..</p>
<p><b>Note:</b> the
	<a href="<?php echo $this->createUrl('localeManager'); ?>">Yii::app()->lc</a>
	component is a custom component (LocaleManager);
	<a href="<?php echo $this->createUrl('localeManager'); ?>">click here</a>
	for more information.</p>

<?php Yii::app()->sc->setStart(__LINE__);

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $model->search(),
	'selectionChanged'=>'updateEditForm',
	'id'=>'main_table',
	'columns' => array(
		array(
			'name' => 'c_date',
			'type' => 'raw',
			'htmlOptions' => array('class'=>'date_cell'),
			'value' => 'Yii::app()->lc->toLocal($data->c_date, "date", "small")',
		),
		array(
			'name' => 'c_time',
			'type' => 'raw',
			'htmlOptions' => array('class'=>'time_cell'),
			'value' => 'Yii::app()->lc->toLocal($data->c_time, "time", "small")',
		),
		array(
			'name' => 'c_datetime',
			'type' => 'raw',
			'htmlOptions' => array('class'=>'datetime_cell'),
			'value' => 'Yii::app()->lc->toLocal($data->c_datetime, "datetime", "small")',
		),
	),
));

?>

<div class="form">
<?php echo CHtml::beginForm(); ?>
<div class="row">
	<?php echo CHtml::activeLabelEx($model,'c_date'); ?>
	<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
		array(
			'name'=>'DtTest[c_date]',
			'options' => array('dateFormat'=>Yii::app()->locale->getDateFormat('calendar_small')),
			'htmlOptions' => array('readonly'=>"readonly")
		)
	); ?>
</div>
<div class="row">
	<?php echo CHtml::activeLabelEx($model,'c_time'); ?>
	<?php echo CHtml::dropdownList('c_time_hour', false, $hour_arr); ?>
	<?php echo CHtml::dropdownList('c_time_min', false,
		array('00'=>'00', '15'=>'15', '30'=>'30', '45'=>'45')); ?>
</div>
<div class="row">
	<?php echo CHtml::activeLabelEx($model,'c_datetime'); ?>
	<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
		array(
			'name'=>'DtTest[c_datetime]',
			'options' => array('dateFormat'=>Yii::app()->locale->getDateFormat('calendar_small')),
			'htmlOptions' => array('readonly'=>"readonly")
		)
	); ?>
	<?php echo CHtml::dropdownList('c_datetime_hour', false, $hour_arr); ?>
	<?php echo CHtml::dropdownList('c_datetime_min', false,
		array('00'=>'00', '15'=>'15', '30'=>'30', '45'=>'45')); ?>
</div>

<?php echo CHtml::hiddenField('item_id', 0); ?>
<?php echo CHtml::ajaxButton('Save', $this->createUrl('userinputSave'),
	array('type'=>'POST', 'success'=>'formSaved'), array('disabled'=>"disabled", 'id'=>'save_btn')); ?>

<?php echo CHtml::endForm(); ?>
</div>


<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionUserinputData',
		'protected/modules/InternationalizationModule/controllers/DatetimeController.php'
	), false, true);
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionUserinputSave',
		'protected/modules/InternationalizationModule/controllers/DatetimeController.php'
	), false, true);
?>
</div><!-- demo box -->


<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/guide/topics.i18n'=>'Guide: Internationalization (I18N)',
		'http://www.yiiframework.com/doc/api/CDateFormatter'=>'CDateFormatter',
		'http://www.yiiframework.com/doc/api/CDateTimeParser'=>'CDateTimeParser',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>



<script type="text/javascript">

	function updateEditForm(target_id) {
		var id =$.fn.yiiGridView.getSelection(target_id);		

		$('#item_id').val(id);		
		$('#save_btn').attr('disabled', (id > 0 ? false : true));

		$.getJSON('<?php echo $this->createUrl('userinputData'); ?>&id='+id,
			function(data) {
				$('#DtTest_c_date').val(data.c_date);
				$('#c_time_hour').val(data.c_time_hour);
				$('#c_time_min').val(data.c_time_min);
				$('#DtTest_c_datetime').val(data.c_datetime);
				$('#c_datetime_hour').val(data.c_datetime_hour);
				$('#c_datetime_min').val(data.c_datetime_min);
			});
	}


	function formSaved(data, textStatus, XMLHttpRequest) {
		$.fn.yiiGridView.update('main_table');
	}

</script>