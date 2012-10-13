<?php

class AjaxController extends Controller
{

	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
	}


	public function getExampleSubMenu($example_id) {
		$res =array();

		//'Label'=>'http://url',
		//'Label 2'=>array('controller/action)',
		//'Label 3'=>'#anchor', // example in the same page

		$items = array(
			'ajax_request' => array(
				'Ajax request: ajaxLink' => array('ajax/ajaxRequest', '#'=>'ajaxLink'),
				'Ajax request: ajaxButton' => array('ajax/ajaxRequest', '#'=>'ajaxButton'),
				'Ajax request (advanced)' => array('ajax/ajaxRequestAdvanced'),
			),
		);


		if (isset($items[$example_id])) {
			$res =$items[$example_id];
		}

		return $res;
	}


	public function actionIndex() {		
		$this->render('index');
	}


	public function actionAjaxRequest() {
		$this->render('ajax_request');
	}

	public function actionAjaxRequestAdvanced() {
		$this->render('ajax_request_advanced');
	}


	public function actionReqTest01() {
		echo date('H:i:s');
		Yii::app()->end();
	}

	public function actionReqTest02() {
		$date = date('H:i:s');

		$this->renderPartial('actionReqTest02', array('date'=>$date));

		Yii::app()->end();
	}

	// Ajax Link with Loading Image
	public function actionReqTest01Loading() {
        sleep(4);   // Sleep for 4 seconds just to demonstrate the Loading Image can be seen, for learning purpose only		
        echo date('H:i:s');
		Yii::app()->end();
	} 

	public function actionReqTest03() {
		echo CHtml::encode(print_r($_POST, true));
	}


}