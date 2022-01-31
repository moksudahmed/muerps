<?php

/**
 * 
 * update on 28-05-2013 by muBlRon;
 * 
 * This is the model class for table "{{syllabus}}".
 *
 * The followings are the available columns in table '{{syllabus}}':
 * @property integer $syllabusID
 * @property string $programmeCode
 * @property double $syl_version
 * @property string $syl_startTerm
 * @property integer $syl_startYear
 * @property string $syl_endTerm
 * @property integer $syl_endYear
 * @property integer $syl_maxCreditHour
 * @property string $syl_description
 * @property double $syl_minCGPA
 * @property double $syl_maxCGPA
 * @property string $syl_approvedDate
 *
 * The followings are the available model relations:
 * @property Module[] $modules
 * @property Programme $programmeCode0
 */
class Syllabus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Syllabus the static model class
	 */
        public $syl_startTerm;
        public $syl_minMonth;
        
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{d_syllabus}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
           
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('syl_approvedDate, syllabusCode, syl_version,syl_startTerm, syl_startYear, syl_maxCreditHour, syl_minCGPA, syl_maxCGPA', 'required'),
			array(' syl_startYear, syl_endYear, syl_maxCreditHour', 'numerical', 'integerOnly'=>true),
			array('syl_version, syl_minCGPA, syl_maxCGPA, syl_minMonth', 'numerical'),
			
                        array('syllabusCode', 'unique'),
                        array('syl_maxCreditHour', 'length', 'max'=>3),
			//array('syl_startTerm, syl_endTerm', 'length', 'max'=>1),
			array('syl_description', 'safe'),
                        //array('syl_approvedDate', 'date'),
                    
                       // array('syl_startTerm, syl_endTerm', 'in', 'range'=>array('1','2','3')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('syllabusCode, programmeCode, syl_version,syl_startTerm, syl_endTerm', 'safe', 'on'=>'search'),
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
			'modules' => array(self::HAS_MANY, 'Module', 'syllabusCode'),
			'programme' => array(self::BELONGS_TO, 'Programme', 'programmeCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'syllabusCode' => 'Syllabus Code',
			'programmeCode' => 'Programme Code',
			'syl_version' => 'Version',
                    'syl_startTerm' => 'Start Trem',
                    'syl_startYear' => 'Start Year',
                    'syl_endTerm' => 'End Term',
                    'syl_endYear' => 'End Year',
                    'syl_maxCreditHour' => 'Minimum Credit Hour',
                    'syl_description' => 'Description',
                    'syl_approvedDate' => 'Approval Date',
                    'syl_minCGPA' =>'Minimum Required CGPA',
                    'syl_maxCGPA' =>'Maximum Earned CGPA',
                    'syl_minMonth' =>'Minimum Month',
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
                $criteria->condition="\"programmeCode\"='{$id}'";
		$criteria->compare('syllabusCode',$this->syllabusCode);
		$criteria->compare('programmeCode',$this->programmeCode,true);
		$criteria->compare('syl_version',$this->syl_version);
                $criteria->compare('syl_startTerm',$this->syl_startTerm);
                $criteria->compare('syl_endTerm',$this->syl_endTerm);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}