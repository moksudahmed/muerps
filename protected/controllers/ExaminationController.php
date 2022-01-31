<?php

class ExaminationController extends Controller
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
           
            //$option = new Options;            
      
            //$capabilities = $option->getControllerOptions( 'examination_controller', yii::app()->user->getState('role'));
           
            if(yii::app()->user->getState('role')==='super-admin')
            {
                return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','getSuppleBatch'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','ReportTabulation','TabulationPDF','ResultPDF','TabulationRetakePDF','ResultRetakePDF','getBatch','result','TranscriptIndex','academicRecord','TranscriptPDF','GetGroup','TabulationSupplyPDF','ResultSheetSupplyPDF','TranscriptBackpage','TabulationPDFNew','ResultPDFNew','Transcript','EditTranscript','UpdateTranscript'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
                    );
		/*return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				//'actions'=>array('create','update','GetResult','getSuppleBatch','Transcript'),
				'users'=>array('@'),
			),*/
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
                               // 'actions'=>$capabilities,
                                //'actions'=>array_merge($option->getOptions('generate_transcript'),$option->getOptions('generate_result_and_tabulation')),
       				'actions'=>array('admin','delete','ReportTabulation','TabulationPDF','ResultPDF','TabulationRetakePDF','ResultRetakePDF','getBatch','result','TranscriptIndex','academicRecord','TranscriptPDF','GetGroup','TabulationSupplyPDF','ResultSheetSupplyPDF','Transcript','TranscriptBackpage','TranscriptXLS','GenerateWord','EditTranscript','UpdateTranscript'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);*/
            }
            elseif(yii::app()->user->getState('role')==='admin')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GetResult','getSuppleBatch'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','ReportTabulation','TabulationPDF','ResultPDF','TabulationRetakePDF','ResultRetakePDF','getBatch','result','TranscriptIndex','academicRecord','TranscriptPDF','GetGroup','TabulationSupplyPDF','TranscriptBackpage','TabulationPDFNew','ResultPDFNew',),
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
				'actions'=>array('create','update','GetResult','getSuppleBatch'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','ReportTabulation','TabulationPDF','ResultPDF','TabulationRetakePDF','ResultRetakePDF','getBatch','result','TranscriptIndex','academicRecord','TranscriptPDF','GetGroup','TabulationSupplyPDF','ResultSheetSupplyPDF','TranscriptBackpage','TabulationPDFNew','ResultPDFNew',),
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
				'actions'=>array('create','update','getSuppleBatch'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','ReportTabulation','TabulationPDF','ResultPDF','TabulationRetakePDF','ResultRetakePDF','getBatch','result','TranscriptIndex','academicRecord','TranscriptPDF','GetGroup','TabulationSupplyPDF','ResultSheetSupplyPDF','TranscriptBackpage','TabulationPDFNew','ResultPDFNew',),
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','getSuppleBatch'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','ReportTabulation','TabulationPDF','ResultPDF','TabulationRetakePDF','ResultRetakePDF','getBatch','result','academicRecord','getGroup','TabulationPDFNew','ResultPDFNew'),
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
				'actions'=>array('create','update','getSuppleBatch'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','ReportTabulation','TabulationPDF','TabulationSupplyPDF','ResultSheetSupplyPDF','ResultPDF','TabulationRetakePDF','ResultRetakePDF','getBatch','result','TranscriptIndex','academicRecord','TranscriptPDF','PublishResultSwitch','GetGroup','Transcript','TranscriptBackpage','TabulationPDFNew','ResultPDFNew','EditTranscript','UpdateTranscript'),
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
                        'actions'=>array('create','update','getSuppleBatch'),
                        'users'=>array('@'),
                    ),
                    array('allow', // allow admin user to perform 'admin' and 'delete' actions
                        'actions'=>array('admin','delete','ReportTabulation','TabulationPDF','TabulationSupplyPDF','ResultSheetSupplyPDF','ResultPDF','TabulationRetakePDF','ResultRetakePDF','getBatch','result','TranscriptIndex','academicRecord','TranscriptPDF','PublishResultSwitch','GetGroup','Transcript','TranscriptBackpage','TabulationPDFNew','ResultPDFNew','EditTranscript','UpdateTranscript'),
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
		
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GetResult','getBatch','getSuppleBatch'),
				'users'=>array('@'),
			),
		
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
		$model=new Examination;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Examination']))
		{
			$model->attributes=$_POST['Examination'];
                        
                        $model->exm_type = yii::app()->session['examType'];
                        
			if($model->save())
				$this->redirect(array('view','id'=>$model->examinationID));
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

		if(isset($_POST['Examination']))
		{
			$model->attributes=$_POST['Examination'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->examinationID));
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
	public function actionIndex($id=null)
	{
            
            if($id)
            {
                 yii::app()->session['examType']=$id;
                
             
            }
            else 
            {
                $id=yii::app()->session['examType'];
            }
           
            
            if($id==1)yii::app()->session['examName']='<span  class="label label-success" >Final</span>';
            elseif($id==2)yii::app()->session['examName']='<span  class="label label-warning" >Supplementary</span>';
            elseif($id==3)yii::app()->session['examName']='<span  class="label label-important" >Special Supplementary</span>';
            
		$model=new Examination('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Examination']))
			$model->attributes=$_GET['Examination'];

		$this->render('index',array(
			'model'=>$model,'id'=>$id
		));
	}
        
        public function actionResult()
	{
		$this->render('result');
	}
         public function actionReportTabulation(){           
            
                if($_REQUEST['group'] == "0"){
                        
                    yii::app()->session['group'] = "All";
                }
                else{
                    yii::app()->session['group'] = $_REQUEST['group'];     
                }   
                yii::app()->session['reRegiType'] = $_REQUEST['reRegiType']; 

               if(isset($_REQUEST['programmeCode'],$_REQUEST['batchName2'],$_REQUEST['resultTerm'],$_REQUEST['resultYear']))
                { 
                    yii::app()->session['reTerm']= (int)$_POST['resultTerm'];
                    yii::app()->session['reYear']= (int)$_POST['resultYear'];
                    yii::app()->session['reType']= (int)$_POST['resultType'];
                    yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
		
                    yii::app()->session['reProCode']=(int)$_POST['programmeCode'];
                 
                    
                    yii::app()->session['reBatName']=(int)$_POST['batchName2'];
                    
                   
                   
                    
                    //yii::app()->session['retake']=$_REQUEST['retake'];   
                    
                    $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                //    echo var_dump($batch); exit();
                    yii::app()->session['reAcTerm']=$batch->bat_term;
                    yii::app()->session['reAcYear']=$batch->bat_year;
                    
                    
                }   
               
               // yii::app()->session['group'] = "All";
                if(isset($_REQUEST['thesis']))
                {
                    yii::app()->session['subject_type'] = "thesis";
                    yii::app()->session['retake']=$_REQUEST['retake'];   
                }
                yii::app()->session['subject_type'] = "all";
                
                if(isset($_REQUEST['studentID']) && isset($_REQUEST['pass']))
                {
                   
                    yii::app()->session['sid'] = $_REQUEST['studentID']; 
                    
                    $model = new Examination();
		        //  $dataProvider = $model->searchTabulationByStudentID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID',yii::app()->session['reProCode'],yii::app()->session['sid']);       
                  $dataProvider = $model->searchTabulationByStudentID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'],yii::app()->session['reProCode'],yii::app()->session['sid']);
                  
                 // echo var_dump($dataProvider); exit();
                  $this->render('reportTabulation',array('model'=>$model,'dataProvider'=>$dataProvider));
         
                }
                else{    
                    
                   $model = new Examination();
                   yii::app()->session['sid'] = null;
                   if(yii::app()->session['group']  == "All"){
                     $dataProvider = $model->searchTabulation( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],null,yii::app()->session['reRegiType']);
                   }
                   else{
                    $dataProvider = $model->searchTabulation( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group'],yii::app()->session['reRegiType']);
                   }
                   
                
                   $this->render('reportTabulation',array('model'=>$model,'dataProvider'=>$dataProvider));
                }
	}

          public function actionReportTabulation2()
	{
      //echo $_REQUEST['batchName'];
      //exit();
                if(isset($_REQUEST['programmeCode'],$_REQUEST['batchName2'],$_REQUEST['resultTerm'],$_REQUEST['resultYear']))
                {
                    yii::app()->session['reTerm']= (int)$_POST['resultTerm'];
                    yii::app()->session['reYear']= (int)$_POST['resultYear'];
                    yii::app()->session['reType']= (int)$_POST['resultType'];
                    yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
		
                    yii::app()->session['reProCode']=(int)$_POST['programmeCode'];
                    
                    
                    yii::app()->session['reBatName']=(int)$_POST['batchName2'];
                    
                    yii::app()->session['group']=$_POST['group'];    
                    yii::app()->session['retake']=$_REQUEST['retake'];   
                   // echo yii::app()->session['group'];
                    $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                    yii::app()->session['reAcTerm']=$batch->bat_term;
                    yii::app()->session['reAcYear']=$batch->bat_year;
                }        
                yii::app()->session['subject_type'] = "all";
                if(isset($_REQUEST['thesis']))
                {
                    yii::app()->session['subject_type'] = "thesis";
                     yii::app()->session['retake']=$_REQUEST['retake'];   
                }
                        
                $model = new Examination();
		                 
                $dataProvider = $model->searchTabulation( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                
                $this->render('reportTabulation',array('model'=>$model,'dataProvider'=>$dataProvider));
         
	}
        public function actionReportTabulation1()
	{
      //echo $_REQUEST['batchName'];
      //exit();
                if(isset($_REQUEST['programmeCode'],$_REQUEST['batchName2'],$_REQUEST['resultTerm'],$_REQUEST['resultYear']))
                {
                    yii::app()->session['reTerm']= (int)$_POST['resultTerm'];
                    yii::app()->session['reYear']= (int)$_POST['resultYear'];
                    yii::app()->session['reType']= (int)$_POST['resultType'];
                    yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
		
                    yii::app()->session['reProCode']=(int)$_POST['programmeCode'];
                    
                    
                    yii::app()->session['reBatName']=(int)$_POST['batchName2'];
                    
                    yii::app()->session['group']=$_POST['group'];    
                    
                   // echo yii::app()->session['group'];
                    $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                    yii::app()->session['reAcTerm']=$batch->bat_term;
                    yii::app()->session['reAcYear']=$batch->bat_year;
                }        
        
                  
                $model = new Examination();
		                 
                $dataProvider = $model->searchTabulation( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                
                $this->render('reportTabulation',array('model'=>$model,'dataProvider'=>$dataProvider));
         
	}
      
             
          public function actionPublishResultSwitch()
          {
               //$request =  yii::app()->request;
              //$request->post('');
              echo $_POST['publishGroup'.$_POST['i']];
              
              
              echo $_POST['publishType'.$_POST['i']];
              echo $_POST['batchName'.$_POST['i']];
              //exit();
              if($_POST['publishType'.$_POST['i']]===1)
              {
                  $this->redirect( Yii::app()->createUrl('examination/TabulationPDF', array('proCode'=>yii::app()->session['rpProCode'],'batchName'=>$_POST['batchName'.$_POST['i']],'term'=>yii::app()->session['rpTerm'],'year'=>yii::app()->session['rpYear'],'group'=>$_POST['publishGroup'.$_POST['i']])));
              }
              else
              {
                  $this->redirect(Yii::app()->createUrl('examination/ResultPDF', array('proCode'=>yii::app()->session['rpProCode'],'batchName'=>$_POST['batchName'.$_POST['i']],'term'=>yii::app()->session['rpTerm'],'year'=>yii::app()->session['rpYear'],'group'=>$_POST['publishGroup'.$_POST['i']])));
           
              }
                  
          }

        public function actionTabulationPDF($proCode =null, $batchName= null,$term = null,$year=null, $result_type= null, $group=null ,$examType=1 ){
           
            $session=new CHttpSession;
            $session->open();
           
            // echo $result_type.$batchName.$term.$year.$examType;
            Yii::import('application.modules.admin.extensions.bootstrap.*');

            $model = new Examination();
            

            if($proCode !=null && $batchName!= null && $term != null && $year != null && $result_type !=null)
            {
                yii::app()->session['reProCode'] = $proCode;
                yii::app()->session['reBatName'] = $batchName;
                yii::app()->session['reTerm'] = $term;
                yii::app()->session['reYear'] = $year;
                yii::app()->session['reType']= $examType;
                yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
          
                
                 $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                yii::app()->session['reAcTerm']=$batch->bat_term;
                yii::app()->session['reAcYear']=$batch->bat_year;
     
                
            }
            
            else{

             /*   yii::app()->session['reTerm'],
                yii::app()->session['reYear'],
                yii::app()->session['examinationID'], 
                yii::app()->session['reProCode'], 
                yii::app()->session['reBatName'],
                yii::app()->session['group']*/
                yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                $group = yii::app()->session['group'];
                $result_type = yii::app()->session['reRegiType'];
                //$result_type ='Regular'; 
               // echo yii::app()->session['examinationID'].$result_type.$group;
            }

            if( yii::app()->session['sid'] !=null ){
               
                $model = new Examination();
		        $rows = $model->searchTabulationDataByStudentID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'],yii::app()->session['sid']);
                          
                $subjectRows = $model->searchHowManySubjectInTheTabulationByStudetID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'],yii::app()->session['sid']);
      
            }
            else{
                    if($result_type =='Regular' && $group == 'All'){ 
                    
                        $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                    //   $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'], $result_type, $group,1);
                   
                    $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'],yii::app()->session['examinationID'], $result_type, $group, $examType = 1);
                    
                    }
                    else if($result_type =='Retake' && $group == 'All'){ 
                    
                        $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                    //   $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'], $result_type, $group,1);
                        $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'],yii::app()->session['examinationID'], $result_type, $group, $examType = 1);
                    // echo var_dump($subjectRows); exit();
                    }
                    else if($result_type =='Regular' && $group != 'All'){ 
                    // $result_type ='group';
                        $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                        $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                        // echo var_dump($group);exit();
                    }
                    
                    else
                    {
                    
                    }
                }
           // echo "Test"; exit();
            $pdf = new TabulationPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor(Yii::app()->name);            
            if($result_type =='Retake'){
                $pdf->setText('Retake Tabulation');
              }
              else{
                $pdf->SetTitle('Tabulation Sheet');
              }
            $pdf->SetSubject('Spring Term Examinatyion 2013');
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            $pdf->setHeaderFont(Array('times', '', 6));
            $pdf->setFooterFont(Array('times', '', 6));
            $pdf->SetMargins(15, 30, 30);
            $pdf->SetHeaderMargin(10);                    

            $pdf->SetAutoPageBreak(TRUE, 0);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $pdf->SetFont('times', '', 7);
       //     echo var_dump($subjectRows); exit();
            $html = $this->renderPartial('TabulationPDF', array(
                        'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                ), true);

            $fileName = 'Tabulation_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
            $pdf->Output($fileName, "I");
         //   yii::app()->session['sid'] = null;
            
          }
          public function actionResultPDF($proCode =null, $batchName= null,$term = null,$year=null, $result_type= null, $group=null ,$examType=1 )
          {
                   $session=new CHttpSession;
                         $session->open();
                         
                         
                         
                         Yii::import('application.modules.admin.extensions.bootstrap.*');
      
                           $model = new Examination();
                         
            
                        
            if($proCode !=null && $batchName!= null && $term != null && $year != null && $result_type !=null)
            {
                yii::app()->session['reProCode'] = $proCode;
                yii::app()->session['reBatName'] = $batchName;
                yii::app()->session['reTerm'] = $term;
                yii::app()->session['reYear'] = $year;
                yii::app()->session['reType']= $examType;
                yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
          
                
                 $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                yii::app()->session['reAcTerm']=$batch->bat_term;
                yii::app()->session['reAcYear']=$batch->bat_year;
     
                
            }
            
            else{

             /*   yii::app()->session['reTerm'],
                yii::app()->session['reYear'],
                yii::app()->session['examinationID'], 
                yii::app()->session['reProCode'], 
                yii::app()->session['reBatName'],
                yii::app()->session['group']*/
                yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                $group = yii::app()->session['group'];
                $result_type = yii::app()->session['reRegiType'];
                //$result_type ='Regular'; 
               // echo yii::app()->session['examinationID'].$result_type.$group;
            }

            if(yii::app()->session['sid'] !=null){
               
                $model = new Examination();
		        $rows = $model->searchTabulationDataByStudentID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'],yii::app()->session['sid']);
                          
                $subjectRows = $model->searchHowManySubjectInTheTabulationByStudetID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'],yii::app()->session['sid']);
      
            }
            else{
                    if($result_type =='Regular' && $group == 'All'){ 
                    
                        $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                    //   $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'], $result_type, $group,1);
                   
                    $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'],yii::app()->session['examinationID'], $result_type, $group, $examType = 1);
                    
                    }
                    else if($result_type =='Retake' && $group == 'All'){ 
                    
                        $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                    //   $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'], $result_type, $group,1);
                        $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'],yii::app()->session['examinationID'], $result_type, $group, $examType = 1);
                    // echo var_dump($subjectRows); exit();
                    }
                    else if($result_type =='Regular' && $group != 'All'){ 
                    // $result_type ='group';
                        $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                        $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                        // echo var_dump($group);exit();
                    }
                    
                    else
                    {
                    
                    }
                }
   
                          $pdf = new ResultPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                          $pdf->SetCreator(PDF_CREATOR);
                          $pdf->SetAuthor(Yii::app()->name);
                         //$pdf->SetTitle('Result Sheet');
                          
                           
                          $pdf->SetSubject('Spring Term Examination 2013');
                          if($result_type =='Retake'){
                            $pdf->setText('Retake Result Sheet');
                          }
                          else{
                            $pdf->SetTitle('Result Sheet');
                          }
                          $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                          $pdf->setHeaderFont(Array('times', '', 6));
                          $pdf->setFooterFont(Array('times', '', 6));
                          $pdf->SetMargins(15, 30, 30);      
                          $pdf->SetHeaderMargin(10);     
      
                          $pdf->SetAutoPageBreak(TRUE, 0);
                          $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                          $pdf->SetFont('times', '', 7);
                          $html = $this->renderPartial('ResultPDF', array(
                                      'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                              ), true);
                              
                          $fileName = 'Result_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                          $pdf->Output($fileName, "I");
      
                   
      
          }
          public function actionResultPDF23($proCode =null, $batchName= null,$term = null, $year = null, $group=null,$examType=1)
          {
                   $session=new CHttpSession;
                         $session->open();
                         
                         
                         
                         Yii::import('application.modules.admin.extensions.bootstrap.*');
      
                           $model = new Examination();
                          if($proCode !=null && $batchName!= null && $term != null && $year != null)
                          {
                              yii::app()->session['reProCode'] = $proCode;
                              yii::app()->session['reBatName'] = $batchName;
                              yii::app()->session['reTerm'] = $term;
                              yii::app()->session['reYear'] = $year;
                              yii::app()->session['reType']= $examType;
                              yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                        
                              
                               $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                              yii::app()->session['reAcTerm']=$batch->bat_term;
                              yii::app()->session['reAcYear']=$batch->bat_year;
                   
                              
                          }
                         
                          $subject_type = yii::app()->session['subject_type'];
                          $group = yii::app()->session['group'];
                         
                          
                          if($group)
                          {
                              $result_type ='group';
                              $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                              $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                             //  echo var_dump($subjectRows);exit();
                          }
                          else
                          {
                             if($subject_type == 'thesis')
                             {
                               $result_type ='thesis';
                               $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type);
                               $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type);
                              
                              }
                             else
                             {
                               $result_type = 'all';
                               $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type);
                               $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'], $result_type);
                              
                               }
                          }   
                          $pdf = new ResultPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                          $pdf->SetCreator(PDF_CREATOR);
                          $pdf->SetAuthor(Yii::app()->name);
                           $pdf->SetTitle('Result Sheet');
                          $pdf->SetSubject('Spring Term Examination 2013');
                          $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                          $pdf->setHeaderFont(Array('times', '', 6));
                          $pdf->setFooterFont(Array('times', '', 6));
                          $pdf->SetMargins(15, 30, 30);      
                          $pdf->SetHeaderMargin(10);     
      
                          $pdf->SetAutoPageBreak(TRUE, 0);
                          $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                          $pdf->SetFont('times', '', 7);
                          $html = $this->renderPartial('ResultPDF', array(
                                      'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                              ), true);
      
                          $fileName = 'Result_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                          $pdf->Output($fileName, "I");
      
                   
      
          }
              public function actionTabulationPDFNew($proCode =null, $batchName= null,$term = null,$year=null,$examType=1 )
                {
                         $session=new CHttpSession;
                         $session->open();
                         
                         Yii::import('application.modules.admin.extensions.bootstrap.*');
                          if($proCode !=null && $batchName!= null && $term != null && $year != null)
                          {
                              yii::app()->session['reProCode'] = $proCode;
                              yii::app()->session['reBatName'] = $batchName;
                              yii::app()->session['reTerm'] = $term;
                              yii::app()->session['reYear'] = $year;
                              yii::app()->session['reType']= $examType;
                              yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                        
                              $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                              yii::app()->session['reAcTerm']=$batch->bat_term;
                              yii::app()->session['reAcYear']=$batch->bat_year;
                   
                              
                          }
                          $model = new Examination();
                          if(yii::app()->session['sid']!=null){
                               $rows = $model->searchTabulationDataByStudentID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'],yii::app()->session['sid']);
                          
                             $subjectRows = $model->searchHowManySubjectInTheTabulationByStudetID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'],yii::app()->session['sid']);
                        }
                          else{
                             $rows = $model->searchTabulationData( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                             $subjectRows = $model->searchHowManySubjectInTheTabulation( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                          }         
                          $pdf = new TabulationPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                          $pdf->SetCreator(PDF_CREATOR);
                          $pdf->SetAuthor(Yii::app()->name);
                          $pdf->SetTitle('Tabulation Sheet');
                          $pdf->SetSubject('Spring Term Examinatyion 2013');
                          $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                          $pdf->setHeaderFont(Array('times', '', 6));
                          $pdf->setFooterFont(Array('times', '', 6));
                          $pdf->SetMargins(15, 30, 30);
                          $pdf->SetHeaderMargin(10);                    
      
                          $pdf->SetAutoPageBreak(TRUE, 0);
                          $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                          $pdf->SetFont('times', '', 7);
                          $html = $this->renderPartial('TabulationPDF', array(
                                      'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                              ), true);
                         
                         $fileName = 'Tabulation_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                          $pdf->Output($fileName, "I");
      
      
                }
         
                     
    public function actionTabulationPDF3($proCode =null, $batchName= null,$term = null,$year=null,$examType=1 )
          {
                   $session=new CHttpSession;
                   $session->open();
                   
                   
                  // echo $proCode.$batchName.$term.$year.$examType;
                  // exit();
                   Yii::import('application.modules.admin.extensions.bootstrap.*');

                     $model = new Examination();
                    if($proCode !=null && $batchName!= null && $term != null && $year != null)
                    {
                        yii::app()->session['reProCode'] = $proCode;
                        yii::app()->session['reBatName'] = $batchName;
                        yii::app()->session['reTerm'] = $term;
                        yii::app()->session['reYear'] = $year;
                        yii::app()->session['reType']= $examType;
                        yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                  
                        
                         $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                        yii::app()->session['reAcTerm']=$batch->bat_term;
                        yii::app()->session['reAcYear']=$batch->bat_year;
             
                        
                    }
                   
                    $subject_type = yii::app()->session['subject_type'];
                    $group = yii::app()->session['group'];
                    $result_type ='Regular';
                    
                    if($group)
                    {
                       // $result_type ='group';
                        $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                        $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                       //  echo var_dump($subjectRows);exit();
                    }
                    else
                    {
                       if($subject_type == 'thesis')
                       {
                        
                         $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type);
                         $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type, 'Thesis/Research Paper');
                        
                        }
                       else
                       {
                         
                         $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type);
                         $subjectRows = $model->searchNoOfSubject( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'], $result_type,'All');
                     //   echo var_dump($subjectRows); exit();
                         }
                    }
                    // $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$result_type,$group);
                   
                 //   $rows = $model->searchTabulationData( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                   // $rows =  FormUtil::generateResultAndTabulation(array( "studentID", "per_name"));
                    //$subjectRows = FormUtil::selectedSubjectForResultAndTabulation(array("o.moduleCode", "v.mod_name"));
                   // $subjectRows = $model->searchHowManySubjectInTheTabulation( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
              //    echo var_dump($subjectRows); exit();
                    $pdf = new TabulationPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor(Yii::app()->name);
                    $pdf->SetTitle('Tabulation Sheet');
                    $pdf->SetSubject('Spring Term Examinatyion 2013');
                    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                    $pdf->setHeaderFont(Array('times', '', 6));
                    $pdf->setFooterFont(Array('times', '', 6));
                    $pdf->SetMargins(15, 30, 30);
                    $pdf->SetHeaderMargin(10);                    

                    $pdf->SetAutoPageBreak(TRUE, 0);
                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                    $pdf->SetFont('times', '', 7);
               //     echo var_dump($subjectRows); exit();
                    $html = $this->renderPartial('TabulationPDF', array(
                                'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                        ), true);

                    $fileName = 'Tabulation_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                    $pdf->Output($fileName, "I");


          }
          public function actionTabulationPDFNew1($proCode =null, $batchName= null,$term = null,$year=null,$examType=1 )
          {
                   $session=new CHttpSession;
                   $session->open();
                   
                   Yii::import('application.modules.admin.extensions.bootstrap.*');
                    if($proCode !=null && $batchName!= null && $term != null && $year != null)
                    {
                        yii::app()->session['reProCode'] = $proCode;
                        yii::app()->session['reBatName'] = $batchName;
                        yii::app()->session['reTerm'] = $term;
                        yii::app()->session['reYear'] = $year;
                        yii::app()->session['reType']= $examType;
                        yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                  
                        $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                        yii::app()->session['reAcTerm']=$batch->bat_term;
                        yii::app()->session['reAcYear']=$batch->bat_year;
             
                        
                    }
                    $model = new Examination();
                    $rows = $model->searchTabulationData( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                    $subjectRows = $model->searchHowManySubjectInTheTabulation( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                             
                    $pdf = new TabulationPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor(Yii::app()->name);
                    $pdf->SetTitle('Tabulation Sheet');
                    $pdf->SetSubject('Spring Term Examinatyion 2013');
                    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                    $pdf->setHeaderFont(Array('times', '', 6));
                    $pdf->setFooterFont(Array('times', '', 6));
                    $pdf->SetMargins(15, 30, 30);
                    $pdf->SetHeaderMargin(10);                    

                    $pdf->SetAutoPageBreak(TRUE, 0);
                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                    $pdf->SetFont('times', '', 7);
                    $html = $this->renderPartial('TabulationPDF', array(
                                'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                        ), true);
                   
                   $fileName = 'Tabulation_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                    $pdf->Output($fileName, "I");


          }
        public function actionTabulationSupplyPDF($proCode =null, $batchName= null,$term = null,$year=null,$examType=1 )
          {
                   $session=new CHttpSession;
                   $session->open();
                   
                   Yii::import('application.modules.admin.extensions.bootstrap.*');

                     $model = new Examination();
                    if($proCode !=null && $batchName!= null && $term != null && $year != null)
                    {
                        yii::app()->session['reProCode'] = $proCode;
                        yii::app()->session['reBatName'] = $batchName;
                        yii::app()->session['reTerm'] = $term;
                        yii::app()->session['reYear'] = $year;
                        yii::app()->session['reType']= $examType;
                        yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                  
                        
                         $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                        yii::app()->session['reAcTerm']=$batch->bat_term;
                        yii::app()->session['reAcYear']=$batch->bat_year;
             
                        
                    }
                   
                                         
                    $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID']);
                    $subjectRows = $model->searchNoOfSubjectSupply( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID']);
                        
                    
                    $pdf = new TabulationPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor(Yii::app()->name);
                    $pdf->SetTitle('Tabulation Sheet');
                    $pdf->SetSubject('Spring Term Examinatyion 2013');
                    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                    $pdf->setHeaderFont(Array('times', '', 6));
                    $pdf->setFooterFont(Array('times', '', 6));
                    $pdf->SetMargins(15, 30, 30);
                    $pdf->SetHeaderMargin(10);                    

                    $pdf->SetAutoPageBreak(TRUE, 0);
                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                    $pdf->SetFont('times', '', 7);
                    $html = $this->renderPartial('TabulationPDF', array(
                                'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                        ), true);

                   $fileName = 'Tabulation_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                    $pdf->Output($fileName, "I");


          }
           public function actionResultSheetSupplyPDF($proCode =null, $batchName= null,$term = null, $year = null, $group=null,$examType=1)
	{
              $session=new CHttpSession;
                   $session->open();
                   Yii::import('application.modules.admin.extensions.bootstrap.*');
                    if($proCode !=null && $batchName!= null && $term != null && $year != null)
                    {
                        yii::app()->session['reProCode'] = $proCode;
                        yii::app()->session['reBatName'] = $batchName;
                        yii::app()->session['reTerm'] = $term;
                        yii::app()->session['reYear'] = $year;
                        yii::app()->session['reType']= $examType;
                        yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                  
                        $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                        yii::app()->session['reAcTerm']=$batch->bat_term;
                        yii::app()->session['reAcYear']=$batch->bat_year;
             
                        
                    }
                     $group = yii::app()->session['group'];
                     $model = new Examination();
                    
                     
                    $rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID']);
                    $subjectRows = $model->searchNoOfSubjectSupply( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID']);
                  
                    $pdf = new ResultPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor(Yii::app()->name);
                     $pdf->SetTitle('Result Sheet');
                    $pdf->SetSubject('Spring Term Examination 2013');
                    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                    $pdf->setHeaderFont(Array('times', '', 6));
                    $pdf->setFooterFont(Array('times', '', 6));
                    $pdf->SetMargins(15, 30, 30);      
                    $pdf->SetHeaderMargin(10);     

                    $pdf->SetAutoPageBreak(TRUE, 0);
                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                    $pdf->SetFont('times', '', 7);
                    $html = $this->renderPartial('ResultPDF', array(
                                'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                        ), true);

                    $fileName = 'Result_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                    $pdf->Output($fileName, "I");

             

	}
          
          public function actionTabulationRetakePDF($proCode =null, $batchName= null,$term = null,$year=null,$examType=1 )
          {
                   $session=new CHttpSession;
                   $session->open();
                   Yii::import('application.modules.admin.extensions.bootstrap.*');
                    if($proCode !=null && $batchName!= null && $term != null && $year != null)
                    {
                        yii::app()->session['reProCode'] = $proCode;
                        yii::app()->session['reBatName'] = $batchName;
                        yii::app()->session['reTerm'] = $term;
                        yii::app()->session['reYear'] = $year;
                        yii::app()->session['reType']= $examType;
                        yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                  
                        $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                        yii::app()->session['reAcTerm']=$batch->bat_term;
                        yii::app()->session['reAcYear']=$batch->bat_year;
             
                        
                    }
                     $group = yii::app()->session['group'];
                     $model = new Examination();
                    if($group)
                    {
                         
                         
                        $rows = $model->searchTabulationReturnRowsTwo( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['reTerm'], yii::app()->session['reYear'],$group);
                        $subjectRows = $model->searchNoOfSubjectRetake( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$group);
                    }
                    else
                    {
                         //$rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID']);
                         
                         $rows = $model->searchTabulationReturnRowsTwo( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['reTerm'], yii::app()->session['reYear']);
                         $subjectRows = $model->searchNoOfSubjectRetake( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID']);
                    }
                    $pdf = new TabulationPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor(Yii::app()->name);
                    $pdf->SetTitle('Tabulation Sheet');
                    $pdf->SetSubject('Spring Term Examination 2013');
                    //$pdf->setText('Tabulation');
                    $pdf->setText('Retake Tabulation');
                    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                    $pdf->setHeaderFont(Array('times', '', 6));
                    $pdf->setFooterFont(Array('times', '', 6));
                    $pdf->SetMargins(15, 30, 30);      
                    $pdf->SetHeaderMargin(10);     

                    $pdf->SetAutoPageBreak(TRUE, 0);
                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                    $pdf->SetFont('times', '', 7);
                    $html = $this->renderPartial('TabulationPDF', array(
                                'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                        ), true);

                    $fileName = 'Tabulation_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                    $pdf->Output($fileName, "I");

             


          }
          public function actionResultPDFNew($proCode =null, $batchName= null,$term = null,$year=null,$examType=1 )
          {
                   $session=new CHttpSession;
                   $session->open();
                   echo yii::app()->session['reProCode']; exit();
                   Yii::import('application.modules.admin.extensions.bootstrap.*');
                    if($proCode !=null && $batchName!= null && $term != null && $year != null)
                    {
                        yii::app()->session['reProCode'] = $proCode;
                        yii::app()->session['reBatName'] = $batchName;
                        yii::app()->session['reTerm'] = $term;
                        yii::app()->session['reYear'] = $year;
                        yii::app()->session['reType']= $examType;
                        yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                  
                        $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                        yii::app()->session['reAcTerm']=$batch->bat_term;
                        yii::app()->session['reAcYear']=$batch->bat_year;
             
                        
                    }
                    $model = new Examination();
                    if(yii::app()->session['sid']!=null){
                       $rows = $model->searchTabulationDataByStudentID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'],yii::app()->session['sid']);
                    
                       $subjectRows = $model->searchHowManySubjectInTheTabulationByStudetID(yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'],yii::app()->session['sid']);
                    }
                    else{
                       $rows = $model->searchTabulationData( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                     //  $subjectRows = $model->searchHowManySubjectInTheTabulation( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                     
                    }         
                    $pdf = new ResultPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor(Yii::app()->name);
                     $pdf->SetTitle('Result Sheet');
                    $pdf->SetSubject('Spring Term Examination 2013');
                    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                    $pdf->setHeaderFont(Array('times', '', 6));
                    $pdf->setFooterFont(Array('times', '', 6));
                    $pdf->SetMargins(15, 30, 30);      
                    $pdf->SetHeaderMargin(10);     

                    $pdf->SetAutoPageBreak(TRUE, 0);
                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                    $pdf->SetFont('times', '', 7);
                    $html = $this->renderPartial('ResultPDF', array(
                                'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                        ), true);

                    $fileName = 'Result_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                    $pdf->Output($fileName, "I");

             


          }
        public function actionResultPDFNEw1($proCode =null, $batchName= null,$term = null, $year = null, $group=null,$examType=1)
	{
                   $session=new CHttpSession;
                   $session->open();
                   Yii::import('application.modules.admin.extensions.bootstrap.*');
                   if($proCode !=null && $batchName!= null && $term != null && $year != null)
                    {
                        yii::app()->session['reProCode'] = $proCode;
                        yii::app()->session['reBatName'] = $batchName;
                        yii::app()->session['reTerm'] = $term;
                        yii::app()->session['reYear'] = $year;
                        yii::app()->session['reType']= $examType;
                        yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                  
                        $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                        yii::app()->session['reAcTerm']=$batch->bat_term;
                        yii::app()->session['reAcYear']=$batch->bat_year;
             
                        
                    }
                   $model = new Examination();
                   
                   $rows = $model->searchTabulationData( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                   $subjectRows = $model->searchHowManySubjectInTheTabulation( yii::app()->session['reTerm'],yii::app()->session['reYear'],yii::app()->session['examinationID'], yii::app()->session['reProCode'], yii::app()->session['reBatName'],yii::app()->session['group']);
                 
                
                    $pdf = new ResultPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor(Yii::app()->name);
                     $pdf->SetTitle('Result Sheet');
                    $pdf->SetSubject('Spring Term Examination 2013');
                    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                    $pdf->setHeaderFont(Array('times', '', 6));
                    $pdf->setFooterFont(Array('times', '', 6));
                    $pdf->SetMargins(15, 30, 30);      
                    $pdf->SetHeaderMargin(10);     

                    $pdf->SetAutoPageBreak(TRUE, 0);
                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                    $pdf->SetFont('times', '', 7);
                    $html = $this->renderPartial('ResultPDF', array(
                                'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                        ), true);

                    $fileName = 'Result_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                    $pdf->Output($fileName, "I");

             

	}
        
        public function actionResultRetakePDF($proCode =null, $batchName= null,$term = null, $year = null, $group=null,$examType=1)
	{
              $session=new CHttpSession;
                   $session->open();
                   Yii::import('application.modules.admin.extensions.bootstrap.*');
                    if($proCode !=null && $batchName!= null && $term != null && $year != null)
                    {
                        yii::app()->session['reProCode'] = $proCode;
                        yii::app()->session['reBatName'] = $batchName;
                        yii::app()->session['reTerm'] = $term;
                        yii::app()->session['reYear'] = $year;
                        yii::app()->session['reType']= $examType;
                        yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                  
                        $batch = Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['reProCode'],'batchName'=>yii::app()->session['reBatName']));
                        yii::app()->session['reAcTerm']=$batch->bat_term;
                        yii::app()->session['reAcYear']=$batch->bat_year;
             
                        
                    }
                     $group = yii::app()->session['group'];
                     $model = new Examination();
                    if($group)
                    {
                         
                         
                        $rows = $model->searchTabulationReturnRowsTwo( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['reTerm'], yii::app()->session['reYear'],$group);
                        $subjectRows = $model->searchNoOfSubjectRetake( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID'],$group);
                    }
                    else
                    {
                         //$rows = $model->searchTabulationReturnRows( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID']);
                         
                         $rows = $model->searchTabulationReturnRowsTwo( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['reTerm'], yii::app()->session['reYear']);
                         $subjectRows = $model->searchNoOfSubjectRetake( yii::app()->session['reProCode'],yii::app()->session['reBatName'], yii::app()->session['examinationID']);
                       // echo var_dump($subjectRows);exit();
                         }
                    $pdf = new ResultPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor(Yii::app()->name);
                    $pdf->SetTitle('Result Sheet');
                    $pdf->SetSubject('Spring Term Examination 2013');
                    $pdf->setText('Retake Result Sheet'); 
                    //$pdf->setText('Result Sheet'); 
                    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
                    $pdf->setHeaderFont(Array('times', '', 6));
                    $pdf->setFooterFont(Array('times', '', 6));
                    $pdf->SetMargins(15, 30, 30);      
                    $pdf->SetHeaderMargin(10);     

                    $pdf->SetAutoPageBreak(TRUE, 0);
                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                    $pdf->SetFont('times', '', 7);
                    $html = $this->renderPartial('ResultPDF', array(
                                'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                        ), true);

                    $fileName = 'Result_'.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)'.'.pdf';
                    $pdf->Output($fileName, "I");

             

	}
        
	public function actionGetAllBatch()
        {
         //   echo CHtml::tag('option',array('value'=>'test'),CHtml::encode('test'),true);
//                echo "test";
          
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

        public function actionGetBatch()
        {
         //   echo CHtml::tag('option',array('value'=>'test'),CHtml::encode('test'),true);
//                echo "test";
          
		if(isset($_REQUEST['programmeCode']))
		{
                    if(isset($_POST['resultType'])){
                        $examID = Examination::model()->findByAttributes(array('exm_type'=>$_POST['resultType'],'exm_examTerm'=>$_POST['resultTerm'],'exm_examYear'=>$_POST['resultYear']))->examinationID; 	
                    
                    //echo "programme code:".$_REQUEST['programmeCode'];
		
                        $sql= "SELECT distinct
                         h.\"batchName\", 
                         f.bat_term, 
                         f.bat_year
                       FROM 
                         public.tbl_u_exammarks u, 
                         public.tbl_s_moduleregistration s, 
                         public.tbl_q_termadmission h, 
                         public.tbl_f_batch f
                       WHERE 
                         u.\"moduleRegistrationID\" = s.\"moduleRegistrationID\" AND
                         h.\"termAdmissionID\" = s.\"termAdmissionID\" AND
                         h.\"programmeCode\" = f.\"programmeCode\" AND
                         h.\"batchName\" = f.\"batchName\" AND
                         u.\"examinationID\" =  :examID AND 
                         h.\"programmeCode\" = :proCode order By h.\"batchName\" ";     

                         $model = Batch::model()->findAllBySql($sql,array(':proCode'=>$_REQUEST['programmeCode'],':examID'=>$examID));
                    }
                    else
                    {
                        $model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']),'ex_bat_active=true');
                    }
                    
                    
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
                            $termYear=" [ ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year." ]";
                            //echo "<optgroup label='{$termYear}'>";
                            $batchName=$item->batchName.FormUtil::getBatchNameSufix($item->batchName)." Batch    ".$termYear;
                                echo CHtml::tag('option',array('value'=>$item->batchName),CHtml::encode($batchName),true);
                            //echo"</optgroup>";
                        }

                     }  
                   
                }
            
                
        }
        
        public function actionGetGroup()
        {
         //   echo CHtml::tag('option',array('value'=>'test'),CHtml::encode('test'),true);
//                echo "test";
          
		if(isset($_REQUEST['programmeCode']))
		{
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                       /* $sql="SELECT 
                    distinct
                    e.mod_group

                  FROM 
                    tbl_h_offeredmodule h, 
                    tbl_e_module e
                  WHERE 
                    h.\"moduleCode\" = e.\"moduleCode\" AND
                    h.\"syllabusCode\" = e.\"syllabusCode\" and
                   h.\"batchName\"=:batchName and
                    h.\"programmeCode\"=:proCode and 
                    h.ofm_term=:ofmTerm and 
                    h.ofm_year=:ofmYear
                    ;";
                
                     $model = Module::model()->findAllBySql($sql,array(':batchName'=>$_REQUEST['batchName2'],':proCode'=>$_REQUEST['programmeCode'],':ofmTerm'=>$_REQUEST['resultTerm'],':ofmYear'=>$_REQUEST['resultYear']));                
                    */
                    
                     $sql="SELECT 
                    distinct
                    e.mod_group

                  FROM 
                    tbl_h_offeredmodule h, 
                    tbl_e_module e
                  WHERE 
                    h.\"moduleCode\" = e.\"moduleCode\" AND
                    h.\"syllabusCode\" = e.\"syllabusCode\" and
                   h.\"batchName\"=:batchName and
                    h.\"programmeCode\"=:proCode 
                    ;";
            
                    $model = Module::model()->findAllBySql($sql,array(':batchName'=>$_REQUEST['batchName2'],':proCode'=>$_REQUEST['programmeCode']));
               
            
                    //$model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']),'ex_bat_active=true');
                 
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No group Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-All-"),true);
                        
               
                        
                        foreach($model as $item)
                        {
            
                            echo CHtml::tag('option',array('value'=>$item->mod_group),CHtml::encode($item->mod_group),true);
                           
                        }

                     }  
                   
                }
            
                
        }
        
        
        
        
        public function actionGetResult()
        {
                
               
                
                $sid = yii::app()->session['studentID'];
                
                
                  $this->render('_studentTranscript',array(
			'sid'=>$sid,
                    ));

              
        }
        
      public function actionTranscript()
        {
                
             Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
             require_once(Yii::app()->params['tcpdf']);
	     require_once(Yii::app()->params['tcpdfConf']);
             
           
            
             $sid = yii::app()->session['trnsStudentID'];
             $sql="SELECT * FROM  generate_transcript('{$sid}')ORDER BY c_mod_group, c_title"; 
             $transcirptData = Yii::app()->db->createCommand($sql)->queryAll();
             
             $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
             $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count
            
             $dataProvider = new CSqlDataProvider($sql, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                            'keyField' => 'c_moduleCode', 
                            'totalItemCount' => $count,

                            //if the command above use PDO parameters
                            //'params'=>array(
                            //':param'=>$param,
                            //),


                            'sort' => array(
                                'attributes' => array(
                                    'c_moduleCode','c_title'
                                ),
                               /* 'defaultOrder' => array(
                                    'c_moduleCode' => CSort::SORT_ASC, //default sort value
                                ),*/
                          ),
                            'pagination' => array(
                                'pageSize' => 100,
                            ),
                        ));
                
                    
                $pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
                
                $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Transcript');
		$pdf->SetSubject('Transcript');
                //$pdf->SetPrintHeader(false);
		//$pdf->SetKeywords('example, text, report');
		//$pdf->SetHeaderData('', 0, "Tabulation Data", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Transcript",'');
		$pdf->setHeaderFont(Array('times', '', 25));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 32, 30);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(0);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('times', '', 10);
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
            
                
               $this->renderPartial('_transcriptView',array('pdf'=>$pdf,'dataProvider' => $dataProvider,'transcirptData'=>$transcirptData,'sid'=>$sid),true);
                //$pdf->writeHTML($view, true, false, false, false, '');
                
                $pdf->LastPage();
       
                // close and output PDF document
                $pdf->Output($sid.'.pdf', 'I');
        }
         public function actionGenerateWord() {
             $sid = yii::app()->session['trnsStudentID'];
             $sql="SELECT * FROM  generate_transcript('{$sid}')ORDER BY c_mod_group, c_title"; 
             $transcirptData = Yii::app()->db->createCommand($sql)->queryAll();
             
             $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
             $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count
              
             $dataProvider = new CSqlDataProvider($sql, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                            'keyField' => 'c_moduleCode', 
                            'totalItemCount' => $count,

                            //if the command above use PDO parameters
                            //'params'=>array(
                            //':param'=>$param,
                            //),


                            'sort' => array(
                                'attributes' => array(
                                    'c_moduleCode','c_title'
                                ),
                               /* 'defaultOrder' => array(
                                    'c_moduleCode' => CSort::SORT_ASC, //default sort value
                                ),*/
                          ),
                            'pagination' => array(
                                'pageSize' => 100,
                            ),
                        ));
                

            $div = $this->renderPartial('_transcriptDoc',array('dataProvider' => $dataProvider,'transcirptData'=>$transcirptData,'sid'=>$sid),true);             
         
            header("Pragma: no-cache");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename=\"test.doc");
            header("Content-Transfer-Encoding: binary");
            ob_clean();
            flush();
            echo $div;
            Yii::app()->end();
        }
        public function actionTranscriptXLS()
        {
              
                      
             $sid = yii::app()->session['trnsStudentID'];
             $sql="SELECT * FROM  generate_transcript('{$sid}')ORDER BY c_mod_group, c_title"; 
             $transcirptData = Yii::app()->db->createCommand($sql)->queryAll();
             
             $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
             $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count
             
             $dataProvider = new CSqlDataProvider($sql, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                            'id' => 'c_moduleCode',
                            'keyField' => 'c_moduleCode', 
                            'totalItemCount' => $count,

                            //if the command above use PDO parameters
                            //'params'=>array(
                            //':param'=>$param,
                            //),


                            'sort' => array(
                                'attributes' => array(
                                    'c_moduleCode','c_title'
                                ),
                               /* 'defaultOrder' => array(
                                    'c_moduleCode' => CSort::SORT_ASC, //default sort value
                                ),*/
                          ),
                            'pagination' => array(
                                'pageSize' => 100,
                            ),
                        ));
           //   $model = new Examination();
           //   $dataProvider = $model->searchTranscriptData($sid);
    
             
             $this->render('_transcriptXLS',array(
			'sid'=>$sid,
                         'dataProvider' => $dataProvider,'transcirptData'=>$transcirptData,
                    ));  
             
             
        }
        
        public function actionTranscriptBackpage()
        {
                
                 Yii::import('application.modules.admin.extensions.bootstrap.*');


                 require_once(Yii::app()->params['tcpdf']);
                 require_once(Yii::app()->params['tcpdfConf']);
                                 
                $pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
                
                $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Transcript');
		$pdf->SetSubject('Transcript');
                //$pdf->SetPrintHeader(false);
		//$pdf->SetKeywords('example, text, report');
		//$pdf->SetHeaderData('', 0, "Tabulation Data", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Transcript",'');
		$pdf->setHeaderFont(Array('times', '', 25));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 32, 30);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(0);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('times', '', 10);
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
                
                $pdf->AddPage();
                $html = $this->renderPartial('_transcriptBackPage',array('pdf'=>$pdf,),true);
                $pdf->writeHTML($html, true, false, false, false,'');

               //$this->renderPartial('_transcriptView',array('pdf'=>$pdf,'dataProvider' => $dataProvider,'transcirptData'=>$transcirptData,'sid'=>$sid),true);
                //$pdf->writeHTML($view, true, false, false, false, '');
                
                $pdf->LastPage();
       
                // close and output PDF document
                $pdf->Output('backpage.pdf', 'I');
        }
        public function actionTranscriptPDF()
        {
                
                 Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);

                
                    
                $pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
                
                $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Result Sheet');
		$pdf->SetSubject('Spring Term Examinatyion 2013');
                $pdf->SetPrintHeader(false);
		//$pdf->SetKeywords('example, text, report');
		//$pdf->SetHeaderData('', 0, "Tabulation Data", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Transcript",'');
		$pdf->setHeaderFont(Array('times', '', 25));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 20, 30);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(0);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('times', '', 10);
                
                // Add a page
              //  yii::app()->session['trnsStudentID'] ='121-115-001';
                $sid =yii::app()->session['trnsStudentID'];
                
                $sql= "select \"studentID\" from vw_transcript  where \"studentID\"=:studentID order by tra_year,tra_term; "; 
                       //echo $sql;
                $model= ExamMarks::model()->findAllBySql($sql,array(':studentID'=>$sid));
                        //$msearchModuleGroupsName($proCode,$batName,$examTerm,$examYear, $sid) 
             
                $this->renderPartial('_transcriptPDF',array('pdf'=>$pdf,'model'=>$model,),true);
               
                //$pdf->writeHTML($view, true, false, false, false, '');
                
                $pdf->LastPage();
       
                // close and output PDF document
                $pdf->Output('Transcript.pdf', 'I');
        }
		public function actionEditTranscript(){
             $sid = yii::app()->session['trnsStudentID'];
             $sql="SELECT * FROM generate_transcript('{$sid}')ORDER BY c_mod_group, c_modulecode"; 
             $transcirptData = Yii::app()->db->createCommand($sql)->queryAll();
             
             $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
             $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count
              
             $dataProvider = new CSqlDataProvider($sql, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                            'keyField' => 'c_moduleCode', 
                            'totalItemCount' => $count,            
                            'sort' => array(
                                'attributes' => array(
                                    'c_moduleCode','c_title'
                                ),
                               /* 'defaultOrder' => array(
                                    'c_moduleCode' => CSort::SORT_ASC, //default sort value
                                ),*/
                          ),
                            'pagination' => array(
                                'pageSize' => 100,
                            ),
                        ));                
              $rows = Yii::app()->db->createCommand($sql)->queryAll();
              //echo var_dump($dataProvider); exit();
              $this->render('editTranscript',array('rows'=>$rows,'dataProvider' => $dataProvider,'transcirptData'=>$transcirptData,'sid'=>$sid,));
        }

        public function actionUpdateTranscript(){  

           // echo(round(2.80,2) . "<br>");
         //  echo(ceil(0.60) . "<br>");
        //    exit();
             $sid = $_REQUEST['sid'];
             $sql="SELECT * FROM generate_transcript('{$sid}')ORDER BY c_mod_group, c_modulecode"; 
           //  $sql="SELECT * FROM generate_transcript('{$sid}')ORDER BY c_mod_group, c_actual_credithour, c_title, c_letterGrade, c_cgpa"; 
             $rows = Yii::app()->db->createCommand($sql)->queryAll();
             $_rows = $rows;
             $j = 0;
             foreach ($_REQUEST['id'] as $item)
             {   
                              if(isset($_REQUEST['pass']))
                                {
                                   
                                    $i =0;
                                    foreach ($rows as $row){                                       
                                       if($_REQUEST['id'][$item] == $row['c_modulecode']){                                           
                                           $rows[$i]["c_mod_group"] = $_REQUEST['group'][$item];
                                           $rows[$i]["c_mod_credithour"] = $_REQUEST['credithour'][$item];
                                           $sql = "SELECT * FROM check_grade_point('{$row["c_lettergrade"]}')";                                           
                                           $gpa = Yii::app()->db->createCommand($sql)->queryAll();                                                                                     
                                           $rows[$i]["c_cgpa"] = number_format($_REQUEST['credithour'][$item] * $gpa[0]["check_grade_point"], 2);                                    
                                       }
                                       $i++;
                                    }  
                                }
                             
           } 
                   
                if(isset($_REQUEST['remove']))
                {
                   
                    
                    $_temp =array_keys($_REQUEST['remove']);    
                   
                   
                        $i = 0;          
                        foreach ($_rows as $row){ 
                            foreach ($_temp as $pos){
                            
                              if($i == $pos){
                               
                                unset($rows[$pos]);
                              }
                              
                            }
                            
                            $i++;
                        }    
                     
                    
                        
                }
                
          //  exit();
           $data = array();
           //$cdata = array();
           $i = 0;
           foreach ($rows as $row)
           {  
                 $data[$i] = $row["c_mod_group"];
                 $i++;
                
           }
           $data = array_unique($data);
           sort($data);
           $moduleGroup = array();
           for($i = 0; $i<count($data); $i++){
               $moduleGroup[$i]["c_mod_group"] = $data[$i];
           }
           // exit();     
         //  echo var_dump($rows); exit();
           Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
             require_once(Yii::app()->params['tcpdf']);
	     require_once(Yii::app()->params['tcpdfConf']);           
                
                $pdf = new TCPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
                
                $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Transcript');
		$pdf->SetSubject('Transcript');
                //$pdf->SetPrintHeader(false);
		//$pdf->SetKeywords('example, text, report');
		//$pdf->SetHeaderData('', 0, "Tabulation Data", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Transcript",'');
		$pdf->setHeaderFont(Array('times', '', 25));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 32, 30);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(0);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('times', '', 10);
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
                
                
               $this->renderPartial('_transcriptUpdateView',array('rows'=>$rows,'moduleGroup'=>$moduleGroup,'pdf'=>$pdf,'sid'=>$sid),true);
                //$pdf->writeHTML($view, true, false, false, false, '');
                
                $pdf->LastPage();
       
                // close and output PDF document
                $pdf->Output($sid.'.pdf', 'I');

        }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Examination the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Examination::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Examination $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='examination-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
