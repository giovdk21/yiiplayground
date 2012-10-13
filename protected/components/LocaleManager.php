<?php

/**
 * @author Giovanni Derks
 * @license New BSD License
 * http://twitter.com/giovdk21
 */


class LocaleManager extends CApplicationComponent {


	public function init() {
		parent::init();
		$this->initLanguage();
	}


	protected function initLanguage() {
		Yii::app()->setLanguage($this->getSelectedLanguage());
	}

	
	public function getSelectedLanguage() {
		if (isset(Yii::app()->session['sel_lang'])) {
			return Yii::app()->session['sel_lang'];
		}
		else {
			return Yii::app()->getLanguage();
		}
	}


	public function setLanguage($language) {
		$language =strtolower($language);
		Yii::app()->setLanguage($language);
		Yii::app()->session['sel_lang']=$language;
	}


	public function getFormatByType($format_type, $format_id, $datetime_format=false) {
		$res =false;

		$datetime_format =(!empty($datetime_format) ?
			$datetime_format : Yii::app()->locale->getDateTimeFormat());

		switch ($format_type) {
			case 'date': {
				$res =Yii::app()->locale->getDateFormat($format_id);
			} break;
			case 'time': {
				$res =Yii::app()->locale->getTimeFormat($format_id);
			} break;
			case 'datetime': {
				$res =strtr(
					$datetime_format,
					array(
						"{0}" => Yii::app()->locale->getTimeFormat($format_id),
						"{1}" => Yii::app()->locale->getDateFormat($format_id),
					)
				);
			} break;
		}

		return $res;
	}


	public function getDbFormat($format_type) {
		$dt_format =Yii::app()->params['database_format']['dateTimeFormat'];
		return $this->getFormatByType($format_type, 'database', $dt_format);
	}


	/**
	 * Convert a date, time or datetime to local/given format to local format
	 * @param <mixed>   $dt date  time, datetime or timestamp
	 * @param <string>  $format_type  'date' | 'time' | 'datetime' used as output
	 * @param <string>  $to_format_id  id/width of the format (short, medium, ..)
	 * @param <string>  $from_format  manually specified locale format string
	 * @param <bool>    $is_timestamp if true, dt will be considered a timestamp
	 * @return <mixed>  formatted string or false if fail
	 */
	public function toLocal($dt, $format_type=false, $to_format_id=false, $from_format=false, $is_timestamp=false) {
		$res =false;

		// kind of data we are convering; datetime is default:
		$format_type =(!empty($format_type) ? $format_type : 'datetime');

		// format id ("width") of data we are convering to; small is default:
		$to_format_id =(!empty($to_format_id) ? $to_format_id : 'short');

		if (!$is_timestamp) {
			 // default storage format:
			$from_format =(!empty($from_format) ? $from_format : $this->getDbFormat($format_type));

			$res =Yii::app()->dateFormatter->format(
				$this->getFormatByType($format_type, $to_format_id),
				CDateTimeParser::parse($dt, $from_format)
			);
		}
		else {
			$res =Yii::app()->dateFormatter->format(
				$this->getFormatByType($format_type, $to_format_id),
				$dt // timestamp
			);
		}

		return $res;
	}


	/**
	 * Convert a date, time or datetime to local/given format to database format
	 * @param <mixed>   $dt date  time, datetime or timestamp
	 * @param <string>  $to_format_type  'date' | 'time' | 'datetime' used as output
	 * @param <string>  $from_format_id  id/width of the format (short, medium, ..)
	 * @param <string>  $from_format_type  'date' | 'time' | 'datetime' used as input
	 * @param <string>  $from_format  manually specified locale format string
	 * @param <bool>    $is_timestamp if true, dt will be considered a timestamp
	 * @return <mixed>  formatted string or false if fail
	 */
	public function toDatabase($dt, $to_format_type=false, $from_format_id=false,
		                         $from_format_type=false, $from_format=false, $is_timestamp=false) {
		$res =false;

		// kind of data we are convering to; datetime is default:
		$to_format_type =(!empty($to_format_type) ? $to_format_type : 'datetime');

		// kind of data we are convering from; by default it is the
		// same as to_format_type, that it is a common situation:
		$from_format_type =(!empty($from_format_type) ? $from_format_type : $to_format_type);

		// format id ("width") of data we are convering from; small is default:
		$from_format_id =(!empty($from_format_id) ? $from_format_id : 'short');

		if (!$is_timestamp) {
			$from_format =(!empty($from_format) ?
				$from_format : $this->getFormatByType($from_format_type, $from_format_id));

			$res =Yii::app()->dateFormatter->format(
				$this->getFormatByType($to_format_type, 'database'),
				CDateTimeParser::parse($dt, $from_format)
			);
		}
		else {
			$res =Yii::app()->dateFormatter->format(
				$this->getFormatByType($to_format_type, 'database'),
				$dt // timestamp
			);
		}

		return $res;
	}


	/**
	 *
	 * @param <type> $dt
	 * @param <type> $format_type
	 * @param <type> $format_id
	 * @param <type> $is_timestamp
	 * @return <type> 
	 */
	public function splitDatetime($dt, $format_type=false, $format_id=false, $is_timestamp=false) {
		$res =false;
		$timestamp =0;

		if (!$is_timestamp) {
			// kind of data we are convering to; datetime is default:
			$format_type =(!empty($format_type) ? $format_type : 'datetime');
			// format id ("width") of data we are convering from; small is default:
			$format_id =(!empty($format_id) ? $format_id : 'short');
			$from_format =$this->getFormatByType($format_type, $format_id);
			$timestamp =CDateTimeParser::parse($dt, $from_format);
		}
		else {
			$timestamp =$dt;
		}

		if ($timestamp > 0) {
			// not using getdate() as we want to have 2 digits values

			$my_format ='yyyy-MM-dd HH:mm:ss';
			$my_date_string =Yii::app()->dateFormatter->format($my_format, $timestamp);

			$res =array(
				'date'=>substr($my_date_string, 0, 10),
				'time'=>substr($my_date_string, 11),
				'datetime'=>$my_date_string,
				'year'=>substr($my_date_string, 0, 4),
				'yy'=>substr($my_date_string, 2, 2),
				'month'=>substr($my_date_string, 5, 2),
				'day'=>substr($my_date_string, 8, 2),
				'hour'=>substr($my_date_string, 11, 2),
				'min'=>substr($my_date_string, 14, 2),
				'sec'=>substr($my_date_string, 17, 2),
			);
		}

		return $res;
	}


	/**
	 *
	 * @param <type> $dt_arr
	 * @param <type> $to_format_type
	 * @param <type> $format_id
	 * @param <type> $from_format_id
	 * @return <type> 
	 */
	public function mergeDatetime($dt_arr, $to_format_type=false, $format_id=false, $from_format_id=false) {
		// kind of data we are convering to; datetime is default:
		$to_format_type =(!empty($to_format_type) ? $to_format_type : 'datetime');
		// format id ("width") of data we are convering from; small is default:
		$format_id =(!empty($format_id) ? $format_id : 'short');
		$from_format_id =(!empty($from_format_id) ? $from_format_id : $format_id);

		if (isset($dt_arr['date'])) {
			$from_format =$this->getFormatByType('date', $from_format_id);
			$timestamp =CDateTimeParser::parse($dt_arr['date'], $from_format);
			$dt_info =getdate($timestamp);
			$dt_arr['day']=$dt_info['mday'];
			$dt_arr['month']=$dt_info['mon'];
			$dt_arr['year']=$dt_info['year'];
		}

		if (isset($dt_arr['time'])) {
			$from_format =$this->getFormatByType('time', $from_format_id);
			$timestamp =CDateTimeParser::parse($dt_arr['time'], $from_format);
			$dt_info =getdate($timestamp);
			$dt_arr['hour']=$dt_info['hours'];
			$dt_arr['min']=$dt_info['minutes'];
			$dt_arr['sec']=$dt_info['seconds'];
		}

		$timestamp =mktime(
			(isset($dt_arr['hour']) ? $dt_arr['hour'] : null),
			(isset($dt_arr['min']) ? $dt_arr['min'] : null),
			(isset($dt_arr['sec']) ? $dt_arr['sec'] : null),
			(isset($dt_arr['month']) ? $dt_arr['month'] : null),
			(isset($dt_arr['day']) ? $dt_arr['day'] : null),
			(isset($dt_arr['year']) ? $dt_arr['year'] : null)
		);

		$my_format ='yyyy-MM-dd HH:mm:ss';
		$to_format =$this->getFormatByType($to_format_type, $format_id);
		$res =Yii::app()->dateFormatter->format($my_format, $timestamp);

		return $res;
	}


}