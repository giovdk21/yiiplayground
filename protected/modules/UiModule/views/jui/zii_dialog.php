<?php $this->breadcrumbs =array('Interface'=>array('jui/index'), 'Zii dialog',); ?>

<div class="example_title">Simple dialog</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'mydialog',
	// additional javascript options for the dialog plugin
	'options'=>array(
		'title'=>'Dialog box 1',
		'autoOpen'=>false,
		'modal'=>true,		
	),
));

echo 'dialog content here';

$this->endWidget('zii.widgets.jui.CJuiDialog');

// the link that may open the dialog
echo CHtml::link('open dialog', '#', array(
	'onclick'=>'$("#mydialog").dialog("open"); return false;',
));


Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));

?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array('http://www.yiiframework.com/doc/api/CJuiDialog'=>'CJuiDialog'),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>

<div class="example_title">Input dialog with Javascript callback</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

    /* Input dialog with Javascript callback */
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id'=>'mydialog2',
        'options'=>array(
            'title'=>'Add New Item',
            'autoOpen'=>false,
            'modal'=>true,
            'buttons'=>array(
                'Add Item'=>'js:addItem',
                'Cancel'=>'js:function(){ $(this).dialog("close");}',
            ),
        ),
    ));

    echo '<div class="dialog_input"><input type="text" id="item-name-input" name="item-name"/></div>';

    $this->endWidget('zii.widgets.jui.CJuiDialog');

    echo CHtml::link('open dialog', '#', array(
            'onclick'=>'$("#mydialog2").dialog("open"); return false;',
    ));
?>
<?php /* include your relevant javascript somewhere */ ?>
<script type="text/javascript" >
    function addItem(){
        $(this).dialog("close");
        alert( $("#item-name-input").val() + " has been added");
    }
</script>
    
<?php  Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__)); ?>
</div>