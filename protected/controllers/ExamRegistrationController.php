<?php

class ExamRegistrationController extends Controller
{
	

	// Uncomment the following methods and override them if needed
	//public $layout='//layouts/column2';
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
            
            $rules= array();

            
            
            if(yii::app()->user->getState('role')==='super-admin')
            {
                $rules = array('admin','examRegistration','register','AdmitCardIndex','AdmitCardIssue','ExamRegisteredList','GetBatch','GetProgramme','SelectModule','cancelAdmitPrint','GeneratePdf','GenerateExcel','GetProgrammeCode','getRegisteredModule','GetRegModuleMarksList','saveMarks','SaveFinal','generateFirstHalfPDF','reportTabulation','saveTest','GenerateAdmitCardPDF','GenerateRegisterPDF','GenerateSignatureSheetPDF','suppleRegistration','ERSgetModules','ERSgetStudentID','registerSuppleExam','ExamRegisteredSuppleList','delete','ERExamRegistrationSupple','GenerateGradeSheet','Supplementary','SaveSuppleRegistration','SuppleRegList','DeleteSuppleRegistration','supplementaryPDF','individualAdmitCardIssue','generateAdmitCard');
	    }
            elseif(yii::app()->user->getState('role')==='admin')
            {
		$rules = array('admin','examRegistration','register','AdmitCardIndex','AdmitCardIssue','ExamRegisteredList','GetBatch','GetProgramme','SelectModule','cancelAdmitPrint','GeneratePdf','GenerateExcel','GetProgrammeCode','getRegisteredModule','GetRegModuleMarksList','saveMarks','SaveFinal','generateFirstHalfPDF','reportTabulation','saveTest','GenerateAdmitCardPDF','GenerateRegisterPDF','GenerateSignatureSheetPDF','suppleRegistration','ERSgetModules','ERSgetStudentID','Supplementary','SaveSuppleRegistration','SuppleRegList','DeleteSuppleRegistration','supplementaryPDF','ERExamRegistrationSupple');
	    }
            elseif(yii::app()->user->getState('role')==='head')
            {
		$rules = array('admin','examRegistration','register','AdmitCardIndex','AdmitCardIssue','ExamRegisteredList','GetBatch','GetProgramme','SelectModule','cancelAdmitPrint','GeneratePdf','GenerateExcel','GetProgrammeCode','getRegisteredModule','GetRegModuleMarksList','saveMarks','SaveFinal','generateFirstHalfPDF','reportTabulation','saveTest','GenerateAdmitCardPDF','GenerateRegisterPDF','GenerateSignatureSheetPDF','suppleRegistration','ERSgetModules','ERSgetStudentID','Supplementary','SaveSuppleRegistration','SuppleRegList','DeleteSuppleRegistration','supplementaryPDF');
	    }
            elseif(yii::app()->user->getState('role')==='coordinator')
            {
		$rules = array('admin','examRegistration','register','AdmitCardIndex','AdmitCardIssue','ExamRegisteredList','GetBatch','GetProgramme','SelectModule','cancelAdmitPrint','GeneratePdf','GenerateExcel','GetProgrammeCode','getRegisteredModule','GetRegModuleMarksList','saveMarks','SaveFinal','generateFirstHalfPDF','reportTabulation','saveTest','GenerateAdmitCardPDF','GenerateRegisterPDF','GenerateSignatureSheetPDF','suppleRegistration','ERSgetModules','ERSgetStudentID','registerSuppleExam','ExamRegisteredSuppleList','delete','deleteSupple','ERSexamRegistrationSupple',);
	    }
            elseif(yii::app()->user->getState('role')==='faculty')
            {
		$rules =array('admin','examRegistration','register','AdmitCardIndex','AdmitCardIssue','ExamRegisteredList','GetBatch','GetProgramme','SelectModule','cancelAdmitPrint','GeneratePdf','GenerateExcel','GetProgrammeCode','getRegisteredModule','GetRegModuleMarksList','saveMarks','SaveFinal','generateFirstHalfPDF','reportTabulation','saveTest','GenerateAdmitCardPDF','GenerateRegisterPDF','GenerateSignatureSheetPDF','suppleRegistration','ERSgetModules','ERSgetStudentID','registerSuppleExam','ExamRegisteredSuppleList','delete','deleteSupple','ERSexamRegistrationSupple',);
	    }
            elseif(yii::app()->user->getState('role')==='exam')
            {
		$rules = array('admin','examRegistration','register','AdmitCardIndex','AdmitCardIssue','ExamRegisteredList','GetBatch','GetProgramme','SelectModule','cancelAdmitPrint','GeneratePdf','GenerateExcel','GetProgrammeCode','getRegisteredModule','GetRegModuleMarksList','saveMarks','SaveFinal','generateFirstHalfPDF','reportTabulation','saveTest','GenerateAdmitCardPDF','GenerateRegisterPDF','GenerateSignatureSheetPDF','registerSuppleExam','ExamRegisteredSuppleList','delete','ERExamRegistrationSupple','GenerateGradeSheet','Supplementary','SaveSuppleRegistration','SuppleRegList','DeleteSuppleRegistration','supplementaryPDF','individualAdmitCardIssue','generateAdmitCard');
            }
            elseif(yii::app()->user->getState('role')==='registry')
            {
        	$rules = array();
	    }
            elseif(yii::app()->user->getState('role')==='admission')
            {
		//$rules = array();
               	$rules = array('admin','examRegistration','register','AdmitCardIndex','AdmitCardIssue','ExamRegisteredList','GetBatch','GetProgramme','SelectModule','cancelAdmitPrint','GeneratePdf','GenerateExcel','GetProgrammeCode','getRegisteredModule','GetRegModuleMarksList','saveMarks','SaveFinal','generateFirstHalfPDF','reportTabulation','saveTest','GenerateAdmitCardPDF','GenerateRegisterPDF','GenerateSignatureSheetPDF','registerSuppleExam','ExamRegisteredSuppleList','delete','ERExamRegistrationSupple','GenerateGradeSheet','Supplementary','SaveSuppleRegistration','SuppleRegList','DeleteSuppleRegistration','supplementaryPDF');
        
	    }
            elseif(yii::app()->user->getState('role')==='deo')
            {
		$rules = array('admin','examRegistration','register','AdmitCardIndex','AdmitCardIssue','ExamRegisteredList','GetBatch','GetProgramme','SelectModule','cancelAdmitPrint','GeneratePdf','GenerateExcel','GetProgrammeCode','getRegisteredModule','GetRegModuleMarksList','saveMarks','SaveFinal','generateFirstHalfPDF','reportTabulation','saveTest','GenerateAdmitCardPDF','GenerateRegisterPDF','GenerateSignatureSheetPDF','registerSuppleExam','ExamRegisteredSuppleList','delete','ERExamRegistrationSupple','GenerateGradeSheet','Supplementary','SaveSuppleRegistration','SuppleRegList','DeleteSuppleRegistration','supplementaryPDF');
	    }
            else
            {
                    $rules=array('');
            }
            
            
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','SerStudentInfo'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>$rules,
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
                    
		);
            
	}

	public function actionIndex()
	{
            
                if(isset($_REQUEST['exrYear'] , $_REQUEST['exrTerm']))
                {
                        yii::app()->session['exrYear']=$_REQUEST['exrYear'];
                        yii::app()->session['exrTerm']=$_REQUEST['exrTerm'];
                        yii::app()->session['exrType']=$_REQUEST['exrType'];
                        
                }
       
                $examinationID = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['exrType'],'exm_examTerm'=>yii::app()->session['exrTerm'],'exm_examYear'=>yii::app()->session['exrYear']))->examinationID;
                yii::app()->session['examinationID']=$examinationID;
                if($examinationID)
                {        
                    if(yii::app()->session['exrType']==1)
                    {
                        $data = TermAdmission::searchTermAdmission(yii::app()->session['exrTerm'],yii::app()->session['exrYear']);



                        $this->render('index',array(
                            'data'=>$data,
                        ));
                    }
                    else
                    {
                        $this->redirect(array('ExamRegistration/ERExamRegistrationSupple'));
                    }
                }
                else
                {
                   Yii::app()->user->setFlash('warning','No Examination Found for selected term. please create Examination first !!!');
                    $this->redirect(array('ExamDepartment/index'));                 
                }
	}  
        
    
            
        public function actionExamRegistration()
	{
            
            if(isset($_REQUEST['studentID']))
            {
                yii::app()->session['exrStudentID']=$_REQUEST['studentID'];
                
            }   
                
                $traAdmission = TermAdmission::model()->findByAttributes(array('studentID'=>yii::app()->session['exrStudentID'],'tra_term'=>yii::app()->session['exrTerm'],'tra_year'=>yii::app()->session['exrYear']));
                
                if($traAdmission)
                {
                            
                            
                            $student = Student::model()->findByPk($traAdmission->studentID);
                            $person = Person::model()->findByPk($student->personID);
                            
                            
                            yii::app()->session['exrStudentName'] = $person->per_title." ".$person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['exrAcTerm'] = $student->stu_academicTerm;
                            yii::app()->session['exrAcYear'] = $student->stu_academicYear;
                            yii::app()->session['exrProCode'] = $traAdmission->programmeCode;
                            yii::app()->session['exrBatName'] = $traAdmission->batchName;
                            yii::app()->session['exrSecName'] = $traAdmission->sectionName;
           
                            if(!$traAdmission->tra_finalExamRegistred)
                            {
                                $moduleReg = new ModuleRegistration();

                                $data=$moduleReg->searchByTermAdmissionID($traAdmission->termAdmissionID);

                                $this->render('examRegistration',array('view'=>'_registeredModules',
                                'model'=>$traAdmission, 'dataProvider'=>$data,'flag'=>'true',
                                ));
                            }
                            else
                            {
                                Yii::app()->user->setFlash('warning','The ID: '.$traAdmission->studentID.' is already in Exam Registered List !!!');
                                $this->redirect(array('index'));                
                            }
                    
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','No Module Registered For this ID !!!');
                    $this->redirect(array('index'));                
                }
            
                
                
                
              
	}
        
        
        
        public function actionRegister()
	{
                //echo "Bismillah Hir Rahmanir Rahim. ";
               
            if(isset($_REQUEST['termAdmissionID']))
            {
                        
             
                        
               //echo $_REQUEST['studentID'];
                            
                            $sql ="UPDATE tbl_q_termadmission SET
                                \"tra_finalExamRegistred\"=true, \"tra_finalExamRegDate\"= now() 
                                WHERE \"termAdmissionID\"={$_REQUEST['termAdmissionID']}; "; 


                            if(Yii::app()->db->createCommand($sql)->execute())
                            {
                            //echo "Alhamdulilah!!";
                            
                                
                                
                                Yii::app()->user->setFlash('success','Alhamdulilah!! Exam Has Been Registred Successfully For: <strong>'.$_REQUEST['studentID'].'</strong>!!!');
                                
				$this->redirect(array('examRegistration/index'));
                           }
            }                 
                    
                    //unset($_POST['offered']);
                    //$dataProvider = $model->search(Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']))->syllabusCode,yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['secNameOfm']);
                    
                    //$this->renderPartial('_notRegistredModule');
                    
                    
	}
        
        public function actionExamRegisteredList()
        {
            
            if(isset($_REQUEST['programmeCode']))
            {
                yii::app()->session['exrProCode']=$_REQUEST['programmeCode'];
                yii::app()->session['exrTerm']=$_REQUEST['exrTerm'];
                yii::app()->session['exrYear']=$_REQUEST['exrYear'];
            }
                
                $model = new TermAdmission();
                $dataProvider = $model->searchExamRegisteredList(yii::app()->session['exrProCode'],yii::app()->session['exrTerm'],yii::app()->session['exrYear']);
                    
                $this->render('ExamRegisteredList',array('dataProvider'=>$dataProvider));
            
        }
        
        public function actionExamRegisteredSuppleList()
        {
            
            if(isset($_REQUEST['programmeCode']))
            {
                yii::app()->session['exrProCode']=$_REQUEST['programmeCode'];
                yii::app()->session['exrTerm']=$_REQUEST['exrTerm'];
                yii::app()->session['exrYear']=$_REQUEST['exrYear'];
            }
                
                $model = new TermAdmission();
                $dataProvider = $model->searchExamRegisteredSuppleList(yii::app()->session['exrProCode'],yii::app()->session['exrTerm'],yii::app()->session['exrYear']);
                    
                $this->render('ExamRegisteredSuppleList',array('dataProvider'=>$dataProvider));
            
        }
        
        public function actionAdmitCardIndex($id=null)
        {
            if(isset($id))
            {
                yii::app()->session['aciExamType']=$id;
            }
           $this->render('admitCardIndex');
            
        }
        
        public function actionAdmitCardIssue()
        {
            if(isset($_REQUEST['programmeCode']))
            {
                yii::app()->session['aciTerm']=$_REQUEST['aciTerm'];
                yii::app()->session['aciYear']=$_REQUEST['aciYear'];
            
                yii::app()->session['aciProCode']=$_REQUEST['programmeCode'];
              
                yii::app()->session['aciBatName']=$_REQUEST['batchName'];
               //exit();
            }
            
                $model = new ExamRegistration();
                $dataProvider = $model->searchExamRegisteredList(yii::app()->session['aciBatName'],yii::app()->session['aciProCode'],yii::app()->session['aciTerm'],yii::app()->session['aciYear']);
                    
                $this->render('admitCardIssuedList',array('view'=>'_admitCardNotIssuedList','dataProvider'=>$dataProvider));
            
        }
        
        public function actionGetProgramme()
        {
            
            if(isset($_REQUEST['aciYear'],$_REQUEST['aciTerm']))
		{
                    yii::app()->session['aciTerm']=$_REQUEST['aciTerm'];
                    yii::app()->session['aciYear']=$_REQUEST['aciYear'];
                    
                   // echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                    
                    $model = Department::model()->findAll();
                 
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
                            echo $item->departmentID;
                            echo "<optgroup label='{$item->dpt_name}'>";
                            foreach(Programme::model()->findAllByAttributes(array('departmentID'=>$item->departmentID)) as $item2)
                            {
                                //$sectionName="Section ".$item2->batchName.FormUtil::getBatchNameSufix($item2->batchName)." ".$item2->sectionName."    -- ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year." --";
                                echo CHtml::tag('option',array('value'=>$item2->programmeCode),CHtml::encode($item2->pro_name),true);
                            }
                            echo"</optgroup>";
                            
                        
                            
                        }

                    }  
                   
                }
        }

        public function actionGetBatch()
        {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if(isset($_REQUEST['programmeCode']))
		{
                    yii::app()->session['aciTerm']=$_REQUEST['aciTerm'];
                    yii::app()->session['aciYear']=$_REQUEST['aciYear'];
                    
                    $model = ExamRegistration::searchBatchInTermAdmission(yii::app()->session['aciTerm'], yii::app()->session['aciYear'], $_REQUEST['programmeCode']);
                    
                    if(count($model)<0)
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
                            //$batchName="---".$itembatchName.FormUtil::getBatchNameSufix($item->batchName)." Batch---";
                            //echo "<optgroup label='{$item['batchName']}'>";
                            //foreach(Section::model()->findAllByAttributes(array('batchName'=>$item->batchName,'programmeCode'=>$item->programmeCode)) as $item2)
                            //{
                                $sectionName="Batch ".$item['batchName'].FormUtil::getBatchNameSufix($item['batchName'])." ".$item['sectionName'];
                                echo CHtml::tag('option',array('value'=>$item['sectionName']."-".$item['batchName']),CHtml::encode($sectionName),true);
                            //}
                //            echo"</optgroup>";
                            
                        
                            
                        }

                    }  
                   
                }
                
                
        }
        
        public function actionERSgetModules()
        {
             
            if(isset($_REQUEST['programmeCode']))
            {
                yii::app()->session['exrProCode']=$_REQUEST['programmeCode'];
                
            }
                    $sql="SELECT 
                            h.\"offeredModuleID\", 
                            h.\"moduleCode\", 
                            h.\"batchName\",
                            h.\"sectionName\",
                            e.mod_name, 
                            e.mod_group
                          FROM 
                            {{e_module}} as e, 
                            {{h_offeredmodule}} as h
                          WHERE 
                            e.\"moduleCode\" = h.\"moduleCode\" AND
                            e.\"syllabusCode\" = h.\"syllabusCode\" AND
                            
                            h.\"programmeCode\" = :programmeCode AND 
                            h.ofm_term = :ofm_term AND 
                            h.ofm_year = :ofm_year ";
                    
               //     echo $sql;
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':programmeCode'=>yii::app()->session['exrProCode'],':ofm_term'=>yii::app()->session['exrTerm'],':ofm_year'=>yii::app()->session['exrYear']));
                    
                    if($ofmModule)
                    {
                        $this->renderPartial('_ERSgetModules',array('ofmModule'=>$ofmModule),false,true);
                    }
                    else
                    {
                        //echo "test"; exit();
                        Yii::app()->user->setFlash('warning',' No Registered Module Found For Selected Term !!!');
                       $this->renderPartial('_noDataFound');
                    }
                    
             
        }
        /*
        public function actionERSgetStudentID()
        {
            //echo $_REQUEST['offeredModuleID']; exit();
            if(isset($_REQUEST['offeredModuleID']))
            {
                yii::app()->session['ofmID']=$_REQUEST['offeredModuleID'];
            
                
                
            }
            //echo yii::app()->session['ofmID'];
            
            $test = new OfferedModule();
            $test = $test::model()->findByPk(yii::app()->session['ofmID']);
            
            $sql ="
                select distinct 
                q.\"studentID\",
                concat( q.\"termAdmissionID\",'-',s.\"moduleRegistrationID\") as \"tmID\",
                
                max(u.emr_date), 
                u.emr_absent from tbl_u_exammarks as u  
                JOIN  tbl_s_moduleregistration s  on (u.\"moduleRegistrationID\" = s.\"moduleRegistrationID\" ) 
                join tbl_q_termadmission q on (q.\"termAdmissionID\" = s.\"termAdmissionID\") 
                join tbl_h_offeredmodule h on (h.\"offeredModuleID\" = s.\"offeredModuleID\")
                where 
                ( u.emr_absent='t' or u.emr_mark<(SELECT 
                r.\"mrs_finalPass\"
              FROM 
                public.tbl_r_markingscheme r
              WHERE 
                r.ex_mrs_default = 't' )) and h.\"moduleCode\" = :moduleCode and h.\"syllabusCode\" = :syllabusCode 
                
                
            group by u.emr_date, q.\"studentID\", u.emr_absent, s.\"moduleRegistrationID\"
            , q.\"termAdmissionID\" order by q.\"studentID\" ;";
            
            $data = TermAdmission::model()->findAllBySql($sql,array(':moduleCode'=> $test->moduleCode,':syllabusCode'=>$test->syllabusCode,));
          
               // echo count($data);
            //exit();
            yii::app()->session['ofmData']=  serialize($data);
            
            //$data = array('100','200');
             $this->render('examRegistrationSuppleTwo',array('data'=>$data),false,true);
        }
*/
        public function actionRegisterSuppleExam()
        {
            //echo $_REQUEST['tmID'];
             if(isset($_REQUEST['tmID']))
             {
                 $split= array();
                 $split = explode('-', $_REQUEST['tmID']);
                  // echo $split[0];
                 //$termAdm = TermAdmission::model()->findByPk($split[0])->tra_suppleExamRegistred;
                 $examMarks= ExamMarks::model()->findByPk(array('examinationID'=>yii::app()->session['examinationID'],'moduleRegistrationID'=>$split[1]));
               
                 if($examMarks)
                 {
                    Yii::app()->user->setFlash('warning','Student ID already registared for supple exam!!!');
                 
                     $data= unserialize(yii::app()->session['ofmData']);
                     $this->render('examRegistrationSuppleTwo',array('data'=>$data)); 
                    
                 }
                 else 
                 {
                        $exmType=yii::app()->session['examinationID'];



                        //$date=date('Y-m-d');
                        $sql = "UPDATE tbl_s_moduleregistration
                               SET 
                           \"reg_suppleExamReg\"='t', 
                           \"reg_suppleExamRegDate\"=now()
                           WHERE \"moduleRegistrationID\"={$split[1]};";

                           $sql2="INSERT INTO tbl_u_exammarks(
                   \"examinationID\", \"moduleRegistrationID\",
                   emr_absent)
                   VALUES ({$exmType}, {$split[1]}, 't');";

//echo $sql2;
                       if(Yii::app()->db->createCommand($sql)->execute() && Yii::app()->db->createCommand($sql2)->execute())
                       {
                           Yii::app()->user->setFlash('success','Alhamdulilah!! Supple Exam Has Been Registred Successfully!!!');

                           $data= unserialize(yii::app()->session['ofmData']);
                           $this->render('examRegistrationSuppleTwo',array('data'=>$data)); 
                       }
                 }
             }
        }


        public function actionSelectModule()
	{
               // echo "Bismillah Hir Rahmanir Rahim. ";
 
                $model = new ExamRegistration();
                $flag=FALSE; $i=0;
                if(isset($_POST['offered']))
                {
                    
                    foreach ($_POST['offered'] as $item)
                    {
                        if($item !=1)
                        {
                            
                        
 
                            $model=$this->loadModel($item);
                            $model->tra_finalAdmitPrint=true;

                            if($model->update())
                            {
                                 $flag=true;$i++;
                            }
 
                        }    
                       
                       
                        
                    }
                    
                }
     
                if($flag==true){
                    Yii::app()->user->setFlash('success','Alhamdulillah, '.$i.' IDs successfully selected for Admit Card Printing !');
                   
                unset($_POST['offered']);    
                }
                
                
                $dataProvider = $model->searchExamRegisteredList(yii::app()->session['aciSecName'],yii::app()->session['aciBatName'],yii::app()->session['aciProCode'],yii::app()->session['aciTerm'],yii::app()->session['aciYear']);
                
                $this->renderPartial('_admitCardNotIssuedList',array('dataProvider'=>$dataProvider),false,true);
                
	}
        
        public function actionCancelAdmitPrint($id)
        {
                $model = new ExamRegistration();
                $model = $this->loadModel($id);
                $model->tra_finalAdmitPrint=false;
                $model->update();
                           
                            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                $dataProvider = $model->searchExamRegisteredList(yii::app()->session['aciSecName'],yii::app()->session['aciBatName'],yii::app()->session['aciProCode'],yii::app()->session['aciTerm'],yii::app()->session['aciYear']);
                
                $this->render('admitCardIssuedList',array('view'=>'_admitCardNotIssuedList','dataProvider'=>$dataProvider));
        }

        
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TermAdmission the loaded model
	 * @throws CHttpException
	 */
	public function loadModelTermAdmission($id)
	{
		$model=TermAdmission::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

        
                /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TermAdmission the loaded model
	 * @throws CHttpException
	 */
        
        
	public function loadModel($id)
	{
		$model= ModuleRegistration::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TermAdmission $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='term-admission-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        

        public function actionGenerateAdmitCardPDF($traID=null)         
        {
                
              Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);

                 
               
             $pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('ADMIT CARD');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, 40, '      ADMIT CARD ', ' ');

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 16));
            //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

            // set font
            $pdf->SetFont('times', '', 12);   // Add a page
               //  $pdf->AddPage();
              
            
                
                
                if($traID){
                    
                    $tra = TermAdmission::model()->findByPk($traID);
                    
                    $studentID = $tra->studentID;
                    $proCode = $tra->programmeCode;
                    $batName = $tra->batchName;
                   
                    $exmTerm = $tra->tra_term;

                    $exmYear = $tra->tra_year;
                    $exmType = 'Final';
                    yii::app()->session['aciProCode'] = $tra->programmeCode;
                    
                $sql = "SELECT DISTINCT
                        \"studentID\",\"per_name\",\"per_fathersName\",\"per_mothersName\",
                        \"stu_academicTerm\", \"stu_academicYear\"
                        FROM vw_admit_card
                        WHERE
                          \"studentID\" =:studentID AND
                          \"programmeCode\" = :proCode AND
                          \"batchName\" = :batName AND
                         
                          \"exm_examTerm\" = :exmTerm AND
                          \"exm_examYear\" = :exmYear                          
                        ORDER BY \"studentID\"";
                       $model = ExamRegistration::model()->findAllBySql($sql,array(':studentID'=>$studentID,':proCode'=>$proCode,':batName'=>$batName,':exmTerm'=>$exmTerm,':exmYear'=>$exmYear));   
                }
                else
                {
                       
                    $proCode = yii::app()->session['aciProCode'];
                    $batName = yii::app()->session['aciBatName'];
                   
                    $exmTerm = yii::app()->session['aciTerm'];

                    $exmYear = yii::app()->session['aciYear'];
                    $exmType = yii::app()->session['aciExamType'];

                    $sql = "SELECT DISTINCT
                            \"studentID\",\"per_name\",\"per_fathersName\",\"per_mothersName\",
                            \"stu_academicTerm\", \"stu_academicYear\"
                            FROM vw_admit_card
                            WHERE

                              \"programmeCode\" = :proCode AND
                              \"batchName\" = :batName AND
                            
                              \"exm_examTerm\" = :exmTerm AND
                              \"exm_examYear\" = :exmYear 
                            ORDER BY \"studentID\"";                
         
                    $model = ExamRegistration::model()->findAllBySql($sql,array(':proCode'=>$proCode,':batName'=>$batName,':exmTerm'=>$exmTerm,':exmYear'=>$exmYear));

                }
                   // echo count($model); exit();
//                $this->renderPartial('_admitCardtPDF',array('pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'secName'=>$secName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,),true);
               
                 $html = $this->renderPartial('_admitCardPDF', array(
                                'pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,'exmType'=>$exmType,
                        ), true);
                 $pdf->writeHTML($html, true, false, true, false, '');
                   $fileName = 'AdmitCard_'.Programme::model()->findByPk($proCode)->pro_shortName.$batName;
                    $pdf->Output($fileName.'.pdf', "I");

        }

        
        public function actionIndividualAdmitCardIssue()
        {
              if(isset($_POST['aciYear'] , $_POST['aciTerm']))
                {
                        yii::app()->session['aciYear']=$_REQUEST['aciYear'];
                        yii::app()->session['aciTerm']=$_REQUEST['aciTerm'];

                }
                //echo FormUtil::bgenerateAdmitCardatchFlag(2, 2013, 3, 2012);
                //$data = array();
           //print_r($data);     
                
                
                $this->render('_admitCard',array());  
              
        }
        public function actionGenerateAdmitCard(){
            
          //   yii::app()->session['termAdmissionID'] = 65000;
               $promotion = Admission::eligibleForPromotion($_POST['studentID'], yii::app()->session['aciTerm'],yii::app()->session['aciYear']);
             //  $backUrl = Yii::app()->controller->createUrl('examRegistration/individualAdmitCardIssue');
                if(!$promotion){
                    Yii::app()->user->setFlash('warning','He/She is not eligiable for promotion. Please take re-admission!!!');
                    $this->redirect(array('examRegistration/individualAdmitCardIssue'));   
                }
             if(isset($_POST['studentID']))
                {
                 
                
                    $termID = Admission::searchTermAdmission($_POST['studentID'], yii::app()->session['aciTerm'],yii::app()->session['aciYear']);
                    $term = yii::app()->session['aciTerm'];
                    $year = yii::app()->session['aciYear'];

                    $sql ="SELECT a.\"batchName\", a.\"sectionName\", a.\"moduleCode\" as id, a.mod_name FROM  public.vw_admit_card a 
                WHERE   a.\"studentID\" = '{$_POST['studentID']}' AND a.\"exm_examTerm\" = {$term} AND  a.\"exm_examYear\" = {$year} ";
                 $command=Yii::app()->db->createCommand($sql);

                 $dataProvider=new CSqlDataProvider($sql, array(
                        'id'=>'id',
                       // 'totalItemCount'=>$count,
                        //'params'=>$params,
                         'sort'=>array(
                            'attributes'=>array(
                                 'moduleCode',
                            ),
                        ),
                        'pagination'=>array(
                            'pageSize'=>30000,
                        ),
                    ));
                    $this->render('admitCard',array(
                               'termID'=>$termID, 'dataProvider'=>$dataProvider
                        ));  
               }
            
        }
       public function actionGenerateSignatureSheetPDF()         
        {
                
                Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);

                 
               
             $pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('ADMIT CARD');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, 40, '      SIGNATURE SHEET ', ' ');

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 16));
            //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

            // set font
            $pdf->SetFont('times', '', 12);   // Add a page
               //  $pdf->AddPage();
              
                   $proCode = yii::app()->session['aciProCode'];
                $batName = yii::app()->session['aciBatName'];
                $secName = yii::app()->session['aciSecName'];
                $exmTerm = yii::app()->session['aciTerm'];

                $exmYear = yii::app()->session['aciYear'];
                $exmType = yii::app()->session['aciExamType'];

          
                  $sql = "SELECT DISTINCT
                        \"studentID\",\"per_name\",\"per_fathersName\",\"per_mothersName\",
                        \"stu_academicTerm\", \"stu_academicYear\"
                        FROM vw_admit_card
                        WHERE

                          \"programmeCode\" = :proCode AND
                          \"batchName\" = :batName AND
                          \"sectionName\"= :secName AND
                          \"exm_examTerm\" = :exmTerm AND
                          \"exm_examYear\" = :exmYear
                         
                        ORDER BY \"studentID\"";
                //echo $sql;
                $model = ExamRegistration::model()->findAllBySql($sql,array(':proCode'=>$proCode,':batName'=>$batName,'secName'=>$secName,':exmTerm'=>$exmTerm,':exmYear'=>$exmYear));


//                $this->renderPartial('_admitCardtPDF',array('pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'secName'=>$secName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,),true);
               
                 $html = $this->renderPartial('_signatureSheetPDF', array(
                                'pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'secName'=>$secName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,'exmType'=>$exmType,
                        ), true);
                 $pdf->writeHTML($html, true, false, true, false, '');
                  $fileName = 'SignatureSheet_'.Programme::model()->findByPk($proCode)->pro_shortName.$batName.$secName.'.pdf';
                   $pdf->Output($fileName.'pdf', "I");

                //$pdf->writeHTML($view, true, false, false, false, '');
          //      
            //    $pdf->LastPage();
       
                // close and output PDF document
        //        $pdf->Output('Transcript', 'I');
        }
	
        public function actionGenerateRegisterPDF()         
        {
                
                Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);

                 
               
             $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('ADMIT CARD');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, 40, '      Register ', ' ');

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 16));
            //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

            // set font
            $pdf->SetFont('times', '', 12);   // Add a page
                 $pdf->AddPage();
              
                   $proCode = yii::app()->session['aciProCode'];
                $batName = yii::app()->session['aciBatName'];
                $secName = yii::app()->session['aciSecName'];
                $exmTerm = yii::app()->session['aciTerm'];

                $exmYear = yii::app()->session['aciYear'];
                $exmType = yii::app()->session['aciExamType'];

          
                $sql = "SELECT DISTINCT
                        \"studentID\",\"per_name\",\"per_fathersName\",\"per_mothersName\",
                        \"stu_academicTerm\", \"stu_academicYear\"
                        FROM vw_admit_card
                        WHERE

                          \"programmeCode\" = :proCode AND
                          \"batchName\" = :batName AND
                          \"sectionName\"= :secName AND
                          \"exm_examTerm\" = :exmTerm AND
                          \"exm_examYear\" = :exmYear
                        ORDER BY \"studentID\"";
                //echo $sql;
                $model = ExamRegistration::model()->findAllBySql($sql,array(':proCode'=>$proCode,':batName'=>$batName,'secName'=>$secName,':exmTerm'=>$exmTerm,':exmYear'=>$exmYear));

//                $this->renderPartial('_admitCardtPDF',array('pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'secName'=>$secName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,),true);
               
                 $html = $this->renderPartial('_admitCardtRegistarPDF', array(
                                'pdf'=>$pdf,'model'=>$model,'proCode'=>$proCode,'batName'=>$batName,'secName'=>$secName,'exmTerm'=>$exmTerm,'exmYear'=>$exmYear,'exmType'=>$exmType,
                        ), true);
                 $pdf->writeHTML($html, true, false, true, false, '');
                  $fileName = 'Register_'.Programme::model()->findByPk($proCode)->pro_shortName.$batName.$secName;
                    $pdf->Output($fileName.'pdf', "I");

                //$pdf->writeHTML($view, true, false, false, false, '');
          //      
            //    $pdf->LastPage();
       
                // close and output PDF document
        //        $pdf->Output('Transcript', 'I');
        }
	        
 
        public function actionGetRegisteredModule()
        {
                $password = UserIdentity::$checkIdentity;
                //echo $password['115']['offeredModule'];
                if(isset($_REQUEST['password']))
                {   
                    yii::app()->session['mreProCode']=$_REQUEST['programmeCode'];
                    yii::app()->session['mreBatch']=$_REQUEST['batchName'];
                    yii::app()->session['mreSection']=$_REQUEST['sectionName'];
                    yii::app()->session['mreTerm']=$_REQUEST['mreTerm'];
                    yii::app()->session['mreYear']=$_REQUEST['mreYear'];
                    yii::app()->session['mrePassword']=$_REQUEST['password'];
                }
                
                if(isset(yii::app()->session['mrePassword']) && $password[yii::app()->session['mreProCode']]['marksEntry']===yii::app()->session['mrePassword'])
		{
			//echo "programme code:".$_REQUEST['mreYear'];
	
                    $sql="SELECT 
                            * 
                          FROM 
                            {{e_module}} as e, 
                            {{h_offeredmodule}} as h
                          WHERE 
                            e.\"moduleCode\" = h.\"moduleCode\" AND
                            e.\"syllabusCode\" = h.\"syllabusCode\" AND
                            h.\"sectionName\" = :sectionName AND 
                            h.\"batchName\" = :batchName AND 
                            h.\"programmeCode\" = :programmeCode AND 
                            h.ofm_term = :ofm_term AND 
                            h.ofm_year = :ofm_year ";
                    
                    
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':programmeCode'=>yii::app()->session['mreProCode'],':batchName'=>yii::app()->session['mreBatch'],':sectionName'=>yii::app()->session['mreSection'],':ofm_term'=>yii::app()->session['mreTerm'],':ofm_year'=>yii::app()->session['mreYear']));
                    
                    if($ofmModule)
                    {
                        $this->render('getRegisteredModule',array('ofmModule'=>$ofmModule));
                    }
                    else
                    {
                        Yii::app()->user->setFlash('warning',' No Registered Module Found For Selected Term !!!');
                        $this->redirect(array('offeredModule/index'));
                    }
                    
                }
                else
                {
                    Yii::app()->user->setFlash('warning',' Password Does Not Match !!!');
                   $this->redirect(array('offeredModule/index'));
                           
                }
            
        }
        
        public function actionGetRegModuleMarksList()
        {
            if(isset($_REQUEST['offeredModuleID']))
            {
                yii::app()->session['mreOfmID']=$_REQUEST['offeredModuleID'];
                yii::app()->session['mreHalf']=$_REQUEST['mreHalf'];
            }
            
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreOfmID']));
            
            yii::app()->session['mreModule']=$module->moduleCode.':'.$module->mod_name;
            
            
             $sql="SELECT 
                            * 
                          FROM 
                            vw_getfirsthalfmarkslist
                            where \"offeredModuleID\"=:offeredModuleID;   
                          ";
            if(!$moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mreOfmID'])))
            {
                Yii::app()->user->setFlash('warning',' No Admited Students Found For Selected Term !!!');
                        $this->redirect(array('getRegisteredModule')); 
            }
            
            if(yii::app()->session['mreHalf']==1)
            {
               
                    //echo count($moduleReg);
                $this->render('getRegModuleMarksList',array('moduleReg'=>$moduleReg));
            }
            elseif(yii::app()->session['mreHalf']==2)
            {
                
                $this->render('getRegModuleMarksListFinal',array('moduleReg'=>$moduleReg));
            }
            elseif(yii::app()->session['mreHalf']==3)
            {
                
                $this->render('getRegModuleMarksListOldStudent',array('moduleReg'=>$moduleReg));
            }
                
        }
 
        public function actionSaveMarks()
        {            //     echo "Bismillah Hir Rahmanir Rahim!!";                 
        
           if (Yii::app()->request->isAjaxRequest){



                    $i=$_REQUEST['i'];
                    $reg = unserialize(yii::app()->session['reg'.$i]);
                 
                    $reg->reg_attendence=$_REQUEST['attendance-'.$i];
                    $reg->reg_classTest=$_REQUEST['classTest-'.$i];
                    $reg->reg_midterm=$_REQUEST['midterm-'.$i];
                    
                    $sql = "UPDATE {{s_moduleregistration}}
                    SET reg_attendence={$reg->reg_attendence}, \"reg_classTest\"={$reg->reg_classTest}, reg_midterm={$reg->reg_midterm} 
                    WHERE \"moduleRegistrationID\"={$_REQUEST['moduleRegistrationID']};";
                 
                    
                    if(Yii::app()->db->createCommand($sql)->execute())
                    {
                        $this->renderPartial('_formFirstHalf',array('reg'=>$reg,'i'=>$i),false,true);
                    }
                    
            
            }
        
        	
            
        }
        
          public function actionSaveFinal()
        {
                  //echo "Bismillah Hir Rahmanir Rahim!!";
             
            
                  $i=$_REQUEST['i'];
                 // echo $i;
                    $regFinal = unserialize(yii::app()->session['regFinal'.$i]);
                    
                   $regFinal->final= (isset($_REQUEST['final-'.$i]) ?  $_REQUEST['final-'.$i]:0);
            
                   //echo $regFinal->final;
                   
                    //echo isset($_REQUEST['absent-'.$i]);
                    
                    $regFinal->absent = (isset($_REQUEST['absent-'.$i])?'t':'f');
                      // $regFinal->absent = $_REQUEST['absent-'.$i];
                    //echo $regFinal->absent;
                        
                   
                    
                    $merExamID = yii::app()->session['mreExaminationID'];
               
                    
                    
                   
                    $sql = "UPDATE {{u_exammarks}}
                    SET emr_mark={$regFinal->final},  emr_absent='{$regFinal->absent}', emr_date= now()
                    WHERE \"moduleRegistrationID\"={$regFinal->moduleRegistrationID} and \"examinationID\"= {$merExamID};";

                if(Yii::app()->db->createCommand($sql)->execute())
                {
                     $this->renderPartial('_formSecondHalf',array('regFinal'=>$regFinal,'i'=>$i)); 
                }
             
            
        }
      
        
       public function actionSaveTest()
        {
                    if (Yii::app()->request->isAjaxRequest){
         
                    $i=$_REQUEST['i'];
                    
                    $regOldStu = unserialize(yii::app()->session['regOldStu'.$i]);
                    
                    $regOldStu->final= (isset($_REQUEST['final-'.$i]) ? $_REQUEST['final-'.$i]:0);
                    
                    $regOldStu->subTotal= $_REQUEST['subTotal-'.$i];
                    
                    $regOldStu->absent = (isset($_REQUEST['absent-'.$i])?'t':'f');
                    //echo $regOldStu->absent;
                    $attendance = round(($regOldStu->subTotal*((10*100)/60))/100);
                    $classTest = round(($regOldStu->subTotal*((20*100)/60))/100);
                    $midterm = round(($regOldStu->subTotal*50)/100) ;
                    
                    $merExamID = yii::app()->session['mreExaminationID'];
               
                    $date=date('Y-m-d');
                    
                   
                    $sql = "UPDATE {{u_exammarks}}
                    SET emr_mark={$regOldStu->final},  emr_absent='{$regOldStu->absent}', emr_date= '{$date}'
                    WHERE \"moduleRegistrationID\"={$regOldStu->moduleRegistrationID} and \"examinationID\"= {$merExamID};";

                    $sql2 = "UPDATE {{s_moduleregistration}}
                    SET reg_attendence={$attendance}, \"reg_classTest\"={$classTest}, reg_midterm={$midterm} 
                    WHERE \"moduleRegistrationID\"={$regOldStu->moduleRegistrationID};";
                    
                if(Yii::app()->db->createCommand($sql)->execute() && Yii::app()->db->createCommand($sql2)->execute())
                {
                     $this->renderPartial('_formOldStudent',array('regOldStu'=>$regOldStu,'i'=>$i)); 
                }
               
            }
        }
        
      
        
        
        public function actionReportTabulation()
	{
                $model = new ExamRegistration();
               /* if(isset($_REQUEST['programmeCode'],$_REQUEST['batchName'],$_REQUEST['resultTerm'],$_REQUEST['resultYear']))
                {
                    yii::app()->session['reProCode']=$_REQUEST['programmeCode'];
                    
                    yii::app()->session['reBatName']=$_REQUEST['batchName'];
                    yii::app()->session['reTerm']=$_REQUEST['resultTerm'];
                    yii::app()->session['reYear']=$_REQUEST['resultYear'];
                    
                    $dataProvider = $model->searchTabulation( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['reTerm'], yii::app()->session['reYear']);
                    
                }
                else
                {
                 */      
                
                   
                    
                    $dataProvider = $model->searchResultByOfferedModule(yii::app()->session['mreOfmID']);
                //}
                
                
		                 
                
                
                $this->render('reportTabulation',array('model'=>$model,'dataProvider'=>$dataProvider));
         
	}
        
        public function actionGenerateFirstHalfPDF()
        {
             
             Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
              require_once(Yii::app()->params['tcpdf']);
              require_once(Yii::app()->params['tcpdfConf']);

                 
             if(isset($_REQUEST['offeredModuleID']))
            {
                yii::app()->session['mreOfmID']=$_REQUEST['offeredModuleID'];
                yii::app()->session['mreHalf']=$_REQUEST['mreHalf'];
            }
            
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreOfmID']));
            
            yii::app()->session['mreModule']=$module->moduleCode.':'.$module->mod_name;
            
            
             $sql="SELECT 
                            * 
                          FROM 
                            vw_getfirsthalfmarkslist
                            where \"offeredModuleID\"=:offeredModuleID;   
                          ";
             $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mreOfmID']));
            
            if(yii::app()->session['mreHalf']==1)
            {
               
                 $html = $this->renderPartial('getRegModuleMarksListPDF', array(
			'moduleReg'=>$moduleReg
		), true);
            }
               $pdf = new TCPDF('',PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('60 Mark Sheet');
		//$pdf->SetSubject('Spring Term Examinatyion 2013');
		//$pdf->SetKeywords('example, text, report');
		//$pdf->SetHeaderData('', 0, "Tabulation Data", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 50, "MARK SHEET (60 Marks)",'');
		$pdf->setHeaderFont(Array('times', '', 25));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 20, 30);
		$pdf->SetHeaderMargin(5);
		//$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('times', '', 7);
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("60MarkSheet".'pdf', "I");      
 
        }
 
     
     
        
        
    public function actionDelete($id)
    {       
            
                $sql= "UPDATE {{q_termadmission}}
           SET 

               \"tra_finalExamRegistred\"='f', \"tra_finalAdmitPrint\"='f', 
               \"tra_finalExamRegDate\"=null
         WHERE \"termAdmissionID\"={$id}";

            Yii::app()->db->createCommand($sql)->execute();

                        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                        if(!isset($_GET['ajax']))
                                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('examRegisteredList'));

    }  
    
    
     public function actionERExamRegistrationSupple()
      {  
          
              $this->render('suppleExamRegistration',array('data'=>''
                   
                   ),false,true);
          
      }
      
      
      public function actionSupplementary()
      {
          
          //echo "!! Bismillah Hir Rahmanir Rahim !!";
          if(isset($_REQUEST['regStudentID']))
            {
                yii::app()->session['regStudentID']=$_REQUEST['regStudentID'];
                
            }   
                
            
                $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['regStudentID']),"ex_adm_active=true");
                
                if($admission)
                {
                    
                    
                
                            $student = Student::model()->findByPk($admission->studentID);
                            $person = Person::model()->findByPk($student->personID);
                            
                            yii::app()->session['studentName'] = $person->per_title." ".$person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['acTerm'] = $student->stu_academicTerm;
                            yii::app()->session['acYear'] = $student->stu_academicYear;
                            yii::app()->session['proCode'] = $admission->programmeCode;
                            yii::app()->session['batName'] = $admission->batchName;
                            yii::app()->session['secName'] = $admission->sectionName;
                        
                    
                    
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('ERExamRegistrationSupple'));                
                }
            
            
            $moduleReg = new  ModuleRegistration();
            
            $dataProvider = $moduleReg->searchSuppleCourseByStudentID(yii::app()->session['regStudentID'],yii::app()->session['examinationID'],yii::app()->session['exrType'],yii::app()->session['exrTerm'],yii::app()->session['exrYear']);
            
            $this->render('supplementary',array(
                            'view'=>'_supplementary',
			 'dataProvider'=>$dataProvider,
                    ));
             
      }
      
      public function actionSaveSuppleRegistration()
      {
             // echo "Bismillah Hir Rahmanir Rahim. ";
              // echo var_dump($_POST['offered']);
              // exit();
                if(isset($_POST['offered']))
                { 
                        
                        $examinationID=yii::app()->session['examinationID'];
                        $i=0;
                        $flag=false;
                        
                        $sql=" ";
                        foreach ($_POST['offered'] as $id)
                        { 
                            $split = array();
                            $split = explode('-', $id);
                                    
                            if($split[0]!=1)
                            {
                                $flag= true;

                                
                               /* $sql="INSERT INTO tbl_u_exammarks(
                        \"examinationID\", \"moduleRegistrationID\")
                    VALUES ({$examinationID},{$split[0]});";*/
                         $now = new DateTime();
                         $regi_date = $now->format('Y-m-d');
                         $sql="INSERT INTO tbl_u_exammarks(
                        \"examinationID\", \"moduleRegistrationID\" , \"supple_regi_date\")
                         VALUES ({$examinationID},{$split[0]},'{$regi_date}')";       
                                
                                //echo $sql;                                exit();
                                Yii::app()->db->createCommand($sql)->execute();
                                
                                $i++;
                            }
                            
                        }
                        //exit();
                        if($flag)
                        {
                            //echo "Alhamdulilah!!";
                           // echo $sql;                        
                           //exit();
                           
                                Yii::app()->user->setFlash('success',$i.' Courses Has Been Registred Successfully !!!');
                                
				//$this->redirect(array('moduleRegistration/index','id'=>yii::app()->session['termAdmissinID']));
                                
                            
                        }
                    
                    
                }
                    //unset($_POST['offered']);
              
                    
                    $moduleReg = new  ModuleRegistration();
            
                    $dataProvider = $moduleReg->searchSuppleCourseByStudentID(yii::app()->session['regStudentID'],yii::app()->session['examinationID'],yii::app()->session['exrType'],yii::app()->session['exrTerm'],yii::app()->session['exrYear']);
            
            
                    $this->renderPartial('_supplementary',array('dataProvider'=>$dataProvider,));
                    //$this->render('index',array('view'=>'_notRegistredModule','dataProvider'=>$dataProvider));
	
             
    }
             
    public function actionSuppleRegList()
    {
          
          //echo "!! Bismillah Hir Rahmanir Rahim !!";
            
            
            $moduleReg = new  ModuleRegistration();
            
            $dataProvider = $moduleReg->searchSuppleRegCourseByStudentID(yii::app()->session['regStudentID'],yii::app()->session['examinationID']);
            
            $this->render('supplementary',array(
                            'view'=>'_supplementaryRegisteredList',
			 'dataProvider'=>$dataProvider,
                    ));
             
     }
    
    
    public function actionDeleteSuppleRegistration($id,$eid)
    {       
            /*
                $sql= "UPDATE tbl_s_moduleregistration
           SET 

               \"reg_suppleExamReg\"='f', 
               \"reg_suppleExamRegDate\"=null
         WHERE \"moduleRegistrationID\"={$id}";
*/
           // Yii::app()->db->createCommand($sql)->execute();
            
            
                $sql2= "DELETE FROM tbl_u_exammarks
               
         WHERE \"moduleRegistrationID\"={$id} and \"examinationID\"={$eid}";
//echo $sql2; exit();
            Yii::app()->db->createCommand($sql2)->execute();


                        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                        if(!isset($_GET['ajax']))
                                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('SuppleRegList'));

    }  
    
    
    public function actionSupplementaryPDF(){
        
    }
}