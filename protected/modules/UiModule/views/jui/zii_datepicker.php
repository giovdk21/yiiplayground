<?php $this->breadcrumbs =array('Interface'=>array('jui/index'), 'Zii calendar',); ?>

<a name="simpleCalendar"></a>
<div class="example_title">Simple Calendar / Date Picker</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('zii.widgets.jui.CJuiDatePicker',
	array(
		// you must specify name or model/attribute
		//'model'=>$model,
		//'attribute'=>'projectDateStart',
		'name'=>'Project[projectDateStart]',

		// optional: what's the initial value/date?
		//'value' => $model->projectDateStart
		'value' => '08/20/2010',

		// optional: change the language
		//'language' => 'de',
		//'language' => 'fr',
		//'language' => 'es',
		'language' => 'pt-BR',

		/* optional: change visual
		 * themeUrl: "where the themes for this widget are located?"
		 * theme: theme name. Note that there must be a folder under themeUrl with the theme name
		 * cssFile: specifies the css file name under the theme folder. You may specify a
		 *          single filename or an array of filenames
		 * try http://jqueryui.com/themeroller/
		*/
		'themeUrl' => Yii::app()->baseUrl.'/css/jui' ,
		'theme'=>'pool',	//try 'bee' also to see the changes
		'cssFile'=>array('jquery-ui.css' /*,anotherfile.css, etc.css*/),


		//  optional: jquery Datepicker options
		'options' => array(
			// how to change the input format? see http://docs.jquery.com/UI/Datepicker/formatDate
			'dateFormat'=>'mm/dd/yy',

			// user will be able to change month and year
			'changeMonth' => 'true',
			'changeYear' => 'true',

			// shows the button panel under the calendar (buttons like "today" and "done")
			'showButtonPanel' => 'true',

			// this is useful to allow only valid chars in the input field, according to dateFormat
			'constrainInput' => 'false',

			// speed at which the datepicker appears, time in ms or "slow", "normal" or "fast"
			'duration'=>'fast',

			// animation effect, see http://docs.jquery.com/UI/Effects
			'showAnim' =>'slide',
		),


		// optional: html options will affect the input element, not the datepicker widget itself
		'htmlOptions'=>array(
		'style'=>'height:30px;
			background:#ffbf00;
			color:#00a;
			font-weight:bold;
			font-size:0.9em;
			border: 1px solid #A80;
			padding-left: 4px;'
		)
	)
);


Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>



<a name="inlineCalendar"></a>
<div class="example_title">Inline Calendar</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('zii.widgets.jui.CJuiDatePicker',
	array(
		'name'=>'inline_datepicker',
		'flat' => true, // tells the widget to show the calendar inline
	)
);

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div>



<?php $this->widget('RightMenu', array('items'=>$this->getExampleSubMenu('datepicker'))); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CJuiDatePicker'=>'CJuiDatePicker',
		'http://docs.jquery.com/UI/Datepicker'=>'JQuery Datepicker Docs'
	),
	//'see_also'=>array(),
	'external_links'=>array(
		'http://jqueryui.com/demos/datepicker/'=>'JQuery Demo',
		'http://jqueryui.com/themeroller/'=>'JQuery Ui Theming'
	),
)); ?>