<?php

class AcademicHistoryController extends Controller
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
			//'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
			//array('allow',  // allow all users to perform 'index' and 'view' actions
				//'actions'=>array('index'),
				//'users'=>array('*'),
			//),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','create','update','excel'),
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
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AcademicHistory;
                $model->personID=yii::app()->session['acHistoryOfId'];
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AcademicHistory']))
		{
			$model->attributes=$_POST['AcademicHistory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->academicHistoryID));
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

		if(isset($_POST['AcademicHistory']))
		{
			$model->attributes=$_POST['AcademicHistory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->academicHistoryID));
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
	public function actionAdmin($id)
	{
            
                yii::app()->session['personId']=$id;
                
                
		
                $condition = "personID={$id}";
                
		$dataProvider=new CActiveDataProvider('AcademicHistory', array(
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
	public function actionIndex($id=null,$sid=null)
	{   
            if(isset($id))
            {
                yii::app()->session['acHistoryOfId'] =$id;
                yii::app()->session['acStudentID'] =$sid;
            }
            else
            {
                $id = yii::app()->session['acHistoryOfId'];
                $sid = yii::app()->session['acStudentID'];
            }
            //echo $id;
		$model=new AcademicHistory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AcademicHistory']))
			$model->attributes=$_GET['AcademicHistory'];

		$this->render('index',array(
			'model'=>$model,'id'=>$id,
		));
	}

	
         public function actionExcel() {
            $model = new AcademicHistory('search');
            $model->unsetAttributes();
            if (isset($_GET['Model'])) {
                $model->attributes = $_GET['Model'];
            }
            if (isset($_GET['export'])) {
                $production = 'export';
            } else {
                $production = 'grid';
            }
            $this->render('create2', array('model' => $model, 'production' => $production));
        } 
        
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
        
        
	public function loadModel($id)
	{
		$model=AcademicHistory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='academic-history-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
        //code of abir .....
        public function actionReportSchool()
        {
            $this->render('report');
        }
        
        public function actionSchoolAjaxData()
        {
            $output=  School::SchoolReport();
            echo json_encode( $output );
        }
        
        
        
}
