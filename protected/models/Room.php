<?php

/**
 * This is the model class for table "{{w_room}}".
 *
 * The followings are the available columns in table '{{w_room}}':
 * @property string $roomCodes
 * @property string $rom_type
 * @property integer $rom_capacity
 * @property string $rom_floor
 *
 * The followings are the available model relations:
 * @property ZRoutine[] $zRoutines
 */
class Room extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{w_room}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('roomCodes', 'required'),
			array('rom_capacity', 'numerical', 'integerOnly'=>true),
			array('roomCodes', 'length', 'max'=>10),
			array('rom_type, rom_floor', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('roomCodes, rom_type, rom_capacity, rom_floor', 'safe', 'on'=>'search'),
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
			'zRoutines' => array(self::HAS_MANY, 'ZRoutine', 'roomCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'roomCodes' => 'Room Codes',
			'rom_type' => 'Rom Type',
			'rom_capacity' => 'Rom Capacity',
			'rom_floor' => 'Rom Floor',
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

		$criteria->compare('roomCodes',$this->roomCodes,true);
		$criteria->compare('rom_type',$this->rom_type,true);
		$criteria->compare('rom_capacity',$this->rom_capacity);
		$criteria->compare('rom_floor',$this->rom_floor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Room the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
