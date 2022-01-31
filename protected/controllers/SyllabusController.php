<?php

class SyllabusController extends Controller
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
		 if(yii::app()->user->getState('role')==='super-admin')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','syllabusPrint','getSyllabusVersion'),
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
			elseif(yii::app()->user->getState('role')==='deo')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','syllabusPrint','getSyllabusVersion'),
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
			 elseif($role=yii::app()->user->getState('role')=='admin')
                {
                    return array(
                        /*
                            array('allow',  // allow all users to perform 'index' and 'view' actions
                                    'actions'=>array('index','view'),
                                    'users'=>array('*'),

                            ),
                            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                                    'actions'=>array('create','update'),
                                    'users'=>array('@'),
                            ),*/
                            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                                    'actions'=>array('admin','delete'),
                                    'users'=>array(yii::app()->user->id),
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

        public function actionSyllabusPrint()
	{
                
                $model=new Syllabus('search');
                $programm = new Module('search');
		$model->unsetAttributes();  // clear any default values
             
        	if(isset($_REQUEST['programmeCode']) && isset($_REQUEST['syllabusCode'])) 
		{
                     	
                    $name = $_REQUEST['programmeCode'];
                    $syllabus_ver = $_REQUEST['syllabusCode'];
                    
                    $sql = "SELECT moduleCode, mod_shortName, mod_name, mod_type, 
                            mod_labIncluded, mod_group, mod_creditHour from tbl_module 
                            JOIN tbl_syllabus on tbl_syllabus.syllabusCode = tbl_module.syllabusCode 
                            WHERE tbl_syllabus.programmeCode = '$name'
                            AND tbl_syllabus.syllabusCode = '$syllabus_ver'";

                    
                      
                      $rows = Yii::app()->db->createCommand($sql)->queryAll();
                   
                                            
                   # You can easily override default constructor's params
                       $mpdf = Yii::app()->ePdf->mpdf();

                       //$mpdf = Yii::app()->ePdf->mpdf();
                       $filename = 'boots.css';
                       $path=Yii::getPathOfAlias('webroot.css.pdfcss.css') . '/';
                       $file=$path.$filename;
                       $stylesheet = file_get_contents($file, true);
                       //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/css/bootstrap12.css');
                       //file_get_contents('/yiistrap.min.css', true);
                       //$stylesheet =file_get_contents(Yii::setPathOfAlias('bootstrap', dirname(FILE).'/../extensions/bootstrap/assets/css') . '/bootstrap.css');
                       $mpdf->WriteHTML($stylesheet, 1);
                       // Define the Header/Footer before writing anything so they appear on the first page
                      // $html = $mpdf->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/images.gif' ));
                       $mpdf->myvariable = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/MU.jpg' );
                       $html = '<div align="right"><img src="var:myvariable" height="50" width="120"></div>'; 
                       $temp = '<div style="text-align: left; font-weight: bold;"></div>';
                       $mpdf->SetHTMLHeader($temp.$html);

                      
                     //  $mpdf->AddPage('L');  
                      
                      $mpdf->WriteHTML($this->renderPartial('_print_syllabus',array(
                                   'rows'=>$rows,), true));
                      $mpdf->SetHTMLFooter('
                       <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
                       <td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
                       <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
                       <td width="33%" style="text-align: right; ">Syllabus</td>
                       </tr></table>
                       ');

                      $mpdf->Output();
                      
                       //$this->render('_attendance',array('rows'=>$rows,));

                }
                else
                {

        		$this->render('syllabus_print',array(
                		'model'=>$model,
                        ));
                }


	}

        public function actionGetSyllabusVersion()
        {
            echo 'test';
            
		if(isset($_REQUEST['programmeCode']))
		{
			
                        
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                    yii::app()->session['proCode']=$_REQUEST['programmeCode'];

                    $model = Syllabus::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']));
                    
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("-- no syllabus version found--"),true);
                    }
                    else    
                    {
                           $model=CHtml::listData($model,'syllabusCode','syllabusCode');
                           
                           
                           echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("-Please Select-"),true);
                           
                           foreach($model as $value=>$name)
                           {
                               echo CHtml::tag('option',
                                          array('value'=>$value),CHtml::encode($name),true);
                           }

                    }
                }
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
           
		$model=new Syllabus;

                $model->programmeCode = yii::app()->session['programmeCode'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Syllabus']))
		{
			$model->attributes=$_REQUEST['Syllabus'];
                        $model->syl_endTerm=$_REQUEST['Syllabus']['syl_endTerm'];
                        $model->syl_startTerm=$_REQUEST['Syllabus']['syl_startTerm'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->syllabusCode));
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

		if(isset($_POST['Syllabus']))
		{
			$model->attributes=$_REQUEST['Syllabus'];
                        $model->syl_startTerm=$_REQUEST['Syllabus']['syl_startTerm'];
                        $model->syl_endTerm=$_REQUEST['Syllabus']['syl_endTerm'];
			if($model->update())
				$this->redirect(array('view','id'=>$model->syllabusCode));
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
	
	public function actionIndex($id=NULL)
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
            
            
		$model=new Syllabus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Syllabus']))
			$model->attributes=$_GET['Syllabus'];

		$this->render('index',array(
			'model'=>$model,'id'=>$id
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Syllabus the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Syllabus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Syllabus $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='syllabus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
