<?php

class Ui_otherController extends Controller
{

	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
	}


	public function actionIndex() {		
		$this->render('index');
	}

	/**
	 * For demo breadcrumbs CBreadcrumbs
	 */
	public function actionBreadcrumbs() {
		$this->render('breadcrumbs');
	}

	/**
	 * Demo tree view using CTreeView
	 * This one using simple given data to display
	 */
	public function actionTreeView() {
		$dataTree=array(
			array(
				'text'=>'Grampa', //must using 'text' key to show the text
				'children'=>array(//using 'children' key to indicate there are children
					array(
						'text'=>'Father',
						'children'=>array(
							array('text'=>'me'),
							array('text'=>'big sis'),
							array('text'=>'little brother'),
						)
					),
					array(
						'text'=>'Uncle',
						'children'=>array(
							array('text'=>'Ben'),
							array('text'=>'Sally'),
						)
					),
					array(
						'text'=>'Aunt',
					)
				)
			)
		);

		$this->render('tree_view', array('dataTree'=>$dataTree));
	}

	/**
	 * Display simple tab view using CTabView
	 */
	public function actionTabView(){
		$this->render('tab_view'); 
	}


	/**
	 * Displaying star rating using CStarRating
	 * The Get will get the value from the star
	 */
	public function actionStarRating() {
		$ratingValue=0;

		if (isset($_POST['rating'])) {
			$ratingValue=$_POST['rating']; //according the widget name, in this case is "rating"
		}
		$this->render('star_rating', array('ratingValue'=>$ratingValue));
	}

	/**
	 * Part of CStarRating demo
	 * This action to get the POST value that the star rating ajax post
	 */
        public function actionStarRatingAjax() {
		$ratingAjax=isset($_POST['rate']) ? $_POST['rate'] : 0;
		echo "You are voting $ratingAjax through AJAX!";
	}


	/**
	 * Displaying menu using CMenu
	 */
        public function actionMenu(){
		$listMenu =array(
			array('label'=>'Home', 'url'=>array('site/index'), 'active'=>true),
			array('label'=>'Products', 'url'=>array('site/index')),
			array('label'=>'About Us', 'url'=>array('site/index')),
			array('label'=>'Contacts', 'url'=>array('site/index')),
		);
		$this->render('menu',array('menu'=>$listMenu));
	}

	/**
	 * Displaying the text with Text Highlighter
	 */
	public function actionTextHighlighter(){

		$code = 'echo "hello"; '; //default code
		$language = 'php'; //default text
		$showLineNumbers = false;

		if (isset($_POST['code']))
			$code = $_POST['code'];

		if(isset($_POST['language']))
			$language = $_POST['language'];

		if(isset($_POST['show-line-numbers']))
			$showLineNumbers= true;

		//list currently available language that CTextHighlighter support
		$listLanguage = array(
			'php'=>'PHP',
			'sql'=>'SQL',
			'xml'=>'XML',
			'abap'=>'ABAP',
			'cpp'=>'C++',
			'css'=>'CSS',
			'diff'=>'DIFF',
			'dtd' => 'DTD',
			'html'=>'HTML',
			'java'=>'Java',
			'javascript'=>'Javascript',
			'mysql'=>'MySQL',
			'perl'=>'Perl',
			'python'=>'Python',
			'ruby'=>'Ruby',
		);

		$this->render('text_highlighter', array(
			'code'=>$code,
			'language'=>$language,
			'showLineNumbers'=>$showLineNumbers,
			'listLanguage'=>$listLanguage));
	}
}