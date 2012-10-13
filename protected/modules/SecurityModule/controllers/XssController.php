<?php

class XssController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
	}

        public function actionHtmlPurifier(){
                $user_input = null;
                if (isset($_POST['user_input'])){
                        $user_input = $_POST['user_input'];
                }

                $parser=new CHtmlPurifier(); //create instance of CHtmlPurifier
                $user_input=$parser->purify($user_input); //we purify the $user_input

                $this->render("htmlpurifier", array('user_input'=>$user_input));
        }
	public function actionIndex() {
		$this->render('index');
	}

}