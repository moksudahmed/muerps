<?php

class FacultyController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','getFacultyMemberList'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$this->render('view',array(
			'person'=> Person::model()->findByPk($id),
                        'faculty'=> Faculty::model()->findByPk($id)
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
                yii::app()->session['facCreate']=true;
            }
            else
            {
                yii::app()->session['facCreate']=false;
            }
            
            if(!yii::app()->session['facCreate'])
            {
                $this->redirect(array('index','id'=>yii::app()->session['dptID']));
            }
                
                $form ="_form_1";
                   
                $person = new Person();
                $faculty=new Faculty();
                    
                $acHistory = new AcademicHistory();
                $jobExp= new JobExperiance();
                    
                $faculty->departmentID= yii::app()->session['dptID'];
                    
		 //Uncomment the following line if AJAX validation is needed
                    
                

		if(isset($_REQUEST['Person']) &&  isset($_REQUEST['Faculty']))
		{
                    
                        
                    CActiveForm::validate($person);
                    CActiveForm::validate($faculty);
                    CActiveForm::validate($acHistory);
                    
                    
                    $person->attributes = $_REQUEST['Person'];       
                    
                    $faculty->attributes = $_REQUEST['Faculty'];
                    
                    
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
                    
                    
                    
                        if($person->validate() && $faculty->validate())
                        {   
                            
                            //echo "Bismillah Hir Rah Manir Rahim";
                            //echo "pre:".$_REQUEST['preview'];
                            //echo "isset".isset($_REQUEST['preview']);
                               if(isset($_REQUEST['preview']) && $_REQUEST['preview']==1)
                               {
                                   $form="_form_2";
                                           
                               }
                               elseif(isset($_REQUEST['preview']) && $_REQUEST['preview']==2 && yii::app()->session['facCreate'])
                               { //echo "saved:".$_REQUEST['preview'];
                                   
                                   $person->ex_per_ref='f';
                                   
                                   $person->per_dateOfBirth=date("Y-m-d",strtotime($person->per_dateOfBirth));
                                   $faculty->fac_joining= date("Y-m-d",strtotime($faculty->fac_joining));
                                   $faculty->fac_leave= date("Y-m-d",strtotime($faculty->fac_leave));
                                   
                                   if($person->save())
                                    {	
                                       
                                    $faculty->facultyID= $person->personID;
                                    $faculty->fac_loginName= $person->per_email;
                                    $i=0; $achFlag=false; $sql = array();
                                        
                                        //$sql = "INSERT INTO tbl_k_academichistory (ach_degree, ach_group, ach_institution, ach_board, \"ach_passingYear\", ach_result, \"personID\") VALUES"; 
                              
                                        foreach($acHistory->ach_degree as $item)
                                        {
                                        
                                                if ($item) 
                                                {   $achFlag= true;
                                                    

                                                    $sql [$i]= "INSERT INTO tbl_k_academichistory (ach_degree, ach_group, ach_institution, ach_board, \"ach_passingYear\", ach_result, \"personID\") VALUES"."  ( '{$item}', '{$acHistory->ach_group[$i]}', '{$acHistory->ach_institution[$i]}', '{$acHistory->ach_board[$i]}', '{$acHistory->ach_passingYear[$i]}', '{$acHistory->ach_result[$i]}', '{$person->personID}');"; 
                                                }



                                            $i++;
                                        }

                                        //echo $sql;
                                         $j=0; $joeFlag=false; $sql2= array();
                                        foreach($jobExp->joe_employer as $item2)
                                        {

                                                if ($item2) 
                                                {   $joeFlag= true;
                                                 $joining= date("Y-m-d",strtotime($jobExp->joe_startDate[$j]));
                                                 $leave= date("Y-m-d",strtotime($jobExp->joe_endDate[$j]));

                                                    $sql2[$j] ="INSERT INTO tbl_l_jobexperiance ( joe_employer, joe_address, joe_contact, joe_position, \"joe_startDate\", \"joe_endDate\",  \"personID\") VALUES"."  ( '{$item2}', '{$jobExp->joe_address[$j]}', '{$jobExp->joe_contact[$j]}', '{$jobExp->joe_position[$j]}', '{$joining}', '{$leave}', '{$person->personID}');"; 
                                                }



                                            $j++;
                                        }


                                        //echo $sql2;
                                        if($faculty->save())
                                        {
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
                                            
                                            yii::app()->session['facCreate']=false;
                                            $this->redirect(array('index'));
                                        }

                                    }
                              }
                            
         
                              
                            
                        }
		}
                
                    
                                  $this->render('create',array(
                            'faculty'=>$faculty,'person'=>$person,'acHistory'=>$acHistory,'jobExp'=>$jobExp, 'form'=>$form
                        ));
                            
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            
                
		$faculty= Faculty::model()->findByPk($id);
                $person= Person::model()->findByPk($id);
                //echo $person->per_mobile;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_REQUEST['Faculty'],$_REQUEST['Person']))
		{
                    
                    
                    CActiveForm::validate($faculty);
                    CActiveForm::validate($person);
                    
			
                        $faculty->attributes=$_REQUEST['Faculty'];
                        $person->attributes=$_REQUEST['Person'];
                        
                       
                        if($person->validate() && $faculty->validate() )
                        {
                            
                            $fileName=$faculty->facultyID.'.jpg';
                            
                            if(move_uploaded_file($_FILES['photograph']['tmp_name'], './faculty/'.$fileName))
                            {        
                                $person->ex_per_image=1;
                                //Yii::app()->request->baseUrl.
                                $file = new File('./faculty');
                                //$file->createTmb($filename);
                                $file->imageResize($fileName);
                                
                            }
                            
                            if($person->update() && $faculty->update() )
                            {	
                            
                               
                               
                              $this->redirect(array('index'));
                            }
                            
                               
				
                        }
		}

		$this->render('update',array(
			'faculty'=>$faculty,'person'=>$person
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
                    yii::app()->session['dptID']=$id;
                }
                else
                {
                    $id = yii::app()->session['dptID'];
                }
		
                yii::app()->session['department']=Department::model()->findByPk($id)->dpt_name;
                
                
                $model=new Faculty();
		$model->unsetAttributes();  // clear any default values
		
                if(isset($_GET['Faculty']))
			$model->attributes=$_GET['Faculty'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Faculty('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Faculty']))
			$model->attributes=$_GET['Faculty'];

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
		$model=Faculty::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

         public function loadPersonModel($id)
        {
                $modelPerson=  Person::model()->findByPk((int)$id);             
                if($modelPerson===null)   
                        throw new CHttpException(404,'The requested page does not exist.');
                return $modelPerson;
        }
        
        
        /**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='faculty-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
