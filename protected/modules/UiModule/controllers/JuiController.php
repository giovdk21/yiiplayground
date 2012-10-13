<?php

class JuiController extends Controller
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
			'zii_autocomplete' => array(
				'Ajax datasource' => array('jui/ziiAutocomplete', '#'=>'ajax_datasource'),
				'Array datasource' => array('jui/ziiAutocomplete', '#'=>'array_datasource'),
			),
			'datepicker' => array(
				'Simple Calendar' => array('jui/ziiDatePicker', '#'=>'simpleCalendar'),
				'Inline Calendar' => array('jui/ziiDatePicker', '#'=>'inlineCalendar'),
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
	
	public function actionZiiDialog() {		
		$this->render('zii_dialog');
	}

	/**
	 * Zii Datepicker widget
	 */
	public function actionZiiDatePicker() {
		$this->render('zii_datepicker');
	}

	public function actionZiiAutocomplete() {
		$this->render('zii_autocomplete');
	}

	public function actionAutocompleteTest() {
		$res =array();

		if (isset($_GET['term'])) {
			// http://www.yiiframework.com/doc/guide/database.dao
			$qtxt ="SELECT username FROM {{user}} WHERE username LIKE :username";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":username", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			$res =$command->queryColumn();
		}

		echo CJSON::encode($res);
		Yii::app()->end();
	} /* end of actionAutocompleteTest */

	public function actionZiiTab() {
		$this->render('zii_tab');
	}

        public function actionZiiProgressBar(){
                $this->render('zii_progressbar');
        }

        public function actionZiiDraggable(){
                $this->render('zii_draggable');
        }

        public function actionZiiDroppable(){
                $this->render('zii_droppable');
        }

        public function actionZiiSortable(){
                $this->render('zii_sortable');
        }

}