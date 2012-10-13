<?php

class UiController extends Controller
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


	public function actionJNotify() {
		$this->render('jnotify');
	}
	
	public function actionCLEditor(){
		$this->render('cleditor');
	}

	public function actionJQGrid(){
		$this->render('jqgrid');
	}

}