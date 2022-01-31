<?php

class StudentController extends Controller
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
            
                    $rules = array('create','update','attendance','allattendance','printAct','studentProfile','ProfileIndex','RegisteredCourse','GetResult','FinancialRecord');
            }
            elseif(yii::app()->user->getState('role')==='head')
            {
                    $rules = array('create','update','attendance','allattendance','printAct','studentProfile','ProfileIndex','RegisteredCourse','GetResult','FinancialRecord');
            }
            elseif(yii::app()->user->getState('role')==='exam')
            {
                    $rules = array('create','update','attendance','allattendance','studentProfile','printAct','ProfileIndex','RegisteredCourse','GetResult','FinancialRecord');
            }
            elseif(yii::app()->user->getState('role')==='admission')
            {
                //$rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','deleteSelected','GetPreviousRecordOf','InvoicePDF','StudentProfile','delete2');
                    $rules = array('create','update','attendance','allattendance','printAct','studentProfile','ProfileIndex','RegisteredCourse','GetResult','FinancialRecord');
            }
			elseif(yii::app()->user->getState('role')==='admin')
            {
                //$rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','deleteSelected','GetPreviousRecordOf','InvoicePDF','StudentProfile','delete2');
                    $rules = array('create','update','attendance','allattendance','printAct','studentProfile','ProfileIndex','RegisteredCourse','GetResult','FinancialRecord');
            }
            elseif(yii::app()->user->getState('role')==='deo')
            {
                //$rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','deleteSelected','GetPreviousRecordOf','InvoicePDF','StudentProfile','delete2');
                    $rules = array('create','update','attendance','allattendance','printAct','studentProfile','ProfileIndex','RegisteredCourse','GetResult','FinancialRecord');
            }
            elseif(yii::app()->user->getState('role')==='basic-user')
            {
                //$rules = array('admittedTerms','create','ModulesToBeAdvisied','RegisteredCourse','selectModule','selectedCourses','deleteSelected','GetPreviousRecordOf','InvoicePDF','StudentProfile','delete2');
                    $rules = array('studentProfile');
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
        
        
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

        
        public function actionAttendance()
	{
                
                $model=new Student('search');
                $admission = new Admission('search');
		$model->unsetAttributes();  // clear any default values
             
        	if(isset($_REQUEST['programmeCode']) && isset($_REQUEST['batchName']) && ($_REQUEST['sectionName'])) 
		{
                     	
                      $sql = 'SELECT st.studentID, pr.per_firstName,pr.per_lastName FROM tbl_student st 
                             JOIN tbl_person pr ON st.personID = pr.personID 
                             JOIN tbl_admission ad ON st.studentID = ad.studentID';
                      $sql .= ' WHERE st.programmeCode = ' . $_REQUEST['programmeCode']; //the product id    
                      $sql .= ' AND ad.batchName = ' . $_REQUEST['batchName']; //the product id    
                      $sql .= " AND ad.sectionName = '".$_REQUEST['sectionName']."'";
                      $rows = Yii::app()->db->createCommand($sql)->queryAll();
                      $mpdf = Yii::app()->ePdf->mpdf();

                   # You can easily override default constructor's params
                       $mpdf = Yii::app()->ePdf->mpdf();

                       //$mpdf = Yii::app()->ePdf->mpdf();
                       $filename = 'boots.css';
                       $path=Yii::getPathOfAlias('webroot.css.pdfcss.css') . '/';
                       $file=$path.$filename;
                       $stylesheet = file_get_contents($file, true);
                        $mpdf->WriteHTML($stylesheet, 1);
                          $mpdf->myvariable = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/MU.jpg' );
                       $html = '<div align="right"><img src="var:myvariable" height="50" width="120"></div>'; 
                        $mpdf->SetHTMLHeader($html);

                      $mpdf->WriteHTML($this->renderPartial('_attendance',array(
                                   'rows'=>$rows), true));
                     
                      $mpdf->SetHTMLFooter('
                       <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
                       <td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
                       <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
                       <td width="33%" style="text-align: right; ">Attendacne Sheet</td>
                       </tr></table>
                       ');

                      $mpdf->Output();
                                         
                      
                       //$this->render('_attendance',array('rows'=>$rows,));

                }
                else
                {

        		$this->render('attendance',array(
                		'model'=>$model,'admission'=>$admission,
                        ));
                }


	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$person = new Person;
                $student =new Student;
                $admission = new Admission;

                $admission->programmeCode = Yii::app()->session['programmeCode'];
                $admission->batchName = Yii::app()->session['batchName'];
                $admission->sectionName = yii::app()->session['sectionName'];
                
                         
                                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                if(isset($_POST['Person']))
		{
                
                    if(isset($_POST['Student']))
                    {
                         /*   $persons->attributes=$_POST['Person'];
                            $model->attributes=$_POST['Student'];
                            
                            $persons->per_entryDate = '2013-4-5';
                            $maxID = Yii::app()->db->createCommand()
                                                ->select('max(personID) as max')
                                                ->from('tbl_person')
                                                ->queryScalar();
                           $model->personID = $maxID + 1;
                            //if($persons->save())
                            //{
                            
                            //    $model->save();
                                $this->redirect(array('academichistory/create','id'=>$model->studentID));
                            //}
                           */ 
                    }
                }
		$this->render('create',array(
			'person'=>$person,'student'=>$student,'admission'=>$admission
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->studentID));
		}

		$this->render('update',array(
			'model'=>$model,
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		 yii::app()->session['sectionName']=$id;
                
                
		$programmeCode = Yii::app()->session['programmeCode'];
                $batchName = Yii::app()->session['batchName'];
                
                $condition = "sectionName='{$id}' and batchName='{$batchName}' and programmeCode='{$programmeCode}'";
                
		$dataProvider=new CActiveDataProvider('Admission', array(
                'criteria'=>array('condition'=>$condition),
                'pagination'=>array('pageSize'=>20,)
                 ));
                
		
                
                $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Student('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Student::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

        public function actionPrintAct($id)
	{
                
                $model=new Student('search');
                
		$model->unsetAttributes();  // clear any default values
                
        	//if(isset($name)) 
	//	{
                     	
                      $sql = "SELECT st.studentID, pr.per_title, pr.per_firstName, pr.per_lastName, pr.per_gender,
                              pr.per_dateofBirth, pr.per_bloodGroup, pr.per_nationality, pr.per_fathersName, 
                              pr.per_mothersName, pr.per_spouseName, pr.per_permanentAddress, pr.per_postCode, pr.per_telephone,
                              pr.per_mobile, pr.per_email, pr.per_presentAddress, pr.per_maritalStatus, 
                              pr.per_criminalConviction, pr.per_convictionDetails, pr.per_entryDate, 
                              ad.sectionName, ad.batchName, ad.programmeCode, ad.adm_date
                              FROM tbl_student st 
                              JOIN tbl_person pr ON st.personID = pr.personID 
                              JOIN tbl_admission ad ON st.studentID = ad.studentID
                              WHERE st.studentID = '$id'";
                      
                      $rows = Yii::app()->db->createCommand($sql)->queryAll();
                     

                   # You can easily override default constructor's params
                       $mpdf = Yii::app()->ePdf->mpdf();

                       //$mpdf = Yii::app()->ePdf->mpdf();
                       $filename = 'boots.css';
                       $path=Yii::getPathOfAlias('webroot.css.pdfcss.css') . '/';
                       $file=$path.$filename;
                       $stylesheet = file_get_contents($file, true);
                       $mpdf->WriteHTML($stylesheet, 1);
                       $mpdf->myvariable = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/MU.jpg' );
                       
                       $html = '<div align="right"><img src="var:myvariable" height="50" width="120"></div>'; 
                       $mpdf->SetHTMLHeader($html);

                       $mpdf->WriteHTML($this->renderPartial('_studentProfile',array(
                                   'rows'=>$rows), true));
                     
                      $mpdf->SetHTMLFooter('
                       <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
                       <td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
                       <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
                       <td width="33%" style="text-align: right; ">Student Profile</td>
                       </tr></table>
                       ');

                      $mpdf->Output();
                                         
                      
                       $this->render('_studentProfile',array('rows'=>$rows,));

        
	}
        
        
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
        public function actionStudentProfile($id)
	{
                $student=Student::model()->findByPk($id);
                   
       //         echo $student->personID;
         //   echo $id;
   		$this->render('studentProfile',array(
			'admission'=>  Admission::model()->findByAttributes(array('studentID'=>$id,'ex_adm_active'=>true)),
                        'student'=> $student,
                        'person'=> Person::model()->findByPk($student->personID)
		));
                
               
	}
        
        public function actionProfileIndex()
	{
            
            
            if(isset($_REQUEST['studentID']))
            {
                $split = array();
            
                $split = explode(' ', $_REQUEST['studentID']);
            
                Yii::app()->session['studentID']=$split[0];
                
            }
            
            
                $student=Student::model()->findByPk(Yii::app()->session['studentID']);
                
                if( count($student)==0)
                {
                     Yii::app()->user->setFlash('warning',' No result found !!!');
                     $this->redirect(array('site/index'));
                }
                
                $admission= Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID']),"ex_adm_active=true");
                $person = Person::model()->findByPk($student->personID);
                
                yii::app()->session['proCode']=$admission->programmeCode;
   		yii::app()->session['secName']= $admission->sectionName;
                yii::app()->session['batName']= $admission->batchName;
                yii::app()->session['studentName']= $person->per_firstName.' '.$person->per_lastName;
                yii::app()->session['acTerm']=$student->stu_academicTerm;
                yii::app()->session['acYear']=$student->stu_academicYear;
                
                $this->render('profileIndex',array(
                        'view'=>'_profile',
			'admission'=>  $admission,
                        'student'=> $student,
                        'person'=> $person
		));
                
               
	}

        
        public function actionRegisteredCourse()
	{
            $model = new ModuleRegistration();
            
                $dataProvider = $model->search(yii::app()->session['studentID'], yii::app()->session['proCode']);
            
                
                
                //echo "count:".count($dataProvider);
                $this->render('registeredCourseList',array('view'=>'_registeredCourse','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
        }
        
        
        public function actionGetResult()
	{
            
                            
                            $dataProvider= ExamMarks::searchIndividualResult(yii::app()->session['studentID']);
                              $this->render('getResult',array(
			'dataProvider'=>$dataProvider,
                    ));
                            
            
              
	}
        public function actionFinancialRecord()
	{
            
                $session=new CHttpSession;
                $session->open();
                $term =  FormUtil::getCurrentTerm();
                $year = FormUtil::getYear();
                $sid = yii::app()->session['studentID'];    
                $getTermAdmissionID = "SELECT 
                                      tbl_q_termadmission.\"termAdmissionID\" 
                                    FROM 
                                      public.tbl_o_student, 
                                      public.tbl_q_termadmission
                                    WHERE 
                                      tbl_o_student.\"studentID\" = tbl_q_termadmission.\"studentID\" AND
                                      tbl_o_student.\"studentID\" = '{$sid}' AND 
                                      tbl_q_termadmission.tra_term = '{$term}' AND 
                                      tbl_q_termadmission.tra_year = '{$year}' ;
                                    ";
                  $rows = Yii::app()->db->createCommand($getTermAdmissionID)->queryAll($getTermAdmissionID);
                  
                  foreach ($rows as $row) 
                      $getTermAdmissionID = $row['termAdmissionID'];
                  
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
                          h.\"sectionName\"
                        FROM 
                          public.tbl_h_offeredmodule h 
                          join public.tbl_s_moduleregistration s on (h.\"offeredModuleID\" = s.\"offeredModuleID\")
                        join	public.tbl_e_module e on (h.\"moduleCode\" = e.\"moduleCode\" AND h.\"syllabusCode\" = e.\"syllabusCode\" )


                          left join public.tbl_j_person j on (h.\"facultyID\" = j.\"personID\") 

                        WHERE 
                         s.\"termAdmissionID\" = '{$getTermAdmissionID}'
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
                              tbl_q_termadmission.\"termAdmissionID\" ='{$getTermAdmissionID}'
                              ;";
                    //echo $sql2; exit(0);        
                    $rows2 = Yii::app()->db->createCommand($sql2)->queryAll($getTermAdmissionID);
                    
                
                    $this->render('_finanacialRecord',array(
			'rows'=>$rows,'rows2'=>$rows2,
                    ));               
                                        
              
	}
}
