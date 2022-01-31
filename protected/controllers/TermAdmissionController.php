<?php

class TermAdmissionController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete2','admission','termAdmission','termsBySection','studentList','MagicBoxAdmitCard','getAttendance','getSection','AttStudentList','AttendanceExcel','AttendancePDF','TermAdmittedExcel','TermAdmittedPDF','GetModule','TermAdmissionAdvance','createBulkAdmission'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            
            elseif (yii::app()->user->getState('role')==='head') {
            
                return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','admission','termAdmission','termsBySection','studentList','MagicBoxAdmitCard','getAttendance','getSection','AttStudentList','AttendanceExcel','AttendancePDF','TermAdmittedExcel','TermAdmittedPDF','GetModule'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='coordinator') {
            
                return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','admission','termAdmission','termsBySection','studentList','MagicBoxAdmitCard','getAttendance','getSection','AttStudentList','AttendanceExcel','AttendancePDF','TermAdmittedExcel','TermAdmittedPDF','GetModule'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='faculty') {
            
                return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','admission','termAdmission','termsBySection','studentList','MagicBoxAdmitCard','getAttendance','getSection','AttStudentList','AttendanceExcel','AttendancePDF','TermAdmittedExcel','TermAdmittedPDF','GetModule'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='exam') {
            
                return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','admin','admission','termAdmission','termsBySection','studentList','MagicBoxAdmitCard','getAttendance','getSection','AttendanceExcel','AttendancePDF','TermAdmittedExcel','TermAdmittedPDF','GetModule','termAdmissionAdvance','CreateBulkAdmission'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='admin') {
            
                return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','admin','admission','termAdmission','termsBySection','studentList','MagicBoxAdmitCard','getAttendance','getSection','AttendanceExcel','AttendancePDF','TermAdmittedExcel','TermAdmittedPDF','GetModule','termAdmissionAdvance','CreateBulkAdmission'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='deo') {
            
                return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','admin','admission','termAdmission','termsBySection','studentList','MagicBoxAdmitCard','getAttendance','getSection','AttendanceExcel','AttendancePDF','TermAdmittedExcel','TermAdmittedPDF','GetModule','termAdmissionAdvance','createBulkAdmission'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='admission') {
            
                return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','admin','admission','termAdmission','termsBySection','studentList','MagicBoxAdmitCard','getAttendance','getSection','AttendanceExcel','AttendancePDF','TermAdmittedExcel','TermAdmittedPDF','GetModule','TermAdmissionAdvance','createBulkAdmission'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionTermAdmission()
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
                            
                            yii::app()->session['studentName'] = $person->per_title." ".$person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['acTerm'] = $student->stu_academicTerm;
                            yii::app()->session['acYear'] = $student->stu_academicYear;
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
            //echo $data['programmeCode'];
            //echo count(OfferedModule::model()->findAllByAttributes(array('sectionName'=>$data['sectionName'],'batchName'=>$data['batchName'],'programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year'])));
            
            if(!$flagOfm=(count(OfferedModule::model()->findAllByAttributes(array('sectionName'=>$data['sectionName'],'batchName'=>$data['batchName'],'programmeCode'=>$data['programmeCode'],'ofm_term'=>$data['tra_term'],'ofm_year'=>$data['tra_year'])))>0?true:false))
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

       
        public function actionTermsBySection($sid=null,$bid=null,$pid=null)
	{
            if($sid && $bid && $pid)
            {
                yii::app()->session['secName']=$sid;
                yii::app()->session['batName']=$bid;
                yii::app()->session['proCode']=$pid;
            }
            
            $data = array('sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode']);      
            
            
            
            
            
            $model = new TermAdmission();
           
            $dataProvider=$model->searchTermsBySection($data['sectionName'], $data['batchName'], $data['programmeCode']);        
        
            $this->render('termsBySection',array(
			'model'=>$model, 'dataProvider'=>$dataProvider
                    ));
                
              
	}
        
       
        public function actionStudentList($tid=null,$yid=null,$sid=null,$bid=null,$pid=null)
	{
            
            if($tid && $yid )
            { 
                yii::app()->session['traTerm']=$tid;
                yii::app()->session['traYear']=$yid;
                yii::app()->session['secName']=$sid;
                yii::app()->session['batName']=$bid;
                yii::app()->session['programmeCode']=$pid;
            }
            
            $data = array('traTerm'=>yii::app()->session['traTerm'],'traYear'=>yii::app()->session['traYear'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode']);      
            
            
            $model = new TermAdmission();
           
            $dataProvider=$model->searchStudentList($data['traTerm'],$data['traYear'],$data['sectionName'], $data['batchName'], $data['programmeCode']);        
        
            $this->render('studentList',array(
			'model'=>$model, 'dataProvider'=>$dataProvider
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
                                
                                yii::app()->session['termAdmissinID']=TermAdmission::model()->findByAttributes($data)->termAdmissionID;
                                Yii::app()->user->setFlash('success','Term Admission Successful.');
                                
				$this->redirect(array('moduleRegistration/index','id'=>yii::app()->session['termAdmissinID']));
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
		$model=$this->loadModel($id);
//echo $id; exit();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TermAdmission']))
		{
			$model->attributes=$_POST['TermAdmission'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->termAdmissionID));
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
	public function actionDelete2($id)
	{       
            
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('termAdmission'));
	}

	
        public function actionIndex()
	{
            
                if(isset($_REQUEST['traYear'] , $_REQUEST['traTerm']))
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

        
        public function actionMagicBoxAdmitCard()
        {
            $this->renderPartial('_MagicBoxAdmitCard',array('ok'=>'ok'),false,true);
		
            
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
        
        
        

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TermAdmission the loaded model
	 * @throws CHttpException
	 */
        
        public function actionGetModule()
        { if(isset($_REQUEST['programmeCode'],$_REQUEST['sectionName']))
            {
                $split= array();
                $split= explode('-', $_REQUEST['sectionName']);
                yii::app()->session['attYear']=$_REQUEST['attYear'];
                        yii::app()->session['attTerm']=$_REQUEST['attTerm'];
                        yii::app()->session['attProCode']=$_REQUEST['programmeCode'];
                        yii::app()->session['attBatName']=$split[0];
                        yii::app()->session['attSecName']=$split[1];
                
                
            }
            
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

            /*
            $sql= "
SELECT *,
concat(j.per_title, ' ', j.\"per_firstName\", ' ', j.\"per_lastName\") AS fac_name
 FROM {{e_module}} as e join  {{h_offeredmodule}} as h on 
(e.\"moduleCode\" = h.\"moduleCode\" 
AND e.\"syllabusCode\" = h.\"syllabusCode\" ) left join {{j_person}} as j
on (h.\"facultyID\"= j.\"personID\") WHERE 
                            
                            h.\"sectionName\" = :sectionName AND 
                            h.\"batchName\" = :batchName AND 
                            h.\"programmeCode\" = :programmeCode AND 
                            h.ofm_term = :ofm_term AND 
                            h.ofm_year = :ofm_year ";
*/
//echo $sql; exit();
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':programmeCode'=>yii::app()->session['attProCode'],':batchName'=>yii::app()->session['attBatName'],':sectionName'=>yii::app()->session['attSecName'],':ofm_term'=>yii::app()->session['attTerm'],':ofm_year'=>yii::app()->session['attYear']));
                    
            
            
            $this->renderPartial('getModule',array('ofmModule'=>$ofmModule));
        }
        
        
        public function actionTermAdmissionAdvance()
        {

		if(isset($_POST['programmeCode'],$_POST['sectionName4']))
                {
                    $split= array();
                    $split= explode('-', $_REQUEST['sectionName4']);

                        //   echo $_REQUEST['sectionName4']; exit();
                        
                            yii::app()->session['traTermAdv']=$_POST['traTermAdv'];
                            yii::app()->session['traYearAdv']=$_POST['traYearAdv'];

                            yii::app()->session['traProCodeAdv']=$_REQUEST['programmeCode'];
                            yii::app()->session['traBatNameAdv']=$split[0];
                            yii::app()->session['traSecNameAdv']=$split[1];


                }             
                //$dataProvider = $model->searchSubjectForResultPublish(yii::app()->session['rePublishProCode'],yii::app()->session['rePublishTerm'],yii::app()->session['rePublishYear']);
                $dataProvider = TermAdmission::model()->searchNotTermAdmittedStudent(yii::app()->session['traSecNameAdv'],yii::app()->session['traBatNameAdv'],yii::app()->session['traProCodeAdv'],yii::app()->session['traTermAdv'],yii::app()->session['traYearAdv']);
                $this->render('trmAdGetStudentOfBatch',array('dataProvider'=>$dataProvider));
               
        }
        
        
        public function actionCreateBulkAdmission()
        {
           // echo "Bismillah Hir Rahmanir Rahim  ";
                $flag=false;
                $modules = Offeredmodule::model()->findAllByAttributes(array('sectionName'=>yii::app()->session['traSecNameAdv'],'batchName'=>yii::app()->session['traBatNameAdv'],'programmeCode'=>yii::app()->session['traProCodeAdv'],'ofm_term'=>yii::app()->session['traTermAdv'],'ofm_year'=>yii::app()->session['traYearAdv']));
                
                if( count([$modules]))
                {
                    $data = array();
                    $data['sectionName']=yii::app()->session['traSecNameAdv'];
                    $data['batchName']=yii::app()->session['traBatNameAdv'];
                    $data['programmeCode']=yii::app()->session['traProCodeAdv'];
                    $data['tra_term']=yii::app()->session['traTermAdv'];
                    $data['tra_year']=yii::app()->session['traYearAdv'];
                    
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
                    
                    //$model= new TermAdmission();

                    if(isset($_REQUEST['data']))
                    {
                        
                        $empID = yii::app()->session['MainFacultyID'];
                        $i=0;
                        foreach($_REQUEST['data'] as $id)
                        {
                            $sql= "INSERT INTO {{q_termadmission}} (\"studentID\", \"sectionName\", \"batchName\", \"programmeCode\", tra_term, tra_year,\"employeeID\") VALUES "
                                 ."('{$id}','{$data['sectionName']}',{$data['batchName']},'{$data['programmeCode']}',{$data['tra_term']} ,{$data['tra_year']},{$empID})";

                                 //echo $sql;

                            if(Yii::app()->db->createCommand($sql)->execute())
                            {
                                    //echo "Alhamdulilah!!";
                                
                                $termAdmissionID = TermAdmission::model()->findByAttributes(array('studentID'=>$id,'sectionName'=>$data['sectionName'],'batchName'=>$data['batchName'],'programmeCode'=>$data['programmeCode'],'tra_term'=>$data['tra_term'],'tra_year'=>$data['tra_year']))->termAdmissionID;
                                $markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID; 
                        
                                $examinationID = Examination::model()->findByAttributes(array('exm_examTerm'=>$data['tra_term'],'exm_examYear'=>$data['tra_year'],'exm_type'=>1))->examinationID;      
                                
                                foreach ($modules as $item)
                                { 

                                    


                                        //$sql .="INSERT INTO {{s_moduleregistration}} (\"termAdmissionID\", \"offeredModuleID\", \"markingSchemeID\" ) VALUES ( {$termAdmissionID}, {$offeredModuleID}, {$markingSchemeID}) ;";

                                        $sql=" SELECT sp_insertmoduleregistration({$markingSchemeID},{$item->offeredModuleID},{$termAdmissionID},{$examinationID}); ";  
                                        //$sql.="test ";
                                       // echo $sql;                                //exit();
                                        if(Yii::app()->db->createCommand($sql)->execute())
                                        $flag=true;    
                                                
                                      //  $i++;
                                    

                                }
                                
                            }
                            $i++;
                        }
                    }

		
                    
                }
                else
                {
                    Yii::app()->user->setFlash('warning','No courses offered for this Term !!');
                    $dataProvider = TermAdmission::model()->searchNotTermAdmittedStudent(yii::app()->session['traSecNameAdv'],yii::app()->session['traBatNameAdv'],yii::app()->session['traProCodeAdv'],yii::app()->session['traTermAdv'],yii::app()->session['traYearAdv']);
                    $this->renderPartial('_noneAdmittedStudent',array('dataProvider'=>$dataProvider));
                }
                
                if($flag)
                {
                    Yii::app()->user->setFlash('success','Term Admission Successful For '.$i.' Students.');
                    $dataProvider = TermAdmission::model()->searchNotTermAdmittedStudent(yii::app()->session['traSecNameAdv'],yii::app()->session['traBatNameAdv'],yii::app()->session['traProCodeAdv'],yii::app()->session['traTermAdv'],yii::app()->session['traYearAdv']);
                    $this->renderPartial('_noneAdmittedStudent',array('dataProvider'=>$dataProvider));
                }
                
                 
                
        }


        public function loadModel($id)
	{
		$model=TermAdmission::model()->findByPk($id);
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
        
        
}
