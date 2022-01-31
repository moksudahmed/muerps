<?php

class BatchController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable'),
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
                $flag=false;
        
                //$model->bat_term=$term;
                //$model->bat_year=  FormUtil::getYear();
                //echo FormUtil::getCurrentTerm();
                // Uncomment the following line if AJAX validation is needed
                
                    $model= new Batch();
                    $model->programmeCode=yii::app()->session['programmeCode'];
                    //$proCode=yii::app()->session['programmeCode'];
                   $sql="SELECT 
                        d.\"syllabusCode\"
                      FROM 
                        tbl_d_syllabus d, 
                        tbl_c_programme c, 
                        tbl_c_programme p
                      WHERE 
                        d.\"programmeCode\" = c.\"programmeCode\" AND
                        c.\"departmentID\" = p.\"departmentID\" AND
                        p.\"programmeCode\" = '{$model->programmeCode}';";
                     
                        $syllabus= Syllabus::model()->findAllBySql($sql);
                    
                    $sql2="
                        SELECT distinct
                        concat( sp_get_term_name(aa.\"fee_startTerm\"),' ',aa.\"fee_startYear\",' onward') as \"feesTitle\", 
                        concat( aa.\"fee_startTerm\",' ',aa.\"fee_startYear\",' onward') as \"feesName\", 
                            aa.\"fee_startTerm\", 
                            aa.\"fee_startYear\"
                          FROM 
                            public.tbl_aa_fees aa
                          WHERE 
                            aa.\"programmeCode\" = '{$model->programmeCode}' order by  aa.\"fee_startYear\" desc, aa.\"fee_startTerm\" desc
                            ;";
                    
                         $fees = Fees::model()->findAllBySql($sql2);   
                        
                    if(isset($_POST['Batch']))
                    {
                        $model->attributes=$_POST['Batch'];
                        
                        $model->batchName = $this->getNextBatchFromProgrammeCode($model->programmeCode,$model->bat_term,$model->bat_year);
                       
                        $batch = Batch::model()->findByAttributes(array('bat_term'=>$model->bat_term,'bat_year'=>$model->bat_year,'programmeCode'=>$model->programmeCode));  	 
 
                       
                        $this->performAjaxValidation($model);
                        
                        if(count($batch))
                        {
                            Yii::app()->user->setFlash('warning','Batch Already Exists!!');
                            $this->redirect(array('index'));
                        }
                        else{
                        
                        
                            if($model->validate())
                            {           
                                
                                $split= array();
                                $split= explode(' ',$model->feesName);
                                $split[0];
                                
                                $fees2= Fees::model()->findAllByAttributes(array('programmeCode'=>$model->programmeCode,'fee_startTerm'=>$split[0],'fee_startYear'=>$split[1]));
                                $flag=(count($fees2)?TRUE:FALSE);
                                
                                
                                
                                
                                
                                if($flag)
                                {
                                    if($model->save())
                                    {
                                        foreach ($fees2 as $item)
                                        {
                                            $sqlInsert="INSERT INTO tbl_ac_batchfees(
                                                    \"batchName\", \"programmeCode\", \"feesID\")
                                            VALUES ({$model->batchName},{$model->programmeCode} ,{$item->feesID} );";
                                            
                                            Yii::app()->db->createCommand($sqlInsert)->execute();

                                        }    
                                

                                        Yii::app()->user->setFlash('success','New batch created Successfully!!');
                                        $this->redirect(array('view','id'=>$model->batchName,'pid'=>$model->programmeCode));
                                    }
                                    
                                }
                                else
                                {
                                        Yii::app()->user->setFlash('warning','New batch Creation Failure!!');
                                        $this->redirect(array('index'));
                                }
                            }
                        }
                    }
                  
                        $this->render('create',array(
                                'form'=>'_form','model'=>$model,'syllabus'=>$syllabus,'fees'=>$fees
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                     $sql2="
                        SELECT distinct
                        concat( sp_get_term_name(aa.\"fee_startTerm\"),' ',aa.\"fee_startYear\",' onward') as \"feesTitle\", 
                        concat( aa.\"fee_startTerm\",' ',aa.\"fee_startYear\",' onward') as \"feesName\", 
                            aa.\"fee_startTerm\", 
                            aa.\"fee_startYear\"
                          FROM 
                            public.tbl_aa_fees aa
                          WHERE 
                            aa.\"programmeCode\" = '{$model->programmeCode}' order by  aa.\"fee_startYear\" desc, aa.\"fee_startTerm\" desc
                            ;";
                    
                         $fees = Fees::model()->findAllBySql($sql2);   
		if(isset($_POST['Batch']))
		{
			$model->attributes=$_POST['Batch'];
			if($model->update())
				$this->redirect(array('view','id'=>$model->batchName,'pid'=>$model->programmeCode));
		}

		$this->render('update',array(
			'model'=>$model,'fees'=>$fees
		));
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
	

	/**
	 * Manages all models.
	 */
	public function actionIndex($id=null)
	{
            if($id)
            {
                yii::app()->session['programmeCode']=$id;
                
            }
            else 
            {
                $id=yii::app()->session['programmeCode'];
            }
                $pro = Programme::model()->findByPk($id);
                $dpt = Department::model()->findByPk($pro->departmentID);
                
                yii::app()->session['programme'] = $pro->programmeCode.":".$pro->pro_name;
                yii::app()->session['department'] = $dpt->dpt_code.":".$dpt->dpt_name;
                
            
		$model=new Batch('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Batch']))
			$model->attributes=$_GET['Batch'];

		$this->render('index',array(
			'model'=>$model,'id'=>$id
		));
	}

        public function actionEditable($id,$pid)
	{   

		
		Yii::import('bootstrap.widgets.TbEditableSaver');
                $es = new TbEditableSaver('Batch');
                $es->update();
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Batch the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id,$pid)
	{
		$model=Batch::model()->findByPk(array('batchName'=>$id,'programmeCode'=>$pid));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


        
        
	/**
	 * Performs the AJAX validation.
	 * @param Batch $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='batch-form')
		{
                   
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        }
        
        
    private function getNextBatchFromProgrammeCode($proCode, $currentTerm, $currentYear)
    {
        
        $model = Programme::model()->findByPk($proCode);
        
        return $this->calculateBatchNumber($model->pro_startTerm, $model->pro_startYear, $currentTerm, $currentYear);
    }

    private function calculateBatchNumber($startTerm,$startYear,$currentTerm,$currentYear)
    {
        
        if( ($startTerm >0 && $startTerm <4) &&  ($currentTerm >0 && $currentTerm <4) && ($startYear<=$currentYear) )
        {
            $batch = ((($currentYear-$startYear)*3)-$startTerm+$currentTerm)+1;
        }
        else {
            $batch=0;
        }
        
        return $batch;
        
    }
        
}