<?php

/**
 * This is the model class for table "{{s_markingscheme}}".
 *
 * The followings are the available columns in table '{{s_markingscheme}}':
 * @property integer $markingSchemeID
 * @property string $mrs_versionNo
 * @property integer $mrs_attendance
 * @property integer $mrs_classTest
 * @property integer $mrs_midTerm
 * @property integer $mrs_final
 * @property integer $mrs_startTerm
 * @property integer $mrs_startYear
 * @property integer $mrs_endTerm
 * @property integer $mrs_endYear
 * @property string $mrs_gradingSchemeName
 * @property integer $mrs_attendancePass
 * @property integer $mrs_classTestPass
 * @property integer $mrs_midtermPass
 * @property integer $mrs_finalPass
 * @property boolean $ex_mrs_default
 *
 * The followings are the available model relations:
 * @property RModuleregistration[] $rModuleregistrations
 */
class MarkingScheme extends CActiveRecord
{

    public $FirstHalfMarks;
    
    public $FirstHalfPassMarks;
    
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MarkingScheme the static model class
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
		return '{{r_markingscheme}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mrs_gradingSchemeName, mrs_versionNo, mrs_attendance, mrs_classTest, mrs_midTerm, mrs_final, mrs_startTerm, mrs_startYear, mrs_attendancePass, mrs_classTestPass, mrs_midtermPass, mrs_finalPass', 'required'),
			array('mrs_attendance, mrs_classTest, mrs_midTerm, mrs_final,  mrs_startYear,  mrs_endYear, mrs_attendancePass, mrs_classTestPass, mrs_midtermPass, mrs_finalPass', 'numerical', 'integerOnly'=>true),
			array('mrs_versionNo', 'length', 'max'=>50),
			array('mrs_gradingSchemeName', 'length', 'max'=>50),
			array('ex_mrs_default', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('markingSchemeID, mrs_versionNo, mrs_attendance, mrs_classTest, mrs_midTerm, mrs_final, mrs_startTerm, mrs_startYear, mrs_endTerm, mrs_endYear, mrs_gradingSchemeName, mrs_attendancePass, mrs_classTestPass, mrs_midtermPass, mrs_finalPass, ex_mrs_default', 'safe', 'on'=>'search'),
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
			'rModuleregistrations' => array(self::HAS_MANY, 'RModuleregistration', 'markingSchemeID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'markingSchemeID' => 'MarkingSchemeID',
			'mrs_versionNo' => 'Version No',
			'mrs_attendance' => 'Attendance',
			'mrs_classTest' => 'Class Test',
			'mrs_midTerm' => 'Midterm',
			'mrs_final' => 'Final',
			'mrs_startTerm' => 'Start Term',
			'mrs_startYear' => 'Start Year',
			'mrs_endTerm' => 'End Term',
			'mrs_endYear' => 'End Year',
			'mrs_gradingSchemeName' => 'Grading Scheme Name',
			'mrs_attendancePass' => 'Attendance Pass Marks',
			'mrs_classTestPass' => 'Class Test Pass Marks',
			'mrs_midtermPass' => 'Midterm Pass Marks',
			'mrs_finalPass' => 'Final Pass Marks',
			'ex_mrs_default' => 'Default Using',
                        'FirstHalfMarks' => 'First Half Marks',
 
                        'FirstHalfPassMarks' => 'First Half Pass Marks',
 
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

                $criteria->select=array('*','("mrs_attendance"+ "mrs_classTest"+ "mrs_midterm") as "FirstHalfMarks"','("mrs_attendancePass"+ "mrs_classTestPass"+ "mrs_midtermPass") as "FirstHalfPassMarks"' );
		
                $criteria->compare('markingSchemeID',$this->markingSchemeID);
		$criteria->compare('mrs_versionNo',$this->mrs_versionNo,true);
		$criteria->compare('mrs_attendance',$this->mrs_attendance);
		$criteria->compare('mrs_classTest',$this->mrs_classTest);
		$criteria->compare('mrs_midTerm',$this->mrs_midterm);
		$criteria->compare('mrs_final',$this->mrs_final);
		$criteria->compare('mrs_startTerm',$this->mrs_startTerm);
		$criteria->compare('mrs_startYear',$this->mrs_startYear);
		$criteria->compare('mrs_endTerm',$this->mrs_endTerm);
		$criteria->compare('mrs_endYear',$this->mrs_endYear);
		$criteria->compare('mrs_gradingSchemeName',$this->mrs_gradingSchemeName,true);
		$criteria->compare('mrs_attendancePass',$this->mrs_attendancePass);
		$criteria->compare('mrs_classTestPass',$this->mrs_classTestPass);
		$criteria->compare('mrs_midtermPass',$this->mrs_midtermPass);
		$criteria->compare('mrs_finalPass',$this->mrs_finalPass);
		$criteria->compare('ex_mrs_default',$this->ex_mrs_default);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}