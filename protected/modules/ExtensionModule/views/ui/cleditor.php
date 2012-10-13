<?php $this->breadcrumbs =array('User Interface'=>array('ui/index'), 'ClEditor'); ?>


<div class="example_title">ClEditor extension demo</div>

<p>
	With this extension you can easily insert a very lightweight WYIWYG editor on your Yii application. 
</p>
<p>
	Please, go to <a href="http://www.yiiframework.com/extension/cleditor/">cleditor extension page</a> for further information.
</p>


<div class="demo_box">

<?php
Yii::app()->sc->setStart(__LINE__); ?>

<?php echo CHtml::form(); ?>
<div style="position: relative; border: 1px solid #DDD;">
	<?php $this->widget('application.modules.ExtensionModule.extensions.cleditor.ECLEditor',
		array('name'=> 'editor'));?>
	<div style="clear:both"></div>
	<?php
	echo CHtml::ajaxSubmitButton(
	'Test Submit',
		array('cleditor/testsubmit'),
		array(
			'update'=>'#server_response',
		)
	);
?>
</div>
<?php echo CHtml::endForm(); ?>
<br />
<div id="server_response"></div>
<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/extension/cleditor/'=>'ClEditor extension',
	),
	//'see_also'=>array(),
	'external_links'=>array(
	
		'http://premiumsoftware.net/cleditor/index.html'=>'ClEditor resource page',
		'http://premiumsoftware.net/cleditor/index.html'=>'ClEditor demo',
		'http://www.yiiframework.com/forum/index.php?showtopic=13121&st=0'=>'Discussion and Bug Report',
	),
)); ?>

