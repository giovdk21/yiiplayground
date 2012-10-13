<?php

/**
 * DataViewController: used for GridView and pagination examples
 */

class DataviewController extends Controller
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
			'grid_view' => array(
				'Basic GridView' => array('dataview/gridView'),
				'Using CArrayDataProvider' => array('dataview/gridViewArray'),
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
	
	public function actionGridView() {
		$model =new User('search');
		if(isset($_GET['User']))
			$model->attributes =$_GET['User'];

		$params =array(
			'model'=>$model,
		);

		if(!isset($_GET['ajax'])) $this->render('grid_view', $params);
		else  $this->renderPartial('grid_view', $params);
	}

  
  public function actionGridViewArray() {

    $rawData=array(
			array('id'=>1, 'username'=>'from', 'email'=>'array'),
			array('id'=>2, 'username'=>'test 2', 'email'=>'hello@example.com'),
		);
		// or using: $rawData=User::model()->findAll();
		$arrayDataProvider=new CArrayDataProvider($rawData, array(
			'id'=>'id',
			/* 'sort'=>array(
				'attributes'=>array(
					'username', 'email',
				),
			), */
			'pagination'=>array(
				'pageSize'=>10,
			),
		));

		$params =array(
			'arrayDataProvider'=>$arrayDataProvider,
		);

		if(!isset($_GET['ajax'])) $this->render('grid_view_array', $params);
		else  $this->renderPartial('grid_view_array', $params);
	}


	public function actionGridStyle() {
		$model =new User('search');
		if(isset($_GET['User']))
			$model->attributes =$_GET['User'];

		$params =array(
			'model'=>$model,
		);

		if(!isset($_GET['ajax'])) $this->render('grid_style', $params);
		else  $this->renderPartial('grid_style', $params);
	}

}