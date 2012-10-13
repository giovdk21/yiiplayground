<?php $this->breadcrumbs =array('Interface'=>array('jui/index'), 'Zii sortable',); ?>

<div class="example_title">Simple Sortable</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

echo "Try to drag them : ";
$this->widget('zii.widgets.jui.CJuiSortable', array(
        //list of items
        'items'=>array(
                'id1'=>'Item 1',
                'id2'=>'Item 2',
                'id3'=>'Item 3',
                'id4'=>'Item 4',
                'id5'=>'Item 5',
        ),
        // additional javascript options for the accordion plugin
        'options'=>array(
                'opacity'=>0.6, //set the dragged object's opacity to 0.6
        ),
));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
        <div class="clear"></div>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<?php $this->widget('MoreInfoBox', array(
	'references'=>array('http://www.yiiframework.com/doc/api/CJuiSortable'=>'CJuiSortable'),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>
