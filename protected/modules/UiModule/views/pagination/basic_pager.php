
<a name="SampleData"></a>
<div class="example_title">Sample data</div>
<div class="demo_box"><?php Yii::app()->sc->setStart(__LINE__); ?>
	
<b>Page <?php echo $pages->getCurrentPage()+1; ?></b>
<ul><li><?php echo implode('</li><li>', $sample); ?></li></ul>
<?php Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));

Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionBasicPager',
		'protected/modules/UiModule/controllers/PaginationController.php'
	), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<a name="CPagination"></a>
<div class="example_title">CPagination</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('CLinkPager', array(
	'pages'=>$pages,
));

$this->widget('CListPager', array(
	'pages'=>$pages,
));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<a name="CLinkPager"></a>
<div class="example_title">CLinkPager</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('CLinkPager', array(
	'currentPage'=>$pages->getCurrentPage(),
	'itemCount'=>$item_count,
	'pageSize'=>$page_size,
	'maxButtonCount'=>6,
	'nextPageLabel'=>'My text &gt;',
	'header'=>'',
));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>



<a name="CListPager"></a>
<div class="example_title">CListPager</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

$this->widget('CListPager', array(
	'currentPage'=>$pages->getCurrentPage(),
	'itemCount'=>$item_count,
	'pageSize'=>$page_size,
	'header'=>'My Text: ',
));

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
?>
</div><!-- demo box -->



<?php $this->widget('RightMenu', array('items'=>$this->getExampleSubMenu('basic_pager'))); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/1.1/CPagination'=>'CPagination',
		'http://www.yiiframework.com/doc/api/1.1/CLinkPager'=>'CLinkPager',
		'http://www.yiiframework.com/doc/api/1.1/CListPager'=>'CListPager',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>