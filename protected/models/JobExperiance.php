<?php

/**
 * This is the model class for table "{{jobexperiance}}".
 * * -update --ron--13-05-2013-
 * 
 * The followings are the available columns in table '{{jobexperiance}}':
 * @property integer $jobExperianceID
 * @property string $joe_employer
 * @property string $joe_address
 * @property string $joe_position
 * @property string $joe_startDate
 * @property string $joe_endDate
 * @property string $joe_contact
 * @property integer $personID
 *
 * The followings are the available model relations:
 * @property Person $person
 */
class JobExperiance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JobExperiance the static model class
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
		return '{{l_jobexperiance}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    
                    array(' joe_employer, joe_position,joe_address,joe_startDate, personID', 'required'),
			array('jobExperianceID, personID, joe_contact', 'numerical', 'integerOnly'=>true),
			array('joe_employer', 'length', 'max'=>200),
			array('joe_address', 'length', 'max'=>1000),
			array('joe_position', 'length', 'max'=>50),
			array('joe_contact', 'length', 'max'=>15),
			
                       // array('joe_startDate, joe_endDate', 'date'),
                    array('joe_startDate, joe_endDate', 'length', 'max'=>10),
                        array('joe_address', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('jobExperianceID, joe_employer, joe_position, personID', 'safe', 'on'=>'search'),
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
			'person' => array(self::BELONGS_TO, 'Person', 'personID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'jobExperianceID' => 'JobExperianceID',
			'joe_employer' => 'Employer',
			'joe_address' => 'Address',
			'joe_position' => 'Position',
			'joe_startDate' => 'Start Date',
			'joe_endDate' => 'End Date',
			'joe_contact' => 'Contact',
			'personID' => 'PersonID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($personID)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                $criteria->condition="t.\"personID\"=:personID";
                $criteria->params=array(':personID'=>$personID);
		$criteria->compare('jobExperianceID',$this->jobExperianceID);
		$criteria->compare('joe_employer',$this->joe_employer,true);
		
		$criteria->compare('joe_position',$this->joe_position,true);
		
		$criteria->compare('personID',$this->personID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}