<?php
class DbManager extends CApplicationComponent{

	public function init() {
		parent::init();
		// if we already have a connection, we quit
		// this will allow user to set up a custom one
		if (Yii::app()->db->active)
			return;
		
		if (isset($_GET['r']) && $_GET['r'] == 'site/createUserDb')
			return;

		if ($this->dbExists()) {
			Yii::app()->db->connectionString ='sqlite:'.Yii::app()->params['user_db'];
			Yii::app()->db->setActive(true);
		} else {			
			$this->resetUserDb();			
		}
	}


	protected function dbExists() {
		return file_exists(Yii::app()->params['user_db']);
	}


	public function resetUserDb() {
		$source_db =Yii::app()->params['factory_db'];
		$dest_db =Yii::app()->params['user_db'];
		Yii::app()->db->setActive(false);

		if (file_exists($source_db)) {
			if (@copy($source_db, $dest_db)) { // copy from factory.db to user.db
			  // we set file permissions to the file
				@chmod(Yii::app()->params['user_db'], 0666);
				// we set the connection string
				Yii::app()->db->connectionString ='sqlite:'.Yii::app()->params['user_db'];
			}
			else {
				// if we can't copy/create it, we ask the user to do it by hand
				// or set right permissions
				Yii::app()->db->connectionString ='sqlite:'.Yii::app()->params['factory_db'];
				
				Yii::app()->controller->redirect('site/createUserDb');
			}
		}		

		Yii::app()->db->setActive(true);
	}
	
}

?>