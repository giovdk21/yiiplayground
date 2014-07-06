<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Url helper';
$this->params['breadcrumbs'] = ['Helpers', 'Url'];
$this->params['guideUrl'] = 'http://www.yiiframework.com/doc-2.0/yii-helpers-url.html';
?>

<h1><?= Html::encode($this->title); ?></h1>


<article class="example-row">
	<h2>base()</h2>

	<div class="demo_box">

		<?php
		Yii::$app->sc->setStart(__LINE__);

		echo "Base url: " . Url::base();

		Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__));
		?>

	</div>
	<?php Yii::$app->sc->renderSourceBox(); ?>
</article>


<article class="example-row">
	<h2>home()</h2>

	<div class="demo_box">

		<?php
		Yii::$app->sc->setStart(__LINE__);

		echo "Home url: " . Url::home();

		Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__));
		?>

	</div>
	<?php Yii::$app->sc->renderSourceBox(); ?>
</article>

<article class="example-row">
	<h2>to()</h2>

	<div class="demo_box">

		<?php
		Yii::$app->sc->setStart(__LINE__);

		echo "Url: " . Url::to(['site/index', 'src' => 'ref1', '#' => 'name']);

		Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__));
		?>

	</div>
	<?php Yii::$app->sc->renderSourceBox(); ?>
</article>