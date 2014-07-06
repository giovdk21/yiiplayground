<?php

namespace app\controllers;

use Yii;
use app\components\BaseController;
use yii\web\Response;


class AjaxController extends BaseController
{

	public $jsFile;

	public function init() {
		parent::init();

		$this->jsFile = '@app/views/' . $this->id . '/ajax.js';

		// Publish and register the required JS file
		Yii::$app->assetManager->publish($this->jsFile);
		$this->getView()->registerJsFile(
			Yii::$app->assetManager->getPublishedUrl($this->jsFile),
			['yii\web\YiiAsset'] // depends
		);
	}


	public function actionIndex() {

		// note: ajax.js is loaded by the init() method

		return $this->render('ajax');
	}

	public function actionSimple() {
		if (Yii::$app->request->isAjax) {
			Yii::$app->response->format = Response::FORMAT_JSON;


			$res = array(
				'body'    => date('Y-m-d H:i:s'),
				'success' => true,
			);

			return $res;
		}
	}

	public function actionLinkForm() {
		if (Yii::$app->request->isAjax) {
			Yii::$app->response->format = Response::FORMAT_JSON;


			$res = array(
				'body'    => print_r($_POST, true),
				'success' => true,
			);

			return $res;
		}
	}

}
