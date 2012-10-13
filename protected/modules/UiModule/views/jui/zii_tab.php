<?php $this->breadcrumbs =array('Interface'=>array('jui/index'), 'Zii tabs',); ?>

<div class="example_title">Basic tabs example</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs' => array(
		'StaticTab 1' => 'Content for tab 1',
		'StaticTab 2' => array('content' => 'Content for tab 2', 'id' => 'tab2'),
		// panel 3 contains the content rendered by a partial view
		'AjaxTab' => array('ajax' => $this->createUrl('/AjaxModule/ajax/reqTest01')),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));


Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->



<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CJuiTabs'=>'CJuiTabs',
		'http://jqueryui.com/demos/tabs/'=>'jQuery UI - Tabs',
	),
	'see_also'=>array($this->createUrl('/AjaxModule/ajax/ajaxRequest')=>'Ajax request example'),
	//'external_links'=>array(),
)); ?>