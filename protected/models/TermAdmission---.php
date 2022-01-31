<?php

/**
 * This is the model class for table "{{q_termadmission}}".
 *
 * The followings are the available columns in table '{{q_termadmission}}':
 * @property integer $termAdmissionID
 * @property string $studentID
 * @property string $sectionName
 * @property integer $batchName
 * @property string $programmeCode
 * @property integer $tra_term
 * @property integer $tra_year
 * @property string $tra_date
 * @property integer $employeeID
 *
 * The followings are the available model relations:
 * @property SModuleregistration[] $sModuleregistrations
 * @property PAdmission $student
 * @property PAdmission $sectionName0
 * @property PAdmission $batchName0
 * @property PAdmission $programmeCode0
 * @property MEmployee $employee
 */
class TermAdmission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TermAdmission the static model class
	 */
        public $studentID;
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
        public $moduleRegistrationID;
        public $tmID;
        public $moduleCode;
        public $mod_name;
        public $fac_name;
        
        public $reg_suppleExamRegDate;
        public $regTermDate;


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
			array('studentID, sectionName, batchName, programmeCode, tra_term, tra_year, tra_date', 'required'),
			array('batchName, tra_term, tra_year, employeeID', 'numerical', 'integerOnly'=>true),
			array('studentID', 'length', 'max'=>15),
			array('sectionName', 'length', 'max'=>1),
			array('programmeCode', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('termAdmissionID, studentID, sectionName, batchName, programmeCode, tra_term, tra_year, tra_date, employeeID', 'safe', 'on'=>'search'),
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
			'sModuleregistrations' => array(self::HAS_MANY, 'SModuleregistration', 'termAdmissionID'),
			'student' => array(self::BELONGS_TO, 'PAdmission', 'studentID'),
			'sectionName0' => array(self::BELONGS_TO, 'PAdmission', 'sectionName'),
			'batchName0' => array(self::BELONGS_TO, 'PAdmission', 'batchName'),
			'programmeCode0' => array(self::BELONGS_TO, 'PAdmission', 'programmeCode'),
			'employee' => array(self::BELONGS_TO, 'MEmployee', 'employeeID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			
			'studentID' => 'Student ID',
			'sectionName' => 'Section',
			'batchName' => 'Batch',
			'programmeCode' => 'Programme Code',
			'tra_term' => 'Term',
			'tra_year' => 'Year',
			'tra_date' => 'Date',
			'employeeID' => 'Employee ID',
                        'per_fathersName' =>'Fathers Name',
                        'per_gender' =>'Gender',
                        'per_bloodGroup' =>'Blood Group',
                        'per_mobile' =>'Mobile',
                        'per_email' =>'Email',
                        'per_name' =>'Name',
                        'tra_finalExamRegDate'=>'Reg Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchAdmittedTerms($studentID, $secName, $batName, $proCode)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                  $criteria->select=array(
                't.*', 
                'concat_ws(\' \',p.per_title,  p."per_firstName", p."per_lastName") as per_name',
             
            );
                  
                $criteria->join.="LEFT JOIN {{j_person}} AS p ON p.\"personID\" = t.\"employeeID\"";
                $criteria->condition='t."studentID"=:studentID and t."programmeCode"=:proCode';
		
                $criteria->params=array('studentID'=>$studentID,':proCode'=>$proCode);
                
                //$criteria->condition='t."studentID"=:studentID and  t."sectionName"=:secName and t."batchName"=:batName and t."programmeCode"=:proCode';
                //$criteria->params=array('studentID'=>$studentID,':secName'=>$secName,':batName'=>$batName,':proCode'=>$proCode);
                $criteria->order="tra_year, tra_term";
                
		$criteria->compare('termAdmissionID',$this->termAdmissionID);
		$criteria->compare('studentID',$this->studentID,true);
		$criteria->compare('sectionName',$this->sectionName,true);
		$criteria->compare('batchName',$this->batchName);
		$criteria->compare('programmeCode',$this->programmeCode,true);
		$criteria->compare('tra_term',$this->tra_term);
		$criteria->compare('tra_year',$this->tra_year);
		$criteria->compare('tra_date',$this->tra_date,true);
		$criteria->compare('employeeID',$this->employeeID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>24,)
		));
	}
        
        public function searchTermsBySection($secName, $batName, $proCode)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select="distinct t.tra_term, t.tra_year, t.\"sectionName\", t.\"batchName\", t.\"programmeCode\" ";
                
                
                
                $criteria->condition='t."sectionName"=:secName and t."batchName"=:batName and t."programmeCode"=:proCode';
                $criteria->params=array(':secName'=>$secName,':batName'=>$batName,':proCode'=>$proCode);
                $criteria->order="tra_year, tra_term";
                
		$criteria->compare('termAdmissionID',$this->termAdmissionID);
		$criteria->compare('studentID',$this->studentID,true);
		$criteria->compare('sectionName',$this->sectionName,true);
		$criteria->compare('batchName',$this->batchName);
		$criteria->compare('programmeCode',$this->programmeCode,true);
		$criteria->compare('tra_term',$this->tra_term);
		$criteria->compare('tra_year',$this->tra_year);
		$criteria->compare('tra_date',$this->tra_date,true);
		$criteria->compare('employeeID',$this->employeeID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchStudentList($traTerm,$traYear,$secName,$batName,$proCode)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select=array(
                't.*', 
                's."stu_academicTerm"',
                's."stu_academicYear"',
                'p."personID"',
                    
                    //'p.*',
                'concat_ws(\' \',p.per_title,  p."per_firstName", p."per_lastName") as per_name',
         
                'p."per_fathersName"',
                'p."per_gender"',
                'p."per_bloodGroup"',
                    
                'p."per_mobile"',
                'p."per_email"',
                    
            );
              
                $criteria->join="JOIN {{o_student}} AS s ON s.\"studentID\" = t.\"studentID\"";
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = s.\"personID\"";
                $criteria->condition="t.tra_term=:traTerm and t.tra_year=:traYear and t.\"programmeCode\"=:proCode and t.\"batchName\"=:batName and t.\"sectionName\"=:secName ";
                $criteria->params=array(':traTerm'=>$traTerm,':traYear'=>$traYear,':proCode'=>$proCode,':batName'=>$batName,':secName'=>$secName);
                $criteria->order="\"studentID\"";
                
	        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100,)
		));
	}
        
        
        public function searchAttStudentList($offeredModuleID)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select=array(
                't.*', 
                's."stu_academicTerm"',
                's."stu_academicYear"',
                'p."personID"',
                    
                    //'p.*',
                'concat(p.per_title, \' \', p."per_firstName", \' \', p."per_lastName") as per_name',
         
                'p."per_fathersName"',
                'p."per_gender"',
                'p."per_bloodGroup"',
                    
                'p."per_mobile"',
                'p."per_email"',
                    
            );
                $criteria->join=" JOIN {{s_moduleregistration}} AS m ON m.\"termAdmissionID\" = t.\"termAdmissionID\"";
                $criteria->join.="JOIN {{o_student}} AS s ON s.\"studentID\" = t.\"studentID\"";
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = s.\"personID\"";
                
                $criteria->condition="m.\"offeredModuleID\"=:offeredModuleID";
                $criteria->params=array(':offeredModuleID'=>$offeredModuleID,);
                $criteria->order="\"studentID\"";
                
	        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100,)
		));
	}
        
        public function search2($secName,$batName,$proCode,$ofmTerm,$ofmYear)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria();
                
               
                
                $criteria->condition='t."sectionName"=:secName and t."batchName"=:batName and t."programmeCode"=\':proCode\' and t.ofm_term=:ofmTerm and t.ofm_Year=:ofmYear';
		
                 $criteria->params=array(':secName'=>$secName,':batName'=>$batName,':proCode'=>$proCode,':ofmTerm'=>$ofmTerm,':ofmYear'=>$ofmYear);
                
                $criteria->compare('termAdmissionID',$this->termAdmissionID);
		$criteria->compare('studentID',$this->studentID,true);
		$criteria->compare('sectionName',$this->sectionName,true);
		$criteria->compare('batchName',$this->batchName);
		$criteria->compare('programmeCode',$this->programmeCode,true);
		$criteria->compare('tra_term',$this->tra_term);
		$criteria->compare('tra_year',$this->tra_year);
		$criteria->compare('tra_date',$this->tra_date,true);
		$criteria->compare('employeeID',$this->employeeID);

                //echo $criteria;
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
    public static function searchTermAdmission($traTerm,$traYear)
    {

       $sql="select  t.\"studentID\" from {{q_termAdmission}} as t, {{f_batch}} as b where t.\"batchName\"=b.\"batchName\" and t.\"programmeCode\"=b.\"programmeCode\" and b.ex_bat_active=true and t.tra_term={$traTerm} and t.tra_year={$traYear}  order by t.\"studentID\"";
   
       $list= Yii::app()->db->createCommand($sql)->query();
 
       $rs= array();
       
        foreach($list as $item){
    
           $rs[]=$item['studentID'];

        }
       
        return $rs;
    }
        
    public function searchExamRegisteredList($proCode,$traTerm,$traYear)
    {
        
        $date= array();
        $date= FormUtil::getDateRangeByTerm($traTerm, $traYear);
        
       // echo $traTerm;
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select=array(
                't.*', 
              
                's."stu_academicTerm"',
                's."stu_academicYear"',
                'p."personID"',
              //      'm."moduleCode"',
                //    'm.mod_name',
              
                    
                    
                    //'p.*',
                'concat(p.per_title, \' \', p."per_firstName", \' \', p."per_lastName") as per_name',
         
                'p."per_fathersName"',
                'p."per_gender"',
                
                    
                'p."per_mobile"',
                'p."per_email"',
                    
            );
              
                $criteria->join="JOIN {{o_student}} AS s ON s.\"studentID\" = t.\"studentID\"";
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = s.\"personID\"";
                
              
                    $criteria->condition="t.tra_term=:traTerm and t.tra_year=:traYear and t.\"programmeCode\"=:proCode and t.\"tra_finalExamRegistred\"=true";
                    $criteria->params=array(':traTerm'=>$traTerm,':traYear'=>$traYear,':proCode'=>$proCode);
              
              
                
      //          $criteria->params=array(':proCode'=>$proCode);
                $criteria->order="\"batchName\", \"sectionName\", \"studentID\" ";
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100,)
		));
	}    
        
    public function searchExamRegisteredSuppleList($proCode,$traTerm,$traYear)
    {
        
        $date= array();
        $date= FormUtil::getDateRangeByTerm($traTerm, $traYear);
        
       // echo $traTerm;
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select=array(
                't.*', 
                    'r."moduleRegistrationID"',
                's."stu_academicTerm"',
                's."stu_academicYear"',
                'p."personID"',
                    'm."moduleCode"',
                    'm.mod_name',
                    'r."reg_suppleExamRegDate"',
                    'concat(r."reg_suppleExamRegDate",\'-\',r."moduleRegistrationID") as "regTermDate"',
                    
                    //'p.*',
                'concat(p.per_title, \' \', p."per_firstName", \' \', p."per_lastName") as per_name',
         
                'p."per_fathersName"',
                'p."per_gender"',
                
                    
                'p."per_mobile"',
                'p."per_email"',
                    
            );
              
                $criteria->join="JOIN {{o_student}} AS s ON s.\"studentID\" = t.\"studentID\"";
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = s.\"personID\"";
                
                
                    $criteria->join.=" JOIN {{s_moduleRegistration}} AS r ON t.\"termAdmissionID\" = r.\"termAdmissionID\"";
                    $criteria->join.=" JOIN {{h_offeredModule}} AS o ON o.\"offeredModuleID\" = r.\"offeredModuleID\"";
                    $criteria->join.=" JOIN {{e_module}} AS m ON o.\"moduleCode\" = m.\"moduleCode\" and o.\"syllabusCode\" = m.\"syllabusCode\" ";
                 /*   $criteria->condition="r.\"reg_suppleExamRegDate\" >= '{$date[0]}' and r.\"reg_suppleExamRegDate\" <='{$date[1]}'  and
                    
                    t.\"programmeCode\"='{$proCode}' and r.\"reg_suppleExamReg\"=true
                    ";*/
                    $criteria->condition=" t.\"programmeCode\"='{$proCode}' and r.\"reg_suppleExamReg\"=true";
                    //$criteria->params=array(':startDate'=>$date[0],':endDate'=>$date[1],':proCode'=>$proCode);
                
                
      //          $criteria->params=array(':proCode'=>$proCode);
                $criteria->order="\"batchName\", \"sectionName\", \"studentID\" ";
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100,)
		));
	}    
}
        
