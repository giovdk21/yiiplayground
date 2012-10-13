<?php

class LangController extends Controller {


	public function actionSelect() {
		$language =$_GET['lc'];
		Yii::app()->lc->setLanguage($language);
		$this->redirect(Yii::app()->request->urlReferrer);
	}


	
	

}