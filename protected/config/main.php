<?php
/**
* This is the base config file.  Other config files may extend this.  See development.php
*/


// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');


// Common Jui Widget preferences:
//$jui_prefs =array(
//	'themeUrl'=>'css/jui/',
//	'theme'=>'base',
//);


// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii Playground',

	// preloading 'log' component
	'preload'=>array('log', 'dbManager', 'uiSettings', 'lc', 'bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),


	'localeDataPath'=>'protected/i18n/data/',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'uiSettings'=>array(
			'class'=>'UiSettings',
		),
		'db'=>array(
			'autoConnect'=>false, // we will activate the connection from dbManager
			'connectionString' => '', // we set connectionString from dbManager
			'tablePrefix'=>'tbl_',
		),
		'sc'=>array(
			'class' => 'application.components.SrcCollect',
		),
		'dbManager'=>array(
			'class' => 'application.components.DbManager',
		),
		'lc'=>array(
			'class' => 'application.components.LocaleManager',
		),
		// uncomment the following to use a MySQL database
		/*
		'db_mysql'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
//		'widgetFactory' => array(
//			'widgets' => array(
//				'CJuiDialog' => $jui_prefs,
//				'CJuiTabs' => $jui_prefs,
//				'CJuiDatePicker' => $jui_prefs,
//				'CJuiAutoComplete' => $jui_prefs,
//			),
//		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		),
	),

	'modules' => array(
		'AjaxModule',
		'UiModule',
		'InternationalizationModule',
		'SecurityModule',
		'ExtensionModule',
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'factory_db'=>'protected/data/factory.db',
		'user_db'=>'protected/data/user.db',
		'database_format'=>array(
			'date'=>'yyyy-MM-dd',
			'time'=>'HH:mm:ss',
			'dateTimeFormat'=>'{1} {0}',
		),
	),
);