<?php

class ClEditorController extends Controller {
	public function actionTestsubmit() {
		if(isset($_POST['editor'])){
			$this->renderPartial('testsubmit',array('value'=>$_POST['editor']));	
		}
	}
}