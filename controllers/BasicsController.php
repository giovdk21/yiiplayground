<?php

namespace app\controllers;

use Yii;
use app\components\BaseController;


class BasicsController extends BaseController
{

	public function actionAliases() {
		return $this->render('aliases');
	}

}
