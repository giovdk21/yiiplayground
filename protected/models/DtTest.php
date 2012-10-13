<?php

/**
 * This is the model class for table "{{dt_test}}".
 */
class DtTest extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{dt_test}}':
	 * @var integer $id
	 * @var string $c_date
	 * @var string $c_time
	 * @var string $c_datetime
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return DtTest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{dt_test}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('c_date, c_time, c_datetime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, c_date, c_time, c_datetime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'c_date' => 'Date',
			'c_time' => 'Time',
			'c_datetime' => 'Date and time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('c_date',$this->c_date,true);

		$criteria->compare('c_time',$this->c_time,true);

		$criteria->compare('c_datetime',$this->c_datetime,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}