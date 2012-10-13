<?php $this->breadcrumbs =array('User Interface'=>array('ui/index'), 'JNotify'); ?>


<div class="example_title">JNotify extension demo</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__); ?>

<div style="position: relative; height:150px; border: 1px solid #DDD;">
	<div id="StatusBar" style="height: 20px;">
	</div>

	<div id="Notification">
	</div>
</div>

<br />


<button id="addStatusBarMessage">Add a non permanent message (Status Bar)</button>
<br />
<button id="addStatusBarError">Add a permanent error (Status Bar)</button>
<br />
<br />
<button id="addNotificationMessage">Add a non permanent message (Notification)</button>
<br />
<button id="addNotificationError">Add a permanent error (Notification)</button>

<?php // Initialize the extension
$this->widget('application.modules.ExtensionModule.extensions.jnotify.JNotify', array(
	'statusBarId'=>'StatusBar',
	'notificationId'=>'Notification',
	'notificationHSpace'=>'30px',	
	'notificationWidth'=>'280px',
	'notificationShowAt'=>'topRight',
	//'notificationShowAt'=>'bottomLeft',
	//'notificationAppendType'=>'prepend',
)); ?>


<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<?php Yii::app()->sc->setStart(__LINE__); ?>

<script type="text/javascript">
$('#addStatusBarMessage').click(function() {
	$('#StatusBar').jnotifyAddMessage({
		text: 'This is a non permanent message.',
		permanent: false,
		showIcon: false
	});
});

$('#addStatusBarError').click(function() {
	$('#StatusBar').jnotifyAddMessage({
		text: 'This is a permanent error.',
		permanent: true,
		type: 'error'
	});
});

$('#addNotificationMessage').click(function() {
	$('#Notification').jnotifyAddMessage({
		text: 'This is a non permanent message.',
		permanent: false
	});
});

$('#addNotificationError').click(function() {
	$('#Notification').jnotifyAddMessage({
		text: 'This is a permanent error.',
		permanent: true,
		type: 'error'
	});
});

$(document).ready(function() {
	$('#Notification').jnotifyAddMessage({
		text: 'Hello world!'
	});
});
</script>

<?php Yii::app()->sc->collect('js', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__)); ?>


<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/extension/jnotify/'=>'JNotify extension',
	),
	//'see_also'=>array(),
	'external_links'=>array(
		'http://jnotify.codeplex.com/'=>'JNotify project homepage',
		'http://www.fabiofranzini.com/jNotify/Demo.html'=>'JNotify demo',
		'http://www.fabiofranzini.com/'=>'JNotify author website',
	),
)); ?>