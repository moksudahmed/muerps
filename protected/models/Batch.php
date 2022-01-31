<?php

/**
 * This is the model class for table "{{batch}}".
 *
 * The followings are the available columns in table '{{batch}}':
 * @property integer $batchName
 * @property string $programmeCode
 * @property string $bat_term
 * @property integer $bat_year
 * @property integer $bat_advisor
 *
 * The followings are the available model relations:
 * @property Faculty $batAdvisor
 * @property Programme $programmeCode0
 * @property Section[] $sections
 * @property Section[] $sections1
 */
class Batch extends CActiveRecord
{
        public $feesName;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Batch the static model class
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
		return '{{f_batch}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batchName, bat_year, bat_term, bat_advisor', 'numerical', 'integerOnly'=>true),
			array('programmeCode', 'length', 'max'=>10),
			array('bat_term', 'length', 'max'=>1),
                    
                    array('batchName', 'length', 'max'=>3),
                        array('bat_term', 'in', 'range'=>array('1','2','3')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('batchName, programmeCode, bat_term, bat_year, bat_advisor', 'safe', 'on'=>'search'),
                        array(' bat_term, bat_year, batchName, syllabusCode, feesName', 'required', ),
                    /*
                        array('batchName', 'unique', 'criteria'=>array(
                            'condition'=>'`programmeCode`=:programmeCode',
                            'params'=>array(
                                ':programmeCode'=>$this->programmeCode
                                ))),
                    */
                    
                    array('batchName+programmeCode', 'application.extensions.uniqueMultiColumnValidator'),
                    
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
			'batAdvisor' => array(self::BELONGS_TO, 'Faculty', 'bat_advisor'),
			'programmeCode0' => array(self::BELONGS_TO, 'Programme', 'programmeCode'),
			'sections' => array(self::HAS_MANY, 'Section', 'batchName'),
			'sections1' => array(self::HAS_MANY, 'Section', 'programmeCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'batchName' => 'Batch Name',
			'programmeCode' => 'Programme Code',
			'bat_term' => 'Academic Term',
			'bat_year' => 'Academic Year',
			'bat_advisor' => 'Advisor',
                        'feesName' => 'Fees Structure',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->condition="\"programmeCode\"='{$id}' and ex_bat_active=true";
		$criteria->compare('batchName',$this->batchName);
		$criteria->compare('programmeCode',$this->programmeCode,true);
		$criteria->compare('bat_term',$this->bat_term,true);
		$criteria->compare('bat_year',$this->bat_year);
		$criteria->compare('bat_advisor',$this->bat_advisor);
                $criteria->order="\"batchName\" desc";
                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>12,)
		));
	}
}