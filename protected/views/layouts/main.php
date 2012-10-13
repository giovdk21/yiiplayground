<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/css3.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mb_mainmenu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Ajax / jQuery', 'items'=>array(
					array('label'=>'Ajax request', 'url'=>array('/AjaxModule/ajax/ajaxRequest')),
				)),
				array('label'=>'Interface', 'items'=>array(
					array('label'=>'Zii dialog', 'url'=>array('/UiModule/jui/ziiDialog')),
					array('label'=>'Zii datePicker', 'url'=>array('/UiModule/jui/ziiDatePicker')),
					array('label'=>'Zii autocomplete', 'url'=>array('/UiModule/jui/ziiAutocomplete')),
					array('label'=>'Zii progressBar', 'url'=>array('/UiModule/jui/ziiProgressBar')),
					array('label'=>'Zii draggable', 'url'=>array('/UiModule/jui/ziiDraggable')),
					array('label'=>'Zii droppable', 'url'=>array('/UiModule/jui/ziiDroppable')),
					array('label'=>'Zii sortable', 'url'=>array('/UiModule/jui/ziiSortable')),
					array('label'=>'Zii tabs', 'url'=>array('/UiModule/jui/ziiTab')),
					array('label'=>'Tables and pagination', 'items'=>array(
						array('label'=>'CGridView', 'url'=>array('/UiModule/dataview/gridView')),
						array('label'=>'CGridView CSS Styling', 'url'=>array('/UiModule/dataview/gridStyle')),
						array('label'=>'Basic pager', 'url'=>array('/UiModule/pagination/basicPager')),
					)),
					array('label'=>'Other', 'items'=>array(
                                                array('label'=>'Menu', 'url'=>array('/UiModule/ui_other/menu')),
						array('label'=>'Breadcrumbs', 'url'=>array('/UiModule/ui_other/breadcrumbs')),
                                                array('label'=>'Star Rating','url'=>array('/UiModule/ui_other/starRating')),
                                                array('label'=>'Tree View','url'=>array('/UiModule/ui_other/treeView')),
						array('label'=>'Tab View','url'=>array('/UiModule/ui_other/tabView')),
						array('label'=>'Text Highlighter','url'=>array('/UiModule/ui_other/textHighlighter')),
					)),
				)),
				array('label'=>'i18n and l10n', 'items'=>array(
					array('label'=>'Basic date and time', 'url'=>array('/InternationalizationModule/datetime/basic')),
					array('label'=>'Advanced user input', 'url'=>array('/InternationalizationModule/datetime/userinput')),
				)),
				array('label'=>'Authorization and authentication', 'items_'=>array(
					array('label'=>'Yii\'s RBAC', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'SRBAC extension', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				)),
				array('label'=>'Security', 'items'=>array(
					array('label'=>'Prevent XSS with CHtmlPurifier', 'url'=>array('/SecurityModule/xss/htmlPurifier')),
                                        array('label'=>'Prevent CSRF with enabling enableCsrfValidation', 'url'=>array('/SecurityModule/cookie/csrf')),
				)),
				array('label'=>'General', 'items_'=>array(
					array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				)),
				array('label'=>'Extensions', 'items'=>array(
					// let's keep the categories names as they are on the Yii website
					array('label'=>'Auth', 'items_'=>array(array('label'=>'..', 'url'=>array('/ExtensionModule/')))),
					array('label'=>'Database', 'items_'=>array(array('label'=>'..', 'url'=>array('/ExtensionModule/')))),
					array('label'=>'Date and Time', 'items_'=>array(array('label'=>'..', 'url'=>array('/ExtensionModule/')))),
					array('label'=>'Filesystem', 'items_'=>array(array('label'=>'..', 'url'=>array('/ExtensionModule/')))),
					array('label'=>'Logging', 'items_'=>array(array('label'=>'..', 'url'=>array('/ExtensionModule/')))),
					array('label'=>'Security', 'items_'=>array(array('label'=>'..', 'url'=>array('/ExtensionModule/')))),
					array('label'=>'User interface', 'items'=>array(
						array('label'=>'JNotify', 'url'=>array('/ExtensionModule/ui/JNotify')),
						array('label'=>'cleditor', 'url'=>array('/ExtensionModule/ui/ClEditor')),
						array('label'=>'JQGrid', 'url'=>array('/ExtensionModule/ui/JQGrid')),
					)),
					array('label'=>'Validation', 'items_'=>array(array('label'=>'..', 'url'=>array('/ExtensionModule/')))),
					array('label'=>'Web Service', 'items_'=>array(array('label'=>'..', 'url'=>array('/ExtensionModule/')))),
					array('label'=>'Others', 'items'=>array(
						array('label'=>'OpenFlashChart', 'url'=>array('/ExtensionModule/other/OpenFlashChart'))
					)),
				)),
				array('label'=>'Other', 'items'=>array(					
					//array('label'=>'Forcing file download', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				)),
			),
		)); ?>
	</div><!-- mb_mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<div id="more_topic_info">
		<a id="more_topic_info_link"><span>More information about this topic</span></a>
	</div>

	<div id="top_right_box">
		<span>
			<?php echo CHtml::ajaxLink('Reset database', $this->createUrl('/site/resetDb'), array('beforeSend'=>'askDbResetConfirm', 'type'=>'POST')); ?>
		</span>
		&nbsp;|&nbsp;
		<div id="hide_source_toggle">
			<?php echo CHtml::ajaxLink('Hide source code', $this->createUrl('/site/toggleSource')); ?>
		</div>
	</div> <!-- hide_source_code, top_right_box -->

	<div id="content">
		<?php echo $content; ?>
		<?php if (isset(Yii::app()->sc)) { Yii::app()->sc->renderSourceBox(); } ?>
	</div><!-- content -->

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by the <a href="http://code.google.com/p/yiiplayground/">Yii Playground</a> team.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>