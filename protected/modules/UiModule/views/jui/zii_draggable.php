<?php $this->breadcrumbs =array('Interface'=>array('jui/index'), 'Zii draggable',); ?>

<div class="example_title">Simple Draggable Object</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->beginWidget('zii.widgets.jui.CJuiDraggable');

echo 'Drag me to anywhere!';

$this->endWidget();

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
        
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<div class="example_title">Draggable Object With Constraint in Containment</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);


echo '<div id="xxx" style="width:200px;height:80px;border:1px solid #eee">';
$this->beginWidget('zii.widgets.jui.CJuiDraggable',
        array(
                'options'=>array('containment'=>'#xxx'), //set who is the containment
                 'htmlOptions'=> array(
                         'style'=>'float:left;width:50px;height:50px;border:1px solid #000',
                 )
        )
);

echo 'Drag me';

$this->endWidget();

echo '</div>';

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>

</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array('http://www.yiiframework.com/doc/api/CJuiDraggable'=>'CDraggable'),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>
