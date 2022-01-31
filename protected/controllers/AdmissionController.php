<?php

class AdmissionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
            if(yii::app()->user->getState('role')==='super-admin')
            {
            
            	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('test','view','renderButtons','getSection'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getBatch','getSection','create','studentsInfo','GetNewSection','getAdmission','getAdmission','admissionReport','admissionReport_programm','getBatchByProgrammeCode','getSectionByProgrammeCode','admissionFormPDF','reTake','CreateTermAdmissionForRetake','SaveRetake','DeleteRetake','studentsInfo','obsulateCourseRegistration','GetObsulateCourse','allInOne'),
				'users'=>array(yii::app()->user->id),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','UpdateFromSearch','reAdmission','CreateReAdmission','SectionTransfer','ChangeSection','AdmissionRegister','studentsInfo'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            if(yii::app()->user->getState('role')==='admin')
            {
            
            	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('test','view','renderButtons','getSection'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getBatch','getSection','create','studentsInfo','GetNewSection','getAdmission','getAdmission','admissionReport','admissionReport_programm','getBatchByProgrammeCode','getSectionByProgrammeCode','admissionFormPDF','reTake','CreateTermAdmissionForRetake','SaveRetake','DeleteRetake','studentsInfo'),
				'users'=>array(yii::app()->user->id),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','UpdateFromSearch','reAdmission','CreateReAdmission','SectionTransfer','ChangeSection','AdmissionRegister','studentsInfo'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif(yii::app()->user->getState('role')==='head')
            {
            
            	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('test','view','renderButtons'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getBatch','getSection','create','studentsInfo','GetNewSection','getAdmission','getAdmission','admissionReport','admissionReport_programm','getBatchByProgrammeCode','getSectionByProgrammeCode','reTake','CreateTermAdmissionForRetake','SaveRetake','DeleteRetake'),
				'users'=>array(yii::app()->user->id),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','UpdateFromSearch','reAdmission','CreateReAdmission','SectionTransfer','ChangeSection','AdmissionRegister'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            
            elseif(yii::app()->user->getState('role')==='coordinator')
            {
            
            	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('test','view','renderButtons'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getBatch','getSection','create','studentsInfo','GetNewSection','getAdmission','getAdmission','admissionReport','admissionReport_programm','getBatchByProgrammeCode','getSectionByProgrammeCode','reTake','CreateTermAdmissionForRetake','SaveRetake','DeleteRetake'),
				'users'=>array(yii::app()->user->id),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','reAdmission','CreateReAdmission','SectionTransfer','ChangeSection','AdmissionRegister','obsulateCourseRegistration','GetObsulateCourse'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            
            elseif(yii::app()->user->getState('role')==='faculty')
            {
            
            	return array(
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif(yii::app()->user->getState('role')==='registry')
            {
            
            	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('test','view','renderButtons'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getBatch','getSection','create','studentsInfo','getAdmission','getAdmission','admissionReport','admissionReport_programm','getBatchByProgrammeCode','getSectionByProgrammeCode'),
				'users'=>array(yii::app()->user->id),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','UpdateFromSearch','reAdmission','CreateReAdmission','SectionTransfer','CreateSectionTransfer','AdmissionRegister'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif(yii::app()->user->getState('role')==='admission')
            {
            
            	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getBatch','getSection','create','studentsInfo','admissionReport','admissionReport_programm','getBatchByProgrammeCode','getSectionByProgrammeCode','admissionFormPDF','AdmissionRegister'),
				'users'=>array(yii::app()->user->id),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				//'actions'=>array('studentsInfo','update'),
                                'actions'=>array('studentsInfo','update','UpdateFromSearch','reAdmission','studentsInfo','CreateReAdmission','SectionTransfer','CreateSectionTransfer'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif(yii::app()->user->getState('role')==='exam')
            {
            
            	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getBatch','getSection','admissionReport','admissionReport_programm','getBatchByProgrammeCode','getSectionByProgrammeCode','reAdmission','CreateReAdmission','reTake','CreateTermAdmissionForRetake','SaveRetake','DeleteRetake','obsulateCourseRegistration','GetObsulateCourse','obsulateCourseRegistration','GetObsulateCourse'),
				'users'=>array(yii::app()->user->id),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('studentsInfo'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif(yii::app()->user->getState('role')==='deo')
            {
            
            	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getBatch','getSection','admissionReport','admissionReport_programm','getBatchByProgrammeCode','getSectionByProgrammeCode','reAdmission','CreateReAdmission','reTake','CreateTermAdmissionForRetake','SaveRetake','DeleteRetake','obsulateCourseRegistration','GetObsulateCourse','obsulateCourseRegistration','GetObsulateCourse'),
				'users'=>array(yii::app()->user->id),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('studentsInfo'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            else
            {
                return array(
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
                
	}

        public function actionStudentsInfo()
	{
                
		$this->render('StudentsInfo');
	}
        
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                $student=Student::model()->findByPk($id);
            //echo $student->personID;
		$this->render('view',array(
			'admission'=>  Admission::model()->findByPk(array('studentID'=>$id,'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'])),
                        'student'=> $student,
                        'person'=> Person::model()->findByPk($student->personID)
		));
	}

        
        
        public function actionGetAdmission()
        {
            
            
            $admission = new Admission();
            $form = "_form_1";
            $this->render('create',array(
			'admission'=>$admission, 'form'=>$form
                    ));
            
        }

               
        

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
        
        public function actionCreate()
	{
            
            if(isset($_REQUEST['flag']))
            {
                yii::app()->session['stuCreate']=true;
                yii::app()->session['stuCreatePeresentAdd']=null;
                yii::app()->session['stuCreateLocalGua']=null;
                yii::app()->session['stuCreateHasPreDeg']=null;
                yii::app()->session['stuCreateResult0']=null;
                yii::app()->session['stuCreateResult1']=null;
                        yii::app()->session['stuCreateResult2']=null;
                        yii::app()->session['stuCreateResult3']=null;
            }
            
            if(!yii::app()->session['stuCreate'])
            {
                $this->redirect(array('index'));
            }
                
                $form ="_form_2";
                   
                    $data = array();
                    
                    $person = new Person();
                    $student=new Student();
                    $admission = new Admission();
                    $acHistory = new AcademicHistory();
                    $jobExp= new JobExperiance();
                    
                    
                    if($data = Admission::getStudentId(yii::app()->session['secName'], yii::app()->session['batName'],yii::app()->session['proCode']))
                    {
                        
                        $student->studentID = $data['studentID'];
                        $student->stu_academicTerm = $data['bat_term'];
                        $student->stu_academicYear = $data['bat_year'];
                        $student->programmeCode= $data['programmeCode'];
                        $admission->studentID = $data['studentID'];
                        $admission->sectionName = $data['sectionName'];
                        $admission->batchName = $data['batchName'];
                        $admission->programmeCode = $data['programmeCode'];
                        $admission->adm_startTerm = $data['bat_term'];
                        $admission->adm_startYear = $data['bat_year'];
                        $admission->adm_expireTerm = $data['expireTerm'];
                        $admission->adm_expireYear = $data['expireYear'];
                        //echo $data['expireTerm']." ".$data['expireYear'];
                        //echo $student->studentID;
                        $student->stu_paymentMethod=2;
                     
                    }
                    else 
                    {
                        
                        $this->redirect(array('index'));
                    }
                    
                    
                    
                    
		 //Uncomment the following line if AJAX validation is needed
                    


		if(isset($_REQUEST['Person']) && isset($_REQUEST['Admission']) && isset($_REQUEST['Student']))
		{
                    
                        
                    CActiveForm::validate($person);
                    CActiveForm::validate($admission);
                    CActiveForm::validate($student);
                   // CActiveForm::validate($acHistory);
                    
                    
                    $person->attributes = $_REQUEST['Person'];       
                    $admission->attributes = $_REQUEST['Admission'];
                    $student->attributes = $_REQUEST['Student'];
                    
                    
                    
                    $acHistory->ach_degree= $_REQUEST['ach_degree'];
                    $acHistory->ach_group= $_REQUEST['ach_group'];
                    $acHistory->ach_board= $_REQUEST['ach_board'];
                    $acHistory->ach_institution= $_REQUEST['ach_institution'];
                    $acHistory->ach_passingYear= $_REQUEST['ach_passingYear'];
                    $acHistory->ach_result= $_REQUEST['ach_result'];
                    
                    $jobExp->joe_employer= $_REQUEST['joe_employer'];
                    $jobExp->joe_address= $_REQUEST['joe_address'];
                    $jobExp->joe_contact= $_REQUEST['joe_contact'];
                    $jobExp->joe_position= $_REQUEST['joe_position'];
                    $jobExp->joe_startDate= $_REQUEST['joe_startDate'];
                    $jobExp->joe_endDate= $_REQUEST['joe_endDate'];
                    
                    
                    
                        if($person->validate()  && $student->validate() &&  $admission->validate()  )
                        {   
                            
                           // echo "Bismillah Hir Rah Manir Rahim";
                            //echo "pre:".$_REQUEST['preview'];
                            //echo "isset".isset($_REQUEST['preview']);
                               if(isset($_REQUEST['preview']) && $_REQUEST['preview']==1)
                               {
                                   yii::app()->session['stuCreatePeresentAdd']=$_REQUEST['presentAddress'];
                                   yii::app()->session['stuCreateHasPreDeg']=$_REQUEST['hasPreDegree'];
                                   yii::app()->session['stuCreateLocalGua']=$_REQUEST['localGuardian'];
                                   yii::app()->session['stuCreateResult0']=$_REQUEST['result'][0];
                                   yii::app()->session['stuCreateResult1']=$_REQUEST['result'][1];
                                   yii::app()->session['stuCreateResult2']=$_REQUEST['result'][2];
                                   yii::app()->session['stuCreateResult3']=$_REQUEST['result'][3];
                                   
                                   $form="_form_3";
                                           
                               }
                               elseif(isset($_REQUEST['preview']) && $_REQUEST['preview']==2 && yii::app()->session['stuCreate'])
                               { //echo "saved:".$_REQUEST['preview'];
                                   $person->ex_per_ref='s';
                                   
                                   $person->per_dateOfBirth=date("Y-m-d",strtotime($person->per_dateOfBirth));
                                   $admission->adm_date=date("Y-m-d",strtotime($admission->adm_date));
  
                                   
                                   $admission->waiverID = ($admission->waiverID?$admission->waiverID:'null');
                    
                                   $newData = Admission::getStudentId(yii::app()->session['secName'], yii::app()->session['batName'],yii::app()->session['proCode']);
                                   $student->studentID= $newData['studentID'];
                                   
                                   $sqlAdmission= "SELECT sp_insert_admission_new(
 '{$person->per_title}' ,
 '{$person->per_firstName}' ,
 '{$person->per_lastName}' , 
 '{$person->per_gender}' , 
 '{$person->per_dateOfBirth}' , 
 '{$person->per_bloodGroup}' , 
 '{$person->per_nationality}' ,
 '{$person->per_fathersName}' , 
 '{$person->per_mothersName}' ,
 '{$person->per_spouseName}' ,
 '{$person->per_permanentAddress}' , 
 '{$person->per_telephone}' ,
 '{$person->per_mobile}' ,
 '{$person->per_email}' ,
 '{$person->per_presentAddress}' , 
 '{$person->per_maritalStatus}' ,
 '{$person->per_criminalConviction}' ,
  '{$person->per_convictionDetails}' , 
  '{$student->studentID}' ,  
  {$student->stu_academicTerm} , 
  {$student->stu_academicYear} , 
  '{$student->stu_conditions}' , 
  '{$student->stu_previousID}' ,
  '{$student->stu_previousDegree}' ,
  '{$student->stu_guardiansName}' , 
  '{$student->stu_guardiansAddress}' ,
  '{$student->stu_guardiansMobile}' ,
  '{$student->stu_guardiansEmail}' , 
 '{$admission->sectionName}' ,
 {$admission->batchName} ,
 '{$admission->programmeCode}' ,
 '{$admission->adm_date}' , 
 {$admission->adm_expireTerm} ,
 {$admission->adm_expireYear} , 
 {$admission->adm_startTerm} ,
 {$admission->adm_startYear},
 {$admission->waiverID},
     {$student->stu_paymentMethod}
);";
                                  //echo $sqlAdmission; 
                                   if(Yii::app()->db->createCommand($sqlAdmission)->execute())
                                    {	
                                        
                                      $personID = Student::model()->findByPk($student->studentID)->personID;
                                      
                                        $i=0; $achFlag=false;  $sql=array();
                                        foreach($acHistory->ach_degree as $item)
                                        {
                                                
                                                if ($item) 
                                                {   $achFlag= true;
                                                    

                                                    $sql[$i] = "INSERT INTO tbl_k_academichistory (ach_degree, ach_group, ach_institution, ach_board, \"ach_passingYear\", ach_result, \"personID\") VALUES"."  ( '{$item}', '{$acHistory->ach_group[$i]}', '{$acHistory->ach_institution[$i]}', '{$acHistory->ach_board[$i]}', '{$acHistory->ach_passingYear[$i]}', '{$acHistory->ach_result[$i]}', {$personID});"; 
                                                }


                                            $i++;
                                        }
                                         
                                       // print_r($sql);
                                        //exit();
                                       
                                         $j=0; $joeFlag=false; $sql2=array();
                                        foreach($jobExp->joe_employer as $item2)
                                        {

                                                if ($item2) 
                                                {   $joeFlag= true;
                                                 
                                                    $startDate =($jobExp->joe_startDate[$j] != ''? "'".$jobExp->joe_startDate[$j]."'" : 'null');
                                                    $endDate = ($jobExp->joe_endDate[$j] != ''? "'".$jobExp->joe_endDate[$j]."'" : 'null');
                                                    $startDate = date("Y-m-d",strtotime($startDate));
                                                    $endDate = date("Y-m-d",strtotime($endDate));
                                                    $sql2[$j] ="INSERT INTO tbl_l_jobexperiance ( joe_employer, joe_address, joe_contact, joe_position, \"joe_startDate\", \"joe_endDate\",  \"personID\") VALUES"."  ( '{$item2}', '{$jobExp->joe_address[$j]}', '{$jobExp->joe_contact[$j]}', '{$jobExp->joe_position[$j]}', '{$startDate}', '{$endDate}', {$personID});"; 
                                                }


                                            $j++;
                                        }

                                        

                                       // echo $sql2;
                                        
                                            if($achFlag)
                                            {   
                                                foreach ($sql as $itemSql)
                                                {
                                                    Yii::app()->db->createCommand($itemSql)->execute();
                                                }
                                                
                                            }
                                            
                                            if($joeFlag)
                                            {
                                                foreach ($sql2 as $itemSql2)
                                                {
                                                    Yii::app()->db->createCommand($itemSql2)->execute();
                                                }
                                            }
                                            
                                            yii::app()->session['stuCreate']=false;
                                            yii::app()->session['stuCreatePeresentAdd']=null;
                                            $this->redirect(array('index'));
                                        

                                    }
                              }
                            
         
                              
                            
                        }
		}
                
                    
                                  $this->render('create',array(
                            'admission'=>$admission,'student'=>$student,'person'=>$person,'acHistory'=>$acHistory,'jobExp'=>$jobExp, 'form'=>$form
                        ));
                            
                   
                    
                
		
	}
        
	

        public function actionGetBatchByProgrammeCode()
        {
            
            
		if(isset($_REQUEST['programmeCode']))
		{
			
                        
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                    yii::app()->session['proCode']=$_REQUEST['programmeCode'];

                    $model =  Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']));
                    
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("-- no batch found--"),true);
                    }
                    else    
                    {
                           $model=CHtml::listData($model,'batchName','batchName');
                           
                           
                           echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("-Please Select-"),true);
                           
                           foreach($model as $value=>$name)
                           {
                               echo CHtml::tag('option',
                                          array('value'=>$value),CHtml::encode($name),true);
                           }

                    }
                }
        }
        
  
        public function actionGetBatch()
        {
            
            //echo "test";
            
		if(isset($_REQUEST['programmeCode']))
		{
			
                        
		//	echo "programme code:".$_REQUEST['programmeCode'];
		
                    yii::app()->session['proCode']=$_REQUEST['programmeCode'];

                    
                    $model =  Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']),'ex_bat_active=true');
                    
                    if(!$model)
                    {
                        echo CHtml::tag('span',array('style'=>'color:red;'),CHtml::encode("-- no batch found--"),true);
                        
                    }
                    else    
                    {
                           
                           
                           

                           $data =array();
                           $i=0;
                           foreach ($model as $bat)
                           {
                                    $section = Section::model()->findAllByAttributes(array('programmeCode'=>$bat->programmeCode,'batchName'=>$bat->batchName));

                                    
                                    foreach ($section as $sec) {


                                     $data[$i]= array('sec'=>$sec->batchName.'-'.$sec->sectionName,'sectionName'=>'section '.$bat->batchName.FormUtil::getBatchNameSufix($sec->batchName).' '.$sec->sectionName,'group'=> '----- '.$bat->batchName.FormUtil::getBatchNameSufix($sec->batchName).' Batch -----' );   
                                    

                                     $i++;
                                    }

                           }


                           $this->renderPartial('_formGetBatch',array('data'=>$data),false,true);

                    }
                } 
        }
        
        public function actionGetSection()
        {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if(isset($_REQUEST['programmeCode']))
		{
                     yii::app()->session['proCode']=$_REQUEST['programmeCode'];
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                    //$model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']));
                    $sql='SELECT 
                          f."batchName", 
                          f."programmeCode", 
                          f.bat_term, 
                          f.bat_year, 
                          f.ex_bat_active
                        FROM 
                          public.tbl_f_batch as f where f."programmeCode"=:proCode order by f."batchName";';
                    
                    $model = Batch::model()->findAllBySql($sql,array(':proCode'=>$_REQUEST['programmeCode']));
                    
                    
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No Section Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                        
                        //$model=CHtml::listData($model,'batchName','batchName');
                        
                        foreach($model as $item)
                        {
                            $batchName=$item->batchName.FormUtil::getBatchNameSufix($item->batchName)." Batch"."     [ ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year." ]";
                            echo "<optgroup label='{$batchName}'>";
                            foreach(Section::model()->findAllByAttributes(array('batchName'=>$item->batchName,'programmeCode'=>$item->programmeCode)) as $item2)
                            {
                                $sectionName="Section ".$item2->batchName.FormUtil::getBatchNameSufix($item2->batchName)." ".$item2->sectionName;
                                echo CHtml::tag('option',array('value'=>$item2->batchName."-".$item2->sectionName),CHtml::encode($sectionName),true);
                            }
                            echo"</optgroup>";
                            
                        
                            
                        }

                    }  
                   
                }
                
                
        }
        
        public function actionGetSectionByProgrammeCode()
        {
            
                yii::app()->session['batName']=$_REQUEST['batchName'];
		if(isset($_REQUEST['batchName']))
		{
			
                        
			//echo "programme code:".$_REQUEST['programmeCode'];
		
            

                    $model =  Section::model()->findAllByAttributes(array('programmeCode'=>yii::app()->session['proCode'],'batchName'=>$_REQUEST['batchName']));
                 
                       if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No Section Found--"),true);
                    }
                    else    
                    {
                 

                        

                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("-Please Select-"),true);
                        $model=CHtml::listData($model,'sectionName','sectionName');
                        
                        foreach($model as $value=>$name)
                        {
                           echo CHtml::tag('option',
                                      array('value'=>$value),CHtml::encode($name),true);
                        }

                    }  
                   
                }
                
                
        }

        /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
         
            $admission=  Admission::model()->findByPk(array('studentID'=>$id,'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode']));
         
                $student= Student::model()->findByPk($id);
                $person= Person::model()->findByPk($student->personID);
                //$firstName = $person->per_firstName;
                //$lastName = $person->per_lastName;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
       
		if(isset($_REQUEST['Admission'],$_REQUEST['Student'],$_REQUEST['Person']))
		{
          //  echo var_dump($_REQUEST['Person']["per_lastName"]);
            //exit(0);
                
                  if((($_REQUEST['Person']["per_firstName"] == $person->per_firstName) && ($_REQUEST['Person']["per_lastName"] == $person->per_lastName)) || (yii::app()->user->getState('role')==='super-admin'))
                  {
                  
                    CActiveForm::validate($person);
                    CActiveForm::validate($admission);
                    CActiveForm::validate($student);
                    //echo var_dump($_REQUEST['Person']); exit();
			$admission->attributes=$_REQUEST['Admission'];
                        $student->attributes=$_REQUEST['Student'];
                        $person->attributes=$_REQUEST['Person'];
                        
                       $admission->waiverID = $_REQUEST['Admission']['waiverID'];
                       
                      // echo  $admission->adm_date; exit();
                       
                        if($person->validate() && $student->validate() && $admission->validate()  )
                        {
                            
                            $fileName=$student->studentID.'.jpg';
                            
                            if(move_uploaded_file($_FILES['photograph']['tmp_name'], './photograph/'.$fileName))
                            {        
                                $person->ex_per_image=1;
                                //Yii::app()->request->baseUrl.
                                $file = new File('./photograph');
                                //$file->createTmb($filename);
                                $file->imageResize($fileName);
                                
                            }
                            
                            if($admission->save() && $student->save() && $person->save())
                            {	
                            
                               
                               
                              $this->redirect(array('index'));
                            }
                            
                               
				
                        }
                    }
		}

		$this->render('update',array(
			'admission'=>$admission,'student'=>$student,'person'=>$person
		));
	}
        
        
    public function actionUpdateFromSearch($id)
	{
                    
            $sql = "SELECT \"studentID\", \"sectionName\", \"batchName\", \"programmeCode\"
                        FROM public.tbl_p_admission
                        WHERE \"studentID\" ='{$id}'";
  
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            $admission=  Admission::model()->findByPk(array('studentID'=>$id,'sectionName'=>$rows[0]["sectionName"],'batchName'=>$rows[0]["batchName"],'programmeCode'=>$rows[0]["programmeCode"]));
          
            $student= Student::model()->findByPk($id);
            $person= Person::model()->findByPk($student->personID);
                //$firstName = $person->per_firstName;
                //$lastName = $person->per_lastName;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
       
		if(isset($_REQUEST['Admission'],$_REQUEST['Student'],$_REQUEST['Person']))
		{
          //  echo var_dump($_REQUEST['Person']["per_lastName"]);
            //exit(0);
                
                  if((($_REQUEST['Person']["per_firstName"] == $person->per_firstName) && ($_REQUEST['Person']["per_lastName"] == $person->per_lastName)) || (yii::app()->user->getState('role')==='super-admin'))
                  {
                  
                    CActiveForm::validate($person);
                    CActiveForm::validate($admission);
                    CActiveForm::validate($student);
                    //echo var_dump($_REQUEST['Person']); exit();
			$admission->attributes=$_REQUEST['Admission'];
                        $student->attributes=$_REQUEST['Student'];
                        $person->attributes=$_REQUEST['Person'];
                        
                       $admission->waiverID = $_REQUEST['Admission']['waiverID'];
                       
                      // echo  $admission->adm_date; exit();
                       
                        if($person->validate() && $student->validate() && $admission->validate()  )
                        {
                            
                            $fileName=$student->studentID.'.jpg';
                            
                            if(move_uploaded_file($_FILES['photograph']['tmp_name'], './photograph/'.$fileName))
                            {        
                                $person->ex_per_image=1;
                                //Yii::app()->request->baseUrl.
                                $file = new File('./photograph');
                                //$file->createTmb($filename);
                                $file->imageResize($fileName);
                                
                            }
                            
                            if($admission->save() && $student->save() && $person->save())
                            {	
                            
                               
                               
                              $this->redirect(array('index'));
                            }
                            
                               
				
                        }
                    }
		}

		$this->render('update',array(
			'admission'=>$admission,'student'=>$student,'person'=>$person
		));
	}            

        /**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_REQUEST['returnUrl']) ? $_REQUEST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionAdmin()
	{
            
            if(isset($_REQUEST['sectionName']))
            {
                yii::app()->session['batName']=substr($_REQUEST['sectionName'], '-',-2);
                yii::app()->session['secName']=substr($_REQUEST['sectionName'], -1);
            }
            
                    $proCode=yii::app()->session['proCode'];
                    $batName=yii::app()->session['batName'];
                    $secName=yii::app()->session['secName'];
                    
                    $condition = "sectionName='{$secName}' and batchName='{$batName}' and programmeCode='{$proCode}'";
                
		$dataProvider=new CActiveDataProvider('Admission', array(
                'criteria'=>array('condition'=>$condition),
                'pagination'=>array('pageSize'=>25,)
                 ));
                
		
		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex($sid=null,$bid=null,$pid=null)
	{
		
                if(!$sid && !$bid && !$pid)
                {
                    if(isset($_REQUEST['sectionName']))
                    {
                        $split = array();
                        $split= explode('-', $_REQUEST['sectionName']);
                        //echo $split[0];
                        //exit();
                        $sid = yii::app()->session['secName']=$split[1];
                        $bid = yii::app()->session['batName']=$split[0];
                        $pid = yii::app()->session['proCode'];
                    }
                    else {
                        $sid = yii::app()->session['secName'];
                        $bid = yii::app()->session['batName'];
                        $pid = yii::app()->session['proCode'];
                    }
                }
                else
                {
                    yii::app()->session['secName']=$sid;
                    yii::app()->session['batName']=$bid;
                    yii::app()->session['proCode']=$pid;
                }
           
                yii::app()->session['section'] = $sid;
                yii::app()->session['batch'] =   $bid.FormUtil::getBatchNameSufix($bid);
                $bat = Batch::model()->findByPk(array('batchName'=>$bid,'programmeCode'=>$pid));
              //  echo $bat->bat_term;
                yii::app()->session['academicTerm'] =   FormUtil::getTerm($bat->bat_term)." ".$bat->bat_year ;
                $pro = Programme::model()->findByPk($pid);
                yii::app()->session['programme'] = $pro->programmeCode.":".$pro->pro_name;
                
                $model=new Admission('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Admission']))
			$model->attributes=$_GET['Admission'];

                
            
             
                
		$this->render('index',array(
			'model'=>$model,
		));
	}


        public function actionReAdmission()
	{
            
            if(isset($_REQUEST['studentID']))
            {
                yii::app()->session['studentID']=$_REQUEST['studentID'];
                
            }   
                
            
                $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID']),"ex_adm_active=true");
               
                if(isset($admission))
                {
                    
                    
                    $student = Student::model()->findByPk($admission->studentID);
                    $person = Person::model()->findByPk($student->personID);
                            /*
                            yii::app()->session['studentName'] = $person->per_title." ".$person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['acTerm'] = $student->stu_academicTerm;
                            yii::app()->session['acYear'] = $student->stu_academicYear;
                            yii::app()->session['proCode'] = $admission->programmeCode;
                            yii::app()->session['batName'] = $admission->batchName;
                            yii::app()->session['secName'] = $admission->sectionName;*/
                   /* 
                    if(FormUtil::batchFlag($batch->bat_term, $batch->bat_year, yii::app()->session['traTerm'], yii::app()->session['traYear']))
                    {
                         
                        
                    }
                    else
                    { 
            
                        Yii::app()->user->setFlash('warning','Current Term can not be previous than batch\'s start term!!!');
                        $this->redirect(array('index'));                
                    }
                    */
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('studentsInfo'));                
                }
            
                
            
                    
            $this->render('_reAdmissionForm',array(
			 'person'=>$person,'student'=>$student,'admission'=>$admission,
                    ));
                
              
	}

        public function actionCreateReAdmission()
	{
            
                if(isset($_REQUEST['dateOfBirth'],$_REQUEST['per_dateOfBirth']) && ($_REQUEST['dateOfBirth']==$_REQUEST['per_dateOfBirth']))
                {
                    $tad=  TermAdmission::model()->findByAttributes(array('studentID'=>$_REQUEST['studentID'],'tra_term'=>$_REQUEST['startTerm'],'tra_year'=>$_REQUEST['startYear']));
                    
                    if(isset($tad))
                    {
                        if($tad->termAdmissionID)
                        {
                            $reg = ModuleRegistration::model()->findAllByAttributes(array('termAdmissionID'=>$tad->termAdmissionID));
                            $count = count($reg);
                            $msg = "Current Term Admission, and {$count} courses has been deleted!!";
                            
                            if($count>0)
                            {
                                $sql= "DELETE FROM public.tbl_s_moduleregistration where \"termAdmissionID\"={$tad->termAdmissionID};";
                              //  echo $sql;
                                    Yii::app()->db->createCommand($sql)->execute(); 
                            }


                            $sql= "DELETE FROM public.tbl_q_termadmission where \"termAdmissionID\"={$tad->termAdmissionID};";
                           // echo $sql;
                             Yii::app()->db->createCommand($sql)->execute(); 
                            Yii::app()->user->setFlash('warning',$msg);
                        }
                    }
                    
                    $_REQUEST['adm_status']=$_REQUEST['adm_status']+1;
                    
                    $oldRemarks = $_REQUEST['adm_remarks']." --  Changed To: Batch:".$_REQUEST['newBatchName']." on ".date('d-m-Y');
                    
                    
                    $split = array();
                    $split = explode("-", $_REQUEST['newBatchName']);
                    
                    
                    //echo $_REQUEST['batchName'];
                    if($split[3]==1)
                    {
                        $expireTerm=3;
                        $expireYear= $split[4]+6;
                    }
                    elseif ($split[3]==2)
                    {
                        $expireTerm=1;
                        $expireYear= $split[4]+7;
                    }
                    elseif ($split[3]==3)
                    {
                        $expireTerm=2;
                        $expireYear= $split[4]+7;
                    }
                    
                    
                    $sql="UPDATE tbl_p_admission SET adm_remarks='{$oldRemarks}', ex_adm_active=false
                    WHERE \"studentID\"='{$_REQUEST['studentID']}' and \"sectionName\"='{$_REQUEST['sectionName']}' and \"batchName\"={$_REQUEST['batchName']} and \"programmeCode\"='{$_REQUEST['programmeCode']}';";
                    
                    $sql2= " INSERT INTO tbl_p_admission(
                    \"studentID\", \"sectionName\", \"batchName\", \"programmeCode\", \"adm_startTerm\",\"adm_startYear\",  
                     \"adm_expireTerm\", \"adm_expireYear\",adm_remarks, ex_adm_active, adm_status)
                    VALUES ('{$_REQUEST['studentID']}','{$split[0]}',{$split[1]},'{$split[2]}',{$_REQUEST['startTerm']},{$_REQUEST['startYear']},{$expireTerm},{$expireYear},'{$_REQUEST['remarks']}',true,{$_REQUEST['adm_status']});";

    //echo $sql;
    
                    if(Yii::app()->db->createCommand($sql)->execute() && Yii::app()->db->createCommand($sql2)->execute())
                    {
                        Yii::app()->user->setFlash('success','Re-admission successfull of ID:'.$_REQUEST['studentID']);
                        $this->redirect(array('studentsInfo'));                
                    
                    }
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('reAdmission'));                
                }
              
	}
        
        
        public function actionGetNewSection()
        {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if(isset($_REQUEST['programmeCode']))
		{
                    $split=array();
                    $split = explode('-', $_REQUEST['batchName3']);
		
                    $model = Section::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode'],'batchName'=>$split[0]));
                 
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No Section Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                        
                        //$model=CHtml::listData($model,'batchName','batchName');
                        
                        foreach($model as $item)
                        {
                            
                    
                              
                                echo CHtml::tag('option',array('value'=>$item->sectionName),CHtml::encode($item->sectionName),true);
                    
                    
                            
                        
                            
                        }

                    }  
                   
                }
                
                
        }

        
         public function actionSectionTransfer()
	{
           
            if(isset($_REQUEST['programmeCode']))
            {
                yii::app()->session['stfProCode']= $_REQUEST['programmeCode'];
                
                $split= array();
                $split = explode('-', $_REQUEST['batchName3']);
                
                yii::app()->session['stfBatName']=$split[0];
                yii::app()->session['stfSecName']=$split[1];
                yii::app()->session['stfNewSecName']=$_REQUEST['newSection'];
                yii::app()->session['stfTerm']=$_REQUEST['stfTerm'];
                yii::app()->session['stfYear']=$_REQUEST['stfYear'];
                
            }
            
            $proCode= yii::app()->session['stfProCode'];
            $batName= yii::app()->session['stfBatName'];
            $secName= yii::app()->session['stfSecName'];
            //$newSecName= yii::app()->session['stfNewSecName'];
            
            
            
                $dataProvider = Admission::model()->search($secName,$batName,$proCode);
                
            if(yii::app()->session['stfSecName']!=yii::app()->session['stfNewSecName'])
            {
            $this->render('_sectionTransferForm',array(
                    'dataProvider'=>$dataProvider
                    ));
            }
            else
            {
                Yii::app()->user->setFlash('warning','You have selected same section for both select box!!!');
                $this->redirect(array('admission/studentsInfo'));
                
            }
              
	}

        public function actionChangeSection()
        {
            //echo "Bismillah Hi Rahmanir Rahim.";
            
                $proCode= yii::app()->session['stfProCode'];
                $batName= yii::app()->session['stfBatName'];
                $secName= yii::app()->session['stfSecName'];
    
                $newSecName= yii::app()->session['stfNewSecName'];
                $curTerm = yii::app()->session['stfTerm'];
                $curYear = yii::app()->session['stfYear'];
               // echo $curYear;
                
                if(isset($_POST['offered']))
                {
                       
                    foreach ($_POST['offered'] as $item)
                    {
                        
                        $oldRemarks = " --  Changed From: section:{$secName} on ".date('d-m-Y')."----";
                        //--------------update the section in tbl_p_admission------//
                        $sqlAd="UPDATE tbl_p_admission SET adm_remarks='{$oldRemarks}', \"sectionName\"='{$newSecName}'
                        WHERE \"studentID\"='{$item}' and \"sectionName\"='{$secName}' and \"batchName\"={$batName} and \"programmeCode\"='{$proCode}';";
                    
                        //--------------
                         //echo $sqlAd."<br/>";
                       Yii::app()->db->createCommand($sqlAd)->queryAll();
                       
                       
                        $tra = TermAdmission::model()->findByAttributes(array('tra_term'=>$curTerm,'tra_year'=>$curYear,'studentID'=>$item,'batchName'=>$batName,'programmeCode'=>$proCode));
                        
                       
                        if(count($tra))
                        {
                                //-----------delete module registration-------
                            if(count(ModuleRegistration::model()->findAllByAttributes(array('termAdmissionID'=>$tra->termAdmissionID))))
                            {
                                $sqlMreg= "DELETE FROM tbl_s_moduleregistration WHERE \"termAdmissionID\"={$tra->termAdmissionID};";
                        
                               // echo $sqlMreg."<br/>";
                                Yii::app()->db->createCommand($sqlMreg)->queryAll();
                                
                                $ofm = Offeredmodule::model()->findAllByAttributes(array('ofm_term'=>$curTerm,'ofm_year'=>$curYear,'sectionName'=>$newSecName,'batchName'=>$batName,'programmeCode'=>$proCode));
                                $markingScheme = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true));
                                $exam = Examination::model()->findByAttributes(array('exm_examTerm'=>$curTerm,'exm_examYear'=>$curYear,'exm_type'=>1));
                                foreach ($ofm as $ofmItem)
                                {
                                    $sqlMregInsert = "Select sp_insertmoduleregistration({$markingScheme->markingSchemeID}, {$ofmItem->offeredModuleID}, {$tra->termAdmissionID}, {$exam->examinationID});";
                               //     echo $sqlMregInsert."<br/>";
                                    Yii::app()->db->createCommand($sqlMregInsert)->queryAll();
                                }
                            }
                        }
                        
                        
                        
                    }
                    
                    Yii::app()->user->setFlash('success','Section transfer success!!');
                }
                 
                
                
             
            
                
            
            //$dataProvider = Admission::model()->search($secName,$batName,$proCode);
                
            
                    
           // $this->redirect(array('headsfunction/sectionTransfer'));
                            $dataProvider = Admission::model()->search($secName,$batName,$proCode);
            $this->renderPartial('_sectionTransferForm2',array(
                    'dataProvider'=>$dataProvider
                    ));

        //echo $sql;
        }

        
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id )
	{
		$admission=  Admission::model()->findByPk($id);
		if($admission===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $admission;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
            
	//	if(isset($_REQUEST['ajax']) && $_REQUEST['ajax']==='admission-form')
	//	{
                   // echo "Bismillah Hir Rahmanur Rahim";
			echo CActiveForm::validate($model);
			Yii::app()->end();
	//	}
	}
        
        
         public function actionAdmissionFormPDF($id)
	{
                 //echo $student->personID;
		
                      $session=new CHttpSession;
                  $session->open();
                  require_once(Yii::app()->params['tcpdf']);
	          require_once(Yii::app()->params['tcpdfConf']);          
              
                Yii::import('application.modules.admin.extensions.bootstrap.*');
                $html =  realpath(__DIR__ . '/../extensions/bootstrap/assets/bootstrap/css.').'/style.css';
               
                $pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$student=Student::model()->findByPk($id);
                
                $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Admission Form');
		$pdf->SetSubject('');
                $pdf->SetPrintHeader(false);		
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Transcript",'');
		$pdf->setHeaderFont(Array('helvetica', '', 25));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, 10, 20);
		$pdf->SetHeaderMargin(15);                
		$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('dejavusans', '', 10);               
                $this->renderPartial('_admissionFormPDF', array(
                            'admission'=>Admission::model()->findByPk(array('studentID'=>$id,'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'])),
                            'id'=>$id,
                            'student'=> $student,
                            'person'=> Person::model()->findByPk($student->personID), 
                            'pdf'=>$pdf,
                            'html'=>$html,
                        ), true);
                
                $fileName = 'Admission Form';
                $pdf->Output($fileName.'pdf', "I");
	}
        
        
        public function actionAdmissionRegister()
        {
                if(isset($_REQUEST['admissionTerm'],$_REQUEST['admissionYear']))
                {
                    
                    yii::app()->session['admissionTerm']=$_REQUEST['admissionTerm'];
                    yii::app()->session['admissionYear']=$_REQUEST['admissionYear'];                    
                    
                    
                }     
              yii::app()->session['admissionTerm']=1;
              yii::app()->session['admissionYear']=2015;
                Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                $model = new Admission();
		                 
                $dataProvider = $model->searchAllAdmissionRegister(yii::app()->session['admissionTerm'],yii::app()->session['admissionYear']);
               // $title = FormUtil::getTermYear(yii::app()->session['eligableTerm'], yii::app()->session['eligableYear']);
               // $author ='Office of the Controller of Examination';
               $title ='Admission Register'; 
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);
                
                $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                
                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Admission Office');
                $pdf->SetTitle($title);
                $pdf->SetSubject('');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

                // set default header data
                $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title.' ', 'Admission Office', array(0,64,255), array(0,64,128));
                //$pdf->setFooterData(array(0,64,0), array(0,64,128));

                // set header and footer fonts
                $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                // set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                // set margins
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                // set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                // set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                // set some language-dependent strings (optional)
                if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                    require_once(dirname(__FILE__).'/lang/eng.php');
                    $pdf->setLanguageArray($l);
                }

                // ---------------------------------------------------------

                // set default font subsetting mode
                $pdf->setFontSubsetting(true);

                // Set font
                // dejavusans is a UTF-8 Unicode font, if you only need to
                // print standard ASCII chars, you can use core fonts like
                // helvetica or times to reduce file size.
                $pdf->SetFont('dejavusans', '', 12, '', true);

                // Add a page
                // This method has several options, check the source code documentation for more information.
                $pdf->AddPage();

                // set text shadow effect
                //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

                // Set some content to print                                
                $html = $this->renderPartial('_admissionRegisterPDF',array('pdf'=>$pdf,'dataProvider'=>$dataProvider,),true);
                /*$this->render('_admissionRegisterPDF',array(
			'dataProvider'=>$dataProvider
                    ));*/
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                
                // ---------------------------------------------------------

                // Close and output PDF document
                // This method has several options, check the source code documentation for more information.
                $pdf->Output('example_001.pdf', 'I');
        }
        
        
        
        public function actionObsulateCourseRegistration()
        {
              $admission = new Admission();
               if(isset($_REQUEST['studentID'], $_POST['traYear'] , $_POST['traTerm']))
                {
                        yii::app()->session['traYear']=$_REQUEST['traYear'];
                        yii::app()->session['traTerm']=$_REQUEST['traTerm'];
                        yii::app()->session['studentID']=$_REQUEST['studentID'];
           
              $dataProvider = $admission->searchOldSyllabusCourse($_REQUEST['studentID']);//,$rows[0]["sectionName"],$rows[0]["batchName"],$rows[0]["programmeCode"]);
             
              
              $sql= "SELECT \"sectionName\", \"batchName\", \"programmeCode\" FROM tbl_p_admission  WHERE \"studentID\"='{$_REQUEST['studentID']}' ORDER BY \"batchName\" ";
              $rows = Yii::app()->db->createCommand($sql)->queryAll();     
            
              $this->render('courseList',array('dataProvider'=>$dataProvider,'id'=>$_REQUEST['studentID'],'sectionName'=>$rows[0]["sectionName"],'batchName'=>$rows[0]["batchName"],'programmeCode'=>$rows[0]["programmeCode"],'flag'=>true));
             
            
            }
        }
       
        public function actionGetObsulateCourse()
        {
            
             if(isset($_REQUEST['moduleCode']))
             {
              $id = yii::app()->session['studentID'];
              $term =  yii::app()->session['traTerm'];
              $year = yii::app()->session['traYear'];
              $markingSchemeID = 1;
              
              $offeredModuleID = $_REQUEST['moduleCode'];
              $sql = "SELECT t.\"termAdmissionID\" FROM public.tbl_q_termadmission t 
                  WHERE t.\"studentID\" = '{$id}' AND  t.tra_term = {$term} AND t.tra_year = {$year};";
            
             
              $rows2 = Yii::app()->db->createCommand($sql)->queryAll();     
              $termAdmissionID = $rows2[0]['termAdmissionID'];
              $sql ="SELECT e.\"examinationID\" FROM public.tbl_t_examination e 
                    WHERE e.\"exm_examTerm\" ={$term}  AND e.\"exm_examYear\" = {$year} AND e.exm_type =1";
              $rows3 = Yii::app()->db->createCommand($sql)->queryAll();        
              $examinationID = $rows3[0]['examinationID'];
    
             if($offeredModuleID != null && $termAdmissionID !=null && $examinationID !=null){
                
                  $sql=" SELECT sp_insertmoduleregistration({$markingSchemeID},{$offeredModuleID},{$termAdmissionID},{$examinationID}); ";                                                                      //e
                  Yii::app()->db->createCommand($sql)->execute();
               
                  $sql ="SELECT s.\"moduleRegistrationID\" FROM public.tbl_s_moduleregistration s WHERE 
                          s.\"termAdmissionID\" ={$termAdmissionID}  AND s.\"offeredModuleID\" ={$offeredModuleID}";
                  $rows = Yii::app()->db->createCommand($sql)->queryAll();     
                  $sql="UPDATE tbl_s_moduleregistration SET reg_type= 2
                        WHERE \"moduleRegistrationID\"= {$rows[0]['moduleRegistrationID']}";                                                                      //e
                  Yii::app()->db->createCommand($sql)->execute();     
                                
             }
             else
             {
                 Yii::app()->user->setFlash('warning','Something wrong, please check!!');
                 $this->redirect(array('studentsInfo'));   
             }
              Yii::app()->user->setFlash('success','Module Saved Successfully');
              $this->redirect(array('studentsInfo'));   
             }
            
        }  
        
        public function actionAllInOne()
	{
		
                if(isset($_POST['aioYear'] , $_POST['aioTerm']))
                {
                        yii::app()->session['aioYear']=$_REQUEST['aioYear'];
                        yii::app()->session['aioTerm']=$_REQUEST['aioTerm'];

                }
                //echo FormUtil::batchFlag(2, 2013, 3, 2012);
                //$data = array();
                         $data = Admission::searchAdmission();
           //print_r($data);     
                
                
                $this->render('allInOne',array(
			'data'=>$data,
		));
	}
        
}
