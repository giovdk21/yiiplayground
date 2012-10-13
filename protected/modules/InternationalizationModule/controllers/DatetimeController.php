<?php

class DatetimeController extends Controller {

	public function actionIndex() {
		$this->render('index');
	}


	public function actionBasic() {
		$this->render('basic');
	}


	public function actionLocaleManager() {
		$this->render('locale_manager');
	}


	public function actionUserinput() {
		$model =new DtTest('search');		
		$this->render('userinput', array(
				'model'=>$model,
				'hour_arr'=>$this->getHourArray()
			)
		);
	}


	public function actionUserinputData() {
		$item_id =(int)$_GET['id'];

		$model =DtTest::model()->findByPk($item_id);

		if ($model != null) {
			$c_time =explode(':', $model->c_time);
			$dt_info =Yii::app()->lc->splitDatetime($model->c_datetime, false, 'database');
		}

		$res =array(
			'c_date'=>Yii::app()->lc->toLocal($model->c_date, 'date', 'small'),
			'c_time_hour'=>$c_time[0],
			'c_time_min'=>$c_time[1],
			'c_datetime'=>Yii::app()->lc->toLocal($dt_info['date'], 'date', 'small'),
			'c_datetime_hour'=>$dt_info['hour'],
			'c_datetime_min'=>$dt_info['min'],
		);

		echo CJSON::encode($res);
	}


	public function getHourArray() {
		// This is for test pourposes, in real life you could have a widget..
		$res =array();
		for($i=0; $i < 24; $i++) {
			$h =Yii::app()->numberFormatter->format('00', $i);
			$res[$h]=$h;
		}
		return $res;
	}


	public function actionUserinputSave() {

		if (isset($_POST['item_id']) && $_POST['item_id'] > 0 && isset($_POST['DtTest'])) {
			$item_id =(int)$_POST['item_id'];

			$model =DtTest::model()->findByPk($item_id);
			$model->c_date =Yii::app()->dateFormatter->formatDateTime(
				CDateTimeParser::parse(
					$_POST['DtTest']['c_date'],
					Yii::app()->locale->getDateFormat('small')
				),
				'database',
				false
			);

			$model->c_time =$_POST['c_time_hour'].':'.$_POST['c_time_min'].':00';

			$model->c_datetime =Yii::app()->lc->mergeDatetime(
				array(
					'date'=>$_POST['DtTest']['c_datetime'],
					'hour'=>$_POST['c_datetime_hour'],
					'min'=>$_POST['c_datetime_min'],
				),
				'database', 'small'
			);

			$model->save();
		}
	}


}
