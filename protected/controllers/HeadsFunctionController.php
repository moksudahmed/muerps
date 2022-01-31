<?php

class HeadsFunctionController extends Controller
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
				'actions'=>array('index','create','getSection','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','ResultSummary'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','selectTerm','GetSection','getModule','marksEntryProCode','getRegisteredModule','getBatch','GetRegModuleMarksList','SaveTotalMarks','reportTabulation','SaveGrandTotal','ResultSheet','GenerateFirstHalfPDF','GenerateGradeSheet','sectionTransfer','changeSection','RoutineManagement','timeSlotEditable','roomTest','CreateNewRoutine','getNewSection','getTerm','generate60PDF','IndividualCourseReg','courseAuthentication','UpdateApproval','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','OfferedModuleListXLS','regStudentToCourse','AssaignStudentToCourse','saveAssignStudentToCourse','GetRegisteredModuleForBatch','GetMarksListForBatch','GetRegisteredModuleForSpecialRetake','LockPreviousResults'),
				'users'=>array(Yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='admin')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getModule','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','OfferedModuleListXLS'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','selectTerm','getModule','marksEntryProCode','getRegisteredModule','getBatch','GetRegModuleMarksList','SaveTotalMarks','reportTabulation','SaveGrandTotal','ResultSheet','GenerateFirstHalfPDF','GenerateGradeSheet','sectionTransfer','changeSection','RoutineManagement','timeSlotEditable','roomTest','CreateNewRoutine','getNewSection','reTake','SaveRetake','DeleteRetake','Test','getTerm','generate60PDF','CreateTermAdmissionForRetake','IndividualCourseReg','courseAuthentication','UpdateApproval','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','regStudentToCourse','AssaignStudentToCourse','saveAssignStudentToCourse'),
				'users'=>array(Yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
        );
      
        
            }
            elseif (yii::app()->user->getState('role')==='exam')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getModule','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','OfferedModuleListXLS','courseAuthentication'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','selectTerm','getModule','marksEntryProCode','getRegisteredModule','getBatch','reportTabulation','SaveGrandTotal','ResultSheet','GenerateFirstHalfPDF','GenerateGradeSheet','sectionTransfer','changeSection','RoutineManagement','timeSlotEditable','roomTest','CreateNewRoutine','getNewSection','reTake','SaveRetake','DeleteRetake','Test','getTerm','generate60PDF','CreateTermAdmissionForRetake','IndividualCourseReg','UpdateApproval','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','regStudentToCourse','AssaignStudentToCourse','saveAssignStudentToCourse'),
				'users'=>array(Yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
        );
      
        
            }
            elseif (yii::app()->user->getState('role')==='head')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getModule','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','OfferedModuleListXLS','ResultSummary'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','selectTerm','getModule','getBatch','reportTabulation','SaveGrandTotal','ResultSheet','GenerateFirstHalfPDF','GenerateGradeSheet','sectionTransfer','changeSection','RoutineManagement','timeSlotEditable','roomTest','CreateNewRoutine','getNewSection','reTake','SaveRetake','DeleteRetake','Test','getTerm','generate60PDF','CreateTermAdmissionForRetake','IndividualCourseReg','courseAuthentication','UpdateApproval','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','regStudentToCourse','AssaignStudentToCourse','saveAssignStudentToCourse','GetRegisteredModuleForBatch','GetRegisteredModuleForSpecialRetake'),
				'users'=>array(Yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='coordinator')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getModule','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','OfferedModuleListXLS','regStudentToCourse','AssaignStudentToCourse','ResultSummary','GetRegisteredModuleForBatch'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','selectTerm','getModule','marksEntryProCode','getRegisteredModule','getBatch','GetRegModuleMarksList','SaveTotalMarks','reportTabulation','SaveGrandTotal','ResultSheet','GenerateFirstHalfPDF','GenerateGradeSheet','sectionTransfer','changeSection','RoutineManagement','timeSlotEditable','roomTest','CreateNewRoutine','getNewSection','reTake','SaveRetake','DeleteRetake','Test','getTerm','generate60PDF','CreateTermAdmissionForRetake','IndividualCourseReg','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','GetRegisteredModuleForSpecialRetake'),
				'users'=>array(Yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='registry')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','getSection','getModule','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','OfferedModuleListXLS','regStudentToCourse','AssaignStudentToCourse',),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','selectTerm','getModule','marksEntryProCode','getRegisteredModule','getBatch','GetRegModuleMarksList','SaveTotalMarks','reportTabulation','SaveGrandTotal','ResultSheet','GenerateFirstHalfPDF','GenerateGradeSheet','sectionTransfer','changeSection','RoutineManagement','timeSlotEditable','roomTest','CreateNewRoutine','getNewSection','reTake','SaveRetake','DeleteRetake','Test','getTerm','generate60PDF','CreateTermAdmissionForRetake','IndividualCourseReg','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF'),
				'users'=>array(Yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            
            elseif (yii::app()->user->getState('role')==='faculty')
            {
		return array(
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getSection','getModule'),
				'users'=>array('@'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('GetRegModuleMarksList','saveTotalMarks','GenerateFirstHalfPDF','Generate60PDF','resultSheet','GenerateGradeSheet','MarksEntryProCode','ResultSummary'),
				'users'=>array(Yii::app()->user->id),
			),
		
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='exam')
            {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(''),
				'users'=>array('*'),
			),
		
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
				'users'=>array(Yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
            elseif (yii::app()->user->getState('role')==='deo')
            {
                return array(
                    array('allow',  // allow all users to perform 'index' and 'view' actions
                        'actions'=>array('view','update'),
                        'users'=>array('*'),
                    ),
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array('index','create','getSection','getTerm','offeredModule','termButton','selectModule','AllOffered','SelectTerm','Offered','NotOffered','authOfferedModule','MarksEntryProCode','setTeacher','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','ResultSummary'),
                        'users'=>array('@'),
                    ),
                    array('allow', // allow admin user to perform 'admin' and 'delete' actions
                        'actions'=>array('admin','delete','editable','EditableTwo','EditableThree','selectTerm','GetSection','getModule','marksEntryProCode','getRegisteredModule','getBatch','GetRegModuleMarksList','SaveTotalMarks','reportTabulation','SaveGrandTotal','ResultSheet','GenerateFirstHalfPDF','GenerateGradeSheet','sectionTransfer','changeSection','RoutineManagement','timeSlotEditable','roomTest','CreateNewRoutine','getNewSection','getTerm','generate60PDF','IndividualCourseReg','courseAuthentication','UpdateApproval','SupplementaryList','SupplementaryListPDF','CourseTakenByFaculty','CourseTakenByFacultyPDF','OfferedModuleListXLS','regStudentToCourse','AssaignStudentToCourse','saveAssignStudentToCourse','GetRegisteredModuleForBatch','GetMarksListForBatch','GetRegisteredModuleForSpecialRetake','LockPreviousResults'),
                        'users'=>array(Yii::app()->user->id),
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
        
        
        public function actionIndex()
	{
            
              yii::app()->session['mreYear']=yii::app()->session['MainCurYear'];
                        yii::app()->session['mreTerm']=yii::app()->session['MainCurTerm'];
                        if(!Examination::model()->findByAttributes(array('exm_type'=>'1','exm_examTerm'=>yii::app()->session['mreTerm'],'exm_examYear'=>yii::app()->session['mreYear'])))
                        {
                            $term=yii::app()->session['mreTerm'];
                            $year=yii::app()->session['mreYear'];
                            $sql = "INSERT INTO tbl_t_examination(\"exm_examTerm\", \"exm_examYear\") values ({$term},{$year});";                           
                            Yii::app()->db->createCommand($sql)->execute();
                        }
                        yii::app()->session['mreExaminationID']= Examination::model()->findByAttributes(array('exm_type'=>1,'exm_examTerm'=>yii::app()->session['mreTerm'],'exm_examYear'=>yii::app()->session['mreYear']))->examinationID;
                //echo yii::app()->session['mreExaminationID'];
            
            
            $sql="SELECT 
                            * 
                          FROM 
                            {{e_module}} as e, 
                            {{h_offeredmodule}} as h
                          WHERE 
                            e.\"moduleCode\" = h.\"moduleCode\" AND
                            e.\"syllabusCode\" = h.\"syllabusCode\" AND
                            
                            h.ofm_term = :ofm_term AND 
                            h.ofm_year = :ofm_year AND
                            h.\"facultyID\"=:facultyID";
//echo yii::app()->session['MainFacultyID'];
//echo $sql; exit();
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':ofm_term'=>yii::app()->session['mreTerm'],':ofm_year'=>yii::app()->session['mreYear'],':facultyID'=>yii::app()->session['MainFacultyID']));
           
                    $data = Admission::searchAdmission();
                $this->render('index',array('ofmModule'=>$ofmModule,'data'=>$data));
                
                
	}
        
        public function actionSelectTerm()
        {
            if(isset($_REQUEST['programmeCode']))
            yii::app()->session['proCodeOfm']=$_REQUEST['programmeCode'];
                  
            
            
            
            /*
                  
                
              */       
                
                    
                   
      
        
                    $this->render('selectTerm');
                
                
                
        }

        
        public function actionRoutineManagement()
        {
                
                  
                    $split = array();
                    $split = explode('-', $_REQUEST['batchName3']);
                    
                    yii::app()->session['proCodeRtm']=$_REQUEST['programmeCode'];
                    
                    yii::app()->session['batNameRtm']=$split[0];
                    yii::app()->session['secNameRtm']=$split[1];
            
                    $batch = Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameRtm'],'programmeCode'=>yii::app()->session['proCodeRtm']));
                    
                    yii::app()->session['acTermRtm']=$batch->bat_term;
                    
                    
                    yii::app()->session['acYearRtm']=$batch->bat_year;
                     
                    $model = new OfferedModule('search');
             
                   // $dataProvider = $model->search2( yii::app()->session['proCodeRtm'],yii::app()->session['batNameRtm'],yii::app()->session['secNameRtm'],yii::app()->session['mainCurTerm'],yii::app()->session['mainCurYear']);
                    
                    $sql="SELECT 
                    concat(p.per_title,' ',  p.\"per_firstName\",' ', p.\"per_lastName\") as per_name,    
                    t.*, m.* FROM \"tbl_h_offeredmodule\" t 
                        JOIN tbl_e_module AS m ON m.\"moduleCode\" = t.\"moduleCode\" AND m.\"syllabusCode\"=t.\"syllabusCode\" 
                       left JOIN tbl_j_person AS p ON p.\"personID\" = t.\"facultyID\"
                        
                        WHERE t.\"programmeCode\"=:proCode and t.\"batchName\"=:batName  and t.ofm_term=:term and t.ofm_year=:year order by t.\"sectionName\" ";
                    
                    //echo $sql;
                   $data = OfferedModule::model()->findAllBySql($sql,array(':proCode'=>yii::app()->session['proCodeRtm'],':batName'=>yii::app()->session['batNameRtm'],':term'=>yii::app()->session['MainAdmTerm'],':year'=>yii::app()->session['MainAdmYear']));
                  // echo count($data);
                  // exit();
                    $this->render('RoutineManagement',array('model'=>$data));
                
                
                
        }
        
        public function actionGetTerm()
        {
            
                $split = array();
                
		if(isset($_REQUEST['batchName'])){
                
                    $split = explode('-', $_REQUEST['batchName']);
                    
                    
                    yii::app()->session['batNameOfm']= $split[0];
                    yii::app()->session['secNameOfm']= $split[1];
                }
                
                    $batch = Batch::model()->findByPk(array('batchName'=>yii::app()->session['batNameOfm'],'programmeCode'=>yii::app()->session['proCodeOfm']));
                    
                    yii::app()->session['acTermOfm']=$batch->bat_term;
                    
                    
                    yii::app()->session['acYearOfm']=$batch->bat_year;
                
                $this->renderPartial('_selectTerm');
        }
        
                
        public function actionGetModule()
        { 
           // echo "test";
            
            if(isset($_REQUEST['programmeCode'],$_REQUEST['sectionName']))
            {
                $split= array();
                $split= explode('-', $_REQUEST['sectionName']);
                
                        yii::app()->session['attYear']=yii::app()->session['MainCurYear'];
                        yii::app()->session['attTerm']=yii::app()->session['MainCurTerm'];
                        
                        yii::app()->session['attProCode']=$_REQUEST['programmeCode'];
                        yii::app()->session['attBatName']=$split[0];
                        yii::app()->session['attSecName']=$split[1];
                
                
            }
            
            $sql="SELECT 
                            * 
                          FROM 
                            {{e_module}} as e, 
                            {{h_offeredmodule}} as h
                          WHERE 
                            e.\"moduleCode\" = h.\"moduleCode\" AND
                            e.\"syllabusCode\" = h.\"syllabusCode\" AND
                            h.\"sectionName\" = :sectionName AND 
                            h.\"batchName\" = :batchName AND 
                            h.\"programmeCode\" = :programmeCode AND 
                            h.ofm_term = :ofm_term AND 
                            h.ofm_year = :ofm_year ";

//echo $sql; exit();
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':programmeCode'=>yii::app()->session['attProCode'],':batchName'=>yii::app()->session['attBatName'],':sectionName'=>yii::app()->session['attSecName'],':ofm_term'=>yii::app()->session['attTerm'],':ofm_year'=>yii::app()->session['attYear']));
                    
            
            
            $this->renderPartial('getModule',array('ofmModule'=>$ofmModule));
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
        
        
        
        
 
        
        public function actionGetBatch()
        {
         //   echo CHtml::tag('option',array('value'=>'test'),CHtml::encode('test'),true);
//                echo "test";
          
		if(isset($_REQUEST['programmeCode']))
		{
			echo "programme code:".$_REQUEST['programmeCode'];
		
                    $model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']),'ex_bat_active=true');
                 
                    if(!$model)
                    {
                        echo CHtml::tag('option',
                                          array('value'=>0),CHtml::encode("--No Batch Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                        
               
                        
                        foreach($model as $item)
                        {
                            $termYear="-- ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year." --";
                            echo "<optgroup label='{$termYear}'>";
                            $batchName="--".$item->batchName.FormUtil::getBatchNameSufix($item->batchName);
                                echo CHtml::tag('option',array('value'=>$item->batchName),CHtml::encode($batchName),true);
                            echo"</optgroup>";
                        }

                     }  
                   
                }
            
                
        }
 
        
        
        
        
        public function actionSaveGrandTotal()
        {
                         // echo "Bismillah Hir Rahmanir Rahim!!";                 
                 
                        $flag=false;
                     
                        if(isset($_REQUEST['final'])){
                            
                        
                            $sql='';
                            
                            foreach ($_REQUEST['moduleRegistrationID'] as $item)
                            {   
                            
                                
                                 $att = (!isset($_REQUEST['final'][$item])?0:($_REQUEST['final'][$item]==null?0:$_REQUEST['final'][$item]));
                                
                                 $ab= (!isset($_REQUEST['absent'][$item])?'f':($_REQUEST['absent'][$item]==0?'f':'t'));
                                
                                 
                                $sql = "UPDATE {{u_exammarks}}
                                SET emr_mark={$att}, emr_date=now(), emr_absent='{$ab}'  
                                WHERE \"moduleRegistrationID\"={$item};";
                                 
                                
                                Yii::app()->db->createCommand($sql)->execute();         
                                //echo $sql;
                            }
                            
                            
                   
                    
                    
                        $this->redirect(array('headsFunction/GetRegModuleMarksList'));
                    
          
            
            }
        //echo count($_REQUEST['moduleRegistrationID']);
        }
        
        
        
        
        
 
               
        public function actionTimeSlotEditable($id)
        { //  echo "test";
            Yii::import('bootstrap.widgets.TbEditableSaver');
                $es = new TbEditableSaver('routine');
                $es->update();
        }
        
        public function actionRoomTest($id)
        {
            //echo "Bismillah Hir Rahmanir Rahim!!";
            Yii::import('bootstrap.widgets.TbEditableSaver');
                $ee = new TbEditableSaver('routine');
                $ee->update();
        }

        

        public function actionCreateNewRoutine($id) {
           //echo "Bismillah Hir Rahmanir Rahim!!";
           
           $sql="insert into tbl_z_routine (\"offeredModuleID\") values ({$id});";
                    
                       Yii::app()->db->createCommand($sql)->queryAll();
           
            $routine= Routine::model()->findAllByAttributes(array('offeredModuleID'=>$id));
                        
            
            
            
                        $this->renderPartial('_routineManager',array('routine'=>$routine,'id'=>$id),false,true);
            
            
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
        
        
        public function actionIndividualCourseReg()
	{
            $flag=false;
            if(isset($_REQUEST['studentIDinReg']))
            {
                yii::app()->session['studentIDinReg']=$_REQUEST['studentIDinReg'];
                yii::app()->session['inRegTerm']= $_REQUEST['inRegTerm'];
                yii::app()->session['inRegYear']= $_REQUEST['inRegYear'];
                
                
                
            }   
                
            if($termAdmission = TermAdmission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentIDinReg'],'tra_term'=>yii::app()->session['inRegTerm'],'tra_year'=>yii::app()->session['inRegYear'])))
            {
                yii::app()->session['termAdmissionIDinReg']= $termAdmission->termAdmissionID;
            }
            else{
                Yii::app()->user->setFlash('warning','Student is not Admitted for Current Term !!!');
            
                $flag=true;
            }
            
               $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['studentIDinReg']),"ex_adm_active=true"); 
                
                if($admission)
                {
                    yii::app()->session['proCodeinReg'] = $admission->programmeCode;
                    yii::app()->session['batNameinReg'] = $admission->batchName;
                    yii::app()->session['secNameinReg'] = $admission->sectionName;
                    
                
                    $batch = Batch::model()->findByPk(array('batchName'=>$admission->batchName,'programmeCode'=>$admission->programmeCode));
   
                    if(FormUtil::batchFlag($batch->bat_term, $batch->bat_year, yii::app()->session['MainCurTerm'], yii::app()->session['MainCurYear']))
                    {
                            $student = Student::model()->findByPk($admission->studentID);
                            $person = Person::model()->findByPk($student->personID);
                            
                            yii::app()->session['studentName'] = $person->per_title." ".$person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['acTerm'] = $student->stu_academicTerm;
                            yii::app()->session['acYear'] = $student->stu_academicYear;
                            
                        
                    }
                    else
                    { 
            
                        Yii::app()->user->setFlash('warning','Current Term can not be previous than batch\'s start term!!!');
                        
                        
                        $this->redirect(array('index'));                
    //                  
                    }
                    
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    //echo "test"; exit();
                    $this->redirect(array('index'));                
                }
            
            
            
            $data = array('studentID'=>yii::app()->session['studentIDinReg'],'sectionName'=>yii::app()->session['secNameinReg'],'batchName'=>yii::app()->session['batNameinReg'],'programmeCode'=>yii::app()->session['proCodeinReg'],'term'=>yii::app()->session['inRegTerm'],'year'=>yii::app()->session['inRegYear']);      
            
        
            $model=new ModuleRegistration('search');
            
            $dataProvider = $model->searchNotRegistredWithoutTerm($data['studentID'],$data['sectionName'],$data['batchName'],$data['programmeCode']);
	
            
                $this->render('individualCourseReg',array('model'=>$model,'dataProvider'=>$dataProvider,'data'=>$data,'flag'=>$flag));
           
              
              
	}
        
        
        public function actionCourseAuthentication()
         {

               if(isset($_POST['programmeCode']))
                {
                    yii::app()->session['caProCode']=$_POST['programmeCode'];
                    yii::app()->session['caTerm']= (int)$_POST['caTerm'];
                    yii::app()->session['caYear']= (int)$_POST['caYear'];
                }     
               
               //echo yii::app()->session['caYear'];
                //$dataProvider = $model->searchSubjectForResultPublish(yii::app()->session['rePublishProCode'],yii::app()->session['rePublishTerm'],yii::app()->session['rePublishYear']);
                $dataProvider = Offeredmodule::model()->search6(yii::app()->session['caProCode'],yii::app()->session['caTerm'],yii::app()->session['caYear']);
                $this->render('courseAuthentication',array('dataProvider'=>$dataProvider));
         
        }
        public function actionLockPreviousResults()
         {
            if(isset($_POST['locked']) && isset($_POST['lockTerm']) && isset($_POST['lockYear'])){
               
                if(isset($_POST['programmeCode'])){                        
                    $model = new OfferedModule();
                    $model->lockAllResult((int)$_POST['lockTerm'],(int)$_POST['lockYear'], $_POST['programmeCode']);  
                }
                else{
                    $model = new OfferedModule();
                    $model->lockAllResult((int)$_POST['ofmLiTerm'],(int)$_POST['ofmLiYear']);               
                }
            }
            elseif(isset($_POST['lockTerm']) && isset($_POST['lockYear'])){
               
                if(isset($_POST['programmeCode'])){                        
                    $model = new OfferedModule();
                    $model->lockResult((int)$_POST['lockTerm'],(int)$_POST['lockYear'], $_POST['programmeCode']);  
                }
                else{
                    $model = new OfferedModule();
                    $model->lockResult((int)$_POST['ofmLiTerm'],(int)$_POST['ofmLiYear']);               
                }
            }  
            else{                
            }
            $this->redirect(array('index'));     
        }
        public function actionRegStudentToCourse()
        {

               if(isset($_REQUEST['offeredModuleID']))
                {
                    yii::app()->session['caOfferedModuleID']=(int)$_REQUEST['offeredModuleID'];
                    
                    
                }     
               
                $ofm = Offeredmodule::model()->findByPk(yii::app()->session['caOfferedModuleID']);
                
                yii::app()->session['caBatchName'] = $ofm->batchName;
                yii::app()->session['caSectionName'] = $ofm->sectionName;
                yii::app()->session['rePublishProCode']= $ofm->programmeCode;
               
                $module = Module::model()->findByPk(array('moduleCode'=>$ofm->moduleCode,'syllabusCode'=>$ofm->syllabusCode));

                $person = Person::model()->findByPk($ofm->facultyID);

                if(isset($person)){
                    yii::app()->session['caFacultyName']=$person->per_title.' '.$person->per_firstName.' '.$person->per_lastName;
                }
                else {
                    yii::app()->session['caFacultyName']='N/A';
                }
                yii::app()->session['caModule']=$module->moduleCode.':'.$module->mod_name;
             
		                 
                //$dataProvider = $model->searchSubjectForResultPublish(yii::app()->session['rePublishProCode'],yii::app()->session['rePublishTerm'],yii::app()->session['rePublishYear']);
                $dataProvider = ModuleRegistration::model()->searchRegisteredStudentToIndCourse(yii::app()->session['caOfferedModuleID']);
                $this->render('regStudentToCourse',array('dataProvider'=>$dataProvider));
         
        }
        
        public function actionAssaignStudentToCourse()
        {

		                 
                //$dataProvider = $model->searchSubjectForResultPublish(yii::app()->session['rePublishProCode'],yii::app()->session['rePublishTerm'],yii::app()->session['rePublishYear']);
                $dataProvider = ModuleRegistration::model()->searchNotRegisteredStudentToIndCourse(yii::app()->session['caOfferedModuleID']);
                $this->render('assaignStudentToCourse',array('dataProvider'=>$dataProvider));
               
        }
        
        public function actionSaveAssignStudentToCourse()
	{
          //    echo "Bismillah Hir Rahmanir Rahim. ";
               
            
                if(isset($_POST['offered']))
                {  
                        $offeredModuleID = yii::app()->session['caOfferedModuleID']; 
                        $markingSchemeID = MarkingScheme::model()->findByAttributes(array('ex_mrs_default'=>true))->markingSchemeID;  
                        
                        $examinationID = Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['caTerm'],'exm_examYear'=>yii::app()->session['caYear'],'exm_type'=>1))->examinationID; 
                        
                        $i=0;
                        $flag=false;
                        
                        
                        
                        foreach ($_POST['offered'] as $termAdmissionID)
                        { 
                            
                            if($termAdmissionID!=1)
                            {
                                $flag= true;

                                
                                //$sql .="INSERT INTO {{s_moduleregistration}} (\"termAdmissionID\", \"offeredModuleID\", \"markingSchemeID\" ) VALUES ( {$termAdmissionID}, {$offeredModuleID}, {$markingSchemeID}) ;";
                                  
                                $sql=" SELECT sp_insertmoduleregistration({$markingSchemeID},{$offeredModuleID},{$termAdmissionID},{$examinationID}); ";  
                                //$sql.="test ";
                              //  echo $sql;                                //exit();
                                Yii::app()->db->createCommand($sql)->execute();
                                $i++;
                            }
                            
                        }
                        //exit();
                        if($flag)
                        {
                            //echo "Alhamdulilah!!";
                           // echo $sql;                        
                           //exit();
                           
                                Yii::app()->user->setFlash('success',$i.' Students Has Been Registred Successfully !!!');
                                
				$this->redirect(array('headsFunction/AssaignStudentToCourse'));
                                //$this->redirect(array('headsFunction/regStudentToCourse'));
                                
                            
                        }
                    
                    
                }
                    
                
                //$dataProvider = ModuleRegistration::model()->searchNotRegisteredStudentToIndCourse(yii::app()->session['caOfferedModuleID']);
                    
               // $this->renderPartial('_assaignStudentToCourse',array('dataProvider'=>$dataProvider,'flag'=>true));

	
             
        }
        
        
        public function actionSupplementaryList()
        {

               if(isset($_REQUEST['programmeCode'],$_REQUEST['resultTerm'],$_REQUEST['resultYear']))
                {
                    yii::app()->session['rePublishProCode']=$_REQUEST['programmeCode'];
                    yii::app()->session['rePublishTerm']=$_REQUEST['resultTerm'];
                    yii::app()->session['rePublishYear']=$_REQUEST['resultYear'];
                    
                }     
                $model = new Examination();
		                 
                $dataProvider = $model->searchSupplymentryList(yii::app()->session['rePublishProCode'],yii::app()->session['rePublishTerm'],yii::app()->session['rePublishYear']);
                
                $this->render('_supplementaryList',array('dataProvider'=>$dataProvider));
         
        }
        
        public function actionSupplementaryListPDF()
      {
                 if(isset($_REQUEST['programmeCode'],$_REQUEST['resultTerm'],$_REQUEST['resultYear']))
                {
                    yii::app()->session['rePublishProCode']=$_REQUEST['programmeCode'];
                    yii::app()->session['rePublishTerm']=$_REQUEST['resultTerm'];
                    yii::app()->session['rePublishYear']=$_REQUEST['resultYear'];
                    
                }     
                $model = new Examination();
		                 
                $dataProvider = $model->searchSupplymentryList(yii::app()->session['rePublishProCode'],yii::app()->session['rePublishTerm'],yii::app()->session['rePublishYear']);
                
                Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);
                
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                
                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor(' ');
                $pdf->SetTitle('Supplementary List');
                $pdf->SetSubject('');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

                // set default header data
                $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Supplementary List'.'', '', array(0,64,255), array(0,64,128));
                //$pdf->setFooterData(array(0,64,0), array(0,64,128));

                // set header and footer fonts
                $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                // set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                // set margins
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                // set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                // set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                // set some language-dependent strings (optional)
                if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                    require_once(dirname(__FILE__).'/lang/eng.php');
                    $pdf->setLanguageArray($l);
                }

                // ---------------------------------------------------------

                // set default font subsetting mode
                $pdf->setFontSubsetting(true);

                // Set font
                // dejavusans is a UTF-8 Unicode font, if you only need to
                // print standard ASCII chars, you can use core fonts like
                // helvetica or times to reduce file size.
                $pdf->SetFont('times', '', 12, '', true);

                // Add a page
                // This method has several options, check the source code documentation for more information.
                $pdf->AddPage();

                // set text shadow effect
                //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

                // Set some content to print                
 
                $html = $this->renderPartial('_supplementaryListPDF',array('pdf'=>$pdf,'dataProvider'=>$dataProvider,),true);
 
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                // ---------------------------------------------------------

                // Close and output PDF document
                // This method has several options, check the source code documentation for more information.
                $pdf->Output('SupplementaryList.pdf', 'I');
      }
        public function actionCourseTakenByFacultyPDF()
      {
                                if(isset($_REQUEST['programmeCode'],$_REQUEST['resultTerm'],$_REQUEST['resultYear']))
                {
                    yii::app()->session['rePublishProCode']=$_REQUEST['programmeCode'];
                    yii::app()->session['rePublishTerm']=$_REQUEST['resultTerm'];
                    yii::app()->session['rePublishYear']=$_REQUEST['resultYear'];
                    
                }     
                $model = new Faculty();
		                 
                $dataProvider = $model->courseTakenByFaculty(yii::app()->session['rePublishProCode'],yii::app()->session['rePublishTerm'],yii::app()->session['rePublishYear']);
                

                Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);
                
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                
                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor(' ');
                $pdf->SetTitle('Course Distribution List');
                $pdf->SetSubject('');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

                // set default header data
                $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Course Distribution List'.'', '', array(0,64,255), array(0,64,128));
                //$pdf->setFooterData(array(0,64,0), array(0,64,128));

                // set header and footer fonts
                $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                // set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                // set margins
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                // set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                // set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                // set some language-dependent strings (optional)
                if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                    require_once(dirname(__FILE__).'/lang/eng.php');
                    $pdf->setLanguageArray($l);
                }

                // ---------------------------------------------------------

                // set default font subsetting mode
                $pdf->setFontSubsetting(true);

                // Set font
                // dejavusans is a UTF-8 Unicode font, if you only need to
                // print standard ASCII chars, you can use core fonts like
                // helvetica or times to reduce file size.
                $pdf->SetFont('dejavusans', '', 12, '', true);

                // Add a page
                // This method has several options, check the source code documentation for more information.
                $pdf->AddPage();

                // set text shadow effect
                //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

                // Set some content to print                
 
                $html = $this->renderPartial('_courseTakeByFacultyPDF',array('pdf'=>$pdf,'dataProvider'=>$dataProvider,),true);
 
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                // ---------------------------------------------------------

                // Close and output PDF document
                // This method has several options, check the source code documentation for more information.
                $pdf->Output('CourseDistributionList.pdf', 'I');
      }
         public function actionCourseTakenByFaculty()
         {

               if(isset($_REQUEST['programmeCode'],$_REQUEST['resultTerm'],$_REQUEST['resultYear']))
                {
                    yii::app()->session['rePublishProCode']=$_REQUEST['programmeCode'];
                    yii::app()->session['rePublishTerm']=$_REQUEST['resultTerm'];
                    yii::app()->session['rePublishYear']=$_REQUEST['resultYear'];
                    
                }     
                $model = new Faculty();
		                 
                $dataProvider = $model->courseTakenByFaculty(yii::app()->session['rePublishProCode'],yii::app()->session['rePublishTerm'],yii::app()->session['rePublishYear']);
                
                $this->render('_courseTakeByFaculty',array('dataProvider'=>$dataProvider));
         
        }
        
        public function actionGetRegisteredModuleForBatch()
        {
         
                    if(isset($_POST['programmeCode']))
                    {
                        yii::app()->session['mreProCode']=$_POST['programmeCode'];
                        yii::app()->session['mreBatch']=$_POST['batchName'];
                        yii::app()->session['mreSection']=$_POST['sectionName'];
                        yii::app()->session['mreTerm']=$_POST['mreTerm'];
                        yii::app()->session['mreYear']=$_POST['mreYear'];
                    }
                    
                    
                    
                    
                    //yii::app()->session['examinationIDrm']= Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['mreTerm'],'exm_examYear'=>yii::app()->session['mreYear'],'exm_type'=>1))->examinationID;
                
        		//echo "programme code:".$_REQUEST['mreYear'];
	
                    $sql="SELECT 
                            * 
                          FROM 
                            {{e_module}} as e, 
                            {{h_offeredmodule}} as h
                          WHERE 
                            e.\"moduleCode\" = h.\"moduleCode\" AND
                            e.\"syllabusCode\" = h.\"syllabusCode\" AND
                            h.\"sectionName\" = :sectionName AND 
                            h.\"batchName\" = :batchName AND 
                            h.\"programmeCode\" = :programmeCode AND 
                            h.ofm_term = :ofm_term AND 
                            h.ofm_year = :ofm_year 
                            ORDER BY e.\"moduleCode\"";
                    
                    
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':programmeCode'=>yii::app()->session['mreProCode'],':batchName'=>yii::app()->session['mreBatch'],':sectionName'=>yii::app()->session['mreSection'],':ofm_term'=>yii::app()->session['mreTerm'],':ofm_year'=>yii::app()->session['mreYear']));
                    
                    if($ofmModule)
                    {
                        $this->render('getRegisteredModuleForBatch',array('ofmModule'=>$ofmModule));
                    }
                    else
                    {
                        Yii::app()->user->setFlash('warning',' No Registered Module Found For Selected Term !!!');
                        $this->redirect(array('headsFunction/index'));
                    }
                    
            
        }
        
        public function actionGetRegisteredModuleForSpecialRetake()
        {
         
                    if(isset($_POST['mestProCode']))
                    {
                        yii::app()->session['mestProCode']=$_POST['mestProCode'];
                        
                        yii::app()->session['mestTerm']=$_POST['mestTerm'];
                        yii::app()->session['mestYear']=$_POST['mestYear'];
                    }
                    
                    
                    
                    
                    //yii::app()->session['examinationIDrm']= Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['mreTerm'],'exm_examYear'=>yii::app()->session['mreYear'],'exm_type'=>1))->examinationID;
                
        		//echo "programme code:".$_REQUEST['mreYear'];
	
                    $sql="SELECT 
                      m.*,
                      h.*
                    FROM 
                      public.tbl_s_moduleregistration s, 
                      public.tbl_q_termadmission q,
                       public.tbl_e_module m, 
                        public.tbl_h_offeredmodule h
                    WHERE 
                      s.\"termAdmissionID\" = q.\"termAdmissionID\" AND
                      s.\"offeredModuleID\" = h.\"offeredModuleID\" AND
                      h.\"moduleCode\" = m.\"moduleCode\" AND
                      h.\"syllabusCode\" = m.\"syllabusCode\" AND
                      q.tra_term = :term  AND 
                      q.tra_year = :year AND 
                      s.reg_type = 2 AND
                      q.\"programmeCode\" = :proCode;";
                    
                    
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':proCode'=>yii::app()->session['mestProCode'],':term'=>yii::app()->session['mestTerm'],':year'=>yii::app()->session['mestYear']));
                    
                    if($ofmModule)
                    {
                        $this->render('getRegisteredModuleForSpecialRetake',array('ofmModule'=>$ofmModule));
                    }
                    else
                    {
                        Yii::app()->user->setFlash('warning',' No Registered Module Found For Selected Term !!!');
                        $this->redirect(array('headsFunction/index'));
                    }
                    
            
        }
       function actionResultSummary(){
           
              if(isset($_REQUEST['offeredModuleID'])){
                     $mod_name = $_REQUEST['mod_name'];
                     $per_name = $_REQUEST['per_name'];
                     $batch_name = $_REQUEST['batch_name'];
                     $sec_name = $_REQUEST['sec_name'];
                                          
                    $sql = "SELECT \"letterGrade\", count(\"letterGrade\")
                            FROM 
                                public.vw_result_final_exam r
                            WHERE 
                                r.\"offeredModuleID\" ='{$_REQUEST['offeredModuleID']}'  
                                GROUP BY \"letterGrade\" ORDER BY \"letterGrade\" ";
                                
             $result = Yii::app()->db->createCommand($sql)->queryAll();                 
                 
             $command=Yii::app()->db->createCommand($sql);
                                     
             $dataProvider=new CSqlDataProvider($sql, array(
                    'id'=>'id',
                   // 'totalItemCount'=>$count,
                    //'params'=>$params,
                     'sort'=>array(
                        'attributes'=>array(
                             'letterGrade',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
                $this->render('resultSummary',array( 'result'=>$result,'dataProvider'=>$dataProvider,'mod_name'=>$mod_name,'per_name'=>$per_name,'batch_name'=>$batch_name,'sec_name'=>$sec_name,));
                }
        } 
}
