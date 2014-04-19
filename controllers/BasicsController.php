<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class BasicsController extends Controller
{

	public function actionAliases() {
		return $this->render('aliases');
	}

}
