<?php $this->breadcrumbs =array('Interface'=>array('jui/index'), 'Zii droppable',); ?>

<div class="example_title">Simple Droppable Object</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

//some draggable object
$this->beginWidget('zii.widgets.jui.CJuiDraggable',
        array(
                'htmlOptions'=>array(
                        'style'=>'float:left;width:50px;height:50px;background:#FFEEEE;margin:10px;',
                ),
        ));
echo 'Drag me';
$this->endWidget();

//some droppable object (dropzone)
$this->beginWidget('zii.widgets.jui.CJuiDroppable', array(
        'options'=>array(
                'drop'=>'js:function( event, ui ) {alert("Something drop on me!")}', //remember put js:
        ),
        'htmlOptions'=>array(
                'style'=>'float:left;width:100px;height:100px;background:#EEFFEE;margin:10px;',
        )
));
echo 'Drop something around here';

$this->endWidget();

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
        <div class="clear"></div>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<?php $this->widget('MoreInfoBox', array(
	'references'=>array('http://www.yiiframework.com/doc/api/CJuiDroppable'=>'CJuiDroppable'),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>
