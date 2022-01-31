<?php

class TermAdvisingController extends Controller
{
    /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
           //echo  yii::app()->user->getState('role'); exit();
            $rules = array();
            
            
            if(yii::app()->user->getState('role')==='super-admin')
            {
            
                    $rules = array('admittedTerms','admittedTermsForSupperUser','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','deleteSelected','GetPreviousRecordOf','InvoicePDF','StudentProfile','delete2','SpecialRetake','GetSepcialRetakeCourse','GetSepcialCourse','Examption','AllAdmittedTerms','modulesToBeExmaption','ExamptedCourses','selectExamptionModule','ExepmtedCourses','SpecialCourse');
            }
            elseif(yii::app()->user->getState('role')==='head')
            {
                    $rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','GetPreviousRecordOf','InvoicePDF','StudentProfile','SpecialRetake','GetSepcialRetakeCourse','SpecialCourse');
            }
            elseif(yii::app()->user->getState('role')==='coordinator')
            {
              
                    $rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','GetPreviousRecordOf','InvoicePDF','StudentProfile','SpecialRetake','GetSepcialRetakeCourse','SpecialCourse');
            }
            elseif(yii::app()->user->getState('role')==='exam')
            {
                    $rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','GetPreviousRecordOf','InvoicePDF','StudentProfile','SpecialRetake','GetSepcialRetakeCourse','Examption','AllAdmittedTerms','modulesToBeExmaption','ExamptedCourses','selectExamptionModule','ExepmtedCourses','SpecialCourse','GetSepcialCourse','deleteSelected');
            }
            elseif(yii::app()->user->getState('role')==='admission')
            {
                //$rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','deleteSelected','GetPreviousRecordOf','InvoicePDF','StudentProfile','delete2');
                $rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','GetPreviousRecordOf','InvoicePDF','StudentProfile','SpecialRetake','GetSepcialRetakeCourse','Examption','AllAdmittedTerms','modulesToBeExmaption','ExamptedCourses','selectExamptionModule','ExepmtedCourses','SpecialCourse','GetSepcialCourse','deleteSelected');
            }
			 elseif(yii::app()->user->getState('role')==='admin')
            {
                //$rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','deleteSelected','GetPreviousRecordOf','InvoicePDF','StudentProfile','delete2');
                $rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','GetPreviousRecordOf','InvoicePDF','StudentProfile','SpecialRetake','GetSepcialRetakeCourse','Examption','AllAdmittedTerms','modulesToBeExmaption','ExamptedCourses','selectExamptionModule','ExepmtedCourses','SpecialCourse','GetSepcialCourse','deleteSelected');
            }
            elseif(yii::app()->user->getState('role')==='deo')
            {
                $rules = array('admittedTerms','admittedTermsForSupperUser','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','deleteSelected','GetPreviousRecordOf','InvoicePDF','StudentProfile','delete2','SpecialRetake','GetSepcialRetakeCourse','GetSepcialCourse','Examption','AllAdmittedTerms','modulesToBeExmaption','ExamptedCourses','selectExamptionModule','ExepmtedCourses','SpecialCourse');
       
                //$rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','deleteSelected','GetPreviousRecordOf','InvoicePDF','StudentProfile','delete2');
       //             $rules = array('admittedTerms','admittedTermsForSupperUser','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','GetPreviousRecordOf','InvoicePDF','StudentProfile','SpecialRetake','GetSepcialRetakeCourse','GetSepcialCourse','SpecialCourse');
            }
            else
            {
                    $rules=array('');
            }
		
            
            return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
             
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>$rules,
				'users'=>array(Yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		
                if(isset($_POST['traYear'] , $_POST['traTerm']))
                {
                        yii::app()->session['traYear']=$_REQUEST['traYear'];
                        yii::app()->session['traTerm']=$_REQUEST['traTerm'];

                }
                //echo FormUtil::batchFlag(2, 2013, 3, 2012);
                //$data = array();
                         $data = Admission::searchAdmission();
           //print_r($data);     
                
                
                $this->render('index',array(
			'data'=>$data,
		));
	}

	// Uncomment the following methods and override them if needed
	public function actionAdmittedTerms()
	{
            
            if(isset($_REQUEST['studentID']))
            {
                yii::app()->session['studentID']=$_REQUEST['studentID'];
                
            }   
            $promotion = Admission::eligibleForPromotion(yii::app()->session['studentID'],yii::app()->session['traTerm'], yii::app()->session['traYear']);
            //if(yii::app()->user->getState('role')!='super-admin' || !isset($_REQUEST['promotion']))
            if(!isset($_REQUEST['promotion']))
            {    
             if(!$promotion){
                    Yii::app()->user->setFlash('warning','He/She is not eligiable for promotion. Please take re-admission!!!');
                    $this->redirect(array('index'));   
                }
            } 
            
                $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID']),"ex_adm_active=true");
                
                if($admission)
                {
                    
                    
                
                    $batch = Batch::model()->findByPk(array('batchName'=>$admission->batchName,'programmeCode'=>$admission->programmeCode));
                    
                    if(FormUtil::batchFlag($batch->bat_term, $batch->bat_year, yii::app()->session['traTerm'], yii::app()->session['traYear']))
                    {
                            $student = Student::model()->findByPk($admission->studentID);
                            $person = Person::model()->findByPk($student->personID);
                            
                            yii::app()->session['studentName'] = $person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['acTerm'] = $student->stu_academicTerm;
                            yii::app()->session['acYear'] = $student->stu_academicYear;
                            yii::app()->session['trmAdvPaymentMethod'] = $student->stu_paymentMethod;
                            yii::app()->session['proCode'] = $admission->programmeCode;
                            yii::app()->session['batName'] = $admission->batchName;
                            yii::app()->session['secName'] = $admission->sectionName;
                        
                    }
                    else
                    { 
            
                        Yii::app()->user->setFlash('warning','Current Term can not be previous than batch\'s start term!!!');
                        $this->redirect(array('index'));                
                    }
                    
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('index'));                
                }
            
            
            
            $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
          //  
            $flag=(!TermAdmission::model()->findByAttributes($data)?'inline':'none');
            
            //echo count(OfferedModule::model()->findAllByAttributes(array('sectionName'=>$data['sectionName'],'batchName'=>$data['batchName'],'programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year'])));
            
            if(!$flagOfm=(count([OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year']))])>0?true:false))
            {
               
                Yii::app()->user->setFlash('warning','Do not get any module offered for selected Term!!!');    
            }
               //echo count(OfferedModule::model()->findAllByAttributes(array('sectionName'=>$data['sectionName'],'batchName'=>$data['batchName'],'programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year'])));
               //exit();
            $model = new TermAdmission();
                    
            $this->render('admittedTerms',array(
			'model'=>$model, 'data'=>$data,'flag'=>$flag,'flagOfm'=>$flagOfm
                    ));
                
              
	}
        public function actionAdmittedTermsForSupperUser()
	{
            
            if(isset($_REQUEST['studentID']))
            {
                yii::app()->session['studentID']=$_REQUEST['studentID'];
                
            }   
                              
            
                $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID']),"ex_adm_active=true");
                
                if($admission)
                {
                    
                    
                
                    $batch = Batch::model()->findByPk(array('batchName'=>$admission->batchName,'programmeCode'=>$admission->programmeCode));
                    
                    if(FormUtil::batchFlag($batch->bat_term, $batch->bat_year, yii::app()->session['traTerm'], yii::app()->session['traYear']))
                    {
                            $student = Student::model()->findByPk($admission->studentID);
                            $person = Person::model()->findByPk($student->personID);
                            
                            yii::app()->session['studentName'] = $person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['acTerm'] = $student->stu_academicTerm;
                            yii::app()->session['acYear'] = $student->stu_academicYear;
                            yii::app()->session['trmAdvPaymentMethod'] = $student->stu_paymentMethod;
                            yii::app()->session['proCode'] = $admission->programmeCode;
                            yii::app()->session['batName'] = $admission->batchName;
                            yii::app()->session['secName'] = $admission->sectionName;
                        
                    }
                    else
                    { 
            
                        Yii::app()->user->setFlash('warning','Current Term can not be previous than batch\'s start term!!!');
                        $this->redirect(array('index'));                
                    }
                    
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('index'));                
                }
            
            
            
            $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
          //  
            $flag=(!TermAdmission::model()->findByAttributes($data)?'inline':'none');
            
            //echo count(OfferedModule::model()->findAllByAttributes(array('sectionName'=>$data['sectionName'],'batchName'=>$data['batchName'],'programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year'])));
            
            if(!$flagOfm=(count([OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year']))])>0?true:false))
            {
               
                Yii::app()->user->setFlash('warning','Do not get any module offered for selected Term!!!');    
            }
               //echo count(OfferedModule::model()->findAllByAttributes(array('sectionName'=>$data['sectionName'],'batchName'=>$data['batchName'],'programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year'])));
               //exit();
            $model = new TermAdmission();
                    
            $this->render('admittedTerms',array(
			'model'=>$model, 'data'=>$data,'flag'=>$flag,'flagOfm'=>$flagOfm
                    ));
                
              
	}
        
        public function actionCreate()
        {
                $model= new TermAdmission();
                
            	if(isset($_REQUEST['data']))
		{   
                    $empID = yii::app()->session['MainFacultyID'];
                    $data=$_REQUEST['data'];
                        $sql= "INSERT INTO {{q_termadmission}} (\"studentID\", \"sectionName\", \"batchName\", \"programmeCode\", tra_term, tra_year,\"employeeID\") VALUES "
                             ."('{$data['studentID']}','{$data['sectionName']}',{$data['batchName']},'{$data['programmeCode']}',{$data['tra_term']} ,{$data['tra_year']},{$empID})";
                     
                             //echo $sql;
             
                    if(Yii::app()->db->createCommand($sql)->execute())
                    {
                            //echo "Alhamdulilah!!";
                            
                                if(!Examination::model()->findByAttributes(array('exm_examTerm'=>$data['tra_term'],'exm_examYear'=>$data['tra_year'],'exm_type'=>1)))
                                {
                                    $sql2="INSERT INTO {{t_examination}} (\"exm_examTerm\", \"exm_examYear\") VALUES 
                                        ({$data['tra_term']} ,{$data['tra_year']});";
                                    Yii::app()->db->createCommand($sql2)->execute();
                                }
                                
                                if(!Examination::model()->findByAttributes(array('exm_examTerm'=>$data['tra_term'],'exm_examYear'=>$data['tra_year'],'exm_type'=>2)))
                                {
                                    $sql3="INSERT INTO {{t_examination}} (exm_type, \"exm_examTerm\", \"exm_examYear\") VALUES "
                                    ."(2,{$data['tra_term']} ,{$data['tra_year']})";
                                    Yii::app()->db->createCommand($sql3)->execute();
                                }
                                
                                if(!Examination::model()->findByAttributes(array('exm_examTerm'=>$data['tra_term'],'exm_examYear'=>$data['tra_year'],'exm_type'=>3)))
                                {
                                    $sql3="INSERT INTO {{t_examination}} (exm_type, \"exm_examTerm\", \"exm_examYear\") VALUES "
                                    ."(3,{$data['tra_term']} ,{$data['tra_year']})";
                                    Yii::app()->db->createCommand($sql3)->execute();
                                }
                                
                                yii::app()->session['termAdmissinID']=TermAdmission::model()->findByAttributes($data)->termAdmissionID;
                                Yii::app()->user->setFlash('success','Term Admission Successful.');
                                
				$this->redirect(array('modulesToBeAdvisied','id'=>yii::app()->session['termAdmissinID']));
                    }
                          
                         
		}

		
        }
        
        public function actionModulesToBeAdvisied($id=null,$flag=null)
	{            
             //$input = ModuleRegistration::flagPrerequisite(yii::app()->session['studentID'],'GED-113','CSE-V2');
             //echo ModuleRegistration::flagRetake('GED-113','CSE-V2',yii::app()->session['studentID']);
                       
            if($id)
            {
               
           
                 yii::app()->session['mrTermAdmissionID']=$id;
            }
            
                    $tra = TermAdmission::model()->findByPk(yii::app()->session['mrTermAdmissionID']);
                    
                    
                      yii::app()->session['termAdmissionID'] = $tra->termAdmissionID;
                     $sql="SELECT * from vw_RegisteredCourseList WHERE \"termAdmissionID\" = :termID;";
                
                        // echo $sql;
                        // exit();
                         yii::app()->session['totalCourse']=  count(ModuleRegistration::model()->findAllBySql($sql,array(':termID'=> yii::app()->session['termAdmissionID'])));
                    
                    yii::app()->session['proCode'] = $tra->programmeCode;
                    yii::app()->session['batName'] = $tra->batchName;
                    yii::app()->session['secName'] = $tra->sectionName;
                    yii::app()->session['traTermMod'] = $tra->tra_term;
                    yii::app()->session['traYearMod'] = $tra->tra_year;
                    
                    yii::app()->session['sylCode'] = Batch::model()->findByPk(array('batchName'=>$tra->batchName,'programmeCode'=>$tra->programmeCode))->syllabusCode;
                            
            
            
            $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTermMod'],'tra_year'=>yii::app()->session['traYearMod']);      
            
            $model=new ModuleRegistration('search');
            
            $dataProvider = $model->searchNotRegistredForAdvise($data['studentID'],$data['programmeCode'],$data['tra_term'],$data['tra_year'],yii::app()->session['sylCode'],yii::app()->session['termAdmissionID'],50);
	
            if(count([$dataProvider]))
            {
                
                 
                
                $this->render('modulesToBeAdvisied',array('view'=>'_notRegisteredCourse','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
            }
            else
            {
             
                //$dataProvider = $model->search($data['studentID'], $data['programmeCode']);
                
               // $this->render('modulesToBeAdvisied',array('view'=>'','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
                $this->redirect(array('selectedCourses'));
            }
            
	}
        
        public function actionInvoicePDF()
	{
                  $session=new CHttpSession;
                  $session->open();
                  require_once(Yii::app()->params['tcpdf']);
	          require_once(Yii::app()->params['tcpdfConf']);          
              
                  Yii::import('application.modules.admin.extensions.bootstrap.*');
                  $id = yii::app()->session['termAdmissionID'];
                   
                  $sql="SELECT
                        distinct
                         concat(j.\"per_firstName\",' ', j.\"per_lastName\") as per_name, 
                          h.\"offeredModuleID\", 
                          h.\"moduleCode\", 
                          h.\"syllabusCode\", 
                          e.mod_name, 
                          e.\"mod_creditHour\", 
                          s.\"moduleRegistrationID\", 
                          s.\"offeredModuleID\", 
                          h.\"facultyID\",
                          h.\"batchName\",                 
                          h.\"sectionName\",
                          s.\"reg_status\"
                        FROM 
                          public.tbl_h_offeredmodule h 
                          join public.tbl_s_moduleregistration s on (h.\"offeredModuleID\" = s.\"offeredModuleID\")
                        join	public.tbl_e_module e on (h.\"moduleCode\" = e.\"moduleCode\" AND h.\"syllabusCode\" = e.\"syllabusCode\" )


                          left join public.tbl_j_person j on (h.\"facultyID\" = j.\"personID\") 

                        WHERE 
                         s.\"termAdmissionID\" = '{$id}'
                          ;";
                    //     echo $sql; exit(0);
                    $rows = Yii::app()->db->createCommand($sql)->queryAll($sql);
                   
                    //echo count($rows); exit();
                    $sql2  ="
                            SELECT 
                              concat(tbl_j_person.\"per_firstName\",' ', tbl_j_person.\"per_lastName\") as per_name,
                              tbl_j_person.\"per_dateOfBirth\", 
                              tbl_j_person.\"per_presentAddress\",
                              tbl_o_student.\"studentID\"
                            FROM 
                              public.tbl_q_termadmission, 
                              public.tbl_j_person, 
                              public.tbl_o_student
                            WHERE 
                              tbl_q_termadmission.\"studentID\" = tbl_o_student.\"studentID\" AND
                              tbl_o_student.\"personID\" = tbl_j_person.\"personID\" AND
                              tbl_q_termadmission.\"termAdmissionID\" ='{$id}'
                              ;";
                    //echo $sql2; exit(0);        
                    $rows2 = Yii::app()->db->createCommand($sql2)->queryAll($sql2);
                    
                $pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
                
                $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Invoice');
		$pdf->SetSubject('');
                $pdf->SetPrintHeader(false);
		//$pdf->SetKeywords('example, text, report');
		//$pdf->SetHeaderData('', 0, "Tabulation Data", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Transcript",'');
		$pdf->setHeaderFont(Array('helvetica', '', 25));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, 10, 30);
		$pdf->SetHeaderMargin(15);
		//$pdf->SetFooterMargin(30);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('dejavusans', '', 10);
                $pdf->AddPage();

               
                  $view = yii::app()->session['trmAdvPaymentMethod'];
            
                $sql="SELECT * from vw_RegisteredCourseList WHERE \"termAdmissionID\" = :termID;";
                
               // echo $sql;
               // exit();
                $model= ModuleRegistration::model()->findAllBySql($sql,array(':termID'=> yii::app()->session['termAdmissionID']));
             
                
                //echo "count:".count($model);
              // $html = $this->renderPartial('registeredCourseList',array('view'=>$view,'model'=>$model,'dataProvider'=>'','flag'=>true));

             //   $html = $this->renderPartial('invoice', array('view'=>$view,'model'=>$model,'dataProvider'=>'','flag'=>true,
       //                        'rows'=>$rows,'rows2'=>$rows2,
          //              ), true);
                if($view==1)
                {
                    $html = $this->renderPartial('invoiceCreditBasis', array('model'=>$model,'dataProvider'=>'','flag'=>true,
                                'rows'=>$rows,'rows2'=>$rows2,
                        ), true);
                  //  $this->render('invoiceCreditBasis',array( 'rows'=>$rows,'rows2'=>$rows2,));
                }
                else
                {
                    $html = $this->renderPartial('invoiceMonthly', array('model'=>$model,'dataProvider'=>'','flag'=>true,
                                'rows'=>$rows,'rows2'=>$rows2,
                        ), true);
                   // $this->render('invoiceMonthly',array('view'=>$view,'model'=>$model,'dataProvider'=>'','flag'=>true));
                }
                $pdf->writeHTML($html, true, false, false, false, '');
                    //$pdf->writeHTML($html, true, false, true, false, '');
                $fileName = 'invoice_'.yii::app()->session['studentID'].'-'.date('dmY').'.pdf';
                $pdf->Output($fileName, "I");      
	}
       
        public function actionRegisteredCourse()
	{
            $model = new ModuleRegistration();
            
                $dataProvider = $model->search(yii::app()->session['studentID'], yii::app()->session['proCode']);
            
                
                
                //echo "count:".count($dataProvider);
                $this->render('registeredCourseList',array('view'=>'_registeredCourse','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
        }
        
        public function actionSelectedCourses()
	{
             $view = (yii::app()->session['trmAdvPaymentMethod']==1?'_selectedCourses':'_selectedCoursesMonthlyBasis');
             
                $sql="SELECT * from vw_RegisteredCourseList WHERE \"termAdmissionID\" = :termID;";
                
              
                $model= ModuleRegistration::model()->findAllBySql($sql,array(':termID'=> yii::app()->session['termAdmissionID']));
               
            
               // echo $sql;
               // exit();  
                
                //echo "count:".count($model);
                $this->render('registeredCourseList',array('view'=>$view,'model'=>$model,'dataProvider'=>'','flag'=>true));
        }
        
        
        public function actionSelectModule()
	{
           //   echo "Bismillah Hir Rahmanir Rahim. ";
               
           
                if(isset($_POST['offered']))
                { 
                        $termAdmissionID = yii::app()->session['termAdmissionID'];
                        $markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID; 
                        
                        $examinationID = Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['traTermMod'],'exm_examYear'=>yii::app()->session['traYearMod'],'exm_type'=>1))->examinationID;
                        
                        $i=0;
                        $flag=false;
                        
                        $sql=" ";
                        foreach ($_POST['offered'] as $offeredModuleID)
                        { 
                            
                            if($offeredModuleID!=1)
                            {
                                
                                $flag= true;
                                
                                if($oldModuleRegistrationID = ModuleRegistration::model()->flagRetakeByOfmID(yii::app()->session['studentID'],$offeredModuleID)>0)
                                {
                                    $sql1 = "UPDATE tbl_s_moduleregistration set reg_status='Retaken' , reg_type=0 where \"moduleRegistrationID\"={$oldModuleRegistrationID};";
                                    Yii::app()->db->createCommand($sql1)->execute();
                                    
                                    $sql=" SELECT sp_insertmoduleregistrationretake({$markingSchemeID},{$offeredModuleID},{$termAdmissionID},{$examinationID}); ";  
                                        //$sql.="test ";
                                       // echo $sql;                                //exit();
                                    Yii::app()->db->createCommand($sql)->execute();
                                }
                                else
                                { 
                                    $sql=" SELECT sp_insertmoduleregistration({$markingSchemeID},{$offeredModuleID},{$termAdmissionID},{$examinationID}); ";  
                                        //$sql.="test ";
                                       // echo $sql;                                //exit();
                                    Yii::app()->db->createCommand($sql)->execute();
                                }
                                
                                $i++;
                            }
                            
                        }
                        
                        if($flag)
                        {
                            //echo "Alhamdulilah!!";
                           // echo $sql;                        
                           //exit();
                           
                                Yii::app()->user->setFlash('success',$i.' Modules Has Been Registred Successfully !!!');
                                $sql="SELECT * from vw_RegisteredCourseList WHERE \"termAdmissionID\" = :termID;";
                
                        // echo $sql;
                        // exit();
                         yii::app()->session['totalCourse']=  count([ModuleRegistration::model()->findAllBySql($sql,array(':termID'=> yii::app()->session['termAdmissionID']))]);
				//$this->redirect(array('moduleRegistration/index','id'=>yii::app()->session['termAdmissinID']));
                                
                            
                        }
                    
                    
                }
                    //unset($_POST['offered']);
              
                    
                    $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
            
                    $model=new ModuleRegistration('search');
            
                   
                    $dataProvider = $model->searchNotRegistredForAdvise($data['studentID'],$data['programmeCode'],$data['tra_term'],$data['tra_year'],yii::app()->session['sylCode'],yii::app()->session['termAdmissionID'],50);
                    $this->renderPartial('_notRegisteredCourse',array('dataProvider'=>$dataProvider,'flag'=>true));
                    //$this->render('index',array('view'=>'_notRegistredModule','dataProvider'=>$dataProvider));
	
             
        }
              
              
        public function actionDeleteSelected($id,$oid)
	{       
                
		$this->loadModel($id)->delete();
                if($oldModuleRegistrationID = ModuleRegistration::model()->flagRetakeByOfmID(yii::app()->session['studentID'],$oid)>0)
                                {
                                    $sql1 = "UPDATE tbl_s_moduleregistration set reg_status='Regular' , reg_type=1 where \"moduleRegistrationID\"={$oldModuleRegistrationID};";
                                    Yii::app()->db->createCommand($sql1)->execute();
                                }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('SelectedCourses'));
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
		$model=  ModuleRegistration::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

        public function actionDelete2($id)
	{       
            //echo $id;
                
                if(!$this->loadTermAdmissionToDelete($id)->delete())
                    throw new CHttpException(404,'There are some dependancy !!');
               /* {
                    Yii::app()->user->setFlash('success',' Delete operation Successful !!!');  
                }
                else
                {
                    Yii::app()->user->setFlash('warning',' Delete operation Failed !!!');  
                }
                */
                

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('AdmittedTerms'));
	}
        
        public function loadTermAdmission($id)
	{
		$model=TermAdmission::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        
        public function loadTermAdmissionToDelete($id)
	{
                $term= yii::app()->session['MainAdmTerm'];
                $year= yii::app()->session['MainAdmYear'];
		
                $model=TermAdmission::model()->findByAttributes(array('termAdmissionID'=>$id,'tra_term'=>$term,'tra_year'=>$year));
		
                if($model===null)
			throw new CHttpException(404,'Sorry! this record can not be deleted.');
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
        
        public function actionGetPreviousRecordOf()
	{
            
            
            $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID']),"ex_adm_active=true");
                
                if($admission)
                {
                    
                         $student = Student::model()->findByPk($admission->studentID);
                         $person = Person::model()->findByPk($student->personID);
                            
                            yii::app()->session['trnsStudentName'] = $person->per_title." ".$person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['trnsAcTerm'] = $student->stu_academicTerm;
                            yii::app()->session['trnsAcYear'] = $student->stu_academicYear;
                            yii::app()->session['trnsProCode'] = $admission->programmeCode;
                            yii::app()->session['trnsBatName'] = $admission->batchName;
                            yii::app()->session['trnsSecName'] = $admission->sectionName;
                    
                            $examRarks = new ExamMarks();
                            
                            $dataProvider= $examRarks->searchIndividualResult($admission->studentID);
                               $this->render('getPreviousRecordOf',array('view'=>'_getRecordOf', 'model'=>'','dataProvider'=>$dataProvider,'flag'=>true));
                            
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('index'));                
                }
            
              
	}
        
        public function actionSpecialRetake()
	{
            $termAdmissionID = yii::app()->session['termAdmissionID'];
            $markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID; 
            $examinationID = Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['traTermMod'],'exm_examYear'=>yii::app()->session['traYearMod'],'exm_type'=>1))->examinationID;
            
            if(isset($_REQUEST['retakeCourse']))
            {
                $ModuleRegistrationID= explode('-',$_REQUEST['retakeCourse']); 
                if($_REQUEST['previousOfferedModuleID'])
                {
                    $sql1 = "UPDATE tbl_s_moduleregistration set reg_status='Retaken' , reg_type=0 where \"moduleRegistrationID\"={$ModuleRegistrationID[0]};";
                    Yii::app()->db->createCommand($sql1)->execute();
                                    
                    $sql=" SELECT sp_insertmoduleregistrationretake({$markingSchemeID},{$ModuleRegistrationID[1]},{$termAdmissionID},{$examinationID},2); ";  
                                        //$sql.="test ";
                                  //      echo $sql;         exit();
                    Yii::app()->db->createCommand($sql)->execute();
                    $this->redirect(array('selectedCourses'));
                }
                else
                {
                    
                    $sql1 = "UPDATE tbl_s_moduleregistration set reg_status='Retaken' , reg_type=0 where \"moduleRegistrationID\"={$ModuleRegistrationID[0]};";
                    Yii::app()->db->createCommand($sql1)->execute();
                                    
                    $sql=" SELECT sp_insertmoduleregistrationretake({$markingSchemeID},{$_REQUEST['offeredModuleID']},{$termAdmissionID},{$examinationID}); ";  
                                        //$sql.="test ";
                          //              echo $sql;          exit();
                    Yii::app()->db->createCommand($sql)->execute();
                    $this->redirect(array('selectedCourses'));
                    //echo $_REQUEST['retakeCourse'].'---'.'---'.$_REQUEST['previousOfferedModuleID'];
                }
                
            }
            else
            {
                    $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTermMod'],'tra_year'=>yii::app()->session['traYearMod']);      

                    $model=new ModuleRegistration('search');

                    $dataProvider = $model->searchNotRegistredForAdviseSpecial($data['studentID'],$data['programmeCode'],$data['tra_term'],$data['tra_year'],yii::app()->session['sylCode'],yii::app()->session['termAdmissionID'],50);

                    if(count([$dataProvider]))
                    {

                        $this->render('modulesToBeAdvisied',array('view'=>'_specialRetakeCourse','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
                    }
                    else
                    {

                        //$dataProvider = $model->search($data['studentID'], $data['programmeCode']);

                       // $this->render('modulesToBeAdvisied',array('view'=>'','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
                        $this->redirect(array('selectedCourses'));
                    }
                        
            }
	}
        
        public function actionSpecialCourse()
	{
            $termAdmissionID = yii::app()->session['termAdmissionID'];
            $markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID; 
            $examinationID = Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['traTermMod'],'exm_examYear'=>yii::app()->session['traYearMod'],'exm_type'=>1))->examinationID;
            
            
            if(isset($_REQUEST['offeredModuleID']))
            {
                $offeredModuleID =$_REQUEST['offeredModuleID'];
           
                                
                    $sql=" SELECT sp_insertmoduleregistration({$markingSchemeID},{$offeredModuleID},{$termAdmissionID},{$examinationID}); ";  
                                        //$sql.="test ";
                                       // echo $sql;                                //exit();
                    Yii::app()->db->createCommand($sql)->execute();
                    $this->redirect(array('selectedCourses'));
                
                
            }
            else
            {
                    $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTermMod'],'tra_year'=>yii::app()->session['traYearMod']);      

                    $model=new ModuleRegistration('search');

                    $dataProvider = $model->searchNotRegistredForAdviseSpecial($data['studentID'],$data['programmeCode'],$data['tra_term'],$data['tra_year'],yii::app()->session['sylCode'],yii::app()->session['termAdmissionID'],50);

                    if(count([$dataProvider]))
                    {

                        $this->render('modulesToBeAdvisied',array('view'=>'_specialCourse','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
                    }
                    else
                    {

                        //$dataProvider = $model->search($data['studentID'], $data['programmeCode']);

                       // $this->render('modulesToBeAdvisied',array('view'=>'','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
                        $this->redirect(array('selectedCourses'));
                    }
                        
            }
	}
        
        public function actionGetSepcialRetakeCourse()
        {
           //echo CHtml::tag('option',array('value'=>'w'),$_REQUEST['programmeCode'],true);
           //exit();
//                echo "test";
             
           
    //            echo CHtml::tag('option',array('value'=>$_REQUEST['suppleTerm']),CHtml::encode($_REQUEST['suppleYear']),true);
      //          exit();
                
                
             
                
                //echo CHtml::tag('option',array('value'=>$_REQUEST['suppleTerm']),CHtml::encode($examinationID),true);
                 //exit();
		if(isset($_REQUEST['programmeCode']))
		{
                    //echo CHtml::tag('option',array('value'=>$_REQUEST['suppleTerm']),CHtml::encode($examinationID),true);
                 //exit();
			//echo "programme code:".$_REQUEST['programmeCode'];
		$sql="SELECT distinct
                        
                        h.\"batchName\",
                        h.\"sectionName\"
                        
                      FROM 
                        
                        public.tbl_h_offeredmodule h
                      WHERE 
                        
                        
                        
                        h.\"ofm_term\"=:ofmTerm AND
                        h.\"ofm_year\"=:ofmYear AND 
                        h.\"programmeCode\"=:proCode
                         order by h.\"batchName\", h.\"sectionName\" ";
                        
                $sql2="SELECT distinct
                        e.mod_name,
                        e.mod_group,
                        e.\"moduleCode\",
                        h.\"offeredModuleID\"
                        
                      FROM 
                        
                        public.tbl_h_offeredmodule h, 
                        public.tbl_e_module e
                      WHERE 
                        h.\"moduleCode\" = e.\"moduleCode\" AND
                        h.\"syllabusCode\" = e.\"syllabusCode\" AND
                        h.\"ofm_term\"=:ofmTerm AND
                        h.\"ofm_year\"=:ofmYear AND 
                        h.\"batchName\"=:batch AND
                        h.\"sectionName\"=:section AND
                        h.\"programmeCode\"=:proCode
                        order by e.\"moduleCode\" ";
            
                    $model = OfferedModule::model()->findAllBySql($sql,array(':proCode'=>$_REQUEST['programmeCode'],':ofmTerm'=>yii::app()->session['traTermMod'],':ofmYear'=>yii::app()->session['traYearMod']));
                    
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No Course Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                        
               
                        
                        foreach($model as $item)
                        {   
                            $batchName = $item->batchName.FormUtil::getBatchNameSufix($item->batchName).' '.$item->sectionName;
                            echo "<optgroup label='{$batchName}'>";
                            
                            foreach(Offeredmodule::model()->findAllBySql($sql2,array(':proCode'=>$_REQUEST['programmeCode'],':batch'=>$item->batchName,':section'=>$item->sectionName,':ofmTerm'=>yii::app()->session['traTermMod'],':ofmYear'=>yii::app()->session['traYearMod'])) as $item2)
                            {
                                
                                
                                echo CHtml::tag('option',array('value'=>$item2->offeredModuleID),CHtml::encode($item2->moduleCode.': '.$item2->mod_name),true);
                            }
                            echo"</optgroup>";
                        }
                        
                        

                     }  
                   
                }
            
                
        }
        
        public function actionGetSepcialCourse()
        {
           //echo CHtml::tag('option',array('value'=>'w'),$_REQUEST['programmeCode'],true);
           //exit();
//                echo "test";
             
           
    //            echo CHtml::tag('option',array('value'=>$_REQUEST['suppleTerm']),CHtml::encode($_REQUEST['suppleYear']),true);
      //          exit();
                
                
             
                
                //echo CHtml::tag('option',array('value'=>$_REQUEST['suppleTerm']),CHtml::encode($examinationID),true);
                 //exit();
		if(isset($_REQUEST['programmeCode']))
		{
                    //echo CHtml::tag('option',array('value'=>$_REQUEST['suppleTerm']),CHtml::encode($examinationID),true);
                 //exit();
			//echo "programme code:".$_REQUEST['programmeCode'];
		$sql="SELECT distinct
                        
                        h.\"batchName\",
                        h.\"sectionName\"
                        
                      FROM 
                        
                        public.tbl_h_offeredmodule h
                      WHERE 
                        
                        
                        
                        h.\"ofm_term\"=:ofmTerm AND
                        h.\"ofm_year\"=:ofmYear AND 
                        h.\"programmeCode\"=:proCode
                         order by h.\"batchName\", h.\"sectionName\" ";
                        
                $sql2="SELECT distinct
                        e.mod_name,
                        e.mod_group,
                        e.\"moduleCode\",
                        h.\"offeredModuleID\"
                        
                      FROM 
                        
                        public.tbl_h_offeredmodule h, 
                        public.tbl_e_module e
                      WHERE 
                        h.\"moduleCode\" = e.\"moduleCode\" AND
                        h.\"syllabusCode\" = e.\"syllabusCode\" AND
                        h.\"ofm_term\"=:ofmTerm AND
                        h.\"ofm_year\"=:ofmYear AND 
                        h.\"batchName\"=:batch AND
                        h.\"sectionName\"=:section AND
                        h.\"programmeCode\"=:proCode
                        order by e.\"moduleCode\" ";
            
                    $model = OfferedModule::model()->findAllBySql($sql,array(':proCode'=>$_REQUEST['programmeCode'],':ofmTerm'=>yii::app()->session['traTermMod'],':ofmYear'=>yii::app()->session['traYearMod']));
                    
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No Course Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                        
               
                        
                        foreach($model as $item)
                        {   
                            $batchName = $item->batchName.FormUtil::getBatchNameSufix($item->batchName).' '.$item->sectionName;
                            echo "<optgroup label='{$batchName}'>";
                            
                            foreach(Offeredmodule::model()->findAllBySql($sql2,array(':proCode'=>$_REQUEST['programmeCode'],':batch'=>$item->batchName,':section'=>$item->sectionName,':ofmTerm'=>yii::app()->session['traTermMod'],':ofmYear'=>yii::app()->session['traYearMod'])) as $item2)
                            {
                                
                                
                                echo CHtml::tag('option',array('value'=>$item2->offeredModuleID),CHtml::encode($item2->moduleCode.': '.$item2->mod_name),true);
                            }
                            echo"</optgroup>";
                        }
                        
                        

                     }  
                   
                }
            
                
        }
        
    public function actionExamption(){
            
              if(isset($_POST['traYear'] , $_POST['traTerm']))
                {
                        yii::app()->session['traYear']=$_REQUEST['traYear'];
                        yii::app()->session['traTerm']=$_REQUEST['traTerm'];
                       

                }
                //echo FormUtil::batchFlag(2, 2013, 3, 2012);
                //$data = array();
                         $data = Admission::searchAdmission();
           //print_r($data);     
                
                
                $this->render('examption',array(
			'data'=>$data,
		));
          
            
        }
          public function actionAllAdmittedTerms()
	{
            
            if(isset($_REQUEST['studentID']))
            {
                yii::app()->session['studentID']=$_REQUEST['studentID'];
                
            }   
               
               /*$promotion = Admission::eligibleForPromotion(yii::app()->session['studentID'],yii::app()->session['acTerm'],yii::app()->session['acYear']);
                
                            if(!$promotion){
                                Yii::app()->user->setFlash('warning','He/She is not eligiable for promotion. Please take re-admission!!!');
                                $this->redirect(array('index'));   
                            }*/  
                    
                $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID']),"ex_adm_active=true");
                
                if($admission)
                {
                    
                    
                
                    $batch = Batch::model()->findByPk(array('batchName'=>$admission->batchName,'programmeCode'=>$admission->programmeCode));
                    
                    if(FormUtil::batchFlag($batch->bat_term, $batch->bat_year, yii::app()->session['traTerm'], yii::app()->session['traYear']))
                    {
                            $student = Student::model()->findByPk($admission->studentID);
                            $person = Person::model()->findByPk($student->personID);
                            
                            yii::app()->session['studentName'] = $person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['acTerm'] = $student->stu_academicTerm;
                            yii::app()->session['acYear'] = $student->stu_academicYear;
                            yii::app()->session['trmAdvPaymentMethod'] = $student->stu_paymentMethod;
                            yii::app()->session['proCode'] = $admission->programmeCode;
                            yii::app()->session['batName'] = $admission->batchName;
                            yii::app()->session['secName'] = $admission->sectionName;
                            
                           
                        
                    }
                    else
                    { 
            
                        Yii::app()->user->setFlash('warning','Current Term can not be previous than batch\'s start term!!!');
                        $this->redirect(array('index'));                
                    }
                    
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('index'));                
                }
            
            
            
            $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
          //  
            $flag=(!TermAdmission::model()->findByAttributes($data)?'inline':'none');
            
            //echo count(OfferedModule::model()->findAllByAttributes(array('sectionName'=>$data['sectionName'],'batchName'=>$data['batchName'],'programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year'])));
            
            if(!$flagOfm=(count([OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year']))])>0?true:false))
            {
               
                Yii::app()->user->setFlash('warning','Do not get any module offered for selected Term!!!');    
            }
               //echo count(OfferedModule::model()->findAllByAttributes(array('sectionName'=>$data['sectionName'],'batchName'=>$data['batchName'],'programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year'])));
               //exit();
            $model = new TermAdmission();
                    
            $this->render('allAdmittedTerms',array(
			'model'=>$model, 'data'=>$data,'flag'=>$flag,'flagOfm'=>$flagOfm
                    ));
                
              
	}
public function actionModulesToBeExmaption($id=null,$flag=null)
	{            
             //$input = ModuleRegistration::flagPrerequisite(yii::app()->session['studentID'],'GED-113','CSE-V2');
             //echo ModuleRegistration::flagRetake('GED-113','CSE-V2',yii::app()->session['studentID']);
            // echo $id; exit();
            if($id)
            {       
           
                 yii::app()->session['mrTermAdmissionID']=$id;
            }
            
                    $tra = TermAdmission::model()->findByPk(yii::app()->session['mrTermAdmissionID']);
                    
                    
                    yii::app()->session['termAdmissionID'] = $tra->termAdmissionID;
                     $sql="SELECT * from vw_RegisteredCourseList WHERE \"termAdmissionID\" = :termID;";
                 
                        // echo  $tra->termAdmissionID;
                        // exit();
                    yii::app()->session['totalCourse']=  count([ModuleRegistration::model()->findAllBySql($sql,array(':termID'=> yii::app()->session['termAdmissionID']))]);
                    
                    yii::app()->session['proCode'] = $tra->programmeCode;
                    yii::app()->session['batName'] = $tra->batchName;
                    yii::app()->session['secName'] = $tra->sectionName;
                    yii::app()->session['traTermMod'] = $tra->tra_term;
                    yii::app()->session['traYearMod'] = $tra->tra_year;
                    
                    yii::app()->session['sylCode'] = Batch::model()->findByPk(array('batchName'=>$tra->batchName,'programmeCode'=>$tra->programmeCode))->syllabusCode;
                       
            
           
            $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTermMod'],'tra_year'=>yii::app()->session['traYearMod']);      
             
            $model=new ModuleRegistration('search');
            //echo "test"; exit(); 
            $dataProvider = $model->searchExamptionModules($data['studentID'],$data['programmeCode'],$data['tra_term'],$data['tra_year'],yii::app()->session['sylCode'],yii::app()->session['termAdmissionID'],50);
      
            if(count([$dataProvider]))
            {  
                
                $this->render('modulesToBeExamption',array('view'=>'_RegisteredCourseExamption','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
            }
            else
            {
             
                //$dataProvider = $model->search($data['studentID'], $data['programmeCode']);
                
               // $this->render('modulesToBeAdvisied',array('view'=>'','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
                $this->redirect(array('examptedCourses'));
            }
            
	}
        public function actionExamptedCourses()
	{
             $view = (yii::app()->session['trmAdvPaymentMethod']==1?'_selectedCourses':'_selectedCoursesMonthlyBasis');
             
                $sql="SELECT * from vw_RegisteredCourseList WHERE \"termAdmissionID\" = :termID;";
                
              
                $model= ModuleRegistration::model()->findAllBySql($sql,array(':termID'=> yii::app()->session['termAdmissionID']));
               
            
               // echo $sql;
               // exit();  
                
                //echo "count:".count($model);
                $this->render('registeredCourseList',array('view'=>$view,'model'=>$model,'dataProvider'=>'','flag'=>true));
        }
public function actionSelectExamptionModule()
	{
                  
           
                if(isset($_POST['offered']))
                { 
                
                        $termAdmissionID = yii::app()->session['termAdmissionID'];
                        $markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID; 
                        
                        $examinationID = Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['traTermMod'],'exm_examYear'=>yii::app()->session['traYearMod'],'exm_type'=>1))->examinationID;
                        
                        $i=0;
                        $flag=false;
                        
                        $sql=" ";
                        foreach ($_POST['offered'] as $offeredModuleID)
                        { 
                            
                            if($offeredModuleID!=1)
                            {
                              
                                                                    
                                    $sql=" SELECT sp_insertmoduleregistration_examption({$markingSchemeID},{$offeredModuleID},{$termAdmissionID},{$examinationID}); ";  
                                        //$sql.="test ";
                                       // echo $sql;                                //exit();
                                    Yii::app()->db->createCommand($sql)->execute();
                               
                   //                 echo $sql;
         //  exit();
                                $i++;
                            }
                            
                        }
                        
                        if($flag)
                        {
                            //echo "Alhamdulilah!!";
                           // echo $sql;                        
                           //exit();
                           
                                Yii::app()->user->setFlash('success',$i.' Modules Has Been Registred Successfully !!!');
                                $sql="SELECT * from vw_RegisteredCourseList WHERE \"termAdmissionID\" = :termID;";
                
                        // echo $sql;
                        // exit();
                         yii::app()->session['totalCourse']=  count([ModuleRegistration::model()->findAllBySql($sql,array(':termID'=> yii::app()->session['termAdmissionID']))]);
				//$this->redirect(array('moduleRegistration/index','id'=>yii::app()->session['termAdmissinID']));
                                
                            
                        }
                    
                    
                }
                    //unset($_POST['offered']);
              
                    
                    $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
            
                    $model=new ModuleRegistration('search');
            
                   
                    $dataProvider = $model->searchNotRegistredForAdvise($data['studentID'],$data['programmeCode'],$data['tra_term'],$data['tra_year'],yii::app()->session['sylCode'],yii::app()->session['termAdmissionID'],50);
                    $this->renderPartial('_RegisteredCourseExamption',array('dataProvider'=>$dataProvider,'flag'=>true));
                    //$this->render('index',array('view'=>'_notRegistredModule','dataProvider'=>$dataProvider));
	
             
        }
            public function actionExepmtedCourses()
	{
             $view = '_exemptedCourses';
             
                $sql="SELECT * from vw_RegisteredCourseList WHERE \"termAdmissionID\" = :termID;";
                
              
                $model= ModuleRegistration::model()->findAllBySql($sql,array(':termID'=> yii::app()->session['termAdmissionID']));
               
            
               // echo $sql;
               // exit();  
                
                //echo "count:".count($model);
                $this->render('exemptedCourseList',array('view'=>$view,'model'=>$model,'dataProvider'=>'','flag'=>true));
        }
        
}