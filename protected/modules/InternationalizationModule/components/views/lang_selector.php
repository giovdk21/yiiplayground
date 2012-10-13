<div id="lang_selector">
<?php echo Yii::t('i18n', 'Select your language'); ?>:
<?php foreach($available_lang as $locale=>$label): ?>
<a href="<?php
	echo Yii::app()->createUrl(
		'InternationalizationModule/lang/select',
		array('lc'=>$locale), '&amp;'); ?>">
<?php echo Yii::t('i18n', $label); ?></a>&nbsp;
<?php endforeach; ?>
</div>