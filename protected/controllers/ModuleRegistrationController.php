<?php

class ModuleRegistrationController extends Controller
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
				'actions'=>array('admin','delete2','selectModule','RegisteredModule','needToRetake','Retake','SaveRetake','createTermAdmissionForRetake','CancelRetake','createTermAdmission'),
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','selectModule','RegisteredModule','needToRetake','retake','SaveRetake'),
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','selectModule','RegisteredModule','needToRetake','retake','SaveRetake'),
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','selectModule','RegisteredModule','needToRetake','retake'),
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','admin','selectModule','RegisteredModule','needToRetake','Retake','SaveRetake','createTermAdmissionForRetake','CancelRetake','createTermAdmission'),
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','admin','selectModule','RegisteredModule','needToRetake','Retake','SaveRetake','createTermAdmissionForRetake','CancelRetake','createTermAdmission'),
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','admin','selectModule','RegisteredModule','needToRetake','Retake','SaveRetake','createTermAdmissionForRetake','CancelRetake','createTermAdmission'),
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
	public function actionCreate()
	{
		$model=new ModuleRegistration();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['offeredModuleID']))
		{
			$model->termAdmissionID = yii::app()->session['termAdmissionID'];
                        $model->offeredModuleID = $_REQUEST['offeredModuleID'];
                        $model->markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID; 
			$model->reg_type=2;
                        echo $_REQUEST['offeredModuleID'];
                        /*if($model->save())
				$this->redirect(array('view','id'=>$model->moduleRegistrationID));
                         * *
                         */
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['ModuleRegistration']))
		{
			$model->attributes=$_POST['ModuleRegistration'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->moduleRegistrationID));
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
            //echo $id; exit();
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('registeredModule'));
	}	

	/**
	 * Lists all models.
	 */
        public function actionSelectModule()
	{
//              echo "Bismillah Hir Rahmanir Rahim. ";
               
            
                if(isset($_POST['offered']))
                { 
                        $termAdmissionID = yii::app()->session['termAdmissionID'];
                        $markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID; 
                        
                        $examinationID = Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['traTerm'],'exm_examYear'=>yii::app()->session['traYear'],'exm_type'=>1))->examinationID;
                        
                        $i=0;
                        $flag=false;
                        
                        $sql=" ";
                        foreach ($_POST['offered'] as $offeredModuleID)
                        { 
                            
                            if($offeredModuleID!=1)
                            {
                                $flag= true;

                                
                                //$sql .="INSERT INTO {{s_moduleregistration}} (\"termAdmissionID\", \"offeredModuleID\", \"markingSchemeID\" ) VALUES ( {$termAdmissionID}, {$offeredModuleID}, {$markingSchemeID}) ;";
                                  
                                $sql=" SELECT sp_insertmoduleregistration({$markingSchemeID},{$offeredModuleID},{$termAdmissionID},{$examinationID}); ";  
                                //$sql.="test ";
                               // echo $sql;                                //exit();
                                Yii::app()->db->createCommand($sql)->execute();
                                $i++;
                            }
                            
                        }
                        
                        if($flag)
                        {
                            //echo "Alhamdulilah!!";
                           // echo $sql;                        
                           //exit();
                           
                                Yii::app()->user->setFlash('success',$i.' Modules Has Been Registred Successfully !!!');
                                
				//$this->redirect(array('moduleRegistration/index','id'=>yii::app()->session['termAdmissinID']));
                                
                            
                        }
                    
                    
                }
                    //unset($_POST['offered']);
              
                    
                    $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
            
                    $model=new ModuleRegistration('search');
            
                    $dataProvider = $model->searchNotRegistred($data['studentID'],$data['sectionName'],$data['batchName'],$data['programmeCode'],$data['tra_term'],$data['tra_year']);
                    
                    $this->renderPartial('_notRegisteredModule',array('dataProvider'=>$dataProvider,'flag'=>true));
                    //$this->render('index',array('view'=>'_notRegistredModule','dataProvider'=>$dataProvider));
	
             
              }
             
                
                
	
	/**
	 * Manages all models.
	 */
	public function actionIndex($id=null,$flag=null)
	{
            
            // $input = ModuleRegistration::flagPrerequisite(yii::app()->session['studentID'],'GED-113','CSE-V2');
             //echo "test:".$input;
            if($id)
            {
               
           
               yii::app()->session['mrTermAdmissionID']=$id;
            }
            
                    $tra = TermAdmission::model()->findByPk(yii::app()->session['mrTermAdmissionID']);
                    $student = Student::model()->findByPk($tra->studentID);
                    $person = Person::model()->findByPk($student->personID);
                    
                    yii::app()->session['studentID'] = $student->studentID;
                    yii::app()->session['studentName'] = $person->per_title." ".$person->per_firstName." ".$person->per_lastName;
                    yii::app()->session['acTerm'] = $student->stu_academicTerm;
                    yii::app()->session['acYear'] = $student->stu_academicYear;
                    yii::app()->session['termAdmissionID'] = $tra->termAdmissionID;
                    
                    yii::app()->session['proCode'] = $tra->programmeCode;
                    yii::app()->session['batName'] = $tra->batchName;
                    yii::app()->session['secName'] = $tra->sectionName;
                    yii::app()->session['traTermMod'] = $tra->tra_term;
                    yii::app()->session['traYearMod'] = $tra->tra_year;
            
            
            
            $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTermMod'],'tra_year'=>yii::app()->session['traYearMod']);      
            
            $model=new ModuleRegistration('search');
            
            $dataProvider = $model->searchNotRegistred($data['studentID'],$data['sectionName'],$data['batchName'],$data['programmeCode'],$data['tra_term'],$data['tra_year']);
	
            if(count($dataProvider->data))
            {
                $this->render('index',array('view'=>'_notRegisteredModule','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
            }
            else
            {
             
                $dataProvider = $model->search($data['studentID'], $data['programmeCode']);
                //echo "count:".count($dataProvider);
                $this->render('index',array('view'=>'_registeredModule','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
            }
            
	}

        public function actionRegisteredModule()
	{
            $model = new ModuleRegistration();
            
                $dataProvider = $model->search(yii::app()->session['studentID'], yii::app()->session['proCode']);
            
                
                
                //echo "count:".count($dataProvider);
                $this->render('index',array('view'=>'_registeredModule','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
        }
	
        public function actionNeedToRetake()
	{
            
            
            $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
            
            $model=new ModuleRegistration('search');
            
            $dataProvider = $model->searchRetake($data['studentID']);
	
            
                $this->render('index',array('view'=>'_needToRetakeModule','model'=>$model,'dataProvider'=>$dataProvider,'flag'=>true));
            
 
            
	}
        /*
        public function actionRetake()
	{
            
            $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
            
            $model=new ModuleRegistration('search');
            
         
		if(isset($_REQUEST['offeredModuleID']))
		{
                    
                        $split= array();
                        $split= explode(',', $_REQUEST['offeredModuleID']);
                        $moduleCode= array();
                        $moduleCode=  explode(':', $split[0]);
                       // echo "mo:".$moduleCode[0];
                        $sql='';
                    if($model->flagRetake($moduleCode[0], yii::app()->session['syllabusCode'],yii::app()->session['studentID']))
                    {
			$termAdmissionID = yii::app()->session['termAdmissionID'];
                        $offeredModuleID = $split[3];
                        $markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID; 
			
                        $sql .="INSERT INTO tbl_s_moduleregistration(\"termAdmissionID\", \"offeredModuleID\", \"markingSchemeID\",\"reg_type\" ) VALUES ( {$termAdmissionID}, {$offeredModuleID}, {$markingSchemeID}, 2) ;"; 
                        
                      if(Yii::app()->db->createCommand($sql)->execute())
                        {   
                            Yii::app()->user->setFlash('success',' Module Retake Successful!');
				$this->redirect(array('needToRetake'));
                        }
                    }
                    else
                    {
                        Yii::app()->user->setFlash('warning',' There is no instance of the module found !!!');
                        $this->redirect(array('needToRetake'));
                    }
		}
                 //$value=$model->searchOfferedModule($data['studentID'],$data['tra_term'], $data['tra_year'], $data['programmeCode']);
                 //$this->render('_needToRetakeModule',array('model'=>$model,'value'=>$value));
                
	}
        */
        
        public function actionRetake()
	{
            
            $flag=false;
            if(isset($_POST['studentID2']))
            {
                yii::app()->session['studentID']=$_POST['studentID2'];
                yii::app()->session['retakeTerm']= (int)$_POST['retakeTerm'];
                yii::app()->session['retakeYear']= (int)$_POST['retakeYear'];
                
                $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID']),"ex_adm_active=true");
                yii::app()->session['proCode'] = $admission->programmeCode;
                yii::app()->session['batName'] = $admission->batchName;
                yii::app()->session['secName'] = $admission->sectionName;
            }   

            $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID']),"ex_adm_active=true"); 
                
                if($admission)
                {
                    
                    
                
                    $batch = Batch::model()->findByPk(array('batchName'=>$admission->batchName,'programmeCode'=>$admission->programmeCode));
   
                    if(FormUtil::batchFlag($batch->bat_term, $batch->bat_year, yii::app()->session['retakeTerm'], yii::app()->session['retakeYear']))
                    {
                            $student = Student::model()->findByPk($admission->studentID);
                            $person = Person::model()->findByPk($student->personID);
                            
                            yii::app()->session['studentName'] = $person->per_title." ".$person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['acTerm'] = $student->stu_academicTerm;
                            yii::app()->session['acYear'] = $student->stu_academicYear;
                            
                        
                    }
                    else
                    { 
            
                        Yii::app()->user->setFlash('warning','Current Term can not be previous than batch\'s start term!!!');
                        $this->redirect(array('index'));                
    //                    echo "test";
                    }
                    
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('index'));                
                }
            
            $termAdmission = TermAdmission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentID'],'tra_term'=>yii::app()->session['retakeTerm'],'tra_year'=>yii::app()->session['retakeYear']));
            
            if(count($termAdmission)!=0)
            {
                yii::app()->session['termAdmissionID2']= $termAdmission->termAdmissionID;
            }
            else{
                
                Yii::app()->user->setFlash('warning','Student is not Admitted for Current Term !!!');
            //echo "te";
                        
                
                $this->redirect(array('createTermAdmission'));
              //  exit();
            }
            
               
            
            
            
           // $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['traTerm'],'tra_year'=>yii::app()->session['traYear']);      
            
        
            $model=new ModuleRegistration('search');
            
            $dataProvider = $model->searchRetakeNew(yii::app()->session['studentID'], yii::app()->session['termAdmissionID2']);
	
            $dataProvider2 = $model->searchByTermAdmissionID(yii::app()->session['termAdmissionID2']);
              
            $this->render('reTakeModule',array('model'=>$model,'dataProvider'=>$dataProvider,'dataProvider2'=>$dataProvider2,'flag'=>$flag));
           
              
              
	}
        
        public function actionCreateTermAdmission()
	{
		

		$this->render('reCreateTermAdmission',array(
			
		));
	}
        
        public function actionCreateTermAdmissionForRetake()
        {
                
                
            	//if(isset($_REQUEST['data']))
		//{
                       $studentID= yii::app()->session['studentID'];
                    $proCode= yii::app()->session['proCode'];
                    $batName=yii::app()->session['batName'];
                    $secName=yii::app()->session['secName'];
                    $traTerm= yii::app()->session['retakeTerm'];
                    $traYear=yii::app()->session['retakeYear'];
                    
                    $sql="INSERT INTO tbl_q_termadmission(
                    \"studentID\", \"sectionName\", \"batchName\",\"programmeCode\", 
                    tra_term, tra_year)
                    VALUES ('{$studentID}','{$secName}',{$batName},'{$proCode}',{$traTerm},{$traYear});";
                     
                             //echo $sql;
             
                    if(Yii::app()->db->createCommand($sql)->execute())
                    {
                            //echo "Alhamdulilah!!";
             /*               
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
                                
                                //yii::app()->session['termAdmissinID']=TermAdmission::model()->findByAttributes($data)->termAdmissionID;
              */ 
                                Yii::app()->user->setFlash('success','Term Admission Successful.');
              
                                
				$this->redirect(array('retake'));
                    }
                          
                         
		//}

		
        }
        
        public function actionSaveRetake()
	{
            
            $data = array('studentID'=>yii::app()->session['studentID'],'sectionName'=>yii::app()->session['secName'],'batchName'=>yii::app()->session['batName'],'programmeCode'=>yii::app()->session['proCode'],'tra_term'=>yii::app()->session['retakeTerm'],'tra_year'=>yii::app()->session['retakeYear']);      
            
            $model=new ModuleRegistration('search');
            
         
		if(isset($_REQUEST['offeredModuleID']))
		{
                    
                        $split= array();
                        $split= explode(',', $_REQUEST['offeredModuleID']);
                        $moduleCode= array();
                        $moduleCode=  explode(':', $split[0]);
                        
                        $termAdmissionID = yii::app()->session['termAdmissionID2'];
                        $offeredModuleID = $split[3];
                        $examinationID = Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['retakeTerm'],'exm_examYear'=>yii::app()->session['retakeYear'],'exm_type'=>1))->examinationID;    
                        $markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID; 
                        //echo "mo:".$moduleCode[0];
                        
                        if(! Module::model()->findByAttributes(array('moduleCode'=>$moduleCode)))
                        {
                            Yii::app()->user->setFlash('warning',' There is no instance of the Course Code found !!!');
                            $this->redirect(array('reTake'));
                        }
                        
                    if($model->flagRetakeByOfmID(yii::app()->session['studentID'],$offeredModuleID)>0)
                    {
			
                       
                        
                        
			
                        
                        $sql2= "SELECT s.\"moduleRegistrationID\"
                        FROM 
                          tbl_h_offeredmodule h, 
                          tbl_s_moduleregistration s, 
                          tbl_q_termadmission q, 
                          tbl_h_offeredmodule o
                        WHERE 
                          h.\"offeredModuleID\" = s.\"offeredModuleID\" AND
                          h.\"moduleCode\" = o.\"moduleCode\" AND
                          
                          s.\"termAdmissionID\" = q.\"termAdmissionID\" AND
                          q.\"studentID\" = :studentID AND 
                          o.\"offeredModuleID\" = :ofmID;";
                        
                        $reg = ModuleRegistration::model()->findBySql($sql2,array(':studentID'=>yii::app()->session['studentID'],':ofmID'=>$offeredModuleID));
                        
                        $sql1 = "UPDATE tbl_s_moduleregistration set reg_status='Retaken' , reg_type=0 where \"moduleRegistrationID\"={$reg->moduleRegistrationID};";
                        //$sql ="INSERT INTO tbl_s_moduleregistration(\"termAdmissionID\", \"offeredModuleID\", \"markingSchemeID\",\"reg_type\",reg_status ) VALUES ( {$termAdmissionID}, {$offeredModuleID}, {$markingSchemeID}, 1,'Retake') ;"; 
                        
                        
                        
                       $sql=" SELECT sp_insertmoduleregistrationRetake({$markingSchemeID},{$offeredModuleID},{$termAdmissionID},{$examinationID}); ";  
                     
                       if(Yii::app()->db->createCommand($sql1)->execute() && Yii::app()->db->createCommand($sql)->execute())
                        {   
                            Yii::app()->user->setFlash('success',' Course Retake Successful!');
				$this->redirect(array('reTake'));
                        }
                        else
                        {
                            Yii::app()->user->setFlash('warning',' Course Retake Failed!');
				$this->redirect(array('reTake'));
                        }
                    }
                    else
                    {
                       $sql=" SELECT sp_insertmoduleregistration({$markingSchemeID},{$offeredModuleID},{$termAdmissionID},{$examinationID}); ";  
                     
                       if(Yii::app()->db->createCommand($sql1)->execute() && Yii::app()->db->createCommand($sql)->execute())
                        {   
                            Yii::app()->user->setFlash('success',' Course Registration Successful!');
				$this->redirect(array('reTake'));
                        }
                        else
                        {
                            Yii::app()->user->setFlash('warning',' Course Registration Failed!');
				$this->redirect(array('reTake'));
                        }
                    }
		}
                 //$value=$model->searchOfferedModule($data['studentID'],$data['tra_term'], $data['tra_year'], $data['programmeCode']);
                 //$this->render('_needToRetakeModule',array('model'=>$model,'value'=>$value));
                
	}
        
        
        public function actionCancelRetake()
        { 
            if(isset($_REQUEST['termAdmissionID']))
            {
                $flag = false;
                $moduleReg= ModuleRegistration::model()->findAllByAttributes(array('termAdmissionID'=>$_REQUEST['termAdmissionID'],'reg_status'=>'Retake'));
                
                foreach ($moduleReg as $item)
                {
                    //echo $item->moduleRegistrationID;
                
                
                
                    $sql1 = "SELECT 
                        h.\"moduleCode\", h.\"syllabusCode\"
                      FROM 
                        tbl_s_moduleregistration s, 
                        tbl_h_offeredmodule h 
                      WHERE 
                        s.\"offeredModuleID\" = h.\"offeredModuleID\" AND

                        s.\"moduleRegistrationID\" = :regID;";

                    $ofm = OfferedModule::model()->findBySql($sql1,array(':regID'=>$item->moduleRegistrationID));



                    //echo "rest". $reg->moduleRegistrationID;
                    //exit();
                    //$sql="DELETE FROM tbl_s_moduleregistration
                    //WHERE \"moduleRegistrationID\"={$id};";
                    $sql3="Delete from tbl_s_moduleregistration where \"moduleRegistrationID\"={$item->moduleRegistrationID}";        


                    if( Yii::app()->db->createCommand($sql3)->execute() )
                    {   

                            $sql2 ="SELECT 
                            s.\"moduleRegistrationID\"
                          FROM 
                            tbl_s_moduleregistration s, 
                            tbl_h_offeredmodule h, 
                            tbl_q_termadmission q
                          WHERE 
                            s.\"offeredModuleID\" = h.\"offeredModuleID\" AND

                            q.\"termAdmissionID\"= s.\"termAdmissionID\" AND
                            h.\"moduleCode\" = :modCode AND
                            h.\"syllabusCode\" =  :sylCode and
                            q.\"studentID\" = :studentID;";
                            
                            
                            $reg= ModuleRegistration::model()->findBySql($sql2,array(':modCode'=>$ofm->moduleCode,':sylCode'=>$ofm->syllabusCode,':studentID'=>yii::app()->session['studentID']));
                            
                            $sql4= "UPDATE tbl_s_moduleregistration set reg_status='Regular' , reg_type=1 where \"moduleRegistrationID\"={$reg->moduleRegistrationID};";
                        if( Yii::app()->db->createCommand($sql4)->execute() )
                        {
                            $flag= true;
                            
                        }
                        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    }
                }
                
                if($flag)
                {
                    Yii::app()->user->setFlash('success','Retake Course Canceled Successfully !');
                    $this->redirect(array('retake'));    
                }
                {
                    Yii::app()->user->setFlash('warning','Retake Cancellation Failed !');
                    $this->redirect(array('retake'));    
                }
            }
        }
        
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ModuleRegistration the loaded model
	 * @throws CHttpException
	 */
        
	public function loadModel($id)
	{
		$model=ModuleRegistration::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ModuleRegistration $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='module-registration-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
