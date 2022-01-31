<?php

/**
 * This is the model class for table "{{v_timeSlot}}".
 *
 * The followings are the available columns in table '{{v_timeSlot}}':
 * @property string $timeSlotCode
 * @property string $tst_start
 * @property string $tst_end
 *
 * The followings are the available model relations:
 * @property HOfferedmodule[] $hOfferedmodules
 */
class TimeSlot extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{v_timeSlot}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timeSlotCode, tst_start, tst_end', 'required'),
			array('timeSlotCode', 'length', 'max'=>5),
			array('tst_start, tst_end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('timeSlotCode, tst_start, tst_end', 'safe', 'on'=>'search'),
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
			'hOfferedmodules' => array(self::HAS_MANY, 'HOfferedmodule', 'timeSlotCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'timeSlotCode' => 'Time Slot Code',
			'tst_start' => 'Start Time',
			'tst_end' => 'End Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('timeSlotCode',$this->timeSlotCode,true);
		$criteria->compare('tst_start',$this->tst_start,true);
		$criteria->compare('tst_end',$this->tst_end,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TimeSlot the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
