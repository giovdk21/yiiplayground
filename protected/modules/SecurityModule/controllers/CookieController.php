<?php
class CookieController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
	}

        public function actionCsrf(){
                $this->render("csrf");
        }

	public function actionIndex() {
		$this->render('index');
	}

}
