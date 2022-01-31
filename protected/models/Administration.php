<?php

/**
 * This is the model class for table "{{administration}}".
 * * -update --ron--13-05-2013-
 * The followings are the available columns in table '{{administration}}':
 * @property string $administrationCode
 * @property string $adm_name
 * @property string $adm_location
 * @property string $adm_remarks
 * @property string $adm_contactNo
 * @property string $adm_email
 *
 * The followings are the available model relations:
 * @property Employee[] $employees
 */
class Administration extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Administration the static model class
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
		return '{{i_administration}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('administrationCode', 'length', 'max'=>10),
			array('adm_name, adm_email', 'length', 'max'=>100),
			array('adm_location', 'length', 'max'=>300),
			array('adm_contactNo', 'length', 'max'=>25),
			array('adm_remarks', 'safe'),
                    
                        array('adm_email', 'email'),
                    
                    array('administrationCode, adm_name, adm_email', 'required'),
                        array('administrationCode, adm_name', 'unique'),
                        
                        array('adm_contactNo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('administrationCode, adm_name', 'safe', 'on'=>'search'),
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
			'employees' => array(self::HAS_MANY, 'Employee', 'administrationCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'administrationCode' => 'Department Code',
			'adm_name' => 'Name',
			'adm_location' => 'Location',
			'adm_remarks' => 'Remarks',
			'adm_contactNo' => 'Contact No',
			'adm_email' => 'Email',
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

		//$criteria->compare('administrationCode',$this->administrationCode,true);
		//$criteria->compare('adm_name',$this->adm_name,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}