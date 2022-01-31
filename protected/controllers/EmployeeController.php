<?php

class EmployeeController extends Controller
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
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index2','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','delete','create','update','report'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','delete'),
				'users'=>array('admin'),
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
                
            //echo $student->personID;
		$this->render('view',array(
			'person'=> Person::model()->findByPk($id),
                        'employee'=> Employee::model()->findByPk($id)
		));
	}

        public function actionReport()
	{
            $model = new Employee;
		 $this->render('report',array('model'=>$model));	
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            if(isset($_REQUEST['flag']))
            {
                yii::app()->session['empCreate']=true;
            }
            else
            {
                yii::app()->session['empCreate']=false;
            }
            
            if(!yii::app()->session['empCreate'])
            {
                $this->redirect(array('index','id'=>yii::app()->session['adminCode']));
            }
                
                $form ="_form_1";
                   
                $person = new Person();
                $employee=new Employee();
                    
                $acHistory = new AcademicHistory();
                $jobExp= new JobExperiance();
                    
                $employee->administrationCode= yii::app()->session['adminCode'];
                    
		 //Uncomment the following line if AJAX validation is needed
                    


		if(isset($_REQUEST['Person']) &&  isset($_REQUEST['Employee']))
		{
                    
                        
                    CActiveForm::validate($person);
                    CActiveForm::validate($employee);
                    CActiveForm::validate($acHistory);
                    
                    
                    $person->attributes = $_REQUEST['Person'];       
                    
                    $employee->attributes = $_REQUEST['Employee'];
                    
                    
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
                    
                    
                    
                        if($person->validate() && $employee->validate())
                        {   
                            
                            //echo "Bismillah Hir Rah Manir Rahim";
                            //echo "pre:".$_REQUEST['preview'];
                            //echo "isset".isset($_REQUEST['preview']);
                               if(isset($_REQUEST['preview']) && $_REQUEST['preview']==1)
                               {
                                   $form="_form_2";
                                           
                               }
                               elseif(isset($_REQUEST['preview']) && $_REQUEST['preview']==2 && yii::app()->session['empCreate'])
                               { //echo "saved:".$_REQUEST['preview'];
                                   
                                   $person->ex_per_ref='e';
                                    $person->per_dateOfBirth=date("Y-m-d",strtotime($person->per_dateOfBirth));
                                   $employee->emp_joining= date("Y-m-d",strtotime($employee->emp_joining));
                                   $employee->emp_leave= date("Y-m-d",strtotime($employee->emp_leave));
                                   if($person->save())
                                    {	
                                       //echo "saved2:".$_REQUEST['preview'];
                                       
                                    $employee->employeeID= $person->personID;
                                    $employee->emp_loginName= $person->per_email;
                                        $i=0; $achFlag=false; $sql= array();
                                        
                                        //$sql = "INSERT INTO tbl_k_academichistory (ach_degree, ach_group, ach_institution, ach_board, \"ach_passingYear\", ach_result, \"personID\") VALUES"; 
                              
                                        foreach($acHistory->ach_degree as $item)
                                        {
                                        
                                                if ($item && $acHistory->ach_board && $acHistory->ach_group && $acHistory->ach_institution ) 
                                                {   $achFlag= true;
                                                    

                                                    $sql[$i] = "INSERT INTO tbl_k_academichistory (ach_degree, ach_group, ach_institution, ach_board, \"ach_passingYear\", ach_result, \"personID\") VALUES"."  ( '{$item}', '{$acHistory->ach_group[$i]}', '{$acHistory->ach_institution[$i]}', '{$acHistory->ach_board[$i]}', '{$acHistory->ach_passingYear[$i]}', '{$acHistory->ach_result[$i]}', '{$person->personID}');"; 
                                                }



                                            $i++;
                                        }

                                        //echo $sql;
                                         $j=0; $joeFlag=false; $sql2= array();
                                        foreach($jobExp->joe_employer as $item2)
                                        {

                                                if ($item2 && $jobExp->joe_address && $jobExp->joe_position && $jobExp->joe_startDate && $jobExp->joe_endDate ) 
                                                {   
                                                    $joeFlag= true;
                                                 
                                                    $sql2[$j] ="INSERT INTO tbl_l_jobexperiance ( joe_employer, joe_address, joe_contact, joe_position, \"joe_startDate\", \"joe_endDate\",  \"personID\") VALUES"."  ( '{$item2}', '{$jobExp->joe_address[$j]}', '{$jobExp->joe_contact[$j]}', '{$jobExp->joe_position[$j]}', '{$jobExp->joe_startDate[$j]}', '{$jobExp->joe_endDate[$j]}', '{$person->personID}');"; 
                                                }



                                            $j++;
                                        }

                                        if($employee->save())
                                        {
                                            //echo $sql; 
                                            //echo $sql2;        
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
                                            yii::app()->session['empCreate']=false;
                                            $this->redirect(array('index','id'=>yii::app()->session['adminCode']));
                                        }

                                    }
                              }
                            
         
                              
                            
                        }
		}
                
                    
                                  $this->render('create',array(
                            'employee'=>$employee,'person'=>$person,'acHistory'=>$acHistory,'jobExp'=>$jobExp, 'form'=>$form
                        ));
                            
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            
                
		$employee= Employee::model()->findByPk($id);
                $person= Person::model()->findByPk($id);
                //echo $person->per_mobile;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_REQUEST['Employee'],$_REQUEST['Person']))
		{
                    
                    
                        CActiveForm::validate($employee);
                        CActiveForm::validate($person);
                    
			
                        $employee->attributes=$_REQUEST['Employee'];
                        $person->attributes=$_REQUEST['Person'];
                        
                       
                        if($person->validate() && $employee->validate() )
                        {
                            
                            $fileName=$employee->employeeID.'.jpg';
                            
                            if(move_uploaded_file($_FILES['photograph']['tmp_name'], './employee/'.$fileName))
                            {        
                                $person->ex_per_image=1;
                                //Yii::app()->request->baseUrl.
                                $file = new File('./employee');
                                //$file->createTmb($filename);
                                $file->imageResize($fileName);
                                
                            }
                            
                            if( $employee->update() && $person->update())
                            {	
                            
                               
                               
                              $this->redirect(array('index','id'=>yii::app()->session['adminCode']));
                            }
                            
                               
				
                        }
		}

		$this->render('update',array(
			'employee'=>$employee,'person'=>$person
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
	 * Manages all models.
	 */
	public function actionIndex($id=NULL)
	{
                if($id)
                {
                    yii::app()->session['adminCode']=$id;
                }
                else
                {
                    $id = yii::app()->session['adminCode'];
                }
                
                yii::app()->session['adminDepartment']=Administration::model()->findByPk($id)->adm_name;
                
		$model=new Employee();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employee']))
			$model->attributes=$_GET['Employee'];

		$this->render('index',array(
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
		$model=Employee::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
         public function loadPersonModel($id)
        {
                $modelPerson=  Person::model()->findByPk((int)$id);             
                if($modelPerson===null)   
                        throw new CHttpException(404,'The requested page does not exist.');
                return $modelPerson;
        }
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employee-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
