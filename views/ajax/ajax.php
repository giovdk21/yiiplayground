<?php
use yii\helpers\Html;

$this->title = 'Ajax request';
$this->params['breadcrumbs'] = ['Basics', $this->title];
$this->params['guideUrl'] = '';
?>


<h1><?= Html::encode($this->title); ?></h1>

<article class="example-row">

	<h2>Simple request</h2>

	<div class="demo_box" id="hyperlink">

		<?php
		Yii::$app->sc->setStart(__LINE__);

		echo Html::a('Click me', ['ajax/simple'], [
				'id' => 'ajax_link_01',
				'data-on-done' => 'simpleDone',
			]
		);
		echo Html::tag('div', '...', ['id' => 'ajax_result_01']);

		$this->registerJs("$('#ajax_link_01').click(handleAjaxLink);", \yii\web\View::POS_READY);

		Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__));


		Yii::$app->sc->collect('php', Yii::$app->sc->getFunctionFromFile(
				'public function init', Yii::getAlias('@app/controllers/AjaxController.php')
			), false, false
		);

		Yii::$app->sc->collect('php', Yii::$app->sc->getFunctionFromFile(
				'public function actionSimple', Yii::getAlias('@app/controllers/AjaxController.php')
			), false, false
		);

		Yii::$app->sc->collect('js', Yii::$app->sc->getFunctionFromFile(
				'function handleAjaxLink', Yii::getAlias($this->context->jsFile)
			), false, false
		);

		Yii::$app->sc->collect('js', Yii::$app->sc->getFunctionFromFile(
				"'simpleDone': function", Yii::getAlias($this->context->jsFile)
			), false, false
		);
		?>

	</div>
	<?php Yii::$app->sc->renderSourceBox(); ?>
</article>



<article class="example-row">

	<h2>Sending form data</h2>

	<p><strong>Note:</strong> common code is share with the "Simple request" example</p>

	<div class="demo_box" id="hyperlink">

		<?php
		Yii::$app->sc->setStart(__LINE__);

		echo Html::beginForm('', 'post', ['id' => 'link_form']);

		echo "<div>" . Html::label('Name', 'name') . " "
			. Html::textInput('name', null, ['id' => 'name']) . "</div>";

		echo "<div>" . Html::label('E-mail', 'email') . " "
			. Html::input('email', 'email', null, ['id' => 'email']) . "</div>";

		echo Html::a('Click me', ['ajax/link-form'], [
				'id' => 'ajax_link_02',
				'data-on-done' => 'linkFormDone',
				'data-form-id' => 'link_form',
			]
		);

		echo Html::endForm();

		echo Html::tag('pre', '...', ['id' => 'ajax_result_02']);

		$this->registerJs("$('#ajax_link_02').click(handleAjaxLink);", \yii\web\View::POS_READY);

		Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__));

		Yii::$app->sc->collect('php', Yii::$app->sc->getFunctionFromFile(
				'public function actionLinkForm', Yii::getAlias('@app/controllers/AjaxController.php')
			), false, false
		);

		Yii::$app->sc->collect('js', Yii::$app->sc->getFunctionFromFile(
				"'linkFormDone': function", Yii::getAlias($this->context->jsFile)
			), false, false
		);
		?>

	</div>
	<?php Yii::$app->sc->renderSourceBox(); ?>
</article>