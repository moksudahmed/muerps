<?php

class OptionsController extends Controller
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
				'actions'=>array('index','view','settings','optionsValue','updateOptions',),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','edit'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','edit'),
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
        public function actionSettings()
	{
            
            $option = new Options();
            $dataProvider = $option->getOptionGroupWise('controller'); 
            $this->render('settings',array(			
                         'dataProvider' => $dataProvider,
                    )); 
            
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Options;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Options']))
		{
			$model->attributes=$_POST['Options'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->option_id));
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

		if(isset($_POST['Options']))
		{
			$model->attributes=$_POST['Options'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->option_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        public function actionUpdateOptions()
        {
            $es = new EditableSaver('Options');  //'User' is name of model to be updated
            $es->update();
        }
        public function getOptionsValue(){
            
            return array('Metropolitan University'=>'Metro',
                         'Alhamra, Zindabazar, Sylhet'=>'Address',
                        '+880821713077'=>'+880821713077',
                        'info@metrouni.edu.bd'=>'info@metrouni.edu.bd',
                        'Spring:Summer:Autumn'=>'Spring:Summer:Autumn','university'=>'university',
                        '6 months'=>'6 months',
                        'http://www.metrouni.edu.bd'=>'http://www.metrouni.edu.bd',
                        'Summer'=> 'Summer',
                        'Spring'=>'Spring',
                        '2017'=>'2017'                        
                
                        );        
            
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Options');
                /*$option = new Options;
                $row = $option->getOptions('examination_controller');
                print_r($row);*/
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Options('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Options']))
			$model->attributes=$_GET['Options'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        
       
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Options the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Options::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Options $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='options-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
