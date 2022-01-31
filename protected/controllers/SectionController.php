<?php

class SectionController extends Controller
{
	
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
				'actions'=>array('index','view','getBatch'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update',),
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
	public function actionView($id,$bid,$pid)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id,$bid,$pid),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
        
        
        public function actionCreate()
        {
            $model=new Section;

                $model->programmeCode = yii::app()->session['programmeCode'];
                $model->batchName = yii::app()->session['batchName'];
            
                $model->sec_startId = ($this->getLastID($model->batchName, $model->programmeCode)!=null?$this->getLastID($model->batchName, $model->programmeCode):1);
                
                $model->sec_endId=$model->sec_startId+49;
                
            if(isset($_POST['Section']))
            {
                $model->attributes=$_POST['Section'];
                if($model->validate())
                {
                    if($model->save())
				$this->redirect(array('view','id'=>$model->sectionName,'bid'=>$model->batchName,'pid'=>$model->programmeCode));
                }
            }
            $this->render('Create',array('model'=>$model));
        }
    
	
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$bid,$pid)
	{
		$model=$this->loadModel($id,$bid,$pid);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Section']))
		{
			$model->attributes=$_POST['Section'];
			if($model->update())
				$this->redirect(array('view','id'=>$model->sectionName,'bid'=>$model->batchName,'pid'=>$model->programmeCode));
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
	public function actionDelete($id,$bid,$pid)
	{
		$this->loadModel($id,$bid,$pid)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index','id'=>$bid,'pid'=>$pid));
	}

	/**
	 * Lists all models.
	 */
	

	/**
	 * Manages all models.
	 */
	public function actionIndex($id=null,$pid=null)
	{
            if($id)
            {
                yii::app()->session['batchName']=$id;
                yii::app()->session['programmeCode']=$pid;
                
                
               
            }
            else 
            {
                $id=yii::app()->session['batchName'];
                $pid=yii::app()->session['programmeCode'];
            }
            
                $bat=Batch::model()->findByPk(array('batchName'=>$id,'programmeCode'=>$pid));
                $pro = Programme::model()->findByPk($pid);
                $dpt = Department::model()->findByPk($pro->departmentID);
                
                yii::app()->session['batch'] = $id.FormUtil::getBatchNameSufix($id);
                yii::app()->session['academicYear'] = FormUtil::getTerm($bat->bat_term).' '.$bat->bat_year;
                yii::app()->session['programme'] = $pro->programmeCode.":".$pro->pro_name;
                yii::app()->session['department'] = $dpt->dpt_code.":".$dpt->dpt_name;
            
		
                
                $model=new Section('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Section']))
			$model->attributes=$_GET['Section'];

		$this->render('index',array(
			'model'=>$model,'id'=>$id,'pid'=>$pid
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Batch the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id,$bid,$pid)
	{
            
		$model=Section::model()->findByPk(array('sectionName'=>$id,'batchName'=>$bid,'programmeCode'=>$pid));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

        private function getLastID($bid,$pid)
        {
            $sql="select max(\"sec_endId\")+1 as \"lastId\" from {{g_section}} where \"batchName\"={$bid} and \"programmeCode\"='{$pid}';";
            //echo $sql;
            $list= Yii::app()->db->createCommand($sql)->query();
 
            
            $rs= array();
       
            foreach($list as $item){
    
                $rs=$item;
                
            }
            return $rs['lastId'];
            
        }
        /**
	 * Performs the AJAX validation.
	 * @param Batch $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='section-form')
		{
                   
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        }
}