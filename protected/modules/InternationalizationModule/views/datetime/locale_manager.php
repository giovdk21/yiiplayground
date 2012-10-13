<?php $this->breadcrumbs =array(
		'Date & time'=>array('datetime/index'),
		'User input advanced example'=>array('datetime/userinput'),
		'LocaleManager'); ?>

<?php $this->widget('LangSelector'); ?>

<div class="example_title">LocaleManager application component</div>

<p>This is not part of Yii, but it shows you how to use Yii's i18n functions to
	manage your date and time values in a flexible way.</p>
<p>You can access this component with <b>Yii::app()->lc-></b></p>

<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceFromFile(Yii::app()->localeDataPath.Yii::app()->getLanguage().'.php'), false, true);
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceFromFile('protected/components/LocaleManager.php'), false, true);
?>



<?php $this->widget('MoreInfoBox', array(
	//'references'=>array(),
	'see_also'=>array($this->createUrl('userinput')=>'User input advanced example'),
	//'external_links'=>array(),
)); ?>