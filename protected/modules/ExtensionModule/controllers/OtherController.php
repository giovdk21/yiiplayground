<?php

class OtherController extends Controller
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
	
	
	public function actionOpenFlashChart(){
		$this->render('openflashchart');
	}

}