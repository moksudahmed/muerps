<?php

/**
 * This is the model class for table "{{examregistration}}".
 *
 * The followings are the available columns in table '{{examregistration}}':
 * @property integer $examinationID
 * @property integer $moduleRegistrationID
 * @property string $exr_date
 * @property string $exr_issueAdmit
 * @property integer $employeeID
 *
 * The followings are the available model relations:
 * @property Exammarks[] $exammarks
 * @property Exammarks[] $exammarks1
 */
class ExamRegistration extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExamRegistration the static model class
	 */
    
    public $personID;
        public $per_name;
        public $per_title;
        public $per_firstName;
        public $per_lastName;
        public $per_gender;
        public $per_dateOfBirth;
        public $per_bloodGroup;
        public $per_nationality;
        public $per_fathersName;
        public $per_mothersName;
 
        public $per_parmanentAddress;
        public $per_postCode;
        public $per_telephone;
        public $per_mobile;
        public $per_email;
        public $per_presentAddress;
        public $per_maritulStatus;
        public $per_spouseName;
        public $per_personalStatment;
        public $per_criminalConviction;
        public $per_convictionDetails;
        public $ex_per_image;
        public $totalRegistered;
        public $moduleCode;
        public $mod_name;
        public $stu_academicTerm;
        public $stu_academicYear;
        public $absent;
        public $final;
        public $subTotal;
        public $grandTotal;




        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{q_termadmission}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('examinationID, moduleRegistrationID, employeeID', 'numerical', 'integerOnly'=>true),
			array('exr_issueAdmit', 'length', 'max'=>1),
			array('exr_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('examinationID, moduleRegistrationID, exr_date, exr_issueAdmit, employeeID', 'safe', 'on'=>'search'),
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
			'exammarks' => array(self::HAS_MANY, 'Exammarks', 'examinationID'),
			'exammarks1' => array(self::HAS_MANY, 'Exammarks', 'moduleRegistrationID'),
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
			'exr_date' => 'Exr Date',
			'exr_issueAdmit' => 'Exr Issue Admit',
			'employeeID' => 'Employee',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
        public function searchExamRegisteredList($batName,$proCode,$traTerm,$traYear)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select=array(
                't.*', 
                //'count(t."tra_finalExamRegistred") as totalRegistered',
                's."stu_academicTerm"',
                's."stu_academicYear"',
                'p."personID"',
                    
                    //'p.*',
                'concat(p.per_title, \' \', p."per_firstName",\' \', p."per_lastName") as per_name',
         
                'p."per_fathersName"',
                'p."per_gender"',
                'p."per_bloodGroup"',
                    
                'p."per_mobile"',
                'p."per_email"',
                    
            );
            
		$criteria->join="JOIN {{o_student}} AS s ON s.\"studentID\" = t.\"studentID\"";
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = s.\"personID\"";
                $criteria->condition="t.tra_term=:traTerm and t.tra_year=:traYear  and t.\"batchName\"=:batName 
                    and t.\"programmeCode\"=:proCode and t.\"tra_finalExamRegistred\"=true ";
                $criteria->params=array(':traTerm'=>$traTerm,':traYear'=>$traYear,':batName'=>$batName,':proCode'=>$proCode);
                //$criteria->group="t.*";
                $criteria->order="\"batchName\", \"sectionName\", \"studentID\" ";
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100,)
		));
	}
        
        
        
       
        public static function searchBatchInTermAdmission($term,$year,$proCode)
        {

           $sql="select distinct \"sectionName\",\"batchName\" from {{q_termadmission}} where tra_term={$term} and tra_year={$year} and \"programmeCode\"='{$proCode}';";
           echo $sql;
           $list= Yii::app()->db->createCommand($sql)->query();

           $rs= array();

            foreach($list as $item){

               $rs[]=$item;

            }   
       
            return $rs;
        }
        
        public static function searchTermAdmittedProgrammeCode($term,$year)
        {
            
            $sql="select distinct \"programmeCode\" from {{q_termAdmission}} as t where t.tra_term ={$term} and t.tra_year={$year};";
           //echo $sql;
            $list= Yii::app()->db->createCommand($sql)->query();

            $rs= array();

             foreach($list as $item){

                $rs[]=$item['programmeCode'];

             }

             return $rs;
       }
       
       public function searchTabulation($examTerm,$examYear,$proCode,$batName,$secName=NULL)
        {
            
            $sql = "SELECT 
                    \"studentID\", 
                    \"moduleCode\",
                     \"mod_name\", 
                    \"per_name\", 
                    \"markFirstHalf\" ,
                    \"markFinal\",
                    \"total\", 
                    \"letterGrade\",
                    \"gradePoint\",
                    \"exm_examTerm\", 
                    \"exm_examYear\"
                  FROM 
                    vw_result_final_exam
                    where \"exm_examTerm\"={$examTerm} and 
                        \"exm_examYear\"={$examYear} and 
                            \"programmeCode\"='{$proCode}' and 
                                \"batchName\"={$batName} ". ($secName?" and \"sectionName\"='{$secName}' ":" ").    
                  "ORDER BY \"moduleCode\" ";
            //echo $sql;
            //$rows = Yii::app()->db->createCommand($sql)->queryAll();
            
            
            return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
      
        
        public function searchResultByOfferedModule($offeredModuleID)
	{
            
            $sql = "SELECT  \"studentID\" as id, 
                    \"studentID\", 
                    \"moduleCode\",
                     \"mod_name\", 
                    \"per_name\", 
                    \"markFirstHalf\" ,
                    \"markFinal\",
                    \"total\", 
                    \"letterGrade\",
                    \"gradePoint\",
                    \"exm_examTerm\", 
                    \"exm_examYear\",
                    \"offeredModuleID\"
                  FROM 
                    vw_result_final_exam
                    where \"offeredModuleID\"={$offeredModuleID} ORDER BY \"moduleCode\" ";
            //echo $sql;
            //$rows = Yii::app()->db->createCommand($sql)->queryAll();
            
            
            return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                  //  'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
}