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
	<title><?= Html::encode($this->title) . (!empty($this->title) ? ' - ' : '') . 'Yii Playground' ?></title>
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
				['label' => 'Fork on GitHub', 'url' => 'https://github.com/giovdk21/yiiplayground/tree/yii2'],
			],
		]
	);
	NavBar::end();
	?>

	<div class="row container">
		<div class="col-md-3">
			<div class="left-menu">

				<?php
				echo Nav::widget([
						'activateParents' => true,
						'items'           => $this->context->leftMenu,
					]
				);
				?>

			</div>
		</div>


		<div class="col-md-9" role="main">
			<?=
			Breadcrumbs::widget([
					'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]
			) ?>
			<?php if (!empty($this->params['guideUrl'])): ?>
				<?=
				Html::a(
					'<span class="glyphicon glyphicon-question-sign"></span> Yii 2.x Guide',
					$this->params['guideUrl'],
					['target' => '_blank', 'class' => 'guide-link']
				); ?>

			<?php endif; ?>
			<?= $content ?>
		</div>
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
