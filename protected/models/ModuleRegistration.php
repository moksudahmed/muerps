<?php

/**
 * This is the model class for table "{{s_moduleregistration}}".
 *
 * The followings are the available columns in table '{{s_moduleregistration}}':
 * @property integer $moduleRegistrationID
 * @property integer $termAdmissionID
 * @property integer $offeredModuleID
 * @property string $reg_date
 * @property string $reg_type
 * @property double $reg_attendence
 * @property double $reg_classTest
 * @property double $reg_midterm
 * @property integer $markingSchemeID
 *
 * The followings are the available model relations:
 * @property TExamination[] $tblTExaminations
 * @property RMarkingscheme $markingScheme
 * @property HOfferedmodule $offeredModule
 * @property QTermadmission $termAdmission
 */
class ModuleRegistration extends CActiveRecord
{
        public $studentID;
        public $per_name;
        public $syllabusCode;
        public $reg_type;
        public $reg_classtest;
        public $moduleCode;
        public $mod_name;
        public $mod_creditHour;
        public $mod_type;
	public $mod_labIncluded;
        public $mod_group;
        public $mod_prerequisite;
        public $creditHourByTerm;
        public $ofm_year;
        public $ofm_term;
        public $tra_year;
        public $tra_term;
        public $pass;
        public $ofmBatch;
        public $ofmSection;
        public $traBatch;
        public $traSection;
        
        public $total;
        
        public $final;
        public $final2;
        public $subTotal;
        public $grandTotal;
        public $absent;
        public $programmeCode;
        public $emr_date;
        public $batchName;
        public $sectionName;

        public $reg_status;
        public $fee_amount;
        public $emr_mark;
        public $markFirstHalf;
        public $retakeLetterGrade;
        public $ofm_maxCapacity;
        public $capacityLeft;

        public $letterGrade;
        public $gradePoint;
        public $cgpa;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ModuleRegistration the static model class
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
		return '{{s_moduleregistration}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('termAdmissionID, offeredModuleID, reg_date, markingSchemeID', 'required'),
			array('termAdmissionID, offeredModuleID, markingSchemeID', 'numerical', 'integerOnly'=>true),
			array('reg_attendence, reg_classTest, reg_midterm', 'numerical'),
			array('reg_type', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('programmeCode,moduleRegistrationID, termAdmissionID, offeredModuleID, reg_date, reg_type, reg_attendence, reg_classTest, reg_midterm, markingSchemeID', 'safe', 'on'=>'search'),
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
			'tblTExaminations' => array(self::MANY_MANY, 'TExamination', '{{u_examregistration}}(moduleRegistrationID, examinationID)'),
			'markingScheme' => array(self::BELONGS_TO, 'RMarkingscheme', 'markingSchemeID'),
			'offeredModule' => array(self::BELONGS_TO, 'HOfferedmodule', 'offeredModuleID'),
			'termAdmission' => array(self::BELONGS_TO, 'QTermadmission', 'termAdmissionID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'moduleRegistrationID' => 'Module Registration',
			'termAdmissionID' => 'Term Admission',
			'offeredModuleID' => 'Offered Module',
			'reg_date' => 'Reg Date',
			'reg_type' => 'Reg Type',
			'reg_attendence' => 'Reg Attendence',
			'reg_classTest' => 'Reg Class Test',
			'reg_midterm' => 'Reg Midterm',
			'markingSchemeID' => 'Marking Scheme',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($studentID, $proCode)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                $criteria=new CDbCriteria;
                
                $criteria->select="t.*, a.\"batchName\" as \"traBatch\" ,a.\"sectionName\" as \"traSection\", m.*, a.*, o.\"batchName\" as \"ofmBatch\",o.\"sectionName\" as \"ofmSection\"";
                //$criteria->join="termAdmission as a, offeredModule as o, module as m ";

                
                
                $criteria->join=" JOIN {{h_offeredModule}} AS o ON o.\"offeredModuleID\" = t.\"offeredModuleID\"";
                $criteria->join.=" JOIN {{e_module}} AS m ON m.\"moduleCode\" = o.\"moduleCode\" and m.\"syllabusCode\"=o.\"syllabusCode\" ";
                $criteria->join.="JOIN {{q_termAdmission}} AS a ON a.\"termAdmissionID\" = t.\"termAdmissionID\"";
                
                
                
                $criteria->condition="a.\"studentID\"='{$studentID}' and a.\"programmeCode\"='{$proCode}'";
                
                $criteria->order='tra_year, tra_term, "batchName", "sectionName"';
                
                
                

                //print_r($criteria);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
		));
	}
        
        public function  searchByTermAdmissionID($termAdmissionID)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                $criteria=new CDbCriteria;
                
//                $criteria->select="t.* , m.*, a.*, o.\"batchName\" as \"ofmBatch\",o.\"sectionName\" as \"ofmSection\"";
                
                $criteria->select="t.*, a.\"batchName\" as \"traBatch\" ,a.\"sectionName\" as \"traSection\", m.*, a.*,o.ofm_term,o.ofm_year,  o.\"batchName\" as \"ofmBatch\",o.\"sectionName\" as \"ofmSection\"";
//$criteria->join="termAdmission as a, offeredModule as o, module as m ";

                
                
                $criteria->join=" JOIN {{h_offeredModule}} AS o ON o.\"offeredModuleID\" = t.\"offeredModuleID\"";
                $criteria->join.=" JOIN {{e_module}} AS m ON m.\"moduleCode\" = o.\"moduleCode\" and m.\"syllabusCode\"=o.\"syllabusCode\" ";
                $criteria->join.="JOIN {{q_termAdmission}} AS a ON a.\"termAdmissionID\" = t.\"termAdmissionID\"";
                
                
                
                $criteria->condition="a.\"termAdmissionID\"='{$termAdmissionID}' ";
                
                $criteria->order='tra_year, tra_term';
                
                
               
                //print_r($criteria);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
		));
	}
        
        public static function searchNotRegistred($studentID,$secName,$batName,$proCode,$ofmTerm,$ofmYear)
	{
                    
                     $sql = "SELECT DISTINCT s.*, s.\"offeredModuleID\" as ID FROM (Select * from tbl_h_offeredmodule as o join tbl_e_module as m on(o.\"moduleCode\"=m.\"moduleCode\" and o.\"syllabusCode\"=m.\"syllabusCode\") where  \"sectionName\"='{$secName}' and \"batchName\"={$batName} and  \"programmeCode\"='{$proCode}' and ofm_term={$ofmTerm} and ofm_year={$ofmYear} ) as s 
                     WHERE (\"offeredModuleID\") NOT IN
                    (SELECT \"offeredModuleID\" FROM tbl_s_moduleregistration as r join tbl_q_termadmission as t on (r.\"termAdmissionID\"=t.\"termAdmissionID\") where t.\"studentID\"='{$studentID}') order by mod_group, mod_sequence";
               
                $count=Yii::app()->db->createCommand($sql)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
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
        
        public static function searchNotRegistredWithoutTerm($studentID,$sylCode)
	{
                    
                    
                     $sqlCount = "SELECT DISTINCT s.*, s.\"moduleCode\" as ID FROM (Select o.\"moduleCode\", m.mod_name, m.\"mod_creditHour\", m.mod_group, m.mod_sequence from tbl_h_offeredmodule as o join tbl_e_module as m 
on(o.\"moduleCode\"=m.\"moduleCode\" and o.\"syllabusCode\"=m.\"syllabusCode\") 
where m.\"syllabusCode\"='{$sylCode}' ) as s
WHERE (\"moduleCode\") NOT IN
(SELECT o.\"moduleCode\" FROM tbl_s_moduleregistration as r join tbl_q_termadmission as t on (r.\"termAdmissionID\"=t.\"termAdmissionID\") 
join tbl_h_offeredmodule as o on (o.\"offeredModuleID\" = r.\"offeredModuleID\")
where t.\"studentID\"='{$studentID}') order by s.mod_group, s.mod_sequence LIMIT 300 ;

";
               
                    
                     $sql = "SELECT DISTINCT s.*, s.\"moduleCode\" as ID FROM (Select o.\"moduleCode\", m.mod_name, m.\"mod_creditHour\", m.mod_group, m.mod_sequence from tbl_h_offeredmodule as o join tbl_e_module as m 
on(o.\"moduleCode\"=m.\"moduleCode\" and o.\"syllabusCode\"=m.\"syllabusCode\") 
where m.\"syllabusCode\"='{$sylCode}' ) as s
WHERE (\"moduleCode\") NOT IN
(SELECT o.\"moduleCode\" FROM tbl_s_moduleregistration as r join tbl_q_termadmission as t on (r.\"termAdmissionID\"=t.\"termAdmissionID\") 
join tbl_h_offeredmodule as o on (o.\"offeredModuleID\" = r.\"offeredModuleID\")
where t.\"studentID\"='{$studentID}') order by s.mod_group, s.mod_sequence LIMIT 300 ;

";
               
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
                        'pageSize'=>300,
                    ),
                ));
        }
        
        public static function searchRetake($studentID, $termAdmissionID)
	{
                    
               
            
            $sqlCount ="
select max(r.\"moduleRegistrationID\"), count(r.reg_attendence) from tbl_s_moduleregistration as r
   join tbl_r_markingScheme as k on(r.\"markingSchemeID\"=k.\"markingSchemeID\")
   join tbl_q_termadmission as q on (q.\"termAdmissionID\"=r.\"termAdmissionID\")
   join tbl_h_offeredmodule as o on (o.\"offeredModuleID\"=r.\"offeredModuleID\")
    where ((r.reg_attendence + r.\"reg_classTest\"+ r.\"reg_midterm\")
     < (k.\"mrs_attendancePass\" + k.\"mrs_classTestPass\"+ k.\"mrs_midtermPass\"))
and q.\"studentID\"='{$studentID}' and q.\"termAdmissionID\" <>{$termAdmissionID}
      group by  r.reg_attendence, r.\"reg_classTest\", r.reg_midterm, o.\"moduleCode\"";
            
$sql=
"select r.\"moduleRegistrationID\", q.\"studentID\" as id, q.\"studentID\", r.reg_attendence, r.\"reg_classTest\", r.reg_midterm
    , e.\"moduleCode\",e.\"syllabusCode\", e.mod_group, e.\"mod_name\", e.\"mod_labIncluded\", e.mod_type, q.tra_term, q.tra_year, o.ofm_term, o.ofm_year, o.\"batchName\", o.\"sectionName\",
     e.mod_prerequisite, e.\"mod_creditHour\" ,r.reg_type, r.reg_status, reg_date
    from tbl_s_moduleregistration as r
   join tbl_r_markingScheme as k on(r.\"markingSchemeID\"=k.\"markingSchemeID\")
   join tbl_q_termadmission as q on (q.\"termAdmissionID\"=r.\"termAdmissionID\")
   join tbl_h_offeredmodule as o on (o.\"offeredModuleID\"=r.\"offeredModuleID\")
   join tbl_e_module as e on (o.\"moduleCode\"=e.\"moduleCode\" and o.\"syllabusCode\"=e.\"syllabusCode\")
    where ((r.reg_attendence + r.\"reg_classTest\"+ r.\"reg_midterm\")
     < (k.\"mrs_attendancePass\" + k.\"mrs_classTestPass\"+ k.\"mrs_midtermPass\")  )
and q.\"studentID\"='{$studentID}' and q.\"termAdmissionID\" <>{$termAdmissionID}  
      group by r.\"moduleRegistrationID\", r.reg_attendence, r.\"reg_classTest\", r.reg_midterm, e.\"moduleCode\"
      ,e.mod_group, e.\"mod_name\", e.\"mod_labIncluded\", e.mod_type, q.tra_term, q.tra_year, o.ofm_term, o.ofm_year  , e.mod_prerequisite, o.\"batchName\", o.\"sectionName\"
,e.\"syllabusCode\", q.\"studentID\", e.\"mod_creditHour\" ,r.reg_type, r.reg_status, reg_date order by r.reg_status";

     //              echo $sql; 
                $count=Yii::app()->db->createCommand($sqlCount)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     /*'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),*/
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
        
        public static function searchRetakeNew($studentID, $termAdmissionID,$marksBarear = 60)
	{
                    
               
           /* 
            $sqlCount ="SELECT  t.\"moduleRegistrationID\" as id,t.*
                      FROM vw_transcript as t
                      join tbl_r_markingScheme as k on(t.\"markingSchemeID\"=k.\"markingSchemeID\")
                      where t.\"studentID\"= '{$studentID}' 
			and t.\"termAdmissionID\" <>{$termAdmissionID}
                       and t.\"markFirstHalf\"< (k.\"mrs_attendancePass\" + k.\"mrs_classTestPass\"+ k.\"mrs_midtermPass\")";
            
                $sql="SELECT  t.\"moduleRegistrationID\" as id, t.*
                      FROM vw_transcript as t
                      join tbl_r_markingScheme as k on(t.\"markingSchemeID\"=k.\"markingSchemeID\")
                      where t.\"studentID\"= '{$studentID}' 
			and t.\"termAdmissionID\" <>{$termAdmissionID}
                       and t.\"markFirstHalf\"< (k.\"mrs_attendancePass\" + k.\"mrs_classTestPass\"+ k.\"mrs_midtermPass\")";
                       */
            
            $sqlCount="SELECT  t.\"moduleRegistrationID\" as id, t.* 
                      FROM vw_transcript as t
                      where t.\"studentID\"= '{$studentID}' and t.\"termAdmissionID\" <>{$termAdmissionID}  and (\"markFirstHalf\"+emr_mark) <{$marksBarear}";
                      
                      $sql="SELECT  t.\"moduleRegistrationID\" as id, t.* 
                      FROM vw_transcript as t
                      where t.\"studentID\"= '{$studentID}' and t.\"termAdmissionID\" <>{$termAdmissionID}  and (\"markFirstHalf\"+emr_mark) <{$marksBarear}";
     //              echo $sql; 
                $count=Yii::app()->db->createCommand($sqlCount)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     /*'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),*/
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
        public static function flagPrerequisite($moduleCode, $syllabusCode, $studentID = null)
        {
      
            $flag=false;
            $sql="select distinct s.\"moduleRegistrationID\", r.\"offeredModuleID\", ((r.reg_attendence + r.\"reg_classTest\"+ r.\"reg_midterm\") - (k.\"mrs_attendancePass\" + k.\"mrs_classTestPass\"+ k.\"mrs_midtermPass\")) as pass from(
                select  max(m.\"moduleRegistrationID\") as \"moduleRegistrationID\" from tbl_s_moduleregistration as m , tbl_h_offeredmodule as o,  tbl_q_termadmission as t 
                where m.\"offeredModuleID\"=o.\"offeredModuleID\" and t.\"termAdmissionID\"=m.\"termAdmissionID\" and t.\"studentID\"=:studentID and o.\"moduleCode\"=:moduleCode and o.\"syllabusCode\"=:syllabusCode
                    group by o.\"moduleCode\",  o.\"syllabusCode\" 
                ) as s join tbl_s_moduleregistration as r on (s.\"moduleRegistrationID\"=r.\"moduleRegistrationID\")
                join tbl_r_markingScheme as k  on(r.\"markingSchemeID\"=k.\"markingSchemeID\");";
            
// echo $sql;
// exit();
          $data = ModuleRegistration::model()->findBySql($sql, array(':studentID'=>$studentID,':moduleCode'=>$moduleCode,':syllabusCode'=>$syllabusCode));
 
          //  $flag =$data->pass;   
          if($data['pass']<0)
          {
              $flag = 'none';
          }
        
          return $flag;
        }
        
        
        public static function flagRetake($moduleCode, $syllabusCode, $studentID = null)
        {
      
            $flag=false;
            $sql="select distinct s.\"moduleRegistrationID\", r.\"offeredModuleID\"  from(
                select  max(m.\"moduleRegistrationID\") as \"moduleRegistrationID\" from tbl_s_moduleregistration as m , tbl_h_offeredmodule as o,  tbl_q_termadmission as t 
                where m.\"offeredModuleID\"=o.\"offeredModuleID\" and t.\"termAdmissionID\"=m.\"termAdmissionID\" and t.\"studentID\"=:studentID and o.\"moduleCode\"=:moduleCode and o.\"syllabusCode\"=:syllabusCode
                    group by o.\"moduleCode\",  o.\"syllabusCode\",  m.\"moduleRegistrationID\" having m.reg_date= max(m.reg_date) 
                ) as s join tbl_s_moduleregistration as r on (s.\"moduleRegistrationID\"=r.\"moduleRegistrationID\")
                join tbl_r_markingScheme as k  on(r.\"markingSchemeID\"=k.\"markingSchemeID\");";
           // echo $studentID;            exit();
            echo $sql;
          if(!$data = ModuleRegistration::model()->findAllBySql($sql, array(':studentID'=>$studentID,':moduleCode'=>$moduleCode,':syllabusCode'=>$syllabusCode)))
          {   $flag =false;   }
          else{
                if($data[0]->moduleRegistrationID)
                {
                    $flag = true;
                }
                else{
                    $flag=false;
                }
          }
          return $flag;
        }
        
        public static function flagRetakeByOfmIDStudentID($studentID = null,$ofmID)
        {
            $sql="SELECT 
                s.\"moduleRegistrationID\"
              FROM 
                public.tbl_s_moduleregistration s, 
                public.tbl_h_offeredmodule h, 
                public.tbl_h_offeredmodule o, 
                public.tbl_q_termadmission q
              WHERE 
                s.\"offeredModuleID\" = h.\"offeredModuleID\" AND
                h.\"moduleCode\" = o.\"moduleCode\" AND
                h.\"syllabusCode\" = o.\"syllabusCode\" AND
                q.\"termAdmissionID\" = s.\"termAdmissionID\" AND
                o.\"offeredModuleID\" =  :ofmID AND 
                q.\"studentID\" = :stuID
              ";
            
            return (count( ModuleRegistration::model()->findAllBySql($sql, array(':stuID'=>$studentID,':ofmID'=>$ofmID)))>1?true:false);
        }
        
        public static function flagRetakeByOfmID( $studentID = null,$ofmID)
        {
            $sql= "SELECT sp_retakeflag(:stuID,:ofmID) as \"moduleRegistrationID\"";
 
            return ModuleRegistration::model()->findBySql($sql, array(':stuID'=>$studentID,':ofmID'=>$ofmID))->moduleRegistrationID;
         
        }
        
    public static function searchOfferedModule($studentID,$traTerm,$traYear,$programmeCode)
    {
        
       //$sql="select t.\"offeredModuleID\", t.\"moduleCode\", t.\"sectionName\", t.\"batchName\",  m.\"mod_name\" from {{h_offeredmodule}} as t, {{e_module}} as m where t.\"moduleCode\"=m.\"moduleCode\" and t.\"syllabusCode\"=m.\"syllabusCode\" and t.\"ofm_term\"={$traTerm} and t.\"ofm_year\"={$traYear}  and t.\"programmeCode\"='{$programmeCode}';";
       //echo $sql;
        
       $sql="SELECT DISTINCT s.* FROM 
        (Select * from tbl_h_offeredmodule as o join tbl_e_module as m on(o.\"moduleCode\"=m.\"moduleCode\" and o.\"syllabusCode\"=m.\"syllabusCode\") where    o.\"programmeCode\"='{$programmeCode}' and o.ofm_term={$traTerm} and o.ofm_year={$traYear} ) as s 
        WHERE (\"offeredModuleID\") NOT IN
        (SELECT \"offeredModuleID\" FROM tbl_s_moduleregistration as r join tbl_q_termadmission as t on (r.\"termAdmissionID\"=t.\"termAdmissionID\") where t.\"studentID\"='{$studentID}' and t.tra_term={$traTerm} and t.tra_year={$traYear}) order by mod_group, mod_sequence;"; 
        //echo $sql;
       $list= Yii::app()->db->createCommand($sql)->query();
 
       $rs= array();
       
        foreach($list as $item){
            yii::app()->session['syllabusCode']=$item['syllabusCode'];
           $rs[]=$item['moduleCode'].": ".$item['mod_name'].", Section: ".$item['sectionName'].", Batch: ".$item['batchName'].FormUtil::getBatchNameSufix($item['batchName']).", ".$item['offeredModuleID'];

        }
       
        return $rs;
    }
    
    
    public static function searchNotRegistredForAdvise($studentID,$proCode,$ofmTerm,$ofmYear,$sylCode,$termAdmissionID,$marksBarear=50)
    {
                    
   //, sp_retakeflaglg('{$studentID}',s.\"offeredModuleID\") as \"retakeLetterGrade\"       
        //and m.\"syllabusCode\"='{$sylCode}'
          
               
               $sql= "SELECT DISTINCT s.*,sp_ofmcapacityleft(s.\"offeredModuleID\") as \"capacityLeft\", sp_retakeflaglg('{$studentID}',s.\"offeredModuleID\") as \"retakeLetterGrade\",  s.\"offeredModuleID\"  as id FROM
                    (
                    select distinct w.* from
                    (
                        Select distinct o.\"offeredModuleID\",o.\"programmeCode\", o.\"batchName\", o.\"sectionName\", o.\"ofm_term\", o.\"ofm_year\",o.\"ofm_maxCapacity\", m.* from tbl_h_offeredmodule as o join tbl_e_module as m
                        on(o.\"moduleCode\"=m.\"moduleCode\" and o.\"syllabusCode\"=m.\"syllabusCode\" )
                        where \"programmeCode\"='{$proCode}' and ofm_term={$ofmTerm} and ofm_year={$ofmYear}
                    ) as w
                    where (w.\"moduleCode\") NOT IN 
                    (
                        Select distinct  o.\"moduleCode\" from 
                        tbl_h_offeredmodule as o 
                        join tbl_e_module as m on(o.\"moduleCode\"=m.\"moduleCode\" and o.\"syllabusCode\"=m.\"syllabusCode\" )
                        join tbl_s_moduleRegistration as r on (o.\"offeredModuleID\"=r.\"offeredModuleID\")
                        where  r.\"termAdmissionID\"={$termAdmissionID}
                    )

                    ) as s
                    WHERE (\"moduleCode\")
                    NOT IN
                    ( 
                    SELECT  \"moduleCode\"
                      FROM vw_transcript 
                      where \"studentID\"= '{$studentID}'  and (\"markFirstHalf\"+emr_mark) >{$marksBarear}

                  ) order by \"batchName\" desc,\"sectionName\", mod_group, mod_sequence  
        ";
                    
              //echo $sql;
               $count=Yii::app()->db->createCommand($sql)->queryScalar();

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>$count,
                    ),
                ));
        }
    
    public static function searchExamptionModules($studentID,$proCode,$ofmTerm,$ofmYear,$sylCode,$termAdmissionID,$marksBarear=50)
    {
                    
   //, sp_retakeflaglg('{$studentID}',s.\"offeredModuleID\") as \"retakeLetterGrade\"       
        //and m.\"syllabusCode\"='{$sylCode}'
          
               
               $sql= "SELECT DISTINCT s.*,sp_ofmcapacityleft(s.\"offeredModuleID\") as \"capacityLeft\", sp_retakeflaglg('{$studentID}',s.\"offeredModuleID\") as \"retakeLetterGrade\",  s.\"offeredModuleID\"  as id FROM
                    (
                    select distinct w.* from
                    (
                        Select distinct o.\"offeredModuleID\",o.\"programmeCode\", o.\"batchName\", o.\"sectionName\", o.\"ofm_term\", o.\"ofm_year\",o.\"ofm_maxCapacity\", m.* from tbl_h_offeredmodule as o join tbl_e_module as m
                        on(o.\"moduleCode\"=m.\"moduleCode\" and o.\"syllabusCode\"=m.\"syllabusCode\" )
                        where \"programmeCode\"='{$proCode}' 
                    ) as w
                    where (w.\"moduleCode\") NOT IN 
                    (
                        Select distinct  o.\"moduleCode\" from 
                        tbl_h_offeredmodule as o 
                        join tbl_e_module as m on(o.\"moduleCode\"=m.\"moduleCode\" and o.\"syllabusCode\"=m.\"syllabusCode\" )
                        join tbl_s_moduleRegistration as r on (o.\"offeredModuleID\"=r.\"offeredModuleID\")
                        where  r.\"termAdmissionID\"={$termAdmissionID}
                    )

                    ) as s
                    WHERE (\"moduleCode\")
                    NOT IN
                    ( 
                    SELECT  \"moduleCode\"
                      FROM vw_transcript 
                      where \"studentID\"= '{$studentID}'  and (\"markFirstHalf\"+emr_mark) >{$marksBarear}

                  ) order by \"batchName\" desc,\"sectionName\", mod_group, mod_sequence  
        ";
                    
             //echo  $sql;exit();
               $count=30000;// Yii::app()->db->createCommand($sql)->queryScalar();
              // echo $count; exit();
                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>$count,
                    ),
                ));
        }
        public static function searchNotRegistredForAdviseSpecial($studentID,$proCode,$ofmTerm,$ofmYear,$sylCode,$termAdmissionID,$marksBarear=50)
        {
                    
   //, sp_retakeflaglg('{$studentID}',s.\"offeredModuleID\") as \"retakeLetterGrade\"       
        //and m.\"syllabusCode\"='{$sylCode}'
          
               
               $sql= "select w.* from
                (
                    select s.* from
                    (
                            SELECT *
                            FROM vw_transcript 
                            where \"studentID\"= '{$studentID}' and (\"markFirstHalf\"+emr_mark) <40
                            ) as s where (\"moduleCode\") not in
                    (
                    Select distinct \"moduleCode\" from tbl_h_offeredmodule o 
                    where \"programmeCode\"='{$proCode}' and ofm_term={$ofmTerm} and ofm_year={$ofmYear}
                    )
            ) as w
            where (w.\"moduleCode\") NOT IN 
            (
            Select distinct o.\"moduleCode\" from 
            tbl_h_offeredmodule as o 
            join tbl_e_module as m on(o.\"moduleCode\"=m.\"moduleCode\" and o.\"syllabusCode\"=m.\"syllabusCode\" )
            join tbl_s_moduleRegistration as r on (o.\"offeredModuleID\"=r.\"offeredModuleID\")
            where r.\"termAdmissionID\"={$termAdmissionID}
            ) order by w.\"moduleCode\"
        ";
           
                    
              //echo $sql;
              $data = ModuleRegistration::model()->findAllBySql($sql);
              
            
                   
                    foreach ($data as $item) {

        
                     $newData[$item['moduleRegistrationID'].'-'.$item['offeredModuleID']]= $item['moduleCode'].': '.$item['mod_name'];   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     
                    }
                
            
            
               
            return $d=$newData;
               //return $data[0];
        }
        
        public static function searchSuppleCourseByStudentID($studentID,$examinationID,$examType=2,$ofmTerm,$ofmYear)
	{
                    
            if($examType==2)
            {
                $sql ="select distinct w.* from
                (    
                    SELECT distinct t.\"moduleRegistrationID\" as id, \"moduleRegistrationID\", 
                        t.*
                    FROM \"vw_getSupplementary\" as t where t.\"studentID\"='{$studentID}' 


                ) as w
                where (w.\"moduleCode\") NOT IN 
                (
                        SELECT distinct \"moduleCode\" 
                  FROM vw_transcript where \"studentID\"='{$studentID}' and  \"examinationID\"={$examinationID}
                ) order by w.\"exm_examYear\", w.\"exm_examTerm\" ";
            }
            elseif($examType==3)
            {
                $sql ="select distinct w.* from
                (    
                    SELECT distinct t.\"moduleRegistrationID\" as id, \"moduleRegistrationID\", 
                        t.*
                    FROM \"vw_getSupplementary\" as t,
			tbl_h_offeredmodule as h where
                        h.\"moduleCode\" = t.\"moduleCode\"
                        and h.ofm_term ={$ofmTerm} 
                        and h.ofm_year ={$ofmYear}
                        and t.\"studentID\"='{$studentID}' 
                        
                ) as w
                where (w.\"moduleCode\") NOT IN 
                (
                        SELECT distinct \"moduleCode\" 
                  FROM vw_transcript where \"studentID\"='{$studentID}' and  \"examinationID\"={$examinationID}
                ) order by w.\"exm_examYear\", w.\"exm_examTerm\" ";
                
            }
            
                 //  echo $sql; exit();
                $count=Yii::app()->db->createCommand($sql)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     /*'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),*/
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
        public static function searchSuppleRegCourseByStudentID($studentID,$examinationID)
	{
                    
               
            $sql ="SELECT distinct \"moduleRegistrationID\" as id, *
              FROM vw_transcript where \"studentID\"='{$studentID}' and  \"examinationID\"={$examinationID}
            ";
            
            
                   //echo $sql; 
                $count=Yii::app()->db->createCommand($sql)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     /*'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),*/
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
        public static function searchNotRegisteredStudentToIndCourse($ofmID)
	{
                    
                    
                     $sqlCount = "select 
                        b.\"termAdmissionID\" as id,
                        b.\"studentID\",
                        pg_catalog.concat(j.per_title, ' ', j.\"per_firstName\", ' ', j.\"per_lastName\") AS per_name,
                        j.per_mobile,
                        j.per_email,
                        b.tra_date
                         from ((SELECT 
                          q.\"termAdmissionID\"

                        FROM 
                          public.tbl_q_termadmission q, public.tbl_h_offeredmodule h
                        WHERE 
                          q.tra_term = h.ofm_term  AND 
                          q.tra_year = h.ofm_year and
                          q.\"sectionName\"= h.\"sectionName\" and  
                          q.\"batchName\"= h.\"batchName\" and 
                          q.\"programmeCode\"= h.\"programmeCode\"  and h.\"offeredModuleID\"= $ofmID)
                        except
                          (SELECT 
                          s.\"termAdmissionID\" 

                        FROM 
                          tbl_s_moduleregistration s where s.\"offeredModuleID\"=$ofmID)) as a , tbl_o_student as o, 
                          tbl_q_termadmission as b, tbl_j_person as j 
                          where a.\"termAdmissionID\"= b.\"termAdmissionID\" and b.\"studentID\" = o.\"studentID\" 
                          and j.\"personID\"= o.\"personID\"";
               
                    
                     $sql = "select 
                            b.\"termAdmissionID\" as id,
                            b.\"studentID\",
                            pg_catalog.concat(j.per_title, ' ', j.\"per_firstName\", ' ', j.\"per_lastName\") AS per_name,
                            j.per_mobile,
                            j.per_email,
                            b.tra_date
                             from ((SELECT 
                              q.\"termAdmissionID\"

                            FROM 
                              public.tbl_q_termadmission q, public.tbl_h_offeredmodule h
                            WHERE 
                              q.tra_term = h.ofm_term  AND 
                              q.tra_year = h.ofm_year and
                              q.\"sectionName\"= h.\"sectionName\" and  
                              q.\"batchName\"= h.\"batchName\" and 
                              q.\"programmeCode\"= h.\"programmeCode\"  and h.\"offeredModuleID\"= $ofmID)
                            except
                              (SELECT 
                              s.\"termAdmissionID\" 

                            FROM 
                              tbl_s_moduleregistration s where s.\"offeredModuleID\"=$ofmID)) as a , tbl_o_student as o, 
                              tbl_q_termadmission as b, tbl_j_person as j 
                              where a.\"termAdmissionID\"= b.\"termAdmissionID\" and b.\"studentID\" = o.\"studentID\" 
                              and j.\"personID\"= o.\"personID\" order by b.\"studentID\"";
               
                $count=Yii::app()->db->createCommand($sqlCount)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
        public static function searchRegisteredStudentToIndCourse($ofmID)
	{
                    
                    
                     $sqlCount = "SELECT s.\"moduleRegistrationID\" as id,
                        pg_catalog.concat(j.per_title, ' ', j.\"per_firstName\", ' ', j.\"per_lastName\") AS per_name,
                          j.per_mobile, 
                          j.per_email, 
                          q.\"studentID\", 
                          q.tra_date


                        FROM 
                          public.tbl_s_moduleregistration s, 
                          public.tbl_q_termadmission q, 
                          public.tbl_o_student o, 
                          public.tbl_j_person j
                        WHERE 
                          s.\"termAdmissionID\" = q.\"termAdmissionID\" AND
                          o.\"personID\" = j.\"personID\" AND
                          o.\"studentID\" = q.\"studentID\" and s.\"offeredModuleID\"=$ofmID";
               
                    
                     $sql = "SELECT s.\"moduleRegistrationID\" as id,
                        pg_catalog.concat(j.per_title, ' ', j.\"per_firstName\", ' ', j.\"per_lastName\") AS per_name,
                          j.per_mobile, 
                          j.per_email, 
                          q.\"studentID\", 
                          q.tra_date


                        FROM 
                          public.tbl_s_moduleregistration s, 
                          public.tbl_q_termadmission q, 
                          public.tbl_o_student o, 
                          public.tbl_j_person j
                        WHERE 
                          s.\"termAdmissionID\" = q.\"termAdmissionID\" AND
                          o.\"personID\" = j.\"personID\" AND
                          o.\"studentID\" = q.\"studentID\" and s.\"offeredModuleID\"=$ofmID order by q.\"studentID\"";
               
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
                        'pageSize'=>300,
                    ),
                ));
        }
 
        public static function searchAcademicRecord($studentID)
	{
                    
                    
                     
               
                    $sql = "SELECT distinct t.\"moduleRegistrationID\" as id , t.*
                    FROM vw_transcript as t where \"studentID\"='{$studentID}' order by t.\"exm_examYear\", t.\"exm_examTerm\", t.\"moduleCode\" ";
                    
                $count=Yii::app()->db->createCommand($sql)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'moduleCode',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
}