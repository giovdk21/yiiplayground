<?php $this->breadcrumbs =array('Date & time'=>array('datetime/index'), 'Basic date and time'); ?>

<?php $this->widget('LangSelector'); ?>

<div class="example_title">Date and time</div>

<div class="demo_box">
<?php Yii::app()->sc->setStart(__LINE__); ?>

<ul>
<li>Current language: <?php echo Yii::app()->getLanguage(); ?></li>
<li>Date &amp; time short: <?php echo Yii::app()->dateFormatter->formatDateTime(time(), 'short'); ?></li>
<li>Date medium: <?php echo Yii::app()->dateFormatter->formatDateTime(time(), 'medium', false); ?></li>
<li>Time medium: <?php echo Yii::app()->dateFormatter->formatDateTime(time(), false, 'medium'); ?></li>
<li>Date short format: <?php echo Yii::app()->locale->getDateFormat('short'); ?></li>
<li>Time medium format: <?php echo Yii::app()->locale->getTimeFormat('medium'); ?></li>
<li>Parsed date and time: <?php echo Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'),
				CDateTimeParser::parse('04/06/2010', 'dd/MM/yyyy')); ?></li>
<li>Date &amp; time custom format: <?php echo Yii::app()->dateFormatter->formatDateTime(time(), 'small', 'small'); ?></li>
</ul>

<?php
Yii::app()->sc->collect('html', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceFromFile(Yii::app()->localeDataPath.Yii::app()->getLanguage().'.php'), false, true);
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