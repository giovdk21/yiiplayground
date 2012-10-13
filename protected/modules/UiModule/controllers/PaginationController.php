<?php

/**
 * DataViewController: used for GridView and pagination examples
 */

class PaginationController extends Controller
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
			'basic_pager' => array(
				'Sample data' => array('pagination/basicPager', '#'=>'SampleData'),
				'CPagination' => array('pagination/basicPager', '#'=>'CPagination'),
				'CLinkPager' => array('pagination/basicPager', '#'=>'CLinkPager'),
				'CListPager' => array('pagination/basicPager', '#'=>'CListPager'),
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
	
	public function actionBasicPager() {

		$item_count =32;
		$page_size =5;

		$pages =new CPagination($item_count);
		$pages->setPageSize($page_size);

		// simulate the effect of LIMIT in a sql query
		$end =($pages->offset+$pages->limit <= $item_count ? $pages->offset+$pages->limit : $item_count);

		$sample =range($pages->offset+1, $end);

		$this->render('basic_pager', array(
			'item_count'=>$item_count,
			'page_size'=>$page_size,
			'items_count'=>$item_count,
			'pages'=>$pages,
			'sample'=>$sample,
		));
	}


}