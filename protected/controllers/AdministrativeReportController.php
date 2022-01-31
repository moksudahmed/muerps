<?php

class AdministrativeReportController extends Controller
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
            if(yii::app()->user->getState('role')==='super-admin')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','reportAllAdmission','getBatch','AllAdmissionPDF','reportTabulation','TabulationPDF','attandance','ReportAttandance','AttendanceExcel','GetSection','YearlyReportAdmission','YearlyReportAdmissionGraph','YearlyReportAdmissionPDF','PerformanceReport','AdmissionYearlyBasis','YearlyBasisProgrammeWise','YearlyReportAdmissionTermwise','AdmittedStudentByInstitution','termwiseReportAdmission','studentsConsecutiveCGPA','studentsConsecutiveCGPAXLS','studentsConsecutiveCGPALessThan2','studentsConsecutiveCGPALessThan2XLS','CopyInstitute','UpdateInstitute','generateStudentsMobileNo','studentsMobileNoXLS','reportPassingOut','passingOutReportXLS','MahmudurRahmanScholarship','batchWiseTotalStudent'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','getBatch'),
				'users'=>array('admin'),
			),
                      /*  array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('jhuman','AttendanceExcel','GetSection'),
				'users'=>array('jhuman'),
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
             elseif(yii::app()->user->getState('role')==='admin')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','reportAllAdmission','getBatch','AllAdmissionPDF','reportTabulation','TabulationPDF','attandance','ReportAttandance','AttendanceExcel','GetSection','YearlyReportAdmission','YearlyReportAdmissionGraph','YearlyReportAdmissionPDF','PerformanceReport','AdmissionYearlyBasis','YearlyBasisProgrammeWise','YearlyReportAdmissionTermwise','AdmittedStudentByInstitution','termwiseReportAdmission','studentsConsecutiveCGPA','studentsConsecutiveCGPAXLS','studentsConsecutiveCGPALessThan2','studentsConsecutiveCGPALessThan2XLS','CopyInstitute','UpdateInstitute','generateStudentsMobileNo','studentsMobileNoXLS','reportPassingOut','passingOutReportXLS','MahmudurRahmanScholarship'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','getBatch'),
				'users'=>array('admin'),
			),
                      /*  array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('jhuman','AttendanceExcel','GetSection'),
				'users'=>array('jhuman'),
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
             elseif (yii::app()->user->getState('role')==='exam')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(''),
				'users'=>array('*'),
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('reportPassingOut','passingOutReportXLS','getBatch','GetSection'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
				'users'=>array(Yii::app()->user->id),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	
	public function actionIndex()
	{
		$this->render('index');
	}

        public function actionGetSection()
        {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if(isset($_REQUEST['programmeCode']))
		{
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                    $model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']));
                 
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
                            $batchName="---".$item->batchName.FormUtil::getBatchNameSufix($item->batchName)." Batch---";
                            echo "<optgroup label='{$batchName}'>";
                            foreach(Section::model()->findAllByAttributes(array('batchName'=>$item->batchName,'programmeCode'=>$item->programmeCode)) as $item2)
                            {
                                $sectionName="Section ".$item2->batchName.FormUtil::getBatchNameSufix($item2->batchName)." ".$item2->sectionName."    -- ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year." --";
                                echo CHtml::tag('option',array('value'=>$item2->batchName."-".$item2->sectionName),CHtml::encode($sectionName),true);
                            }
                            echo"</optgroup>";
                            
                        
                            
                        }

                    }  
                   
                }
                
                
        }
        public function actionGetBatch()
        {
            if(isset($_REQUEST['programmeCode']))
		{
			echo "programme code:".$_REQUEST['programmeCode'];
		
                    $model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']),'ex_bat_active=true');
                 
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No Batch Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                        
               
                        
                        foreach($model as $item)
                        {
                            $termYear="-- ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year." --";
                            echo "<optgroup label='{$termYear}'>";
                            $batchName="--".$item->batchName.FormUtil::getBatchNameSufix($item->batchName);
                                echo CHtml::tag('option',array('value'=>$item->batchName),CHtml::encode($batchName),true);
                            echo"</optgroup>";
                        }

                     }  
                   
                }
        }
         public function actionGetBatch1()
        {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if(isset($_REQUEST['programmeCode']))
		{
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                    $model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']));
                 
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No Section Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                        
                        //$model=CHtml::listData($model,'batchName','batchName');
                        echo "<optgroup label='Batch'>";
                        foreach($model as $item)
                        {
                             
                            $batchName=$item->batchName;//.FormUtil::getBatchNameSufix($item->batchName);
                           
                           // foreach(Section::model()->findAllByAttributes(array('batchName'=>$item->batchName,'programmeCode'=>$item->programmeCode)) as $item2)
                           // {
                               // $sectionName=item2->batchName.FormUtil::getBatchNameSufix($item2->batchName);
                                echo CHtml::tag('option',array('value'=>$batchName),CHtml::encode($batchName),true);
                          //  }
                            
                            
                        
                            
                        }
                        echo"</optgroup>";
                    }  
                   
                }
                
                
        }
      
        public function actionCopyInstitute()
        {
            $sql = "SELECT DISTINCT \"institutionName\",\"institutionID\",district FROM tbl_k_institution 
                    WHERE \"institutionName\" LIKE '%Agroni%'
                    ORDER BY \"institutionName\" ";
           /* $sql = "SELECT DISTINCT \"institutionName\", \"institutionID\",district, division,\"educationBoard\", \"institutionType\" FROM tbl_k_institution 
                    WHERE \"institutionName\" LIKE '%A%'
                    ORDER BY \"institutionName\" ";*/
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            
             foreach ($rows as $row)
                {
                
                     echo $row['institutionID'].' ,'.$row['institutionName'].' ,'.$row['district'].' '.$row['division'].' '.$row['educationBoard'].' '.$row['institutionType'].'</br>';
                 }
               
                           
            
        }
        public function actionUpdateInstitute()
        {
            /*$sql = "UPDATE tbl_k_institution
                   SET \"institutionID\"=, \"institutionName\"=, district=, division=, 
                       \"educationBoard\"=, \"institutionType\"=
                 WHERE \"institutionName\" LIKE '%Abdus Subhan%'";*/
           $sql = "UPDATE tbl_k_institution
                   SET \"institutionName\"='A.K.M.Mosharraf Hossain High School',
                   district='Moulavi Bazar'                   
                 WHERE \"institutionName\" LIKE '%Agragami Girls High School,%'";
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            
            if(Yii::app()->db->createCommand($sql)->execute())
            {
                 echo "Record Updated";
            }
        }
      public function actionAttendanceExcel()
	{
         if(isset($_REQUEST['programmeCode'],$_REQUEST['sectionName2']))
            {
                $split= array();
                $split= explode('-', $_REQUEST['sectionName2']);
                yii::app()->session['attYear']=$_REQUEST['attYear'];
                        yii::app()->session['attTerm']=$_REQUEST['attTerm'];
                        yii::app()->session['attProCode']=$_REQUEST['programmeCode'];
                        yii::app()->session['attBatName']=$split[0];
                        yii::app()->session['attSecName']=$split[1];
                
                
            }
             $pg = yii::app()->session['attProCode'];
             $bg = yii::app()->session['attBatName'];
             $sg = yii::app()->session['attSecName'];
                    
             $sql = "SELECT *
                    FROM 
                    vw_attendance 
                    WHERE 
                    \"programmeCode\" = '{$pg}' AND
                    \"batchName\" = '{$bg}' AND
                    \"sectionName\" = '{$sg}'
                    ORDER BY \"studentID\"
                   ";            
               
             $rows = Yii::app()->db->createCommand($sql)->queryAll();
           //  $sql ="select * from vw_attendance where \"offeredModuleID\"=:offeredModuleID; ";
              //  $dataProvider = Admission::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['attOfmID']));
                
            $html = $this->renderPartial('attendanceExcel',array(
                                   'rows'=>$rows),true);
                        
	     Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('attendanceExcel', array(
				'rows'=>$rows
			), true)
		);
	}

        public function actionReportAllAdmission()
	{
      
                if(isset($_REQUEST['programmeCode'],$_REQUEST['reportTerm'],$_REQUEST['reportYear']))
                {
                    yii::app()->session['adReProCode']=$_REQUEST['programmeCode'];
                    yii::app()->session['adReTerm']=$_REQUEST['reportTerm'];
                    yii::app()->session['adReYear']=$_REQUEST['reportYear'];
                }        
                       
                
                
                $model = new Admission();
		
                $batch = $model->findByAttributes(array('programmeCode'=>yii::app()->session['adReProCode'],'adm_startTerm'=>yii::app()->session['adReTerm'],'adm_startYear'=>yii::app()->session['adReYear']));
              
                yii::app()->session['adReBatName']=$batch->batchName;
                
                
                $dataProvider = $model->searchReportAllAdmission( yii::app()->session['adReProCode'], yii::app()->session['adReTerm'], yii::app()->session['adReYear']);
                
                $this->render('reportAllAdmission',array('model'=>$model,'dataProvider'=>$dataProvider));
         
	}
        
        public function actionAllAdmissionPDF()
        {
               
                       
                
               $session=new CHttpSession;
               $session->open();
               Yii::import('application.modules.admin.extensions.bootstrap.*');
                
                require_once(Yii::app()->params['tcpdf']);
            require_once(Yii::app()->params['tcpdfConf']);

                             
                $model = new Admission();
              
                $rows = $model->searchAllAdmission(yii::app()->session['adReProCode'], yii::app()->session['adReTerm'], yii::app()->session['adReYear']);
                $dataProvider = $model->searchReportAllAdmission(yii::app()->session['adReProCode'], yii::app()->session['adReTerm'], yii::app()->session['adReYear']);
                
                /*$this->render('ReportAllAdmission',array('model'=>$model,
                                   'dataProvider'=>$dataProvider,'dataProvider1'=>$dataProvider1));*/
                $html = $this->renderPartial('reportAllAdmissionPDF',array('model'=>$model,
                                   'dataProvider'=>$dataProvider),true);
                  
                                
                
                //$pdf = new TCPDF();
                $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor(Yii::app()->name);
            $pdf->SetTitle('Result Sheet');
            $pdf->SetSubject('Spring Term Examinatyion 2013');
            //$pdf->SetKeywords('example, text, report');
            //$pdf->SetHeaderData('', 0, "Tabulation Data", '');
            $pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Admission Register",'');
            $pdf->setHeaderFont(Array('times', '', 25));
            $pdf->setFooterFont(Array('times', '', 6));
            $pdf->SetMargins(15, 20, 15);
            $pdf->SetHeaderMargin(5);
            //$pdf->SetFooterMargin(10);
            $pdf->SetAutoPageBreak(TRUE, 0);
            $pdf->SetFont('times', '', 7);
            $pdf->AddPage();
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->LastPage();
            $pdf->Output("ResultSheet".'pdf', "I");



            }
 
      public function actionReportAttandance()
        {
      
                if(isset($_REQUEST['programmeCode'],$_REQUEST['reportTerm'],$_REQUEST['reportYear']))
                {
                    yii::app()->session['programmeCode']=$_REQUEST['programmeCode'];
                    yii::app()->session['reportTerm']=$_REQUEST['reportTerm'];
                    yii::app()->session['reportYear']=$_REQUEST['reportYear'];
                }        
                        
                $model = new Admission();
		                 
                $dataProvider = $model->searchReportAllAdmission( yii::app()->session['programmeCode'], yii::app()->session['reportTerm'], yii::app()->session['reportYear']);
                
                $this->render('reportAttandance',array('model'=>$model,'dataProvider'=>$dataProvider));
         
	}
        
        public function actionPerformanceReport()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
                

                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']))
                {
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    
                }
                 $yr = yii::app()->session['attYear'];
                $sql ="SELECT
                    q.\"tra_term\",
                    q.\"tra_year\",
                    sum (check_grade_point(check_grade1(s.\"markingSchemeID\", s.\"reg_midterm\", u.\"emr_mark\", s.\"reg_attendence\" + s.\"reg_midterm\" + s.\"reg_classTest\" + u.\"emr_mark\"))) as total 
                   FROM tbl_o_student o, 
                    tbl_j_person j, 
                    tbl_p_admission p, 
                    tbl_s_moduleregistration s, 
                    tbl_h_offeredmodule h, 
                    tbl_e_module e, 
                    tbl_q_termadmission q, 
                    tbl_u_exammarks u, 
                    tbl_t_examination t
                  WHERE o.\"studentID\"::text = p.\"studentID\"::text AND o.\"studentID\"::text = q.\"studentID\"::text AND j.\"personID\" = o.\"personID\" AND s.\"offeredModuleID\" = h.\"offeredModuleID\" AND s.\"moduleRegistrationID\" = u.\"moduleRegistrationID\" AND h.\"moduleCode\"::text = e.\"moduleCode\"::text AND h.\"syllabusCode\"::text = e.\"syllabusCode\"::text AND q.\"termAdmissionID\" = s.\"termAdmissionID\" AND t.\"examinationID\" = u.\"examinationID\"
                        AND o.\"studentID\" ='102-116-006'	
                        GROUP BY q.\"tra_term\", q.\"tra_year\"
                        ORDER BY  q.\"tra_year\",q.\"tra_term\"
                    ";     
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            $this->render('performanceReport',array('result'=>$result));
         
	}
        
       
        public function actionYearlyReportAdmissionGraph()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
                

                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']))
                {
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    
                }
                 $yr = yii::app()->session['attYear'];

            $sql = "
             SELECT 
                  tbl_c_programme.\"pro_name\",
                  tbl_j_person.\"per_gender\", 
                  count(tbl_j_person.\"per_gender\") as total, 
                  count(tbl_c_programme.\"pro_name\")

                FROM 
                  public.tbl_j_person, 
                  public.tbl_o_student, 
                  public.tbl_c_programme
                WHERE 
                  tbl_o_student.\"personID\" = tbl_j_person.\"personID\" AND
                  tbl_o_student.\"programmeCode\" = tbl_c_programme.\"programmeCode\" AND
                  tbl_o_student.\"stu_academicYear\" = '{$yr}'
                GROUP BY
                  tbl_c_programme.\"pro_name\",
                  tbl_j_person.\"per_gender\"
                ORDER BY
                   tbl_c_programme.\"pro_name\"
            
            ";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            $this->render('yearlyReportGraphGenerate',array('result'=>$result));
         
	}
        
                    
             
         public function actionYearlyBasisProgrammeWise()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
                

                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']))
                {
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    
                }
                 $year = 2015;//yii::app()->session['attYear'];
      
            
            $sql ="SELECT a.\"programmeCode\", a.\"adm_startYear\", count(p.\"personID\") as total
                    FROM public.tbl_j_person p, public.tbl_p_admission a, public.tbl_o_student s
                    WHERE p.\"personID\" = s.\"personID\" AND s.\"studentID\" = a.\"studentID\" AND a.\"adm_startYear\" =:year
                    GROUP BY a.\"programmeCode\", a.\"adm_startYear\" ORDER BY a.\"programmeCode\"";

           $sql1 ="SELECT a.\"programmeCode\", count(p.\"personID\") as total
                   FROM public.tbl_j_person p, public.tbl_p_admission a, public.tbl_o_student s
                    WHERE p.\"personID\" = s.\"personID\" AND s.\"studentID\" = a.\"studentID\" AND a.\"adm_startYear\" =:year
                    GROUP BY a.\"programmeCode\", a.\"adm_startYear\" ORDER BY a.\"programmeCode\"";

                 $params = array(':year' => $year,);
                 $command=Yii::app()->db->createCommand($sql);
                 $command->bindParam(':year',$year, PDO::PARAM_INT);
                 //$result = Person::model()->findAllBySql($sql, array(':year'=>$year));
                 $command1=Yii::app()->db->createCommand($sql1);
                 $command1->bindParam(':year',$year, PDO::PARAM_INT);
                 $result = $command1->queryAll();
                 
                 $dataProvider=new CSqlDataProvider($sql, array(
                        'id'=>'id',
                       // 'totalItemCount'=>$count,
                        'params'=>$params,
                         'sort'=>array(
                            'attributes'=>array(
                                 'programmeCode','batchName',
                            ),
                        ),
                        'pagination'=>array(
                            'pageSize'=>30000,
                        ),
                    ));

    //
                 $this->render('yearlyProgrammeReportGraphGenerate',array('result'=>$result,'year'=>$year,'dataProvider'=>$dataProvider,'model'=>$model));            
        //      
         
           
         
         
	}
          public function actionYearlyBasisProgrammeWise1()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
                

                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']))
                {
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    
                }
                 $yr = yii::app()->session['attYear'];

            $sql = "
                 SELECT 
                  count (tbl_o_student.\"studentID\") as total, 
                  tbl_c_programme.\"pro_shortName\", 
                  tbl_p_admission.\"adm_startYear\"
                FROM 
                  public.tbl_p_admission, 
                  public.tbl_o_student, 
                  public.tbl_c_programme
                WHERE 
                  tbl_p_admission.\"studentID\" = tbl_o_student.\"studentID\" AND
                  tbl_p_admission.\"programmeCode\" = tbl_c_programme.\"programmeCode\" AND
                  tbl_p_admission.\"adm_startYear\" between '2009' and '2015'
                GROUP BY 
                tbl_c_programme.\"pro_shortName\", 
                tbl_p_admission.\"adm_startYear\"
                ORDER BY tbl_c_programme.\"pro_shortName\",
                tbl_p_admission.\"adm_startYear\"
            ";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    
                     'sort'=>array(
                        'attributes'=>array(
                             'total','pro_shortName','adm_startYear',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
            $this->render('yearlyProgrammeReportGraphGenerate',array('result'=>$result,'dataProvider'=>$dataProvider));
         
	}
         public function actionAdmissionYearlyBasis()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
                

                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']))
                {
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    
                }
                 $yr = yii::app()->session['attYear'];
                $sql ="SELECT 
                          count(tbl_o_student.\"studentID\") as total, 
                          tbl_o_student.\"stu_academicYear\" as id
                        FROM 
                          public.tbl_o_student, 
                          public.tbl_p_admission
                        WHERE 
                          tbl_p_admission.\"studentID\" = tbl_o_student.\"studentID\"
                        GROUP BY
                          tbl_o_student.\"stu_academicYear\"
                         ORDER BY tbl_o_student.\"stu_academicYear\"
                    ";     
            $result = Yii::app()->db->createCommand($sql)->queryAll();
                                  
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    
                     'sort'=>array(
                        'attributes'=>array(
                             'total',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
             
              $this->render('admissionYearlyBasis',array('result'=>$result,'dataProvider'=>$dataProvider));
	}
         public function actionBatchWiseTotalStudent()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
                

                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']) && isset($_REQUEST['attTerm']))
                {
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    yii::app()->session['attTerm']=$_REQUEST['attTerm'];
                    
                }
              	                 
               $rows = $model->searchReportBatchwiseTotalStudent( yii::app()->session['attTerm'], yii::app()->session['attYear']);
                
               //$this->render('reportBatchwiseTotalStudent',array('model'=>$model,'rows'=>$rows));
             
               $html = $this->renderPartial('reportBatchwiseTotalStudent',array(
                                   'rows'=>$rows),true);
                        
	     Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('reportBatchwiseTotalStudent', array(
				'rows'=>$rows
			), true)
		);       
	}
        public function actionYearlyReportAdmission()
	{
                $session=new CHttpSession;
                $session->open();
                Yii::import('application.modules.admin.extensions.bootstrap.*');
                Yii::import('application.modules.admin.extensions.fusioncharts.*');
                
                
                require_once(Yii::app()->params['fusioncharts']);
                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']))
                {
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    
                }
                 $year = yii::app()->session['attYear'];
                 
                 $sql="SELECT a.\"programmeCode\", t.\"batchName\" as id, p.\"per_gender\",coalesce(count(p.\"per_gender\"),0) as total, t.\"tra_year\"
                    FROM public.tbl_o_student s, public.tbl_j_person p,public.tbl_q_termadmission t, public.tbl_c_programme a
                    WHERE s.\"studentID\" = t.\"studentID\" AND p.\"personID\" = s.\"personID\" AND a.\"programmeCode\"=s.\"programmeCode\" AND t.\"tra_year\"=:year
                    GROUP BY t.\"tra_year\", a.\"programmeCode\",t.\"batchName\", p.\"per_gender\"
                    ORDER BY a.\"programmeCode\",t.\"batchName\" DESC, p.\"per_gender\" DESC";   
             
    //         $result = Person::model()->findAllBySql($sql, array(':term'=>$term,':year'=>$year));
              // $command = Yii::app()->db->createCommand($sql);
             $params = array(':year' => $year,);
             $command=Yii::app()->db->createCommand($sql);
             $command->bindParam(':year',$year, PDO::PARAM_INT);
                           
             $dataProvider=new CSqlDataProvider($sql, array(
                   // 'id'=>'id',
                   // 'totalItemCount'=>$count,
                    'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'programmeCode','batchName',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        
//
             $this->render('yearlyReport',array('year'=>$year,'dataProvider'=>$dataProvider));            
    //      
         
	}
public function actionYearlyReportAdmissionTermwise()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		Yii::import('application.modules.admin.extensions.fusioncharts.*');
                
                
                require_once(Yii::app()->params['fusioncharts']);
                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']) && isset ($_REQUEST['attTerm']))
                {
                    $year =$_REQUEST['attYear'];
                    $term =$_REQUEST['attTerm'];
                    
                }
             
              $sql="SELECT a.\"programmeCode\" as id, t.\"batchName\", p.\"per_gender\",coalesce(count(p.\"per_gender\"),0) as total, t.\"tra_term\", t.\"tra_year\"
                    FROM public.tbl_o_student s, public.tbl_j_person p,public.tbl_q_termadmission t, public.tbl_c_programme a
                    WHERE s.\"studentID\" = t.\"studentID\" AND p.\"personID\" = s.\"personID\" AND a.\"programmeCode\"=s.\"programmeCode\" AND t.\"tra_term\"=:term AND t.\"tra_year\"=:year
                    GROUP BY t.\"tra_term\", t.\"tra_year\", a.\"programmeCode\",t.\"batchName\", p.\"per_gender\"
                    ORDER BY a.\"programmeCode\",t.\"batchName\" DESC, p.\"per_gender\" DESC";   
             
    //         $result = Person::model()->findAllBySql($sql, array(':term'=>$term,':year'=>$year));
              // $command = Yii::app()->db->createCommand($sql);
             $params = array(':term' => $term,':year' => $year,);
             $command=Yii::app()->db->createCommand($sql);
             foreach ($params as $key => $val)
                {
                        $command->bindParam($key, $val, PDO::PARAM_STR);
                }      
               //    echo $sql; exit();        
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                            'batchName',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        
//
             $this->render('yearlyReportTermwise',array('term'=>$term,'year'=>$year,'dataProvider'=>$dataProvider));         
	}
    public function actionTermWiseReportAdmission()
	{
                $session=new CHttpSession;
                $session->open();
                Yii::import('application.modules.admin.extensions.bootstrap.*');
                Yii::import('application.modules.admin.extensions.fusioncharts.*');
                    
                require_once(Yii::app()->params['fusioncharts']);
                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']) && isset ($_REQUEST['attTerm']))
                {
                    $year =$_REQUEST['attYear'];
                    $term =$_REQUEST['attTerm'];
                    
                }
             $sql ="SELECT p.\"programmeCode\", i.\"per_gender\", coalesce(count(i.\"per_gender\"),0) as total,s.\"stu_academicTerm\", s.\"stu_academicYear\"
                    FROM public.tbl_c_programme p, public.tbl_j_person i, public.tbl_o_student s
                    WHERE p.\"programmeCode\" = s.\"programmeCode\" AND s.\"personID\" = i.\"personID\" AND s.\"stu_academicTerm\" =:term  AND s.\"stu_academicYear\" =:year
                    GROUP BY p.\"programmeCode\",i.\"per_gender\",s.\"stu_academicTerm\", s.\"stu_academicYear\" 
                    ORDER BY p.\"programmeCode\",i.\"per_gender\" ";
             
              $sql1 ="SELECT count(i.\"per_gender\") as total
                    FROM public.tbl_c_programme p, public.tbl_j_person i, public.tbl_o_student s
                    WHERE p.\"programmeCode\" = s.\"programmeCode\" AND s.\"personID\" = i.\"personID\" AND s.\"stu_academicTerm\" =:term  AND s.\"stu_academicYear\" =:year
                    GROUP BY i.\"per_gender\"
                    ORDER BY i.\"per_gender\" ";
            $result = Person::model()->findAllBySql($sql1, array(':term'=>$term,':year'=>$year));
              // $command = Yii::app()->db->createCommand($sql);
             $params = array(':term' => $term,':year' => $year,);
             $command=Yii::app()->db->createCommand($sql);
             foreach ($params as $key => $val)
                {
                        $command->bindParam($key, $val, PDO::PARAM_STR);
                }      
                           
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'programmeCode','batchName',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        
//
             $this->render('termWiseReport',array('result'=>$result,'term'=>$term,'year'=>$year,'dataProvider'=>$dataProvider));         
	}

        public function actionAdmittedStudentByInstitution()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		Yii::import('application.modules.admin.extensions.fusioncharts.*');
                
                
                require_once(Yii::app()->params['fusioncharts']);
                $model = new Admission();
	         
             $sql ="SELECT a.\"ach_institution\",count(s.\"studentID\") as total
                    FROM public.tbl_o_student s, public.tbl_j_person p, public.tbl_k_academichistory a
                    WHERE s.\"personID\" = p.\"personID\" AND p.\"personID\" = a.\"personID\" 
                    GROUP BY a.\"ach_institution\" ORDER BY a.\"ach_institution\"";

             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'ach_institution',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        
//
             $this->render('admittedStudentByInstitution',array('dataProvider'=>$dataProvider));         
	}
        
         public function actionStudentsConsecutiveCGPA()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		Yii::import('application.modules.admin.extensions.fusioncharts.*');
                                
                if(isset($_REQUEST['attYear']) && isset ($_REQUEST['attTerm']))
                {
                    $year =$_REQUEST['attYear'];
                    $term =$_REQUEST['attTerm'];
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    yii::app()->session['attTerm']=$_REQUEST['attTerm'];
                }
                
                    
                if($term==1)
                {
                    $term2 =3;
                    $term1 =2;
                    $year2 = $year;
                    $year1 = $year;
                }
                else if($term==2)
                {
                    $term2 =1;
                    $term1 =3;
                    $year2 = $year;
                    $year1 = $year-1;
                }
                else
                {
                    $term2 =2;
                    $term1 =1;
                    $year2 = $year;
                    $year1 = $year;
                }
                    
               // echo $term.$year.' '.$term2.$year2.' '.$term1.$year1;
                
                $model = new Admission();
                $sql ="SELECT x.\"studentID\", x.\"programmeCode\", x.\"batchName\", x.\"sectionName\", x.\"cgpa\"
                    FROM \"vw_CGPA4\" as x 
                    WHERE \"tra_term\"='{$term1}' AND  \"tra_year\"='{$year1}' AND \"cgpa\"=4
                    INTERSECT
                    SELECT y.\"studentID\", y.\"programmeCode\", y.\"batchName\", y.\"sectionName\", y.\"cgpa\"
                    FROM \"vw_CGPA4\" as y
                    WHERE \"tra_term\"='{$term2}' AND  \"tra_year\"='{$year2}' AND cgpa=4
                    INTERSECT 
                    SELECT z.\"studentID\", z.\"programmeCode\", z.\"batchName\", z.\"sectionName\", z.\"cgpa\"
                    FROM \"vw_CGPA4\" as z
                    WHERE \"tra_term\"='{$term}' AND  \"tra_year\"='{$year}' AND \"cgpa\"=4
                    ORDER BY \"programmeCode\", \"batchName\"";    
            
             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        
//
             $this->render('studentsConsecutiveCGPA',array('dataProvider'=>$dataProvider));         
	}
        
         public function actionStudentsConsecutiveCGPAXLS()
	{
                $year =yii::app()->session['attYear'];
                $term =yii::app()->session['attTerm'];
                    
                
                
                    
                if($term==1)
                {
                    $term2 =3;
                    $term1 =2;
                    $year2 = $year;
                    $year1 = $year;
                }
                else if($term==2)
                {
                    $term2 =1;
                    $term1 =3;
                    $year2 = $year;
                    $year1 = $year-1;
                }
                else
                {
                    $term2 =2;
                    $term1 =1;
                    $year2 = $year;
                    $year1 = $year;
                }
                    
               
                
                $model = new Admission();
                $sql ="SELECT x.\"studentID\", x.\"programmeCode\", x.\"batchName\", x.\"sectionName\", x.\"cgpa\"
                    FROM \"vw_CGPA4\" as x 
                    WHERE \"tra_term\"='{$term1}' AND  \"tra_year\"='{$year1}' AND \"cgpa\"=4
                    INTERSECT
                    SELECT y.\"studentID\", y.\"programmeCode\", y.\"batchName\", y.\"sectionName\", y.\"cgpa\"
                    FROM \"vw_CGPA4\" as y
                    WHERE \"tra_term\"='{$term2}' AND  \"tra_year\"='{$year2}' AND cgpa=4
                    INTERSECT 
                    SELECT z.\"studentID\", z.\"programmeCode\", z.\"batchName\", z.\"sectionName\", z.\"cgpa\"
                    FROM \"vw_CGPA4\" as z
                    WHERE \"tra_term\"='{$term}' AND  \"tra_year\"='{$year}' AND \"cgpa\"=4
                    ORDER BY \"programmeCode\", \"batchName\"";    
            
             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
         
            // $dataProvider = ModuleRegistration::model()->searchAcademicRecord(yii::app()->session['trnsStudentID']);
              
                
             Yii::app()->request->sendFile('ConsecutiveCGPA_'.'_'.date('dmY').'.xls',
			$this->renderPartial('_ConsecutiveCGPAXLS', array(
				'dataProvider'=>$dataProvider,
			), true)
		);
	}
        
        public function actionStudentsConsecutiveCGPALessThan2()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		Yii::import('application.modules.admin.extensions.fusioncharts.*');
                                
                if(isset($_REQUEST['attYear']) && isset ($_REQUEST['attTerm']))
                {
                    $year =$_REQUEST['attYear'];
                    $term =$_REQUEST['attTerm'];
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    yii::app()->session['attTerm']=$_REQUEST['attTerm'];
                }
                
                    
                if($term==1)
                {
                    $term2 =3;
                    $term1 =2;
                    $year2 = $year;
                    $year1 = $year;
                }
                else if($term==2)
                {
                    $term2 =1;
                    $term1 =3;
                    $year2 = $year;
                    $year1 = $year-1;
                }
                else
                {
                    $term2 =2;
                    $term1 =1;
                    $year2 = $year;
                    $year1 = $year;
                }
                    
               // echo $term.$year.' '.$term2.$year2.' '.$term1.$year1;
                
                $model = new Admission();
                $sql ="SELECT x.\"studentID\", x.\"programmeCode\", x.\"batchName\", x.\"sectionName\", x.\"cgpa\"
                    FROM \"vw_CGPA4\" as x 
                    WHERE \"tra_term\"='{$term1}' AND  \"tra_year\"='{$year1}' AND \"cgpa\"<2
                    INTERSECT
                    SELECT y.\"studentID\", y.\"programmeCode\", y.\"batchName\", y.\"sectionName\", y.\"cgpa\"
                    FROM \"vw_CGPA4\" as y
                    WHERE \"tra_term\"='{$term2}' AND  \"tra_year\"='{$year2}' AND cgpa<2
                    INTERSECT 
                    SELECT z.\"studentID\", z.\"programmeCode\", z.\"batchName\", z.\"sectionName\", z.\"cgpa\"
                    FROM \"vw_CGPA4\" as z
                    WHERE \"tra_term\"='{$term}' AND  \"tra_year\"='{$year}' AND \"cgpa\"<2
                    ORDER BY \"programmeCode\", \"batchName\"";    
            
             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        
//
             $this->render('studentsConsecutiveCGPALessThan2',array('dataProvider'=>$dataProvider));         
	}
         public function actionStudentsConsecutiveCGPALessThan2XLS()
	{
                $year =yii::app()->session['attYear'];
                $term =yii::app()->session['attTerm'];
                    
                
                
                    
                if($term==1)
                {
                    $term2 =3;
                    $term1 =2;
                    $year2 = $year;
                    $year1 = $year;
                }
                else if($term==2)
                {
                    $term2 =1;
                    $term1 =3;
                    $year2 = $year;
                    $year1 = $year-1;
                }
                else
                {
                    $term2 =2;
                    $term1 =1;
                    $year2 = $year;
                    $year1 = $year;
                }
                    
               
                
                $model = new Admission();
                $sql ="SELECT x.\"studentID\", x.\"programmeCode\", x.\"batchName\", x.\"sectionName\", x.\"cgpa\"
                    FROM \"vw_CGPA4\" as x 
                    WHERE \"tra_term\"='{$term1}' AND  \"tra_year\"='{$year1}' AND \"cgpa\"<2
                    INTERSECT
                    SELECT y.\"studentID\", y.\"programmeCode\", y.\"batchName\", y.\"sectionName\", y.\"cgpa\"
                    FROM \"vw_CGPA4\" as y
                    WHERE \"tra_term\"='{$term2}' AND  \"tra_year\"='{$year2}' AND \"cgpa\"<2
                    INTERSECT 
                    SELECT z.\"studentID\", z.\"programmeCode\", z.\"batchName\", z.\"sectionName\", z.\"cgpa\"
                    FROM \"vw_CGPA4\" as z
                    WHERE \"tra_term\"='{$term}' AND  \"tra_year\"='{$year}' AND \"cgpa\"<2
                    ORDER BY \"programmeCode\", \"batchName\"";    
            
             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
         
            // $dataProvider = ModuleRegistration::model()->searchAcademicRecord(yii::app()->session['trnsStudentID']);
              
                
             Yii::app()->request->sendFile('ConsecutiveCGPA_'.'_'.date('dmY').'.xls',
			$this->renderPartial('_ConsecutiveCGPALessThan2XLS', array(
				'dataProvider'=>$dataProvider,
			), true)
		);
	}
        public function actionYearlyReportAdmissionPDF()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
	    
                
                require_once(Yii::app()->params['tcpdf']);
                
		require_once(Yii::app()->params['tcpdfConf']);
                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']))
                {
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    
                }
                 $yr = yii::app()->session['attYear'];
                 
            $sql ="SELECT  p.\"pro_name\", i.\"per_gender\", count(i.\"per_gender\") as total
                        FROM public.tbl_o_student s, public.tbl_c_programme p, public.tbl_j_person i
                    WHERE 
                      s.\"personID\" = i.\"personID\" AND p.\"programmeCode\" = s.\"programmeCode\" AND
                      s.\"stu_academicYear\" = '{$yr}'
                      GROUP BY  p.\"pro_name\", i.\"per_gender\"
                      ORDER BY p.\"pro_name\"          
                    ";
         
            $pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor(Yii::app()->name);
            $pdf->SetTitle('Result Sheet');
            $pdf->SetSubject('Spring Term Examinatyion 2013');
            //$pdf->SetKeywords('example, text, report');
            //$pdf->SetHeaderData('', 0, "Tabulation Data", '');
            $pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Yearly Admission Report",'');
            $pdf->setHeaderFont(Array('times', '', 25));
            $pdf->setFooterFont(Array('times', '', 6));
            $pdf->SetMargins(15, 20, 15);
            $pdf->SetHeaderMargin(5);
            //$pdf->SetFooterMargin(10);
            $pdf->SetAutoPageBreak(TRUE, 0);
            $pdf->SetFont('times', '', 7);
            $pdf->AddPage();
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            
             $html = $this->renderPartial('yearlyReportPDF',array(
                                      'result'=>$result,'pdf'=>$pdf),true);
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->LastPage();
            $pdf->Output("Yearly Report".'pdf', "I");
           

            
	}
        
        
        
        public function actionAttandance()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);
             
                $model = new Admission();
	               
                $dataProvider = $model->searchReportAllAdmission(yii::app()->session['programmeCode'], yii::app()->session['reportTerm'], yii::app()->session['reportYear']);
                $dataProvider1 = $model->searchTotalAdmission(yii::app()->session['programmeCode'], yii::app()->session['reportTerm'], yii::app()->session['reportYear']);
                
                $this->render('reportAttandance',array('model'=>$model,
                                   'dataProvider'=>$dataProvider,'dataProvider1'=>$dataProvider1));
               /* $html = $this->renderPartial('ReportAllAdmission',array('model'=>$model,
                                   'dataProvider'=>$dataProvider,'dataProvider1'=>$dataProvider1),true);
                $pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('School Report');
		$pdf->SetSubject('School Report');
		//$pdf->SetKeywords('example, text, report');
		$pdf->SetHeaderData('', 0, "Report", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Example Report by ".Yii::app()->name, "");
		$pdf->setHeaderFont(Array('helvetica', '', 8));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, 18, 15);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('dejavusans', '', 7);
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("TabulationSheet", "I");*/
                 
	}
        public function actionStudentsMobileNoXLS()
	{
                           
                  $program = yii::app()->session['attProgram'];
                  $batch = yii::app()->session['attBatch'];
                    
                 $sql ="SELECT \"studentID\", \"name\",mobile_no
                      FROM vw_student_mobile_no
                      WHERE \"programmeCode\"='{$program}' AND \"batchName\"={$batch}";    
         // echo $sql; exit();
             $command=Yii::app()->db->createCommand($sql);
            
             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
         
            // $dataProvider = ModuleRegistration::model()->searchAcademicRecord(yii::app()->session['trnsStudentID']);
              
                
             Yii::app()->request->sendFile('StudentmobileNoXLS'.'_'.date('dmY').'.xls',
			$this->renderPartial('_mobileNoXLS', array(
				'dataProvider'=>$dataProvider,
			), true)
		);
	}
        public function actionGenerateStudentsMobileNo()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		Yii::import('application.modules.admin.extensions.fusioncharts.*');
                                
                if(isset($_REQUEST['programmeCode']) && isset ($_REQUEST['sectionName3']))
                {
                    $program =$_REQUEST['programmeCode'];
                    $batch =$_REQUEST['sectionName3'];            
                   yii::app()->session['attProgram'] =$_REQUEST['programmeCode'];;
                   yii::app()->session['attBatch'] =$_REQUEST['sectionName3'];
                    
                $sql ="SELECT \"studentID\", \"name\",mobile_no
                      FROM vw_student_mobile_no
                      WHERE \"programmeCode\"='{$program}' AND \"batchName\"={$batch}";    
         // echo $sql; exit();
             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        
             }
             $this->render('studentsMobileNo',array('dataProvider'=>$dataProvider));         
	}
      public function actionReportPassingOut()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		Yii::import('application.modules.admin.extensions.fusioncharts.*');
                                
                if(isset($_REQUEST['traTerm']) && isset ($_REQUEST['traYear']))
                {
                    $term =$_REQUEST['traTerm'];
                    $year =$_REQUEST['traYear'];            
                   yii::app()->session['traTerm'] =$_REQUEST['traTerm'];
                   yii::app()->session['traYear'] =$_REQUEST['traYear'];    
                
/*                $sql ="SELECT \"studentID\", \"name\",mobile_no
                      FROM vw_student_mobile_no
                      WHERE \"programmeCode\"='{$program}' AND \"batchName\"={$batch}"; */
               $sql =  "SELECT * FROM calculate_batchwise_passing_out_list({$term},{$year})";
         // echo $sql; exit();
             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentid',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        
             }
             $this->render('passingOutReport',array('dataProvider'=>$dataProvider));         
	}
       
          public function actionPassingOutReportXLS()
	{
                           
             $term = yii::app()->session['traTerm'];
             $year = yii::app()->session['traYear'];

             $sql =  "SELECT * FROM calculate_batchwise_passing_out_list({$term},{$year})";
      
         // echo $sql; exit();
             $command=Yii::app()->db->createCommand($sql);
            
             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentid',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
         
            // $dataProvider = ModuleRegistration::model()->searchAcademicRecord(yii::app()->session['trnsStudentID']);
              
                
             Yii::app()->request->sendFile('PassingOutReportXLS'.'_'.date('dmY').'.xls',
			$this->renderPartial('_passingOutReport', array(
				'dataProvider'=>$dataProvider,
			), true)
		);
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
           public function actionMahmudurRahmanScholarship()
	{
                $session=new CHttpSession;
                $session->open();
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		Yii::import('application.modules.admin.extensions.fusioncharts.*');
                
                
                require_once(Yii::app()->params['fusioncharts']);
                $model = new Admission();
	         
                if(isset($_REQUEST['attYear']))
                {
                    yii::app()->session['attYear']=$_REQUEST['attYear'];
                    
                }
                 $year = yii::app()->session['attYear'];
                 
                 $sql="SELECT a.\"programmeCode\", t.\"batchName\", p.\"per_gender\",coalesce(count(p.\"per_gender\"),0) as total, t.\"tra_year\"
                    FROM public.tbl_o_student s, public.tbl_j_person p,public.tbl_q_termadmission t, public.tbl_c_programme a
                    WHERE s.\"studentID\" = t.\"studentID\" AND p.\"personID\" = s.\"personID\" AND a.\"programmeCode\"=s.\"programmeCode\" AND t.\"tra_year\"=:year
                    GROUP BY t.\"tra_year\", a.\"programmeCode\",t.\"batchName\", p.\"per_gender\"
                    ORDER BY a.\"programmeCode\",t.\"batchName\" DESC, p.\"per_gender\" DESC";   
             
    //         $result = Person::model()->findAllBySql($sql, array(':term'=>$term,':year'=>$year));
              // $command = Yii::app()->db->createCommand($sql);
             $params = array(':year' => $year,);
             $command=Yii::app()->db->createCommand($sql);
             $command->bindParam(':year',$year, PDO::PARAM_INT);
                           
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'programmeCode','batchName',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        
//
             $this->render('yearlyReport',array('result'=>$result,'year'=>$year,'dataProvider'=>$dataProvider));            
    //      
         
	}
}

  /*  $sql = 'SELECT tbl_o_student."studentID", tbl_j_person."per_firstName",tbl_j_person."per_lastName", 
                            tbl_j_person."per_title", tbl_j_person."per_gender", 
                            tbl_j_person."per_dateOfBirth", tbl_j_person."per_bloodGroup", tbl_j_person."per_mobile", 
                            tbl_j_person."per_presentAddress", tbl_j_person."per_fathersName", tbl_p_admission."adm_date", 
                            tbl_c_programme."pro_shortName" 	 
                            FROM tbl_o_student, tbl_j_person, tbl_p_admission, tbl_c_programme
                            WHERE 
                            tbl_o_student."personID" = tbl_j_person."personID" AND
                            tbl_o_student."studentID" = tbl_p_admission."studentID" AND
                            tbl_o_student."programmeCode" = tbl_c_programme."programmeCode" AND';
                      
                     $sql .= ' tbl_o_student."stu_academicYear" = ' . $_REQUEST['stu_academicYear']; //the product id    
                     $sql .= ' AND  tbl_o_student."stu_academicTerm" = ' . $_REQUEST['stu_academicTerm']; //the product id    
 
                      $rows = Yii::app()->db->createCommand($sql)->queryAll();
                      
                      $sql = 'SELECT COUNT(*)	 
                             FROM tbl_o_student, tbl_j_person, tbl_p_admission, tbl_c_programme
                             WHERE tbl_o_student."personID" = tbl_j_person."personID" AND
                              tbl_o_student."studentID" = tbl_p_admission."studentID" AND
                              tbl_o_student."programmeCode" = tbl_c_programme."programmeCode" AND';
                      $sql .= ' tbl_o_student."stu_academicYear" = ' . $_REQUEST['stu_academicYear']; //the product id    
                      $sql .= ' AND tbl_o_student."stu_academicTerm" = ' . $_REQUEST['stu_academicTerm']; //the product id    
                                         
                      $rows1 = Yii::app()->db->createCommand($sql)->queryAll();
                     
                      $sql = 'SELECT COUNT(per_gender)	 
                             FROM tbl_o_student, tbl_j_person, tbl_p_admission, tbl_c_programme
                             WHERE tbl_o_student."personID" = tbl_j_person."personID" AND
                              tbl_o_student."studentID" = tbl_p_admission."studentID" AND
                              tbl_o_student."programmeCode" = tbl_c_programme."programmeCode" AND';
                      $sql .= ' tbl_o_student."stu_academicYear" = ' . $_REQUEST['stu_academicYear']; //the product id    
                      $sql .= ' AND tbl_o_student."stu_academicTerm" = ' . $_REQUEST['stu_academicTerm']; //the product id    
                      $sql .= ' AND tbl_j_person."per_gender" = male'; //the product id                      
                      
                      
                      $rows2 = Yii::app()->db->createCommand($sql)->queryAll();
                      $sex = 'female';  
                      $sql = 'SELECT COUNT(per_gender)	 
                             FROM tbl_o_student, tbl_j_person, tbl_p_admission, tbl_c_programme
                             WHERE tbl_o_student."personID" = tbl_j_person."personID" AND
                              tbl_o_student."studentID" = tbl_p_admission."studentID" AND
                              tbl_o_student."programmeCode" = tbl_c_programme."programmeCode" AND';
                      $sql .= ' tbl_o_student."stu_academicYear" = ' . $_REQUEST['stu_academicYear']; //the product id    
                      $sql .= ' AND tbl_o_student."stu_academicTerm" = ' . $_REQUEST['stu_academicTerm']; //the product id    
                     // $sql .= ' AND tbl_j_person."per_gender" IN ($sex)'; //the product id                      
                      
                      
                      $rows3 = Yii::app()->db->createCommand($sql)->queryAll();
                */      
                   
                