<?php

/**
 * This is the model class for table "{{section}}".
 *
 * The followings are the available columns in table '{{section}}':
 * @property string $sectionName
 * @property integer $batchName
 * @property string $programmeCode
 * @property string $sec_startDate
 * @property string $sec_startId
 * @property string $sec_endId
 * @property string $sec_remarks
 *
 * The followings are the available model relations:
 * @property Admission[] $admissions
 * @property Admission[] $admissions1
 * @property Admission[] $admissions2
 * @property Offeredmodule[] $offeredmodules
 * @property Offeredmodule[] $offeredmodules1
 * @property Offeredmodule[] $offeredmodules2
 * @property Batch $batchName0
 * @property Batch $programmeCode0
 */
class Section extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Section the static model class
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
		return '{{g_section}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batchName, sec_startId, sec_endId', 'numerical', 'integerOnly'=>true),
			array('sectionName', 'length', 'max'=>1),
			array('programmeCode', 'length', 'max'=>10),
			array('sec_startId, sec_endId', 'length', 'max'=>3),
			array('sec_startDate, sec_remarks', 'safe'),
			

                        array('sectionName, sec_startDate,sec_endId, sec_startId', 'required', ),
                    /*
                     array('sec_startId, sec_endId', 'match', 'pattern'=>'/^([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$/',
                        'message'=>'ID has specific format like [111-115-001] .'),
                    */
                     array('sectionName', 'match', 'pattern'=>'/^([A-Z])$/',
                        'message'=>'Section name have to be Upper Case [A-Z] .'),
                    
                    array('sectionName+batchName+programmeCode', 'application.extensions.uniqueMultiColumnValidator'),
                    
// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sectionName, batchName, programmeCode, sec_startDate, sec_startId, sec_endId, sec_remarks', 'safe', 'on'=>'search'),
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
			'admissions' => array(self::HAS_MANY, 'Admission', 'sectionName'),
			'admissions1' => array(self::HAS_MANY, 'Admission', 'batchName'),
			'admissions2' => array(self::HAS_MANY, 'Admission', 'programmeCode'),
			'offeredmodules' => array(self::HAS_MANY, 'Offeredmodule', 'sectionName'),
			'offeredmodules1' => array(self::HAS_MANY, 'Offeredmodule', 'batchName'),
			'offeredmodules2' => array(self::HAS_MANY, 'Offeredmodule', 'programmeCode'),
			'batchName0' => array(self::BELONGS_TO, 'Batch', 'batchName'),
			'programmeCode0' => array(self::BELONGS_TO, 'Batch', 'programmeCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sectionName' => 'Section Name',
			'batchName' => 'Batch Name',
			'programmeCode' => 'Programme Code',
			'sec_startDate' => 'Start Date',
			'sec_startId' => 'Start ID',
			'sec_endId' => 'End ID',
			'sec_remarks' => 'Remarks',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id,$pid)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->condition="\"programmeCode\"='{$pid}' AND \"batchName\"={$id}";
		$criteria->compare('sectionName',$this->sectionName,true);
		$criteria->compare('batchName',$this->batchName,true);
		$criteria->compare('programmeCode',$this->programmeCode,true);
		$criteria->compare('sec_startDate',$this->sec_startDate,true);
		$criteria->compare('sec_startId',$this->sec_startId,true);
		$criteria->compare('sec_endId',$this->sec_endId,true);
		$criteria->compare('sec_remarks',$this->sec_remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}