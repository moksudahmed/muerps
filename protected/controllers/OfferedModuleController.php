<?php

class OfferedModuleController extends Controller
{
	
	// Uncomment the following methods and override them if needed
	//public $layout='//layouts/column2';
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
            if(yii::app()->user->getState('role')==='super-admin')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','selectModuleAllSection'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','offeredAllSection','notOfferedAllSection','offeredCourseList','offeredCourseListXLS','AllOfferedXLS'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            
            elseif(yii::app()->user->getState('role')==='head')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','selectModuleAllSection','offeredCourseList','offeredCourseListXLS','AllOfferedXLS'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','offeredAllSection','notOfferedAllSection'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif(yii::app()->user->getState('role')==='coordinator')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','selectModuleAllSection','offeredCourseList','offeredCourseListXLS','AllOfferedXLS'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','offeredAllSection','notOfferedAllSection'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif(yii::app()->user->getState('role')==='faculty')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','OfferedCourseListXLS'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','offeredCourseList'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif(yii::app()->user->getState('role')==='exam')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','selectModuleAllSection'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','offeredAllSection','notOfferedAllSection','offeredCourseList','offeredCourseListXLS','AllOfferedXLS'),
				'users'=>array(yii::app()->user->id),
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
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','selectModuleAllSection','offeredCourseList','offeredCourseListXLS','AllOfferedXLS'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','offeredAllSection','notOfferedAllSection'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            else
            {
                return array(
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
                
	}

        public function actionAllOffered($sid=null,$bid=null,$pid=null)
        {
            $flag=true;
            if($sid && $bid && $pid)
            {   
                $flag=false;
                yii::app()->session['secNameOfm']=$sid;
                yii::app()->session['batNameOfm']=$bid;
                yii::app()->session['proCodeOfm']=$pid;
            }
            else
            {
                $sid = yii::app()->session['secNameOfm'];
                $bid = yii::app()->session['batNameOfm'];
                $pid = yii::app()->session['proCodeOfm'];
            }
            
            $model = new OfferedModule('search');
            
            //$dataProvider = $model->search3($sid,$bid,$pid);
                
            $this->render('AllOffered',array('model'=>$model,'sid'=>$sid,'bid'=>$bid,'pid'=>$pid,'flag'=>$flag));
            
	}
        
        public function actionAllOfferedXLS()
        {
                $sid = yii::app()->session['secNameOfm'];
                $bid = yii::app()->session['batNameOfm'];
                $pid = yii::app()->session['proCodeOfm'];
            
            
            $model = new OfferedModule('search');
            
            $dataProvider = $model->search3($sid,$bid,$pid);
           Yii::app()->request->sendFile('offered_to_batch_'.$bid = yii::app()->session['batNameOfm'].$bid = yii::app()->session['secNameOfm'].'_'.date('dmY').'.xls',     
            $this->renderPartial('_AllOfferedXLS',array('dataProvider'=>$dataProvider),true)
           ); 
	}
        
        public function actionOfferedModule()
	{
             if(isset($_REQUEST['ofmType']))
                yii::app()->session['ofmType']=$_REQUEST['ofmType'];
             
             
            if(isset($_REQUEST['ofmTermYear']))
            {
                $split = array();
                $split= explode('-', $_REQUEST['ofmTermYear']);
     
               
                
                yii::app()->session['batTermOfm'] = $split[0];
                yii::app()->session['batYearOfm'] = $split[1];
            }
            
            $model = new OfferedModule('search');
             
            if(OfferedModule::model()->findAllByAttributes(array('programmeCode'=>yii::app()->session['proCodeOfm'],'batchName'=>yii::app()->session['batNameOfm'],'sectionName'=>yii::app()->session['secNameOfm'],'ofm_term'=>yii::app()->session['batTermOfm'],'ofm_year'=>yii::app()->session['batYearOfm'])))
            {     
                if(yii::app()->session['ofmType']==1)
                { 
                $dataProvider = $model->search2( yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['secNameOfm'],yii::app()->session['batTermOfm'],yii::app()->session['batYearOfm']);
                
		$this->render('Offered',array('dataProvider'=>$dataProvider));
                }
                else{ 
                    $dataProvider = $model->search4( yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['batTermOfm'],yii::app()->session['batYearOfm']);
                
		$this->render('OfferedAllSection',array('dataProvider'=>$dataProvider));
                }
            }
            else
            {
                
                
                
                if(yii::app()->session['ofmType']==1)
                {
                    $dataProvider = $model->search(Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']))->syllabusCode,yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['secNameOfm']);
                    $this->render('NotOffered',array('dataProvider'=>$dataProvider));
                }
                else
                {   $dataProvider = $model->search5(Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']))->syllabusCode,yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm']);
                    $this->render('NotOfferedAllSection',array('dataProvider'=>$dataProvider));
                }    
            }
	}
        
        public function actionOffered()
	{
            
                $model = new OfferedModule('search');
             
                $dataProvider = $model->search2( yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['secNameOfm'],yii::app()->session['batTermOfm'],yii::app()->session['batYearOfm']);
                
		$this->render('Offered',array('dataProvider'=>$dataProvider));
            
	}

        public function actionOfferedAllSection()
	{
            
                $model = new OfferedModule('search');
             
                $dataProvider = $model->search4( yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['batTermOfm'],yii::app()->session['batYearOfm']);
                
		$this->render('OfferedAllSection',array('dataProvider'=>$dataProvider));
            
	}
        
        
        public function actionEditable($id)
	{   
            //echo "test";
		
		Yii::import('bootstrap.widgets.TbEditableSaver');
                $es = new TbEditableSaver('OfferedModule');
                $es->update();
	}
        
        public function actionEditableTwo($id)
	{   
            //echo "test";
		
		Yii::import('bootstrap.widgets.TbEditableSaver');
                $es = new TbEditableSaver('OfferedModule');
                $es->update();
	}
        
        public function actionEditableThree($id)
	{   
            //echo "test";
		
		Yii::import('bootstrap.widgets.TbEditableSaver');
                $es = new TbEditableSaver('OfferedModule');
                $es->update();
	}
        
        public function actionSetTeacher()
	{
            
            
            $model = new Module('search');
             
                 
            
                //$dataProvider = $model->search2( yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['secNameOfm'],yii::app()->session['batTermOfm'],yii::app()->session['batYearOfm']);
                $dataProvider= $model->search('CSE-V2');
		$this->render('setTeacher',array('dataProvider'=>$dataProvider));
            
	}

        public function actionNotOffered()
	{
            
            
            $model = new OfferedModule('search');
             
                 
            
                $dataProvider = $model->search(Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']))->syllabusCode,yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['secNameOfm']);
                
                $this->render('NotOffered',array('dataProvider'=>$dataProvider));
            
	}
        
        public function actionNotOfferedAllSection()
	{
            
            
            $model = new OfferedModule('search');
             
                 
            
                $dataProvider = $model->search5(Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']))->syllabusCode,yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['secNameOfm']);
                
                $this->render('NotOfferedAllSection',array('dataProvider'=>$dataProvider));
            
	}
        
        public function actionIndex()
	{
            unset(yii::app()->session['ofmPassword']);
                $this->render('index');
	}
        
        public function actionSelectModule()
	{
                //echo "Bismillah Hir Rahmanir Rahim. ";
                //print_r($_POST);
                //echo isset($_POST['offered']);
                //exit();
                //if(yii::app()->getRequest('offered'))
                //echo $_REQUEST['ajax'];
                $flag=FALSE; $i=0;
                if(isset($_POST['offered']))
                {
                       
                    foreach ($_POST['offered'] as $item)
                    {
                        if($item!=1)
                        {
                            $model = new OfferedModule();

                            $model->programmeCode = yii::app()->session['proCodeOfm'];
                            $model->batchName = yii::app()->session['batNameOfm'];
                            $model->sectionName= yii::app()->session['secNameOfm'];
                            $model->syllabusCode = Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']))->syllabusCode;
                            $model->ofm_term = yii::app()->session['batTermOfm'];
                            $model->ofm_year = yii::app()->session['batYearOfm'];

                            $model->moduleCode = $item;
                          // echo $model->moduleCode;


                                if($model->save())
                                {
                                     $flag=true;$i++;
                                }


                           //$model->moduleCode= NULL;
                        }
                        
                    }
                    
                }
     
                if($flag==true){
                    Yii::app()->user->setFlash('success',$i.' Modules Has Been Offered Successfully !!!');
                   
                unset($_POST['offered']);    
                }
                
                $model = new OfferedModule('search');
             
                 
            
                $dataProvider = $model->search(Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']))->syllabusCode,yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['secNameOfm']);
                
                $this->renderPartial('_NotOffered',array('dataProvider'=>$dataProvider));
                
	}

        public function actionSelectModuleAllSection()
	{
               // echo "Bismillah Hir Rahmanir Rahim. ";
                //print_r($_POST);
                
                //if(yii::app()->getRequest('offered'))
                //echo $_REQUEST['ajax'];
                $flag=FALSE; $i=0;
                if(isset($_POST['offered']))
                {
                       
                    foreach ($_POST['offered'] as $item)
                    {
                        if($item!=1)
                        {
                            $sec = Section::model()->findAllByAttributes(array('programmeCode'=>yii::app()->session['proCodeOfm'],'batchName'=>yii::app()->session['batNameOfm']));

                            foreach ($sec as $item2)
                            {

                            $model = new OfferedModule();

                            $model->programmeCode = yii::app()->session['proCodeOfm'];
                            $model->batchName = yii::app()->session['batNameOfm'];
                            $model->sectionName= $item2->sectionName;
                            $model->syllabusCode = Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']))->syllabusCode;
                            $model->ofm_term = yii::app()->session['batTermOfm'];
                            $model->ofm_year = yii::app()->session['batYearOfm'];

                            $model->moduleCode = $item;
                          // echo $model->moduleCode;


                                if($model->save())
                                {
                                     $flag=true;
                                }
                            }
                                $i++;
                           //$model->moduleCode= NULL;


                        }
                    } 
                }
     
                if($flag==true){
                    Yii::app()->user->setFlash('success',$i.' Modules Has Been Offered Successfully !!!');
                   
                unset($_POST['offered']);    
                }
                
                $model = new OfferedModule('search');
             
                 
            
                $dataProvider = $model->search(Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']))->syllabusCode,yii::app()->session['proCodeOfm'],yii::app()->session['batNameOfm'],yii::app()->session['secNameOfm']);
                
                $this->renderPartial('_NotOffered',array('dataProvider'=>$dataProvider));
                
	}
        
        
        public function actionDelete($offeredModuleID)
	{
		$this->loadModel($offeredModuleID)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('offered'));
	}
        
        
        public function actionGetSection()
        {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if(isset($_REQUEST['programmeCode']))
		{
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                    $model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']));
                 
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No Section Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                        
                        //$model=CHtml::listData($model,'batchName','batchName');
                        
                        foreach($model as $item)
                        {
                            $batchName="---".$item->batchName.FormUtil::getBatchNameSufix($item->batchName)." Batch---";
                            echo "<optgroup label='{$batchName}'>";
                            foreach(Section::model()->findAllByAttributes(array('batchName'=>$item->batchName,'programmeCode'=>$item->programmeCode)) as $item2)
                            {
                                $sectionName="Section ".$item2->batchName.FormUtil::getBatchNameSufix($item2->batchName)." ".$item2->sectionName."    -- ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year." --";
                                echo CHtml::tag('option',array('value'=>$item2->batchName."-".$item2->sectionName),CHtml::encode($sectionName),true);
                            }
                            echo"</optgroup>";
                            
                        
                            
                        }

                    }  
                   
                }
                
                
        }
       
        
        public function actionGetTerm()
        {
            
              //  echo "test".$_REQUEST['programmeCode']." ".$_REQUEST['batchName'];
		
                
                   //echo      substr($_REQUEST['batchName'], '-',-2);
                     //   echo substr($_REQUEST['batchName'], -1);
                        
                        
                    
                
                if(isset($_REQUEST['programmeCode']))
		{
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                    yii::app()->session['proCodeOfm']=$_REQUEST['programmeCode'];
                    yii::app()->session['batNameOfm']=substr($_REQUEST['batchName'], '-',-2);
                    yii::app()->session['secNameOfm']=substr($_REQUEST['batchName'], -1);
                    
                   
                    $model =  Batch::model()->findByPk(array('programmeCode'=>$_REQUEST['programmeCode'],'batchName'=>substr($_REQUEST['batchName'], '-',-2)));
                   
                    
                    
                    if(!$model)
                    {
                        echo CHtml::tag('span',array('style'=>'color:red;'),CHtml::encode("-- no batch found--"),true);
                        
                    }
                    else    
                    {
                           
                          if( $model->bat_term==1 )
                          {
                              echo CHtml::tag('option',array('style'=>'color:red;'),CHtml::encode("-- Please Select --"),true);
                              
                              for($i=$model->bat_year;$i<$model->bat_year+4;$i++)
                              {
                                  echo "<optgroup label='-- Year {$i} --'>";
                                  
                                  for($j=1;$j<4;$j++)
                                  {
                                      
                                      //$style=($i==$model->bat_year && $j==$model->bat_term?'font-width:bold':'font-width:normal');
                                      $class=(OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode'],'batchName'=>substr($_REQUEST['batchName'], '-',-2),'sectionName'=>substr($_REQUEST['batchName'], -1),'ofm_term'=>$j,'ofm_year'=>$i))?'ofm-red':'ofm-green');
                                      echo "<option value='{$i}-{$j}' class='{$class}'>".FormUtil::getTerm($j)."</option>";
                                      
                                      
                                  }
                                  
                                  echo "</optgroup>";
                              }
                              
                          }
                          else
                          {
                              
                              echo CHtml::tag('option',array('style'=>'color:red;'),CHtml::encode("-- Please Select --"),true);
                     
                              for($i=$model->bat_year;$i<$model->bat_year+5;$i++)
                              {
                                  echo "<optgroup label='-- Year {$i} --'>";
                                  
                                  if($i==$model->bat_year)
                                  {
                                        for($j=$model->bat_term;$j<4;$j++)
                                        {
                                            //$style=($i==$model->bat_year && $j==$model->bat_term?'font-width:bold':'font-width:normal');
                                           $class=(OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode'],'batchName'=>substr($_REQUEST['batchName'], '-',-2),'sectionName'=>substr($_REQUEST['batchName'], -1),'ofm_term'=>$j,'ofm_year'=>$i))?'ofm-red':'ofm-green');
                                            echo "<option value='{$i}-{$j}' class='{$class}'>".FormUtil::getTerm($j)."</option>";


                                        }
                                  }
                                  elseif($i==$model->bat_year+4)
                                  {
                                      
                                      for($j=1;$j<$model->bat_term;$j++)
                                        {
                                            $class=(OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode'],'batchName'=>substr($_REQUEST['batchName'], '-',-2),'sectionName'=>substr($_REQUEST['batchName'], -1),'ofm_term'=>$j,'ofm_year'=>$i))?'ofm-red':'ofm-green');
                                            echo "<option value='{$i}-{$j}' class='{$class}'>".FormUtil::getTerm($j)."</option>";


                                        }
                                      
                                  }
                                  else
                                  {
                                      for($j=1;$j<4;$j++)
                                        {
                                            $class=(OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode'],'batchName'=>substr($_REQUEST['batchName'], '-',-2),'sectionName'=>substr($_REQUEST['batchName'], -1),'ofm_term'=>$j,'ofm_year'=>$i))?'ofm-red':'ofm-green');
                                            echo "<option value='{$i}-{$j}' class='{$class}'>".FormUtil::getTerm($j)."</option>";


                                        }
                                      
                                  }
                                  
                                  echo "</optgroup>";
                              }
                              
                          }
                          

                    }
                }
        }
        
        
        
        
        
        public function actionTermButton()
        {
            yii::app()->session['batTermOfm'] = substr($_REQUEST['batchTerm'], -1);
            yii::app()->session['batYearOfm'] = substr($_REQUEST['batchTerm'], '-',-2);
          
            $data=FormUtil::getTerm(substr($_REQUEST['batchTerm'], -1))." ".substr($_REQUEST['batchTerm'], '-',-2);
            
            $this->renderPartial('_form_1',array('data'=>$data),false,true);
            //echo CHtml::submitButton(FormUtil::getTerm(substr($_REQUEST['batchTerm'], -1))." ".substr($_REQUEST['batchTerm'], '-',-2), array('class' => 'btn btn-primary btn-large'));
           
        }
        
        public function actionSelectTerm()
        {
                $password = UserIdentity::$checkIdentity;
                //echo $password['115']['offeredModule'];
                if(isset($_REQUEST['password']))
                {   
                    $split = array();
                    $split = explode('-', $_REQUEST['batchName']);
                    
                    yii::app()->session['proCodeOfm']=$_REQUEST['programmeCode'];
                    
                    yii::app()->session['batNameOfm']=$split[0];
                    yii::app()->session['secNameOfm']=$split[1];
            
                    $batch = Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']));
                    
                    yii::app()->session['acTermOfm']=$batch->bat_term;
                    
                    
                    yii::app()->session['acYearOfm']=$batch->bat_year;
                     
                     
                    yii::app()->session['ofmPassword']=$_REQUEST['password'];
                }
                
                if(isset(yii::app()->session['ofmPassword']) && $password[yii::app()->session['proCodeOfm']]['offeredModule']===yii::app()->session['ofmPassword'])
		{
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                   
                    
                   
                    $model =  Batch::model()->findByPk(array('programmeCode'=>yii::app()->session['proCodeOfm'],'batchName'=>yii::app()->session['batNameOfm']));
        
                    $this->render('selectTerm',array('model'=>$model));
                }
                else
                {
                    Yii::app()->user->setFlash('warning',' Password Does Not Match !!!');
                   $this->redirect(array('index'));
                }
                
                
        }
 
        public function actionAuthOfferedModule()
        {
            if(isset($_REQUEST['password']))
            {
                
            }
            else
            {
                $this->renderPartial('_authOfferedModule');
            }
        }

        
      
        
        public function actionMarksEntryProCode()
        {
            $data=  ExamRegistration::searchTermAdmittedProgrammeCode($_REQUEST['mreTerm'],$_REQUEST['mreYear']);
       
            $exam = Examination::model()->findByAttributes(array('exm_type'=>$_REQUEST['mreExamType'],'exm_examTerm'=>$_REQUEST['mreTerm'],'exm_examYear'=>$_REQUEST['mreYear']));
            if($exam)
            {
                yii::app()->session['mreExaminationID']=$exam->examinationID;
                yii::app()->session['mreExamType']=$_REQUEST['mreExamType'];
                if(count($data)>0)
                {
                    $this->renderPartial('_formMarksEntryProCode', array('data'=>$data),false,true);    
                }
                else{
                    $_REQUEST['mreYear']=0;
                    Yii::app()->user->setFlash('warning',' No Admitted Student Found For Selected Examination!!! Please Re-Select The Year Dropdown List.');
                    $this->renderPartial('_warning');    

                }
            }
            else
            {
            
                    Yii::app()->user->setFlash('warning',' No Examination Found !!! Please create selected Examination First.');
                    $this->renderPartial('_warning');    

            }
        }
 
        public function actionOfferedCourseList()
        {

               if(isset($_POST['programmeCode']))
                {
                    yii::app()->session['ofmLiProCode']=$_POST['programmeCode'];
                    yii::app()->session['ofmLiTerm']=$_POST['ofmLiTerm'];
                    yii::app()->session['ofmLiYear']=$_POST['ofmLiYear'];
                }     
               
		                 
                //$dataProvider = $model->searchSubjectForResultPublish(yii::app()->session['rePublishProCode'],yii::app()->session['rePublishTerm'],yii::app()->session['rePublishYear']);
                $dataProvider = Offeredmodule::model()->search6(yii::app()->session['ofmLiProCode'],yii::app()->session['ofmLiTerm'],yii::app()->session['ofmLiYear']);
                $this->render('offeredCourseList',array('dataProvider'=>$dataProvider));
         
        }
        
        public function actionOfferedCourseListXLS()
        {

                $model = new Examination();
                
                $dataProvider = Offeredmodule::model()->search6(yii::app()->session['ofmLiProCode'],yii::app()->session['ofmLiTerm'],yii::app()->session['ofmLiYear']);
                Yii::app()->request->sendFile(date('OfferedModuleList').'.xls',$this->renderPartial('_offeredCourseListXLS',array('dataProvider'=>$dataProvider), true) );
         
        }
        
        
        public function loadModel($offeredModuleID)
	{
		$model=  OfferedModule::model()->findByPk($offeredModuleID);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}