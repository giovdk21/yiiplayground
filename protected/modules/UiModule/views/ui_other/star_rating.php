<?php $this->breadcrumbs =array('Interface'=>array('ui_other/index'), 'Star Rating',); ?>

<a name="star_rating"></a>
<div class="example_title">Star Rating</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

echo CHtml::beginForm();
$this->widget('CStarRating',array(
        'name'=>'rating',
        'minRating'=>1, //minimal value
        'maxRating'=>6,//max value
        'starCount'=>6, //number of stars
        ));
echo CHtml::submitButton("Vote!");
echo CHtml::endForm();
echo "You just vote :".$ratingValue;

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionStarRating',
		'protected/modules/UiModule/controllers/Ui_otherController.php'
	), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<a name="star_rating_ajax"></a>
<div class="example_title">Star Rating with Ajax</div>
<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

//because we are activating CSRF and se using POST, we must give token to the AJAX Parameter
$this->widget('CStarRating',array(
    'name'=>'ratingAjax',
    'callback'=>'
        function(){
                $.ajax({
                    type: "POST",
                    url: "'.Yii::app()->createUrl('UiModule/ui_other/starRatingAjax').'",
                    data: "'.Yii::app()->request->csrfTokenName.'='.Yii::app()->request->getCsrfToken().'&rate=" + $(this).val(),
                    success: function(msg){
                                $("#result").html(msg);
                        }})}'
  ));
echo "<br/>";
echo "<div id='result'>No Result</div>";

Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionStarRatingAjax',
		'protected/modules/UiModule/controllers/Ui_otherController.php'
	), false, true);

?>
</div><!-- demo box -->


<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CStarRating'=>'CStarRating',
	),
	//'see_also'=>array(),
	//'external_links'=>array(),
)); ?>