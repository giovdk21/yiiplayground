



<div data-spy="affix" data-offset-top="60" data-offset-bottom="200">

	<h2>Test</h2>

	<h3>Mhm</h3>



	<h2>Test 2</h2>

	<h3>Mhm</h3>



</div>

<?php
use yii\web\View;

$this->registerJs(<<<EOJS

	$('#my-affix').affix({
			offset: {
				top: 100
			}
		});


EOJS
, View::POS_READY);
