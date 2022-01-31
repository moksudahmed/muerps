<?php

class ModuleController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','report','editable'),
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
	public function actionView($id,$pid)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id,$pid),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            
		$model=new Module;
                $model->syllabusCode= yii::app()->session['syllabusCode'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Module']))
		{
			$model->attributes=$_POST['Module'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->moduleCode,'pid'=>$model->syllabusCode));
                            //$this->redirect(array('create'));
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
	public function actionUpdate($id,$pid)
	{
                
		$model=$this->loadModel($id,$pid);
                //$model->rules();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Module']))
		{
                    
			$model->attributes=$_POST['Module'];
                       // var_dump($model->attributes);
                       // exit();
                        if($model->validate())
                        {  // echo "test:".$model->syllabusCode;
                                  //$model->updateByPk(array('moduleCode'=>$id,'syllabusCode'=>$pid));
                                  $model->update();
                                //$model->updateByPk(array('moduleCode'=>$id,'syllabusCode'=>$pid));
                                    $this->redirect(array('view','id'=>$model->moduleCode,'pid'=>$model->syllabusCode));
                           
                        }
                        
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionEditable($id,$pid)
	{   

		
		Yii::import('bootstrap.widgets.TbEditableSaver');
                $es = new TbEditableSaver('Module');
                $es->update();
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id,$pid)
	{
		$this->loadModel($id,$pid)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	
	
	public function actionIndex($id=NULL)
	{
            if($id)
            {
                yii::app()->session['syllabusCode']=$id;
            }
            else 
            {
                $id=yii::app()->session['syllabusCode'];
            }
                $syl = Syllabus::model()->findByPk($id);
                $pro = Programme::model()->findByPk($syl->programmeCode);
                $dpt = Department::model()->findByPk($pro->departmentID);
                
                yii::app()->session['syllabus']=$id;
                yii::app()->session['programme'] = $pro->programmeCode.":".$pro->pro_name;
                yii::app()->session['department'] = $dpt->dpt_code.":".$dpt->dpt_name;
            
            
		$model=new Module('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Module']))
			$model->attributes=$_GET['Module'];

                
		$this->render('index', ['model'=>$model ,'id'=>$id]);
	}

        public function actionReport($id)
	{
		
                $condition = "syllabusCode='{$id}'";
                
		$dataProvider=new CActiveDataProvider('Module', array(
                'criteria'=>array('condition'=>$condition),
                'pagination'=>array('pageSize'=>20,)
                 ));
                
                
                
                
		$this->render('report',array(
			'dataProvider'=>$dataProvider,'id'=>$id,
		));
	}
        
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Module the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id,$pid)
	{
		$model=Module::model()->findByPk(array('moduleCode'=>$id,'syllabusCode'=>$pid));
		
                
                if($model===null)
			throw new CHttpException(404,'The requested page does not exist.'.$id);
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Module $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='module-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
