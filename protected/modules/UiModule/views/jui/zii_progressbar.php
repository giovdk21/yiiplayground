<?php $this->breadcrumbs =array('Interface'=>array('jui/index'), 'Zii progressbar',); ?>

<div class="example_title">Simple Progress Bar</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('zii.widgets.jui.CJuiProgressBar', array(
        'value'=>80, //value in percent
        'htmlOptions'=>array(
                'style'=>'height:20px;'
        ),
));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
        
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>

<div class="example_title">Animated Progress bar </div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

//you must have a animated gif
Yii::app()->clientScript->registerCss('xxx',
        '#yyy .ui-progressbar-value{
                background-image:url(images/pbar-ani.gif)
                }
        '); //must set .ui-progressbar-value in order to animate

$this->widget('zii.widgets.jui.CJuiProgressBar', array(
        'id' => 'yyy', 
        'value'=>30, //value in percent
        'htmlOptions'=>array(
                'style'=>'height:20px',
         ),
));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->

<?php $this->widget('MoreInfoBox', array(
	'references'=>array('http://www.yiiframework.com/doc/api/CJuiProgressBar'=>'CProgressBar'),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>
