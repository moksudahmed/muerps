<?php

/**
 * This is the model class for table "{{t_examination}}".
 *
 * The followings are the available columns in table '{{t_examination}}':
 * @property integer $examinationID
 * @property string $exm_type
 * @property integer $exm_examTerm
 * @property integer $exm_examYear
 * @property string $exm_startDate
 * @property string $exm_endDate
 * @property string $exm_resultDate
 *
 * The followings are the available model relations:
 * @property RModuleregistration[] $tblRModuleregistrations
 */
class Examination extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Examination the static model class
	 */
         public $studentID;
         public $mod_title;
         public $moduleCode;
         public $letterGrade;
         public $gradePoint;
         public $markFirstHalf;
         public $markFinal;
         public $batchName;
         public $programmeCode;
         public $faculty_name;
         public $per_mobile;





         public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{t_examination}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('exm_examTerm, exm_examYear, exm_startDate, exm_endDate, exm_resultDate', 'required'),
			array('exm_type, exm_examTerm, exm_examYear', 'numerical', 'integerOnly'=>true),
			//array('exm_type', 'length', 'max'=>10),
			//array('exm_startDate, exm_endDate, exm_resultDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('examinationID, exm_type, exm_examTerm, exm_examYear, exm_startDate, exm_endDate, exm_resultDate', 'safe', 'on'=>'search'),
                    array('exm_type+exm_examTerm+exm_examYear', 'application.extensions.uniqueMultiColumnValidator'),
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
			'tblRModuleregistrations' => array(self::MANY_MANY, 'RModuleregistration', '{{u_examregistration}}(examinationID, moduleRegistrationID)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'examinationID' => 'Examination',
			'exm_type' => 'Type',
			'exm_examTerm' => 'Term',
			'exm_examYear' => 'Year',
			'exm_startDate' => 'Start Date',
			'exm_endDate' => 'End Date',
			'exm_resultDate' => 'Result Date',
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

                $criteria->condition="exm_type={$id}";
                $criteria->order="\"exm_examYear\", \"exm_examTerm\"";
                
                
		$criteria->compare('examinationID',$this->examinationID);
		$criteria->compare('exm_type',$this->exm_type,true);
		$criteria->compare('exm_examTerm',$this->exm_examTerm);
		$criteria->compare('exm_examYear',$this->exm_examYear);
		$criteria->compare('exm_startDate',$this->exm_startDate,true);
		$criteria->compare('exm_endDate',$this->exm_endDate,true);
		$criteria->compare('exm_resultDate',$this->exm_resultDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100,)
		));
	}
        
        public function searchTranscriptData($sid){
                
               
                $criteria=new CDbCriteria;

                $criteria->select=array( 't.*' );
              
                $criteria->join="generate_transcript";
               // $criteria->join .="LEFT JOIN {{n_faculty}} AS f ON f.\"facultyID\" = t.\"facultyID\" ";
                //$criteria->join .="LEFT JOIN {{b_department}} AS d ON d.\"departmentID\" = f.\"departmentID\" ";
              //  $criteria->join .="LEFT JOIN {{j_person}} AS p ON p.\"personID\" = t.\"facultyID\" ";
               
               
               
             //   $criteria->condition="t.\"programmeCode\"=:proCode and t.ofm_term=:ofmTerm and t.ofm_year=:ofmYear ";
                $criteria->params=array(':sid'=>$sid);

                $criteria->order="\"c_mod_group\", \"c_title\"";
                
		
                
                    return new CActiveDataProvider($this, array(
                            'criteria'=>$criteria,'pagination'=>array('pageSize'=>300,)
                    )
                );
        }
        public function searchTabulationData($examTerm,$examYear,$examID,$proCode,$batName,$group=NULL,$secName=NULL)
	{
            
            $sql = "SELECT DISTINCT
                    \"studentID\",                    
                    \"per_name\" 
                    
                  FROM 
                    vw_result_final_exam
                    where \"exm_examTerm\"={$examTerm} and 
                        \"exm_examYear\"={$examYear} and 
                            \"examinationID\"={$examID} and 
                            \"programmeCode\"='{$proCode}' and 
                                \"batchName\"={$batName} ". ($secName?" and \"sectionName\"='{$secName}' ":" "). 
                                        ($group?" and \"mod_group\"='{$group}' ":" ").
                  "ORDER BY \"studentID\" ";
            $rows = Yii::app()->db->createCommand($sql)->queryAll();             
            return $rows;
          
        }
        public function searchHowManySubjectInTheTabulation($examTerm,$examYear,$examID,$proCode,$batName,$group=NULL,$secName=NULL)
	{
            
            $sql = "SELECT DISTINCT                     
                    \"moduleCode\",
                     \"mod_name\"                    
                  FROM 
                    vw_result_final_exam
                    where \"exm_examTerm\"={$examTerm} and 
                        \"exm_examYear\"={$examYear} and 
                            \"examinationID\"={$examID} and 
                            \"programmeCode\"='{$proCode}' and 
                                \"batchName\"={$batName} ". ($secName?" and \"sectionName\"='{$secName}' ":" "). 
                                        ($group?" and \"mod_group\"='{$group}' ":" ").
                  "ORDER BY \"moduleCode\"";
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;
          
        }
        public function searchTabulation($examTerm,$examYear,$examID,$proCode,$batName,$group=NULL,$regiType=null,$secName=NULL)
	{
            
            $sql = "SELECT \"studentID\" as id,
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
                            \"examinationID\"={$examID} and 
                            \"programmeCode\"='{$proCode}' and \"reg_status\" ='{$regiType}' AND
                                \"batchName\"={$batName} ". ($secName?" and \"sectionName\"='{$secName}' ":" "). 
                                        ($group?" and \"mod_group\"='{$group}' ":" ").
                  "ORDER BY \"moduleCode\", \"studentID\" ";
         //   echo $sql;exit();
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
                        'pageSize'=>30000,
                    ),
                ));
        }
       
        public function searchTabulationByOfferedModuleID($offeredModuleID)
	{
            
            $sql = "SELECT \"studentID\" as id,
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
                    where \"offeredModuleID\"={$offeredModuleID}   
                  ORDER BY \"moduleCode\", \"studentID\" ";
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
       
        
        
        public function searchTabulationReturnRowsTwo($proCode,$batName,$term,$year,$group=null)
	{
            
            if($group!=null)
            {
                $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                       FROM 
                        vw_result_final_exam_retake
                      WHERE 
                        \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} AND tra_term = {$term} and tra_year={$year}  AND \"mod_group\" ='{$group}'
                      ORDER BY \"studentID\" ";
            }
            else
            {
                $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                       FROM 
                        vw_result_final_exam
                      WHERE 
                        \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} AND tra_term = {$term} and tra_year={$year}
                      ORDER BY \"studentID\" ";
            }
            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;
        }
        
          public function getTabulationRow($studentID,$moduleCode,$batch,$examID)
          {
               $sql = "SELECT distinct
                                              \"moduleCode\",
                                              \"markFirstHalf\",
                                              \"markFinal\",
                                              \"total\",
                                              \"letterGrade\",
                                              \"gradePoint\"

                                            FROM
                                              vw_result_final_exam
                                            WHERE
                                              \"studentID\" = '{$studentID}' AND 
                                              \"moduleCode\" = '{$moduleCode}' AND
                                              \"batchName\"='{$batch}' AND
                                              \"examinationID\" = {$examID}
                                            ORDER BY \"moduleCode\"";
                      
                  return Yii::app()->db->createCommand($sql)->queryRow();                                     
                  

          }

        public function searchTabulationReturnRows($proCode,$batName,$examID, $resultType=null, $group=null,$secName=null)
        {
                          
                  /*  $sql = "SELECT DISTINCT \"studentID\" as id,
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
                    where  \"examinationID\"={$examID} and 
                            \"programmeCode\"='{$proCode}' and 
                                \"batchName\"={$batName} ". ($secName?" and \"sectionName\"='{$secName}' ":" "). 
                                        ($group?" and \"mod_group\"='{$group}' ":" ").
                  "ORDER BY \"moduleCode\", \"studentID\" ";*/
                  if($resultType == 'Regular'){

                    if($group =='All')
                    {
                            $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                            FROM 
                            vw_result_final_exam
                          WHERE 
                            \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} 
                            AND \"examinationID\" = {$examID} AND reg_status='Regular' ORDER BY \"studentID\" ";
                    }
                    else{
                      $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                            FROM 
                            vw_result_final_exam
                          WHERE 
                            \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} AND reg_status='Regular'
                            AND \"examinationID\" = {$examID}".($group?" and \"mod_group\"='{$group}' ":" ").
                          " ORDER BY \"studentID\" ";
                    }
                  }
                  elseif ($resultType == 'Retake' || $resultType == 'Retaken'){

                    if($group =='All')
                  {
                          $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                          FROM 
                          vw_result_final_exam
                        WHERE 
                          \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} 
                          AND \"examinationID\" = {$examID} AND (reg_status='Retake' OR reg_status='Retaken') ORDER BY \"studentID\" ";
                  }
                  else{
                    $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                          FROM 
                          vw_result_final_exam
                        WHERE 
                          \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} AND (reg_status='Retake' OR reg_status='Retaken')
                          AND \"examinationID\" = {$examID}".($group?" and \"mod_group\"='{$group}' ":" ").
                        " ORDER BY \"studentID\" ";
                  }
                }
                else{

                    
                          $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                          FROM 
                          vw_result_final_exam
                        WHERE 
                          \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} 
                          AND \"examinationID\" = {$examID}  ORDER BY \"studentID\" ";
                 
                  
                }
                  
                  
          // echo $sql; exit();                
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
                       
                
            return $rows;
        }
        public function searchTabulationRowsByStudentID($examTerm,$examYear,$examID,$proCode,$studentID)
        {
      
                  $sql = "SELECT \"studentID\" as id,
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
                                  \"examinationID\"={$examID} and 
                                  \"programmeCode\"='{$proCode}' and 
                                    \"studentID\" ='{$studentID}'   
                        ORDER BY \"moduleCode\", \"studentID\" ";
                  //echo $sql;
                  //$rows = Yii::app()->db->createCommand($sql)->queryAll();
                 
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
                       
                
            return $rows;
                  
                 
        }
        public function searchTabulationReturnRowsLast($proCode,$batName,$examID, $resultType=null, $group=null)
	{
          
           switch ($resultType ){
               case 'group':// ----------------MAJOR SUBJECT QUEARY ------------------------///        
                            if($group!=null)
                            {
                                $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                                       FROM 
                                        vw_result_final_exam
                                      WHERE 
                                        \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} 
                                        AND \"examinationID\" = {$examID}  AND \"mod_group\" ='{$group}'
                                      ORDER BY \"studentID\" ";
                            }
                            break;
               case 'thesis':  // ----------------Internship/Thesis/ Viva  QUARY ------------------------///        
                              $group = 'Internship/Thesis'; 
                              $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                                       FROM 
                                        vw_result_final_exam
                                      WHERE 
                                        \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} 
                                        AND \"examinationID\" = {$examID} AND \"mod_group\" ='{$group}'
                                      ORDER BY \"studentID\" ";
                      
                             break;
               default:     // ----------------FOR ALL SUBJECT QUARY ------------------------///
                            $sql = "SELECT DISTINCT  \"studentID\", \"per_name\"
                                       FROM 
                                        vw_result_final_exam
                                      WHERE 
                                        \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} 
                                        AND \"examinationID\" = {$examID}
                                      ORDER BY \"studentID\" ";
                             break;
                   
           }
           //echo $sql; exit();                
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
                       
                
            return $rows;
        }
        public function searchNoOfSubjectIndividual($examTerm,$examYear,$examID,$proCode,$studentID)
        {
             //  echo $batName.$examID.$result_type,$group,$examType;exit();
                  $sql ="SELECT DISTINCT o.\"moduleCode\", v.mod_name FROM public.vw_result_final_exam v, public.tbl_h_offeredmodule o
                  WHERE v.\"offeredModuleID\" = o.\"offeredModuleID\" AND o.\"programmeCode\" = '{$proCode}' AND o.\"batchName\" =   {$batName} AND v.\"examinationID\" ={$examID}
                  ORDER BY v.\"mod_name\"";
                 //echo var_dump($sql2);exit();
                
                  $rows = Yii::app()->db->createCommand($sql)->queryAll();
                  return $rows;
              }
        public function searchNoOfSubject2($proCode,$batName,$examID, $result_type ='Regular',$group ='All', $examType = 1)
	{
       //  echo $batName.$examID.$result_type,$group,$examType;exit();
           
          switch ($result_type ){
               case 'group':// ----------------MAJOR SUBJECT QUEARY ------------------------///        
                            if($group!=null)
                            {
                                 $sql ="SELECT DISTINCT o.\"moduleCode\", v.mod_name FROM public.vw_result_final_exam v, public.tbl_h_offeredmodule o
                                        WHERE v.\"offeredModuleID\" = o.\"offeredModuleID\" AND o.\"programmeCode\" = '{$proCode}' AND o.\"batchName\" =   {$batName} AND v.\"examinationID\" ={$examID} and v.\"mod_group\" ='{$group}'
                                        ORDER BY v.\"mod_name\";
                                    ";
                            }
                            break;
               case 'thesis':  // ----------------Internship/Thesis/ Viva  QUARY ------------------------///        
                               $group = 'Internship/Thesis';
                               $sql = "SELECT DISTINCT r.\"moduleCode\", r.mod_name
                                    FROM   public.vw_result_final_exam r
                                    WHERE  r.\"programmeCode\" =  '{$proCode}' AND   r.\"batchName\" = {$batName} AND   r.\"examinationID\" ={$examID} AND r.\"mod_group\" ='{$group}'
                                    ORDER BY r.\"mod_name\"";
                            
                               break;
               default:     // ----------------FOR ALL SUBJECT QUARY ------------------------///
                            $sql ="SELECT DISTINCT o.\"moduleCode\", v.mod_name FROM public.vw_result_final_exam v, public.tbl_h_offeredmodule o
                                    WHERE v.\"offeredModuleID\" = o.\"offeredModuleID\" AND o.\"programmeCode\" = '{$proCode}' AND o.\"batchName\" =   {$batName} AND v.\"examinationID\" ={$examID}
                                    ORDER BY v.\"mod_name\"";
                             // This queary is for retake tabulation & result sheet print.///
                          
                       /* $sql = "SELECT DISTINCT r.\"moduleCode\", r.mod_name
                                FROM   public.vw_result_final_exam r
                                WHERE  r.\"programmeCode\" =  '{$proCode}' AND   r.\"batchName\" = {$batName} AND   r.\"examinationID\" ={$examID} 
                                ORDER BY r.\"mod_name\"";*/
                  
                                   break;
                   
           }
          
           $sql2  = "SELECT * from public.select_subjects_for_tabulation('{$proCode}',{$batName},{$examID},'{$result_type}',1,'{$group}')";
           //echo var_dump($sql2);exit();
          
            $rows = Yii::app()->db->createCommand($sql2)->queryAll();
            return $rows;
        }
        public function searchNoOfSubject($proCode,$batName,$examID, $result_type ='Regular',$group ='All', $examType = 1)
	      {
             
                          
                $sql  = "SELECT DISTINCT * from public.select_subjects_for_tabulation('{$proCode}',{$batName},{$examID},'{$result_type}',1,'{$group}')";
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                //echo var_dump($rows); exit();
                return $rows;
        }
        public function searchNoOfSubjectSupply($proCode,$batName,$examID,$group=null)
	{
              
            
            $sql = "SELECT DISTINCT \"moduleCode\" as modulecode, mod_name FROM vw_result_final_exam WHERE 
                \"programmeCode\" = '{$proCode}' AND \"batchName\" = {$batName} AND \"examinationID\" = {$examID} ORDER BY mod_name";
           
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;
        }
        
        public function searchNoOfSubjectRetake($proCode,$batName,$examID,$group=null)
	{
              
           /* if($group!=null)
            {
                $sql = "SELECT DISTINCT \"moduleCode\", \"mod_name\" FROM vw_result_final_exam_retake
                  WHERE \"programmeCode\" = :proCode AND \"batchName\" = :batName AND \"examinationID\" = :examID AND \"mod_group\" = :group
                  ORDER BY \"mod_name\" ";
                  
                $command = Yii::app()->db->createCommand($sql);
                $command->params = array(':proCode'=>$proCode,':batName'=>$batName,':examID'=>$examID,':group'=>$group);
            
            }
            else 
            {
            

                $sql = "SELECT DISTINCT \"moduleCode\", \"mod_name\" FROM vw_result_final_exam_retake
                  WHERE \"programmeCode\" = :proCode AND \"batchName\" = :batName AND \"examinationID\" = :examID
                  ORDER BY \"mod_name\" ";
               /*  $sql ="SELECT \"moduleCode\", \"mod_name\"
                        FROM vw_result_final_exam_retake
                        WHERE \"programmeCode\" = :proCode' AND \"batchName\" = :batName AND \"examinationID\" = :examID
                        EXCEPT
                        SELECT \"moduleCode\", \"mod_name\"
                        FROM vw_result_final_exam_retake
                        WHERE \"programmeCode\" = :proCode AND \"batchName\" = :batName AND \"examinationID\" = :examID AND mod_group='Internship/Thesis'";
                */
              /*  $command = Yii::app()->db->createCommand($sql);
                $command->params = array(':proCode'=>$proCode,':batName'=>$batName,':examID'=>$examID);
            
            }*/
            
            $sql2  = "SELECT * from public.select_subjects_for_tabulation('{$proCode}',{$batName},{$examID},'Retake',1,'All')";
           
            $rows = Yii::app()->db->createCommand($sql2)->queryAll();
            //$rows = Yii::app()->db->createCommand($sql2)->queryAll();
            //$rows = $command->queryAll();
           // echo var_dump($rows); exit();
            return $rows;
        }
                
        public function searchGradeSheetReturnRows($proCode,$batName,$examTerm,$examYear,$sectionName)
	{
            
            $sql = "SELECT DISTINCT
                    \"studentID\", 
                    \"per_name\"                    
                   FROM 
                    vw_result_final_exam
                  WHERE 
                    \"programmeCode\" = '{$proCode}' AND
                    \"batchName\" = {$batName} AND
                    \"exm_examTerm\" = {$examTerm} AND 
                    \"exm_examYear\" = {$examYear} AND
                    \"sectionName\" = '{$sectionName}'
                  ORDER BY \"studentID\" ";
            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;
        }
    
        public function searchTranscriptHeaderData($sid)
	{
            
            $sql = "SELECT \"studentID\",
                \"stu_academicTerm\", 
                \"stu_academicYear\", 
                  \"name\",
                 \"per_dateOfBirth\", 
                  \"per_nationality\", 
                  \"pro_officialName\", 
                  \"duration\", 
                  \"syl_maxCreditHour\",
                  \"syl_minCGPA\", 
                  \"syl_maxCGPA\", 
                   \"sum\",
                   \"batchName\",
                   \"pro_shortName\"
                FROM vw_transcript_header
                WHERE 
                   \"studentID\" = '{$sid}'
                ORDER BY \"batchName\""; 
                     
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;
        }
        
        public function checkModuleRegistration($moduleCode,$examTerm,$examYear,$sids)
        {
           $sql = "SELECT 
              o.\"moduleCode\"
            FROM 
              public.tbl_q_termadmission t, 
              public.tbl_s_moduleregistration m, 
              public.tbl_h_offeredmodule o
            WHERE 
              m.\"termAdmissionID\" = t.\"termAdmissionID\" AND
              o.\"offeredModuleID\" = m.\"offeredModuleID\" AND
              o.\"moduleCode\" = '{$moduleCode}' AND 
              t.\"studentID\" = '{$sid}' AND 
              t.tra_term = {$examTerm} AND 
              t.tra_year = {$examYear}";
              
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;

        }
        
        
        public function searchSubjectForResultPublish($programCode,$term, $year)
	{
             
             $sql = "SELECT DISTINCT \"offeredModuleID\" as id, m.mod_name, \"offeredModuleID\",  b.\"batchName\", o.\"sectionName\", m.\"moduleCode\", concat(r.per_title, ' ', r.\"per_firstName\", ' ', r.\"per_lastName\") AS per_name, p.\"programmeCode\",
                      r.per_email, r.per_mobile  ,o.ofm_approval    
                            FROM 
                              public.tbl_c_programme p,public.tbl_f_batch b,public.tbl_h_offeredmodule o, public.tbl_e_module m, public.tbl_j_person r
                            WHERE 
                              p.\"programmeCode\" = b.\"programmeCode\" AND b.\"programmeCode\" = o.\"programmeCode\" AND
                              b.\"batchName\" = o.\"batchName\" AND o.\"moduleCode\" = m.\"moduleCode\" AND
                              o.\"syllabusCode\" = m.\"syllabusCode\" AND o.\"facultyID\" = r.\"personID\" AND
                              p.\"programmeCode\" = '{$programCode}' AND 
                              o.ofm_term = '{$term}' AND 
                              o.ofm_year = '{$year}' 
             
                               ORDER BY 
                                    \"programmeCode\",\"batchName\",\"sectionName\"
                    ";
              return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'programmeCode','batchName','sectionName'
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));

        }

        public function searchPublishedResult($programCode,$term, $year)
	{
             
             $sql = "SELECT DISTINCT m.mod_name as id,m.mod_name, \"offeredModuleID\", o.\"sectionName\", b.\"batchName\", m.\"moduleCode\", concat(r.per_title, ' ', r.\"per_firstName\", ' ', r.\"per_lastName\") AS per_name                                 
                            FROM 
                              public.tbl_c_programme p,public.tbl_f_batch b,public.tbl_h_offeredmodule o, public.tbl_e_module m, public.tbl_j_person r
                            WHERE 
                              p.\"programmeCode\" = b.\"programmeCode\" AND b.\"programmeCode\" = o.\"programmeCode\" AND
                              b.\"batchName\" = o.\"batchName\" AND o.\"moduleCode\" = m.\"moduleCode\" AND o.\"syllabusCode\" = m.\"syllabusCode\" AND o.\"facultyID\" = r.\"personID\" AND
                              p.\"programmeCode\" = '{$programCode}' AND 
                              o.ofm_term = '{$term}' AND 
                              o.ofm_year = '{$year}' AND
                              o.publish_result ='TRUE'
                               ORDER BY 
                                    \"batchName\"
                    ";
                              
                              
              return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'offeredModuleID', 'mod_name','batchName', ' moduleCode','sectionName',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));

        }

    public function searchConfirmedResult($programCode,$term, $year)
	{
             $sql ="SELECT DISTINCT * from public.regular_batches(1,2020,'111') order by batchname ASC";
             $sql = "SELECT distinct * from public.regular_batches(:tr,:yr,:pro) ORDER BY batchname ASC";
             $sql1 = "((SELECT h.\"programmeCode\" as id,h.\"batchName\",h.ofm_term as term,h.ofm_year as year, count(h.\"moduleCode\") as \"countMod\"   
                        FROM tbl_h_offeredmodule h 
                        WHERE h.ofm_term =  :tr AND h.ofm_year = :yr  AND h.ofm_publish = true AND h.ofm_approval = true and h.\"programmeCode\"=:pro group by h.\"batchName\", h.\"programmeCode\",h.ofm_term,h.ofm_year order by h.\"batchName\")
                        intersect
                        (
                         SELECT o.\"programmeCode\" as id, o.\"batchName\", o.ofm_term as term,o.ofm_year as year, count(o.\"moduleCode\") as \"countMod\" 
                        FROM tbl_h_offeredmodule o 
                        WHERE o.ofm_term = :tr AND o.ofm_year = :yr and o.\"programmeCode\"=:pro group by o.\"batchName\", o.\"programmeCode\",o.ofm_term,o.ofm_year order by o.\"batchName\")) order by \"batchName\"";
              //print($sql); exit();             
              $command = Yii::app()->db->createCommand($sql);
              $command->params=array(':tr'=>$term,':yr'=>$year,':pro'=>$programCode);
              
              return new CSqlDataProvider($command, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                              ''
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));

        }
        
        
        public function searchRetakeResultByBatchs($programCode,$term, $year)
	{
             
            /* old sql
             * 
             * $sql = "((SELECT h.\"programmeCode\" as id,h.\"batchName\",h.tra_term as term,h.tra_year as year  
                        FROM tbl_q_termadmission h 
                        WHERE h.tra_term =  '{$term}' AND h.tra_year = '{$year}'  AND  h.\"programmeCode\"='{$programCode}' group by h.\"batchName\", h.\"programmeCode\",h.tra_term, h.tra_year order by h.\"batchName\")
                       except
                        (
                         SELECT o.\"programmeCode\" as id, o.\"batchName\", o.ofm_term as term,o.ofm_year as year 
                        FROM tbl_h_offeredmodule o 
                        WHERE o.ofm_term =  '{$term}' AND o.ofm_year = '{$year}' and o.\"programmeCode\"='{$programCode}' group by o.\"batchName\", o.\"programmeCode\",o.ofm_term,o.ofm_year order by o.\"batchName\")) order by \"batchName\"                  
                        ";*/
                   
            
              $sql = "SELECT distinct * from public.retake_batches(:tr,:yr,:pro) ORDER BY batchname ASC";
              $sql2 = "
                    SELECT distinct q.\"programmeCode\" as id,q.\"batchName\",q.tra_term as term,q.tra_year as year
                    FROM 
                      public.tbl_q_termadmission q, 
                      public.tbl_s_moduleregistration s
                    WHERE 
                      q.\"termAdmissionID\" = s.\"termAdmissionID\"
                    AND 	
                                    s.reg_status='Retake'

                    AND
                             q.tra_term=:tr
                    AND
                      q.tra_year=:yr
                       AND q.\"programmeCode\"=:pro order by q.\"batchName\" " ;          
            
              $command = Yii::app()->db->createCommand($sql);
              $command->params=array(':tr'=>$term,':yr'=>$year,':pro'=>$programCode);
              $command->order="\"batchname\"";
              //echo $sql; exit();              
              return new CSqlDataProvider($command, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                              ''
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));

        }
        
        public function searchSuppleResultByBatchs($programCode,$term, $year,$exmType=2)
	{
             
             $sql = "SELECT 
                distinct q.\"batchName\",
                t.\"exm_examTerm\" as term, 
                t.\"exm_examYear\" as year, 
                q.\"programmeCode\" as id
              FROM 
                public.tbl_u_exammarks u, 
                public.tbl_t_examination t, 
                public.tbl_s_moduleregistration s, 
                public.tbl_q_termadmission q
              WHERE 
                u.\"examinationID\" = t.\"examinationID\" AND
                u.\"moduleRegistrationID\" = s.\"moduleRegistrationID\" AND
                s.\"termAdmissionID\" = q.\"termAdmissionID\" AND
                q.\"programmeCode\" = '{$programCode}' AND 
                t.exm_type =  {$exmType} AND 
                t.\"exm_examTerm\" = {$term} AND 
                t.\"exm_examYear\" = {$year} order by q.\"batchName\"";

                        
              return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                              ''
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));

        }
        
        public static function searchConfirmedResultArray($programCode,$term, $year)
	{
             
                $sql = "((SELECT h.\"programmeCode\" ,h.\"batchName\",h.ofm_term as term,h.ofm_year as year, count(h.\"moduleCode\") as \"countMod\"   
                           FROM tbl_h_offeredmodule h 
                           WHERE h.ofm_term =  :term AND h.ofm_year = :year AND h.ofm_approval = 'yes' and h.\"programmeCode\"=:proCode group by h.\"batchName\", h.\"programmeCode\",h.ofm_term,h.ofm_year order by h.\"batchName\")
                           intersect
                           (
                            SELECT o.\"programmeCode\" , o.\"batchName\", o.ofm_term as term,o.ofm_year as year, count(o.\"moduleCode\") as \"countMod\" 
                           FROM tbl_h_offeredmodule o 
                           WHERE o.ofm_term = :term AND o.ofm_year = :year and o.\"programmeCode\" = :proCode group by o.\"batchName\", o.\"programmeCode\",o.ofm_term,o.ofm_year order by o.\"batchName\")) order by \"batchName\" ";
              
                return Examination::model()->findAllBySql($sql, array(':proCode'=>$programCode,':term'=>$term,':year'=>$year));

        }
        
        
        
         public function searchEligableList($term, $year)
        {
            $sql ="SELECT 
                  p.\"programmeCode\", 
                  t.\"batchName\", 
                  t.\"studentID\"
                  
                FROM 
                  public.tbl_b_department d, 
                  public.tbl_c_programme p, 
                  public.tbl_q_termadmission t
                WHERE 
                  d.\"departmentID\" = p.\"departmentID\" AND
                  p.\"programmeCode\" = t.\"programmeCode\" AND
                  t.tra_term =  {$term}AND 
                  t.tra_year = {$year}                  
                 GROUP BY p.\"programmeCode\",t.\"batchName\",t.\"studentID\"
                  ORDER BY p.\"programmeCode\",t.\"batchName\",t.\"studentID\"";            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;    
                  /* return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'id', 'batchName', 'studentID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));*/
        }
        
        public function searchEligiableStudentSummery($term, $year)
        {
            $sql ="SELECT 
                  d.dpt_code as id, 
                  p.\"pro_shortName\", 
                  count (t.\"studentID\") as \"total\"
                FROM 
                  public.tbl_b_department d, 
                  public.tbl_c_programme p, 
                  public.tbl_q_termadmission t
                WHERE 
                  d.\"departmentID\" = p.\"departmentID\" AND
                  p.\"programmeCode\" = t.\"programmeCode\" AND
                  t.tra_term = {$term} AND 
                  t.tra_year = {$year}
                 GROUP BY d.dpt_code,p.\"pro_shortName\"
                  ORDER BY id
                  ";
           

            //$rows = Yii::app()->db->createCommand($sql)->queryAll();
           // return $rows;  
            return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'id', 'batchName',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));

        }
        public function searchStudentTermAdmiisionList($term, $year)
        {
            $sql ="SELECT
                  t.\"studentID\",
                  t.\"batchName\", 
                  d.dpt_code as id, 
                  p.\"pro_shortName\"
                FROM 
                  public.tbl_b_department d, 
                  public.tbl_c_programme p, 
                  public.tbl_q_termadmission t
                WHERE 
                  d.\"departmentID\" = p.\"departmentID\" AND
                  p.\"programmeCode\" = t.\"programmeCode\" AND
                  t.tra_term = {$term} AND 
                  t.tra_year = {$year}
                ORDER BY  p.\"pro_shortName\", t.\"batchName\",t.\"studentID\" ";
           

            //$rows = Yii::app()->db->createCommand($sql)->queryAll();
           // return $rows;  
            return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'id', 'batchName',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));

        }


        public function searchEligiableStudentSupple($term, $year, $departmentID,$exmType)
        {
         
            if(yii::app()->user->getState('role')==='super-admin' || yii::app()->user->getState('role')==='admin' || yii::app()->user->getState('role')==='exam')
            {
                $sql ="
                    SELECT 
                  \"programmeCode\",
                  concat(\"programmeCode\",': ',pro_name) as pro_name,
                  \"moduleCode\" as id,
                  mod_name,
                  count(\"studentID\") as total,
                    \"exm_examTerm\",
                    \"exm_examYear\"
                FROM 
                  public.vw_getsuppleregisteredlistnew 
                  where
                \"exm_examTerm\"={$term} and 
                  \"exm_examYear\"={$year} 
                  group by \"moduleCode\", mod_name, \"programmeCode\", pro_name, \"exm_examTerm\",
                    \"exm_examYear\"
                  order by \"programmeCode\"
                ";
             
            }
            else
            {
                
                $sql ="
                    SELECT 
                  \"programmeCode\",
                  concat(\"programmeCode\",': ',pro_name) as pro_name,
                  \"moduleCode\" as id,
                  mod_name,
                  count(\"studentID\") as total,
                    \"exm_examTerm\",
                    \"exm_examYear\"
                FROM 
                  public.vw_getsuppleregisteredlistnew 
                  where
                \"exm_examTerm\"={$term} and 
                  \"exm_examYear\"={$year}	and 
                      \"departmentID\"={$departmentID} AND
                  exm_type = {$exmType}
                  group by \"moduleCode\", mod_name, \"programmeCode\", pro_name, \"exm_examTerm\",
                    \"exm_examYear\"
                  order by \"programmeCode\"
                ";	
	        
            }
            
           

            //$rows = Yii::app()->db->createCommand($sql)->queryAll();
           // return $rows;  
            return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     /*'sort'=>array(
                        'attributes'=>array(
                             'id', 'batchName',
                        ),
                    ),*/
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));

        }
        
        public function searchSupplymentryList($programCode,$term, $year)
        {
          $sql = "SELECT v.\"studentID\" as id, v.per_name, v.\"moduleCode\", 
                          v.mod_name,                           
                          v.\"markFinal\",                           
                          v.\"letterGrade\", 
                          v.\"exm_examTerm\", 
                          v.\"exm_examYear\",
                          v.\"programmeCode\",
                          v.\"batchName\", 
                          v.\"sectionName\"  
                        FROM 
                          public.vw_result_final_exam v
                        WHERE 
                          v.\"programmeCode\" = '{$programCode}' AND 
                           v.\"exm_examTerm\"={$term} AND
                          v.\"exm_examYear\" ={$year} AND
                          v.\"letterGrade\" = 'F*(S)'
                         ORDER BY  v.\"batchName\", 
                          v.\"sectionName\", id 
                    ";
            

            //$rows = Yii::app()->db->createCommand($sql)->queryAll();
           // return $rows;  
            return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'id',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));

        }
       
        
         public function resultProcessor($output, $tableName, $param){
           
            $last = count($output);
            
            $count = 0;
            $q = "'";
            $sql = ' SELECT DISTINCT ';            
            foreach ($output as $key => $value) {
                $sql = $sql.'"'. $value .'"';
                
                $count++;
                if ($count != $last)
                     $sql = $sql.',';   
            }
            $sql = $sql. ' FROM '. $tableName.' WHERE ';
            
            $last = count($param);
            $count = 0;
            
            foreach ($param as $key => $value) {
                 if(!is_int($value)){   
                        $sql = $sql.'"'. $key .'"'.' = '.$q. $value.$q;                
                }
                else{
                        $sql = $sql.'"'. $key .'"'.' = '. $value;
                }
                $count++;
                if ($count != $last)
                     $sql = $sql.' AND ';                      
              
            }
            return Yii::app()->db->createCommand($sql)->queryAll();                                   
        }
        public function resultProcessorSubjectList($param, $retake='regular'){
           
            $count = 0;
            $q = "'";
            if($retake == 'retake' )
                $sql = 'SELECT DISTINCT "moduleCode", mod_name, mod_group FROM vw_result_final_exam as v WHERE ';
             else{
                 $sql = 'SELECT DISTINCT o."moduleCode", v.mod_name FROM public.vw_result_final_exam v, public.tbl_h_offeredmodule o';
                 $sql = $sql." WHERE v.\"offeredModuleID\" = o.\"offeredModuleID\" AND ";
             }
            $last = count($param);
            $count = 0;
            foreach ($param as $key => $value) {
                    
                    if($key == "reg_status")
                          $sql = $sql.'( v."'. $key .'"'.' = '.$q. $value. $q.' OR v."'. $key . '"'.' = '.$q. 'Retaken' .$q .')';                 
                    else
                         if(!is_int($value))
                            $sql = $sql.'v."'. $key .'"'.' = '.$q. $value.$q;    
                         else
                            $sql = $sql.'v."'. $key .'"'.' = '. $value;
                $count++;
                if ($count != $last)
                     $sql = $sql.' '.' AND ';         
              
            }
            $sql = $sql.' ORDER BY v."mod_name"';           
           return Yii::app()->db->createCommand($sql)->queryAll();                               
        }
        
         public function searchTabulationByStudentID($examTerm,$examYear,$examID,$proCode,$studentID)
	{

            $sql = "SELECT \"studentID\" as id,
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
                            \"examinationID\"={$examID} and 
                            \"programmeCode\"='{$proCode}' and 
                              \"studentID\" ='{$studentID}'   
                  ORDER BY \"moduleCode\", \"studentID\" ";
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
                        'pageSize'=>30000,
                    ),
                ));
        }
         public function searchTabulationDataByStudentID($examTerm,$examYear,$examID,$proCode,$studentID)
	{
            
            $sql = "SELECT DISTINCT
                    \"studentID\",                    
                    \"per_name\" 
                    
                  FROM 
                    vw_result_final_exam
                    where \"exm_examTerm\"={$examTerm} and 
                        \"exm_examYear\"={$examYear} and 
                            \"examinationID\"={$examID} and 
                            \"programmeCode\"='{$proCode}' and                             
                                \"studentID\" = '{$studentID}' 
                               ORDER BY \"studentID\" ";
            $rows = Yii::app()->db->createCommand($sql)->queryAll();             
            return $rows;
          
        }
         public function searchHowManySubjectInTheTabulationByStudetID($examTerm,$examYear,$examID,$proCode,$studentID)
	{
            
            $sql = "SELECT DISTINCT                     
                    \"moduleCode\" as modulecode,
                     \"mod_name\"                    
                  FROM 
                    vw_result_final_exam
                    where \"exm_examTerm\"={$examTerm} and 
                        \"exm_examYear\"={$examYear} and 
                            \"examinationID\"={$examID} and 
                            \"programmeCode\"='{$proCode}' and 
                             \"studentID\" = '{$studentID}'
                               ORDER BY \"moduleCode\"";
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;
          
        }
}