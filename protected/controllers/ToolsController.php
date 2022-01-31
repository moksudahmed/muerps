<?php

class ToolsController extends Controller
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
             if(yii::app()->user->getState('role')==='super-admin')
            {
            	return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','CopySyallabus','lockedCourses','getCourse','getBatch','deleteModuleRegistration','StudentModuleRegistration','activeDeactive','deleteTermAdmission','removeTermAdmission','viewTerm','deleteEmployeeRecord','userAuthStatus','Editable','UserActivation','ResetPassword','AuditTable','vue'),
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
	
	public function actionIndex()
	{
            $this->render('index');
	}
        public function actionVue()
	{
            $this->render('vue');
	}
        
        public function actionCopySyallabus(){
            if(isset($_POST['old_syllabus']) && isset($_POST['new_syllabus']))
            {
                $old = $_POST['old_syllabus'];
                $new = $_POST['new_syllabus'];            
            
            
            $sql=" SELECT sp_cppy_syllabus_modules ('{$old}','{$new}'); ";  
            if(Yii::app()->db->createCommand($sql)->execute())
             {   
                      Yii::app()->user->setFlash('success',' Syllabus coppied Successful!');
                      $this->redirect(array('tools/index'));
              }
              else
              {
                        Yii::app()->user->setFlash('warning',' Copy Failed!');
                        $this->redirect(array('tools/index'));
              }
            }
        }
        
        
        
        
         public function actionDeleteEmployeeRecord($id)
        {
             //echo 'Bismillah Hir Rahmanir Rahim';
            if(isset($id)){
                 
                 $sql = "DELETE FROM tbl_y_user WHERE \"personID\" = '{$id}'";               
                 //echo $sql; exit();
                 try {
                                Yii::app()->db->createCommand($sql)->execute();
                     } catch (Exception $ex) {
                                Yii::app()->user->setFlash('warning',$ex->getMessage());
                     }
            }
             $this->redirect(array('tools/userAuthStatus'));
        }
        public function actionGetBatch()
        {
        //  echo $_REQUEST['programmeCode']; exit();
		if(isset($_REQUEST['programmeCode']))
		{
                    
                    
                        $sql= "
                        SELECT DISTINCT
                          o.\"batchName\"
                        FROM 
                          public.tbl_h_offeredmodule o
                        WHERE 
                          o.\"programmeCode\" = :proCode  AND 
                          o.ofm_term = :resultTerm AND 
                          o.ofm_year = :resultYear  
                       ORDER BY o.\"batchName\"";    

                         $model = Offeredmodule::model()->findAllBySql($sql,array(':proCode'=>$_REQUEST['programmeCode'],'resultTerm:'=>$_REQUEST['resultTerm'], 'resultYear:'=>$_REQUEST['resultYear']));
                    
               
                    }
                        
                        foreach($model as $item)
                        {
                            
                         //   $termYear=" [ ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year."]";
                            //echo "<optgroup label='{$termYear}'>";
                            $batchName=$item->batchName;//.FormUtil::getBatchNameSufix($item->batchName);
                         
                                echo CHtml::tag('option',array('value'=>$item->batchName),CHtml::encode($batchName),true);
                            //echo"</optgroup>";
                        }

         
                
        }
         
        public function actionGetGroup()
        {
         //   echo CHtml::tag('option',array('value'=>'test'),CHtml::encode('test'),true);
//                echo "test";
          
		if(isset($_REQUEST['programmeCode']))
		{
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                   $sql="SELECT 
                    distinct
                    e.\"moduleCode\", e.mod_name

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
                    //$model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']),'ex_bat_active=true');
                 
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No module Found--"),true);
                    }
                    else    
                    {
                  
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-All-"),true);
                   
                        foreach($model as $item)
                        {
           
                            echo CHtml::tag('option',array('value'=>$item->moduleCode),CHtml::encode($item->moduleCode),true);
                           
                        }

                     } 
                }
               
        }
        public function actionRemoveTermAdmission()
        {
          
            $options = new TermAdmission();              
            if(isset($_REQUEST['studentID'])){
                $msg = "";
                yii::app()->session['studentID']=$_REQUEST['studentID'];             
                $dataProvider = $options->searchTermAdmissionByID(yii::app()->session['studentID']);
                //$dataProvider = $options->getTermAdmissionList(yii::app()->session['studentID']);
               // echo var_dump($dataProvider);exit();
                $this->render('termAdmissionList',array('dataProvider'=>$dataProvider,'msg'=>$msg));
              // $this->render('termAdmissionList',array('dataProvider'=>$dataProvider));
   
            }
            else{
                 
                $msg = "Sucessfully deleted term admission";
                $dataProvider = $options->searchTermAdmissionByID(yii::app()->session['studentID']);
                //$dataProvider = $options->getTermAdmissionList(yii::app()->session['studentID']);
               // echo var_dump($dataProvider);exit();
                $this->render('termAdmissionList',array('dataProvider'=>$dataProvider,'msg'=>$msg));
              // $this->render('termAdmissionList',array('dataProvider'=>$dataProvider));
   
            }
        }
        
        
       
        public function actionDeleteTermAdmission()
        {
            if(isset($_REQUEST['tID'])){
               $sql =" DELETE FROM tbl_s_moduleregistration
                        WHERE \"termAdmissionID\"='{$_REQUEST['tID']}'";
               Yii::app()->db->createCommand($sql)->execute();
               
                $sql ="DELETE FROM tbl_q_termadmission
                        WHERE \"termAdmissionID\"='{$_REQUEST['tID']}'";
                Yii::app()->db->createCommand($sql)->execute();                             
                 
            }
             $this->redirect(array('tools/removeTermAdmission'));
        }
        
        public function actionViewTerm(){
            if(isset($_REQUEST['tID']))
            {
                     
               $options = new Options();               
            
               $dataProvider = $options->getTermAdmissionDetailList($_REQUEST['tID']);
               $this->render('viewTermDetails',array('dataProvider'=>$dataProvider));
              
            }
            
            
            
        }
        public static function actionStudentModuleRegistration(){
            
            
             if(isset($_POST['grid']))
             {  
                 foreach ($_POST['grid'] as $grid)
                        { 
                          
                           $sql = "DELETE FROM tbl_s_moduleregistration WHERE \"moduleRegistrationID\"={$grid};";
                           Yii::app()->db->createCommand($sql)->execute();
                                    
                        }
             }
           
           die();
          //  $dataProvider = Options::getModuleRegistrationList(yii::app()->session['proCode'],yii::app()->session['rTerm'], yii::app()->session['rYear'],yii::app()->session['batch'],yii::app()->session['mCode']);

           // $this->render('moduleRegistrationList',array('dataProvider'=>$dataProvider));
         //   $this->redirect(array('deleteModuleRegistration','dataProvider'=>$dataProvider));
           
    }
        
        public function actionDeleteModuleRegistration($dataProvider=null){
            if(isset($_REQUEST['programmeCode']))
		{
                                
                     yii::app()->session['proCode']=$_REQUEST['programmeCode'];
                     yii::app()->session['rTerm']=$_REQUEST['resultTerm'];
                     yii::app()->session['rYear']=$_REQUEST['resultYear'];
                     yii::app()->session['batch']=$_REQUEST['batchName2'];
                     yii::app()->session['mCode']=$_REQUEST['moduleCode'];
                     
                     
                    $dataProvider = Options::getModuleRegistrationList($_REQUEST['programmeCode'],$_REQUEST['resultTerm'],$_REQUEST['resultYear'],$_REQUEST['batchName2'],$_REQUEST['moduleCode']);

                    $this->render('moduleRegistrationList',array('dataProvider'=>$dataProvider));


                }
               /* if($dataProvider!=null)
                {
                    $this->render('moduleRegistrationList',array('dataProvider'=>$dataProvider));
                }*/
            
        }
        public function actionLockedCourses(){
            if(isset($_POST['rpTerm']) && isset($_POST['rpYear']))
            {
                $term = $_POST['rpTerm'];
                $year = $_POST['rpYear'];   
                if(isset($_POST['programmeCode']))
                {
                     $programmeCode =$_POST['programmeCode'];
                     $sql = "UPDATE tbl_h_offeredmodule
                       SET ofm_publish=true, ofm_approval=true
                       WHERE \"programmeCode\" = '{$programmeCode}' AND ofm_year = '{$year}' AND ofm_term='{$term}'";
                    
                }
                else{
                $sql = "UPDATE tbl_h_offeredmodule
                       SET ofm_publish=true, ofm_approval=true
                       WHERE ofm_year = '{$year}' AND ofm_term='{$term}'";

                }
            if(Yii::app()->db->createCommand($sql)->execute())
             {   
                      Yii::app()->user->setFlash('success',' Successful!');
                      $this->redirect(array('tools/index'));
              }
              else
              {
                        Yii::app()->user->setFlash('warning',' Failed!');
                        $this->redirect(array('tools/index'));
              }
            }
        }

        
        public function actionUserAuthStatus(){
            
            if(isset($_POST['userType']))
            {
                yii::app()->session['usrType'] = $_POST['userType'];
                yii::app()->session['usrDptID'] = $_POST['departmentID'];
            }
            
            if(isset(yii::app()->session['usrType']))            
            {
                    
                 $user = new User();
                 
                 $dataProvider = $user->search6( yii::app()->session['usrDptID'], yii::app()->session['usrType']); 
                 
                 
                 $this->render('userAuthStatus',array('dataProvider'=>$dataProvider,'userType'=>yii::app()->session['usrType']));         
            }   
            
                 
                         
        }
        
        public function actionAuditTable(){ 
                echo $_POST['table'];exit();
          
            if(isset($_POST['fromDate']) && $_POST['toDate'] && $_POST['table']){
                $sql = "SELECT 
                l.event_id,  
                l.relid, 
                l.session_user_name, 
                l.action_tstamp_tx, 
                l.action_tstamp_stm, 
                l.action_tstamp_clk, 
                l.client_addr, 
                l.client_port, 
                l.action, 
                l.row_data, 
                l.changed_fields
              FROM 
                audit.logged_actions l
              WHERE 
                l.table_name = '{$_POST['table']}' AND 
                l.schema_name = 'public' AND
                action_tstamp_tx between '{$_POST['fromDate']}' and '{$_POST['toDate']}'";
              
              echo $sql;exit();
                $auditData = Yii::app()->db->createCommand($sql)->queryAll();
                echo  $auditData ; exit();
            }

        }
        
        
        public function actionResetPassword($id)
        {
            $rand = rand(100000, 999999);
            
            $token = CPasswordHelper::hashPassword($rand, 15); // a random 6 digit number
            $expTime = time()+3600*24;
            
            
            $sql="select * from sp_user_authentication('{$id}');";
                // echo $this->username;exit();

            $record=User::model()->findBySql($sql);
            
           
            
           $to=$record->u_email;
           //echo $to; exit();
           $link = "http://77.68.120.8:8086/index.php?r=site/changePasswordToken&loginID={$id}&token={$token}";
           
            
          //-------------------------------------for lacal machine ---------------  
            //$to='fahmed@metrouni.edu.bd'; 
           // $link = "http://localhost/index.php?r=site/changePasswordToken&loginID={$id}&token={$token}";
            
           //------------------- 
            
            $from='noreply@metrouni.edu.bd';
            
            $fromName='MUERP';
            $subject='Password reset link for MuErp';
            $message ="<div> Dear Sir/Madam,"
                    ."<p>Please "
                    ."<a href='{$link}'>click</a> the link to reset your password within 24 hours."
                    ."The link will expire after 24 hours.</p>"
                    ."<p>Thank You<p/>"
                    ."<p>Administrator <br/>,MUERP</p>"
                    ."</div>";
            
          //  $user = User::model()->findByPk($record->uPersonID);
            
            if(User::model()->updateByPk($record->uPersonID,array('usr_resetToken'=>$token,'usr_resetTokenExpire'=>$expTime,'usr_password'=>null)))
            {
                if($msg = FormUtil::sendMail($to, $from,$fromName, $subject, $message))
                {
                    ($msg==true? Yii::app()->user->setFlash('success','Password reset successfull for '.$id):Yii::app()->user->setFlash('warning',$msg));
                }
                
            }
            else
                {
                    Yii::app()->user->setFlash('warning','Password reset Fail !');
                }
            
            $this->redirect(array('tools/userAuthStatus'));
            
            
        }
        
        public function actionUserActivation($id,$loginID,$status)
        {
           
             if(isset($id)){
                 if($status == true)
                 {
                        if(User::model()->updateByPk($id,array('usr_active'=>false)))
                        {
                            $sql = "DROP ROLE \"{$loginID}\";";                                    
                            
                            try {
                                Yii::app()->db->createCommand($sql)->execute();
                            } catch (Exception $ex) {
                                Yii::app()->user->setFlash('warning',$ex->getMessage());
                            }
                            
                            
                            Yii::app()->user->setFlash('success',$loginID.' Deactivated ');
                                                      
                        }
                        else
                        {
                            Yii::app()->user->setFlash('warning',' Deactivation Failed !');
                        }               
                 
                 }
                 else
                 {
                     
                        if(isset(yii::app()->session['usrType']))
                        {
                            if(yii::app()->session['usrType']==1)
                            {
                                //$role = 'faculty';
                                $usr = User::model()->findByPk($id);
                                $role = $usr->usr_role;
                                $sql2 = "GRANT {$role} TO \"{$loginID}\";";
                            }
                            else 
                            {
                                $usr = User::model()->findByPk($id);
                                $role = $usr->usr_role;
                                $sql2= "GRANT  {$role} TO \"{$loginID}\";";
                            }
                        }
                     
                        if(User::model()->updateByPk($id,array('usr_active'=>true,'usr_role'=>$role)))
                        {
                           
                           
                            $sql = "CREATE ROLE \"{$loginID}\" LOGIN
                                    ENCRYPTED PASSWORD 'success8085.com'
                                    NOSUPERUSER INHERIT NOCREATEDB NOCREATEROLE NOREPLICATION;";
                            
                            
                           
                            
                                   
                            try {
                                Yii::app()->db->createCommand($sql)->execute();
                                Yii::app()->db->createCommand($sql2)->execute(); 
                            } catch (Exception $ex) {
                                Yii::app()->user->setFlash('warning',$ex->getMessage());
                            }
                            Yii::app()->user->setFlash('success',$loginID.' Activated ');
                            
                        }
                        else
                        {
                            Yii::app()->user->setFlash('warning','Activation Fail !');
                        }
                        
                 }
                 
                 
                 
            }
             $this->redirect(array('tools/userAuthStatus'));
            
        }
        
       
        
        public function actionEditable($id)
	{   
            //echo "test";
		
		Yii::import('bootstrap.widgets.TbEditableSaver');
                $es = new TbEditableSaver('User');
                $es->update();
                
                
	}
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id )
	{
		$admission=  Admission::model()->findByPk($id);
		if($admission===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $admission;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
            
	//	if(isset($_REQUEST['ajax']) && $_REQUEST['ajax']==='admission-form')
	//	{
                   // echo "Bismillah Hir Rahmanur Rahim";
			echo CActiveForm::validate($model);
			Yii::app()->end();
	//	}
	}
}

                