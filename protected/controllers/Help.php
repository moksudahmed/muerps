<?php

class HelpController extends Controller
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
             $rules= array();

            
            
            if(yii::app()->user->getState('role')==='super-admin')
            {
                
                $rules = array('index','help');
		
                
            }
            elseif(yii::app()->user->getState('role')==='admin')
            {
		
			
		//$rules = array('create','update','GetSection','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligibleListFinal','ExamEligibleListFinalPDF','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','ExamEligibleListSupple','ExamEligibleListSupplePDF','ExamEligibleListSuppleXLS','PublishResultSupple');
			
		
                
            }
            elseif(yii::app()->user->getState('role')==='head')
            {
		
		$rules = array('index','help');	
		///$rules = array('create','update','GetSection','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','ExamEligibleListSupple','ExamEligibleListSuppleXSL','SuppleModuleMarksList','PublishResultSupple','SaveSuppleMarks');
			
		
                
            }
            elseif(yii::app()->user->getState('role')==='coordinator')
            {
		$rules = array('index','help');
		//$rules = array('create','update','GetSection','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','SaveSuppleMarks','SuppleModuleMarksList','ExamEligibleListSupple','PublishResultSupple');
		
                
            }
            elseif(yii::app()->user->getState('role')==='faculty')
            {
		
		//$rules =array('create','update','GetSection','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligableList','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF');
		$rules = array('index','help');
                
            }
            
            elseif(yii::app()->user->getState('role')==='exam')
            {
		//$rules = array('create','update','GetSection','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligibleListFinal','ExamEligibleListFinalPDF','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','ExamEligibleListSupple','ExamEligibleListSupplePDF','ExamEligibleListSuppleXLS','PublishResultSupple');
		$rules = array('index','help');
            }
            elseif(yii::app()->user->getState('role')==='registry')
            {

		//$rules = array('create','update','GetSection','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligableList','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF');
		$rules = array('index','help');	
                
            }
            elseif(yii::app()->user->getState('role')==='admission')
            {
		
		$rules = array('index','help');
		//$rules = array('AcademicRecord','AcademicRecordXLS','AcademicRecordPDF');
				
			
                
            }
            elseif(yii::app()->user->getState('role')==='deo')
            {
		
		
		$rules = array('index','help');
				
			
                
            }
            else
            {
                    $rules=array('');
            }
            
            
            
            return array(
                     /*   array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),	
                */
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>$rules,
				'users'=>array(yii::app()->user->id),
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
	public function actionHelp()
	{
           
           echo "test";
           exit();
		$this->render('help');
                      
         }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
            echo "test";
            exit();
			//	$this->render('index');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return School the loaded model
	 * @throws CHttpException
	 */
	
	/**
	 * Performs the AJAX validation.
	 * @param School $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='school-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
