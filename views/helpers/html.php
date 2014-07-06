<?php
use yii\helpers\Html;

$this->title = 'Html helper';
$this->params['breadcrumbs'] = ['Helpers', 'Html'];
$this->params['guideUrl'] = 'http://www.yiiframework.com/doc-2.0/yii-helpers-html.html';
?>


<h1><?= Html::encode($this->title); ?></h1>

<article class="example-row">

	<h2>Hyperlink tag</h2>

	<div class="demo_box" id="hyperlink">

		<?php
		Yii::$app->sc->setStart(__LINE__);

		echo "My link: " . Html::a('click!', ['helpers/html', '#' => 'hyperlink']);

		Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__));
		?>

	</div>
	<?php Yii::$app->sc->renderSourceBox(); ?>
</article>
