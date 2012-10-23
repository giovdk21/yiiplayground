<?php
/**
* This is the config file to be used by developers (not the production/demo server).  Extends the main.php config file.
* See http://www.yiiframework.com/doc/cookbook/32/
*/
return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'), 
	array(
		'modules' => array(
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'yiirocks',
				'ipFilters'=>array('127.0.0.1'),
				// 'newFileMode'=>0666,
				// 'newDirMode'=>0777,
				'generatorPaths'=>array(
					'bootstrap.gii',
				),
			),
		),
		'components'=>array(
			'request'=>array(
				'enableCsrfValidation'=>true,
			), //end of request
                ),//end of components
	)
);