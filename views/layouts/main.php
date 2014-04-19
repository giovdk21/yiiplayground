<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string        $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
	<?php
	NavBar::begin([
			'brandLabel' => 'Yii Playground',
			'brandUrl'   => Yii::$app->homeUrl,
			'options'    => [
				'class' => 'navbar-inverse navbar-fixed-top',
			],
		]
	);
	echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items'   => [
//				['label' => 'Basics',
//				 'items' => [
//					 ['label' => 'Path Aliases', 'url' => ['basics/aliases']],
//					 ['label' => 'Helper classes', 'url' => ['basics/helpers']],
//					 ['label' => 'Events', 'url' => ['index']],
//					 ['label' => 'Behaviors', 'url' => ['index']],
//				 ]
//				],
//				['label' => 'Advanced',
//				 'items' => [
//					 ['label' => 'Managing assets', 'url' => ['index']],
//					 ['label' => 'Working with forms', 'url' => ['index']],
//					 ['label' => 'Bootstrap widgets', 'url' => ['index']],
//					 ['label' => 'Theming', 'url' => ['index']],
//					 ['label' => 'Caching', 'url' => ['index']],
//					 ['label' => 'Internationalization', 'url' => ['index']],
//					 ['label' => '', 'url' => ['index']],
//				 ]
//				],
				['label' => 'About', 'url' => 'https://github.com/giovdk21/yiiplayground'],
			],
		]
	);
	NavBar::end();
	?>

	<div class="container">
		<?=
		Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]
		) ?>
		<?= $content ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy;
			<a href="https://github.com/giovdk21/yiiplayground/graphs/contributors">Yii Playground contributors</a>
			<?= date('Y') ?></p>

		<p class="pull-right"><?= Yii::powered() ?></p>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
