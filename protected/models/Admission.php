<?php

/**
 * This is the model class for table "{{admission}}".
 *
 * The followings are the available columns in table '{{admission}}':
 * @property string $studentID
 * @property string $sectionName
 * @property integer $batchName
 * @property string $programmeCode
 * @property string $adm_date
 * @property string $adm_status
 * @property integer $adm_creditTransfered
 * @property string $adm_remarks
 * @property integer $employeeID
 *
 * The followings are the available model relations:
 * @property Employee $employee
 * @property Section $sectionName0
 * @property Section $batchName0
 * @property Section $programmeCode0
 * @property Student $student
 * @property Termadmission[] $termadmissions
 * @property Termadmission[] $termadmissions1
 * @property Termadmission[] $termadmissions2
 * @property Termadmission[] $termadmissions3
 */
class Admission extends CActiveRecord 
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admission the static model class
	 */
    
        //public $programmeCode;
        
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
       
        //public $studentID;
 
        public $stu_academicTerm;
        public $stu_academicYear;
 
        public $stu_conditions;
        public $stu_previousID;
        public $stu_previousDegree;
        public $stu_guardiansName;
        public $stu_guardiansAddress;
 
        public $stu_guardiansMobile;
        public $adm_startTerm;
        public $adm_startYear;
        public $adm_expireTerm;
        public $adm_expireYear;
 
        public $employeeID;
        public $waiverID;







        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{p_admission}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
	
            // NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batchName, employeeID, waiverID', 'numerical', 'integerOnly'=>true),
			array('studentID', 'length', 'max'=>15),
			array('sectionName', 'length', 'max'=>2),
			array('programmeCode', 'length', 'max'=>10),
			array('adm_date,', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('studentID, sectionName, batchName, programmeCode,per_bloodGroup,per_email, per_title, per_firstName, per_lastName, adm_date, adm_creditTransfered, adm_remarks, employeeID', 'safe', 'on'=>'search'),
                    
                    
                        array('studentID', 'required'),
                        array('studentID', 'match', 'pattern'=>'/^([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$/',
                        'message'=>'ID has specific format like [111-115-001] .'),
                    
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
			'employee' => array(self::BELONGS_TO, 'Employee', 'employeeID'),
                        'waiver' => array(self::BELONGS_TO, 'Waiver', 'waiverID'),
			'sectionName0' => array(self::BELONGS_TO, 'Section', 'sectionName'),
			'batchName0' => array(self::BELONGS_TO, 'Section', 'batchName'),
			'programmeCode0' => array(self::BELONGS_TO, 'Section', 'programmeCode'),
			'student' => array(self::BELONGS_TO, 'Student', 'studentID'),
			'termadmissions' => array(self::HAS_MANY, 'Termadmission', 'studentId'),
			'termadmissions1' => array(self::HAS_MANY, 'Termadmission', 'sectionName'),
			'termadmissions2' => array(self::HAS_MANY, 'Termadmission', 'batchName'),
			'termadmissions3' => array(self::HAS_MANY, 'Termadmission', 'programmeCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'studentID' => 'Student',
			'sectionName' => 'Section Name',
			'batchName' => 'Batch Name',
			'programmeCode' => 'Programme Code',
			'adm_date' => 'Admission Date',
			
			'adm_creditTransfered' => 'Adm Credit Transfered',
			'adm_remarks' => 'Adm Remarks',
			'employeeID' => 'Employee',
                        'per_title' => 'Title',
                        'per_firstName' => 'First Name',
                        'per_lastName' => 'Last Name',
                        'per_fathersName' => 'Father\'s Name',
                        'per_dateOfBirth'=>'DOB',
                        'per_bloodGroup' => 'Blood Group',
                        'per_mobile' => 'Mobile',
                        'per_name'=>'Name',
                    'per_email' => 'Email',
                    'waiverID'=>'Waiver'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($secName,$batName,$proCode)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select=array(
                't.*', 
                's."stu_guardiansMobile"',
                's."stu_academicTerm"',
                's."stu_academicYear"',
                    'p."personID"',
                    
                    //'p.*',
                    'concat_ws(\' \',p.per_title,\' \',  p."per_firstName",\' \', p."per_lastName") as per_name',
                   // 'p."per_title"',
                    //'p."per_firstName"',
                    //'p."per_lastName"',
                    'p."per_fathersName"',
                    'p."per_gender"',
                    'p."per_bloodGroup"',
                    'p."per_dateOfBirth"',
                    'p."per_mobile"',
                    'p."per_email"',
                    'p."ex_per_image"'
            );
              
                $criteria->join="JOIN {{o_student}} AS s ON s.\"studentID\" = t.\"studentID\"";
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = s.\"personID\"";
                $criteria->condition="t.\"programmeCode\"=:proCode and t.\"batchName\"=:batName and t.\"sectionName\"=:secName and ex_adm_active=true";
                $criteria->params=array(':proCode'=>$proCode,':batName'=>$batName,':secName'=>$secName);
                $criteria->order="\"studentID\"";
                
		$criteria->compare('studentID',$this->studentID,true);
		$criteria->compare('sectionName',$this->sectionName,true);
		$criteria->compare('batchName',$this->batchName);
		$criteria->compare('programmeCode',$this->programmeCode,true);
		$criteria->compare('adm_date',$this->adm_date,true);
		
		$criteria->compare('adm_creditTransfered',$this->adm_creditTransfered);
		$criteria->compare('adm_remarks',$this->adm_remarks,true);
		$criteria->compare('employeeID',$this->employeeID);
                $criteria->compare('per_email',$this->per_email,true);
                $criteria->compare('per_firstName',$this->per_firstName,true);
                $criteria->compare('per_lastName',$this->per_lastName,true);
                $criteria->compare('per_title',$this->per_title,true);
                $criteria->compare('per_bloodGroup',$this->per_bloodGroup,true);
                $criteria->compare('per_mobile',$this->per_mobile,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100,)
		));
	}
        
    public static function searchAdmission($active=1)
    {

       $sql='select t."studentID" from {{p_admission}} as t, {{f_batch}} as b where t."batchName"=b."batchName" and t."programmeCode"=b."programmeCode" and b.ex_bat_active=\''.$active.'\' and t.ex_adm_active=\''.$active.'\' order by t."studentID"';
       $list= Yii::app()->db->createCommand($sql)->query();
 
       $rs= array();
       
        foreach($list as $item){
    
           $rs[]=$item['studentID'];

        }
       
        return $rs;
    }
    public static function searchTermAdmission($id, $term, $year, $active= true)
    {

       //$sql='select t."studentID" from {{p_admission}} as t, {{f_batch}} as b where t."batchName"=b."batchName" and t."programmeCode"=b."programmeCode" and b.ex_bat_active=\''.$active.'\' and t.ex_adm_active=\''.$active.'\' order by t."studentID"';
       $sql ="SELECT t.\"termAdmissionID\" FROM  public.tbl_q_termadmission t, public.tbl_p_admission p WHERE p.\"studentID\" = t.\"studentID\" AND p.\"studentID\" = '{$id}' AND t.tra_term={$term} AND t.tra_year = {$year} AND   p.ex_adm_active = true";
       //$list= Yii::app()->db->createCommand($sql)->query();
       $termAdmission = Yii::app()->db->createCommand($sql)->queryAll();
       $termId = $termAdmission[0]['termAdmissionID'];
      
        return $termId;
    }    
    public static function searchStudent($active=1)
    {

       $sql="SELECT distinct
            s.\"studentID\", 
             concat(p.\"per_firstName\",' ', p.\"per_lastName\") as per_name
          FROM 
            public.tbl_o_student s, 
            public.tbl_j_person p, 
            public.tbl_p_admission a
          WHERE 
            s.\"personID\" = p.\"personID\" AND
            s.\"studentID\" = a.\"studentID\" order by s.\"studentID\" ";
       
       
       $list= Yii::app()->db->createCommand($sql)->query();
 
       $rs= array();
       
        foreach($list as $item){
    
           $rs[]=$item['studentID']." ".$item['per_name'];

        }
       
        return $rs;
    }
    
    public function searchStudentPerformance($sid)
        {
                                  
                $sql = "SELECT v.\"tra_term\", v.\"tra_year\",(sum(v.\"cgpa\")/sum(v.\"mod_creditHour\"))::numeric(10,2) as total
                        FROM public.vw_transcript v
                        WHERE v.\"studentID\" = :sid
                        GROUP BY v.tra_term,v.tra_year
                        ORDER BY v.tra_year,v.tra_term";
                 $command=Yii::app()->db->createCommand($sql);
                 $command->bindParam(':sid',$sid, PDO::PARAM_STR);
                 $result = $command->queryAll();          
            return $result;
        }
    public static function searchAdmissionByDptID($dptID)
    {
       if(yii::app()->user->getState('role')==='faculty' || yii::app()->user->getState('role')==='head')
       {
            $sql='select t."studentID" from {{p_admission}} as t, {{f_batch}} as b, {{c_programme}} as c where t."batchName"=b."batchName" and t."programmeCode"=b."programmeCode" and b.ex_bat_active=\'1\' and t.ex_adm_active=\'1\' and t."programmeCode" = c."programmeCode" and c."departmentID"='.$dptID.' order by t."studentID"';
       }
       else
       {
           $sql='select t."studentID" from {{p_admission}} as t, {{f_batch}} as b, {{c_programme}} as c where t."batchName"=b."batchName" and t."programmeCode"=b."programmeCode" and b.ex_bat_active=\'1\' and t.ex_adm_active=\'1\' and t."programmeCode" = c."programmeCode"  order by t."studentID"';
       }
//echo $sql;
       $list= Yii::app()->db->createCommand($sql)->query();
 
       $rs= array();
       
        foreach($list as $item){
    
           $rs[]=$item['studentID'];

        }
       
        return $rs;
    }    

        
        
        public function loadDetails($id,$secName,$batName,$proCode)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select=array(
                't.*',
                's.*',    
                'p.*',
                'concat(p.per_title," ",  p.per_firstName," ", p.per_lastName) as per_name',
                    
            );
              
                $criteria->join="JOIN {{o_student}} AS s ON s.\"studentID\" = t.\"studentID\"";
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = s.\"personID\"";
                $criteria->condition="t.\"programmeCode\"=:proCode and t.\"batchName\"=:batName and t.\"sectionName\"=:secName and t.\"studentID\"=:studentID";
                $criteria->params=array(':proCode'=>$proCode,':batName'=>$batName,':secName'=>$secName,':studentID'=>$id);

                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100,)
		));
	}
        
    public static function getStudentId($sectionName,$batchName,$programmeCode)
    {
      if($sectionName!=NULL && $batchName!=NULL && $programmeCode!=NULL)
      {
        $sql = " SELECT MAX(CAST(SUBSTRING(a.\"studentID\",9,3) AS integer))+1 AS \"studentID\" ,(b.bat_year-2000) as \"acYear\", s.\"sectionName\", s.\"batchName\", s.\"programmeCode\" , s.\"sec_startId\" ,s.\"sec_endId\", b.bat_term, b.bat_year "
        . " FROM {{p_admission}} as a RIGHT OUTER JOIN {{g_section}} as s ON ( a.\"batchName\"=s.\"batchName\" and a.\"programmeCode\"=s.\"programmeCode\") "
        . " RIGHT OUTER JOIN {{f_batch}} as b "
        . " ON (s.\"batchName\"=b.\"batchName\" and s.\"programmeCode\"=b.\"programmeCode\") "
        . " WHERE s.\"sectionName\"='{$sectionName}' and b.\"batchName\"={$batchName} and b.\"programmeCode\"='{$programmeCode}' and a.adm_status<1
            GROUP BY b.\"programmeCode\",b.bat_term, b.bat_year, s.\"sectionName\", s.\"batchName\", s.\"programmeCode\";"; 
       // echo $sql;
      }
      else
      {
         return NULL;
          
          
      }
        
       $list= Yii::app()->db->createCommand($sql)->query();
    
       if(count($list)<1)
        {
            $sql = " SELECT MAX(CAST(SUBSTRING(a.\"studentID\",9,3) AS integer))+1 AS \"studentID\" ,(b.bat_year-2000) as \"acYear\", s.\"sectionName\", s.\"batchName\", s.\"programmeCode\" , s.\"sec_startId\" ,s.\"sec_endId\", b.bat_term, b.bat_year "
            . " FROM {{p_admission}} as a RIGHT OUTER JOIN {{g_section}} as s ON ( a.\"batchName\"=s.\"batchName\" and a.\"programmeCode\"=s.\"programmeCode\") "
            . " RIGHT OUTER JOIN {{f_batch}} as b "
            . " ON (s.\"batchName\"=b.\"batchName\" and s.\"programmeCode\"=b.\"programmeCode\") "
            . " WHERE s.\"sectionName\"='{$sectionName}' and b.\"batchName\"={$batchName} and b.\"programmeCode\"='{$programmeCode}' 
                GROUP BY b.\"programmeCode\",b.bat_term, b.bat_year, s.\"sectionName\", s.\"batchName\", s.\"programmeCode\";";          
            $list= Yii::app()->db->createCommand($sql)->query();
       }
       
       $rs= array();
       
        foreach($list as $item){
    
           $rs=$item;

        }
        
        $rs['maxIdValue']=$rs['studentID'];
        
        ((!$rs['studentID'])?$id=1:$id=$rs['studentID']);
        
        if($id>=$rs['sec_startId'] && $id <=$rs['sec_endId'])
        {
            
            if($id<10)$id="00".$id;
            elseif($id<100)$id="0".$id;
            
            $rs['acYear']=($rs['acYear']<10 && $rs['acYear']>0 ? '0'.$rs['acYear']:$rs['acYear']);
            
             $id=$rs['acYear'].$rs['bat_term']."-".$rs['programmeCode']."-".$id;
             $rs['studentID']=$id;
             
                if($rs['bat_term']==1)
                {
                    $rs['expireTerm']=3;
                    $rs['expireYear']= $rs['bat_year']+6;
                }
                elseif ($rs['bat_term']==2)
                {
                    $rs['expireTerm']=1;
                    $rs['expireYear']= $rs['bat_year']+7;
                }
                elseif ($rs['bat_term']==3)
                {
                    $rs['expireTerm']=2;
                    $rs['expireYear']= $rs['bat_year']+7;
                }
             
             
             
             return $rs;
        }
        else 
        {
            return null;
        }
    }
    
    public function searchReportAllAdmission($programmeCode,$term,$year)
    {
           
                $sql="SELECT t.\"studentID\" as id, t.*, s.*, p.*, concat_ws(' ',p.per_title, p.\"per_firstName\", p.\"per_lastName\") as per_name FROM {{p_admission}} as t 
                    JOIN {{o_student}} AS s ON (s.\"studentID\" = t.\"studentID\") 
                    JOIN tbl_j_person AS p ON (p.\"personID\" = s.\"personID\")
                    WHERE t.\"programmeCode\"='{$programmeCode}' and s.\"stu_academicTerm\"={$term} and s.\"stu_academicYear\"={$year} 
                    ORDER BY t.\"studentID\" ";
                    
                    $sqlCount="SELECT count(t.\"studentID\")  FROM {{p_admission}} as t 
                    JOIN {{o_student}} AS s ON (s.\"studentID\" = t.\"studentID\") 
                    JOIN tbl_j_person AS p ON (p.\"personID\" = s.\"personID\")
                    WHERE t.\"programmeCode\"='{$programmeCode}' and s.\"stu_academicTerm\"={$term} and s.\"stu_academicYear\"={$year} 
                    GROUP BY t.\"studentID\" ";
		
                    $count=Yii::app()->db->createCommand($sqlCount)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>3000,
                    ),
                ));
	}
       
        
        public function searchAllAdmission($programmeCode,$term,$year)
        {
            $sql = "SELECT
                    *
                  FROM 
                   vw_admission_register
                  WHERE 
                    \"programmeCode\" = '{$programmeCode}' AND
                    \"stu_academicTerm\" = {$term} AND
                    \"stu_academicYear\" = {$year}
                    ";
            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;
        }
        
        public function searchAllAdmissionRegister($term, $year)
        {
                $sql = "SELECT   
                      s.\"studentID\" as id, 
                      concat(p.\"per_firstName\", ' ', p.\"per_lastName\") AS per_name,                       
                      p.per_gender, 
                      p.\"per_dateOfBirth\", 
                      p.\"per_bloodGroup\", 
                      p.\"per_fathersName\", 
                      p.\"per_presentAddress\", 
                      p.per_mobile, 
                      a.adm_date, 
                      w.wav_title, 
                      d.\"pro_shortName\"
                    FROM 
                      public.tbl_p_admission a, public.tbl_ab_waiver w, public.tbl_j_person p,public.tbl_o_student s, public.tbl_c_programme d
                    WHERE 
                      w.\"waiverID\" = a.\"waiverID\" AND p.\"personID\" = s.\"personID\" AND s.\"studentID\" = a.\"studentID\" AND s.\"programmeCode\" = d.\"programmeCode\" AND a.\"adm_startTerm\" = {$term} AND a.\"adm_startYear\" = {$year}";
                $sqlCount ="SELECT   
                      count (s.\"studentID\") as total                     
                    FROM 
                      public.tbl_p_admission a, public.tbl_ab_waiver w, public.tbl_j_person p,public.tbl_o_student s, public.tbl_c_programme d
                    WHERE 
                      w.\"waiverID\" = a.\"waiverID\" AND p.\"personID\" = s.\"personID\" AND s.\"studentID\" = a.\"studentID\" AND s.\"programmeCode\" = d.\"programmeCode\" AND a.\"adm_startTerm\" = {$term} AND a.\"adm_startYear\" = {$year}";
                $count=Yii::app()->db->createCommand($sqlCount)->queryScalar();
                 return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'id', 'a.adm_date',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
        public function freeSearch($keyword)
        {
           
        
            if(FormUtil::isNumeric($keyword))
            {   
           
            if(FormUtil::isID($keyword))
            {
               $sql ="select distinct t.\"personID\" as id,
                t.\"studentID\", 
                 t.\"batchName\", t.\"sectionName\", 
                 concat(t.\"per_firstName\",' ',t.\"per_lastName\") as per_name, 
                 t.\"per_bloodGroup\",t.per_mobile,t.per_email, t.per_gender, 
                 t.\"stu_guardiansMobile\",t.\"stu_academicTerm\" ,t.\"stu_academicYear\", t.\"batchName\", t.\"sectionName\" 
                 from
                (SELECT distinct \"personID\" 


                 FROM tbl_o_student 

                 WHERE 

                 (LOWER(\"studentID\") LIKE LOWER('%{$keyword}%')) ) 
                 as j , vw_admission_register as t
                where
                j.\"personID\" = t.\"personID\"  order by t.\"studentID\"

                ";
               }
               else
               {
               $sql ="select distinct t.\"personID\" as id,
                t.\"studentID\", 
                 t.\"batchName\", t.\"sectionName\", 
                 concat(t.\"per_firstName\",' ',t.\"per_lastName\") as per_name, 
                 t.\"per_bloodGroup\",t.per_mobile,t.per_email, t.per_gender, 
                 t.\"stu_guardiansMobile\",t.\"stu_academicTerm\" ,t.\"stu_academicYear\", t.\"batchName\", t.\"sectionName\" 
                 from
                (SELECT distinct \"personID\" 


                 FROM tbl_j_person 

                 WHERE 

                 (LOWER(\"per_mobile\") LIKE LOWER('%{$keyword}%')) ) 
                 as j , vw_admission_register as t
                where
                j.\"personID\" = t.\"personID\"  order by t.\"studentID\"

                ";
               
           }
       
             
             
                        //  echo $sql;
       }
       else
       {
           
             $sql ="select distinct t.\"personID\" as id,
                t.\"studentID\", 
             t.\"batchName\", t.\"sectionName\", 
             concat(t.\"per_firstName\",' ',t.\"per_lastName\") as per_name, 
             t.\"per_bloodGroup\",t.per_mobile,t.per_email, t.per_gender, 
             t.\"stu_guardiansMobile\",t.\"stu_academicTerm\" ,t.\"stu_academicYear\", t.\"batchName\", t.\"sectionName\" 
             from
            (SELECT distinct \"personID\" 


             FROM tbl_j_person 

             WHERE 

             (LOWER(\"per_firstName\") LIKE LOWER('%{$keyword}%')) 
            OR (LOWER(\"per_lastName\") LIKE LOWER('%{$keyword}%')) 
            OR (LOWER(\"per_bloodGroup\") LIKE LOWER('%{$keyword}%')) 
            OR (LOWER(\"per_fathersName\") LIKE LOWER('%{$keyword}%'))
                OR (LOWER(\"per_mothersName\") LIKE LOWER('%{$keyword}%'))
                    OR (LOWER(\"per_spouseName\") LIKE LOWER('%{$keyword}%'))
                        OR (LOWER(\"per_gender\") LIKE LOWER('%{$keyword}%'))
                            OR (LOWER(\"per_email\") LIKE LOWER('%{$keyword}%'))
                            OR (LOWER(\"per_permanentAddress\") LIKE LOWER('%{$keyword}%'))
            OR (LOWER(\"per_presentAddress\") LIKE LOWER('%{$keyword}%'))) as j , vw_admission_register as t
            where
            j.\"personID\" = t.\"personID\" order by  t.\"studentID\" 

            ";
                     
    
       }
            
            $count=Yii::app()->db->createCommand($sql)->execute();
       
            return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes' => array(
                                            'studentID',
                                            'per_firstName', 
                                            'per_lastName',
                                            'per_bloodGroup'
                                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>100,
                    ),
                ));
    }
      public function eligibleForPromotion($sid, $term, $year)
        {
            $sql = "SELECT * FROM check_promotion('{$sid}',{$term},{$year})";
            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            
            if ($rows[0]["check_promotion"] == 1)
                return true;
            else
                return false;            
        }
       public function searchReportBatchwiseTotalStudent($term,$year)
    {
            $sql ="SELECT 
                  count(tbl_q_termadmission.\"studentID\") as total, 
                  tbl_q_termadmission.\"batchName\", 
                  tbl_q_termadmission.\"sectionName\",   
                  tbl_c_programme.pro_name
                FROM 
                  public.tbl_q_termadmission, 
                  public.tbl_c_programme
                WHERE 
                  tbl_c_programme.\"programmeCode\" = tbl_q_termadmission.\"programmeCode\" AND
                  tbl_q_termadmission.tra_term = {$term} AND 
                  tbl_q_termadmission.tra_year = {$year}
                GROUP BY 
                  tbl_q_termadmission.\"batchName\", 
                  tbl_q_termadmission.\"sectionName\",   
                  tbl_c_programme.pro_name
                  ORDER BY
                  tbl_c_programme.pro_name,
                  tbl_q_termadmission.\"batchName\", 
                  tbl_q_termadmission.\"sectionName\";";
                    
                $count=Yii::app()->db->createCommand($sql)->queryScalar();

            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;  

             /*   return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>3000,
                    ),
                ));*/
	} 
      public function searchOldSyllabusCourse($sid)//,$sectionName,$batchName,$programmeCode)
    {

               $sql ="(SELECT DISTINCT o.\"moduleCode\" FROM  public.tbl_h_offeredmodule o,  
                    public.tbl_e_module m WHERE o.\"moduleCode\" = m.\"moduleCode\" AND  
                o.\"programmeCode\" = '116' AND   o.\"batchName\" = 30 AND o.\"sectionName\"='A'  
                ORDER BY o.\"moduleCode\")
                EXCEPT
                (SELECT o.\"moduleCode\" FROM public.tbl_q_termadmission t, public.tbl_o_student s, 
                public.tbl_s_moduleregistration m, public.tbl_h_offeredmodule o WHERE t.\"termAdmissionID\" = m.\"termAdmissionID\" 
                AND s.\"studentID\" = t.\"studentID\" AND m.\"offeredModuleID\" = o.\"offeredModuleID\" AND  
                s.\"studentID\" = '131-116-050'  ORDER BY o.\"moduleCode\");";        
                              
            $count=Yii::app()->db->createCommand($sql)->execute();
            //echo $count;exit();
            return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes' => array(
                                            'moduleCode'                                           
                                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>100,
                    ),
                ));
                              
	}
}