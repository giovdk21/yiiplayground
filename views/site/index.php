<?php
/**
 * @var yii\web\View $this
 */
?>

<div class="site-index">

	<div class="jumbotron">
		<h1>Yii Playground</h1>

		<p class="lead">The perfect place to play with the
			<a href="http://www.yiiframework.com">Yii Framework</a></p>

		<p><a class="btn btn-lg btn-success" href="https://github.com/giovdk21/yiiplayground/tree/yii2">
				Fork on GitHub
			</a>
		</p>
	</div>

	<div class="body-content">

		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<h2>How it works</h2>

				<?php
				Yii::$app->sc->setStart(__LINE__);

				// ...in one move!
				echo "<ol>";
				echo "<li>Write your code</li>";
				echo "<li>Show your code</li>";
				echo "</ol>";

				Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__));


				Yii::$app->sc->renderSourceBox();
				?>

			</div>
		</div>

	</div>

</div>
