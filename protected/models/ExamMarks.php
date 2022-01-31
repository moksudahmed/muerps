<?php

/**
 * This is the model class for table "{{u_exammarks}}".
 *
 * The followings are the available columns in table '{{u_exammarks}}':
 * @property integer $examinationID
 * @property integer $moduleRegistrationID
 * @property string $emr_date
 * @property double $emr_mark
 * @property integer $emr_status
 * @property date $supple_regi_date
 */
class ExamMarks extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExamMarks the static model class
	 */
    
        public $studentID;
        public $moduleCode;
        public $mod_name;
        public $mod_creditHour;
        public $letterGrade;
        public $gradePoint;
        public $mod_group;
        

        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{u_exammarks}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('examinationID, moduleRegistrationID, emr_date', 'required'),
			array('examinationID, moduleRegistrationID, emr_status', 'numerical', 'integerOnly'=>true),
			array('emr_mark', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('examinationID, moduleRegistrationID, emr_date, emr_mark, emr_status', 'safe', 'on'=>'search'),
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
			'examinationID' => 'Examination',
			'moduleRegistrationID' => 'Module Registration',
			'emr_date' => 'Emr Date',
			'emr_mark' => 'Emr Mark',
			'emr_status' => 'Emr Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchIndividualResult($studentID)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$sql="SELECT tra_term,tra_year, \"moduleCode\", mod_name, reg_date, reg_type, reg_status,  \"markFirstHalf\", \"markSecondHalf\", \"letterGrade\",\"gradePoint\", \"sectionName\", \"batchName\", \"programmeCode\", \"studentID\" as id  from vw_individualresult   where \"studentID\"='{$studentID}'";
                    
                    $sqlCount="SELECT count(\"studentID\") from vw_individualresult where \"studentID\"='{$studentID}' group by \"studentID\" ";
		
                    $count=Yii::app()->db->createCommand($sqlCount)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'moduleCode','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
	}
        public function serachSubjectGroup($sid)
        {
            $sql= "select * from vw_transcript  where \"studentID\"='{$sid}' order by mod_sequence;"; 
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;
        }
        
        public function searchIndividualResultforTranscript($studentID)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$sql="SELECT tra_term,tra_year, \"moduleCode\", mod_name, reg_date, reg_type, \"markFirstHalf\", \"markSecondHalf\", \"letterGrade\",\"gradePoint\", \"sectionName\", \"batchName\", \"programmeCode\", \"studentID\" as id  from vw_individualresult   where \"studentID\"='{$studentID}'";
                    
                    $sqlCount="SELECT count(\"studentID\") from vw_individualresult where \"studentID\"='{$studentID}' group by \"studentID\" ";
		
                    $count=Yii::app()->db->createCommand($sqlCount)->queryScalar();

                
           $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;
           /*     return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'moduleCode','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));*/
	}
}