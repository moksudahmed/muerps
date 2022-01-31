<?php

class FacultiesFunctionController extends Controller
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
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getSection','SaveApproval','getBatch','attStudentList','GetRegModuleMarksList','Generate100PDF','Generate100XLS','saveTotalMarks','Generate60PDF','resultSheet','GenerateGradeSheet','attendanceEXCEL','TermAdmittedExcel','varifyMarks','GetRegisteredModuleForBatch','GetMarksListForBatch','SaveTotalMarksDataEntry','getMarksListForSR','saveTotalMarksSpecialRetake','SuppleModuleMarksList','SaveSuppleMarks','GetSuppleCourse','SupplyTemplateXLS'),
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
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getSection','SaveApproval','getBatch','attStudentList','GetRegModuleMarksList','Generate100PDF','Generate100XLS','saveTotalMarks','Generate60PDF','resultSheet','GenerateGradeSheet','attendanceEXCEL','TermAdmittedExcel','varifyMarks','getRegisteredModuleForBatch'),
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
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getSection','SaveApproval','getBatch','attStudentList','GetRegModuleMarksList','Generate100PDF','Generate100XLS','saveTotalMarks','Generate60PDF','resultSheet','GenerateGradeSheet','attendanceEXCEL','TermAdmittedExcel','varifyMarks','GetRegisteredModuleForBatch','getMarksListForSR','saveTotalMarksSpecialRetake','GetRegisteredModuleForBatch','GetMarksListForBatch','saveTotalMarksDataEntry','SuppleModuleMarksList','SaveSuppleMarks','GetSuppleCourse','SupplyTemplateXLS'),
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
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getSection','SaveApproval','getBatch','attStudentList','GetRegModuleMarksList','Generate100PDF','Generate100XLS','saveTotalMarks','Generate60PDF','resultSheet','GenerateGradeSheet','attendanceEXCEL','TermAdmittedExcel','getMarksListForSR','saveTotalMarksSpecialRetake','GetRegisteredModuleForBatch','GetMarksListForBatch','saveTotalMarksDataEntry','SuppleModuleMarksList','SaveSuppleMarks','GetSuppleCourse','SupplyTemplateXLS'),
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
			'actions'=>array('index','getSection','SaveApproval','getBatch','attStudentList','GetRegModuleMarksList','Generate100PDF','Generate100XLS','saveTotalMarks','Generate60PDF','resultSheet','GenerateGradeSheet','attendanceEXCEL','TermAdmittedExcel','GetRegisteredModuleForBatch','SuppleModuleMarksList','SaveSuppleMarks','GetSuppleCourse','SupplyTemplateXLS'),
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
			
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                  'actions'=>array('index','getSection','SaveApproval','getBatch','attStudentList','GetRegModuleMarksList','Generate100PDF','Generate100XLS','saveTotalMarks','Generate60PDF','resultSheet','GenerateGradeSheet','attendanceEXCEL','TermAdmittedExcel','varifyMarks','GetRegisteredModuleForBatch','GetMarksListForBatch','SaveTotalMarksDataEntry','getMarksListForSR','saveTotalMarksSpecialRetake','SuppleModuleMarksList','SaveSuppleMarks','GetSuppleCourse','SupplyTemplateXLS'),
                  'users'=>array(Yii::app()->user->id),
                ),
                
                array('deny',  // deny all users
                  'users'=>array('*'),
                ),
              );
            }
           /*  elseif (yii::app()->user->getState('role')==='exam')
            {
                
                return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','getSection','SaveApproval','getBatch','attStudentList','GetRegModuleMarksList','Generate100PDF','Generate100XLS','saveTotalMarks','Generate60PDF','resultSheet','GenerateGradeSheet','attendanceEXCEL','TermAdmittedExcel','varifyMarks','GetRegisteredModuleForBatch','getMarksListForSR','saveTotalMarksSpecialRetake','GetRegisteredModuleForBatch','GetMarksListForBatch','saveTotalMarksDataEntry','SuppleModuleMarksList','SaveSuppleMarks','GetSuppleCourse','SupplyTemplateXLS'),
				'users'=>array(Yii::app()->user->id),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }*/
            else
            {
                return array(
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
            }
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
                            e.\"mod_group\" = 'Internship/Thesis' AND
                            e.\"syllabusCode\" = h.\"syllabusCode\" AND
                            h.\"sectionName\" = :sectionName AND 
                            h.\"batchName\" = :batchName AND 
                            h.\"programmeCode\" = :programmeCode AND 
                            h.ofm_term = :ofm_term AND 
                            h.ofm_year = :ofm_year ";
                    
                    
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':programmeCode'=>yii::app()->session['mreProCode'],':batchName'=>yii::app()->session['mreBatch'],':sectionName'=>yii::app()->session['mreSection'],':ofm_term'=>yii::app()->session['mreTerm'],':ofm_year'=>yii::app()->session['mreYear']));
                    
                    if($ofmModule)
                    {
                        $this->render('getRegisteredModuleForBatch',array('ofmModule'=>$ofmModule));
                    }
                    else
                    {
                        Yii::app()->user->setFlash('warning',' No Registered Module Found For Selected Term !!!');
                        $this->redirect(array('facultiesFunction/index'));
                    }
                    
            
        }
        public function actionIndex()
	{
             
                        yii::app()->session['mreYear']=yii::app()->session['MainCurYear'];
                        yii::app()->session['mreTerm']=yii::app()->session['MainCurTerm'];
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
                            h.\"userID\"=:facultyID order by h.\"batchName\", h.\"sectionName\", e.\"moduleCode\"";

//echo $sql; exit();
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':ofm_term'=>yii::app()->session['mreTerm'],':ofm_year'=>yii::app()->session['mreYear'],':facultyID'=>yii::app()->session['MainFacultyID']));
           
                $this->render('index',array('ofmModule'=>$ofmModule));
                
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
                            $batchName=$item->batchName.FormUtil::getBatchNameSufix($item->batchName)." Batch"."    [ ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year." ]";
                            echo "<optgroup label='{$batchName}'>";
                            foreach(Section::model()->findAllByAttributes(array('batchName'=>$item->batchName,'programmeCode'=>$item->programmeCode)) as $item2)
                            {
                                $sectionName="Section ".$item2->batchName.FormUtil::getBatchNameSufix($item2->batchName)." ".$item2->sectionName;
                                echo CHtml::tag('option',array('value'=>$item2->batchName."-".$item2->sectionName),CHtml::encode($sectionName),true);
                            }
                            echo"</optgroup>";
                            
                        
                            
                        }

                    }  
                   
                }
                
                
        }
 
        
        public function actionAttStudentList()
	{
            
            if(isset($_POST['programmeCode'],$_POST['sectionName']))
            {
                $split= array();
                $split= explode('-', $_REQUEST['sectionName']);
                
                        
                        yii::app()->session['attTerm']=$_POST['attTerm'];
                        yii::app()->session['attYear']=$_POST['attYear'];
                        
                        yii::app()->session['attProCode']=$_REQUEST['programmeCode'];
                        yii::app()->session['attBatName']=$split[0];
                        yii::app()->session['attSecName']=$split[1];
                
                
            }
            
            $sql="SELECT 
                            h.\"offeredModuleID\",
                            e.\"moduleCode\",
                            e.mod_name,
                            concat_ws(' ',j.per_title,' ',  j.\"per_firstName\",' ', j.\"per_lastName\") as per_name,
                            j.per_mobile
                          FROM 
                            {{e_module}} as e, 
                            {{h_offeredmodule}} as h
                            left join
                            {{j_person}} as j
                            on ( h.\"facultyID\"= j.\"personID\")
                          WHERE 
                            e.\"moduleCode\" = h.\"moduleCode\" AND
                            e.\"syllabusCode\" = h.\"syllabusCode\" AND

                            h.\"sectionName\" = :sectionName AND 
                            h.\"batchName\" = :batchName AND 
                            h.\"programmeCode\" = :programmeCode AND 
                            h.ofm_term = :ofm_term AND 
                            h.ofm_year = :ofm_year ";

//echo $sql; //exit();
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':programmeCode'=>yii::app()->session['attProCode'],':batchName'=>yii::app()->session['attBatName'],':sectionName'=>yii::app()->session['attSecName'],':ofm_term'=>yii::app()->session['attTerm'],':ofm_year'=>yii::app()->session['attYear']));
                    
            
            $this->render('AttStudentList',array(
			'model'=>$ofmModule, 
                    ));
                
              
	}
        
        public function actionAttendanceExcel($id)
	{
           
            
             $sql ="select * from vw_attendance where \"programmeCode\"=:proCode 
                 and \"batchName\"=:batName and \"sectionName\"=:secName order by \"studentID\" ";
         
         
             $dataProvider = Admission::model()->findAllBySql($sql,array(':proCode'=>yii::app()->session['attProCode'],':batName'=>yii::app()->session['attBatName'],':secName'=>yii::app()->session['attSecName']));
                
           /* $html = $this->renderPartial('attendanceExcel',array(
                                   'dataProvider'=>$dataProvider),true);*/
                        
	     Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('attendanceExcel', array(
				'dataProvider'=>$dataProvider,'id'=>$id
			), true)
		);
	}
        
        public function actionTermAdmittedExcel($id)
	{
         
	    
                
             $sql ="select * from vw_termadmittedlist where \"offeredModuleID\"=:ofmID 
                 ; ";
         
         
             $dataProvider = TermAdmission::model()->findAllBySql($sql,array(':ofmID'=>$id));
              
                
             Yii::app()->request->sendFile(date('YmdHis').'term.xls',
			$this->renderPartial('attendanceTermAdmissionExcel', array(
				'dataProvider'=>$dataProvider,'id'=>$id
			), true)
		);
	}

        
        public function actionAttendancePDF()
	{
      
          
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);
             
                $model = new TermAdmission();
	    
                $ofmID= yii::app()->session['attOfmID'];
             $sql ="select * from vw_attendance where \"programmeCode\"=:proCode 
                 and \"batchName\"=:batName; ";
         
         
             $dataProvider = Admission::model()->findAllBySql($sql,array(':proCode'=>yii::app()->session['attProCode'],':batName'=>yii::app()->session['attBatName']));
              
                
                $html = $this->renderPartial('attendancePDF',array('model'=>$model,
                                   'dataProvider'=>$dataProvider),true);
                $pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('School Report');
		$pdf->SetSubject('School Report');
		//$pdf->SetKeywords('example, text, report');
		$pdf->SetHeaderData('', 0, "Report", '');
                
               	$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Attendance Sheet",'');
	
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Attandance Sheet ".Yii::app()->name, "");
		$pdf->setHeaderFont(Array('times', '', 14));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 18, 15);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('times', '', 7);
		$pdf->AddPage('L');
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("TabulationSheet".'pdf', "I");
                 
	}


        public function actionTermAdmittedPDF()
	{
      
          
		Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);
             
                $model= new TermAdmission();
	    
                $ofmID= yii::app()->session['attOfmID'];
             $sql ="select * from vw_termadmittedlist where \"offeredModuleID\"=:ofmID 
                 ; ";
         
         
             $dataProvider = TermAdmission::model()->findAllBySql($sql,array(':ofmID'=>yii::app()->session['attOfmID']));
              
                yii::app()->session['attFacultyID']= $dataProvider[0]['fac_name'];
                $html = $this->renderPartial('attendancePDF',array('model'=>$model,
                                   'dataProvider'=>$dataProvider),true);
                $pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('School Report');
		$pdf->SetSubject('School Report');
		//$pdf->SetKeywords('example, text, report');
		$pdf->SetHeaderData('', 0, "Report", '');
                
               	$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Attendance Sheet",'');
	
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Attandance Sheet ".Yii::app()->name, "");
		$pdf->setHeaderFont(Array('times', '', 14));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 18, 15);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('times', '', 7);
		$pdf->AddPage('L');
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("TabulationSheet".'pdf', "I");
                 
	}

        

        
       
        
        
        
        
        
        public function actionGenerate100PDF()
        {
             
             Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
              require_once(Yii::app()->params['tcpdf']);
              require_once(Yii::app()->params['tcpdfConf']);

                 
             if(isset($_REQUEST['offeredModuleID']))
            {
                yii::app()->session['mreOfmID']=$_REQUEST['offeredModuleID'];
                yii::app()->session['mreHalf']=$_REQUEST['mreHalf'];
            }
            
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreOfmID']));
            
            yii::app()->session['mreModule']=$module->moduleCode.':'.$module->mod_name;
            
            
             $sql="SELECT 
                            * 
                          FROM 
                            vw_consolidate_mark
                            where \"offeredModuleID\"=:offeredModuleID;   
                          ";
             $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mreOfmID']));
            
            
            //if(yii::app()->session['mreHalf']==1)
            //{
               
                 $html = $this->renderPartial('getRegModuleMarksListPDF', array(
			'moduleReg'=>$moduleReg
		), true);
            //}
               $pdf = new TCPDF('',PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('100 Mark Sheet');
		//$pdf->SetSubject('Spring Term Examinatyion 2013');
		//$pdf->SetKeywords('example, text, report');
		//$pdf->SetHeaderData('', 0, "Tabulation Data", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 50, "MARK SHEET (100 Marks)",'');
		$pdf->setHeaderFont(Array('times', '', 25));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 20, 30);
		$pdf->SetHeaderMargin(5);
		//$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('times', '', 7);
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("100MarkSheet.pdf'", "I");      
 
        }
        
        public function actionGenerate100XLS()
        {
             
             Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
              require_once(Yii::app()->params['tcpdf']);
              require_once(Yii::app()->params['tcpdfConf']);

                 
             if(isset($_REQUEST['offeredModuleID']))
            {
                yii::app()->session['mreOfmID']=$_REQUEST['offeredModuleID'];
                yii::app()->session['mreHalf']=$_REQUEST['mreHalf'];
            }
            
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreOfmID']));
            
            yii::app()->session['mreModule']=$module->moduleCode.':'.$module->mod_name;
            
            
             $sql="SELECT 
                            * 
                          FROM 
                            vw_consolidate_mark
                            where \"offeredModuleID\"=:offeredModuleID;   
                          ";
             $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mreOfmID']));
            
            
            //if(yii::app()->session['mreHalf']==1)
            //{
               /*
                 $html = $this->renderPartial('getRegModuleMarksListPDF', array(
			'moduleReg'=>$moduleReg
		), true); */
            //}
               
                 Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$html = $this->renderPartial('getRegModuleMarksListPDF', array(
			'moduleReg'=>$moduleReg
                    ), true)
		);
                 
        }
        
        
        
        public function actionGenerate60PDF()
        {
             
             Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
              require_once(Yii::app()->params['tcpdf']);
              require_once(Yii::app()->params['tcpdfConf']);

                 
             if(isset($_REQUEST['offeredModuleID']))
            {
                yii::app()->session['mreOfmID']=$_REQUEST['offeredModuleID'];
                yii::app()->session['mreHalf']=$_REQUEST['mreHalf'];
            }
            
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreOfmID']));
            
            yii::app()->session['mreModule']=$module->moduleCode.':'.$module->mod_name;
            
            
             $sql="SELECT 
                            * 
                          FROM 
                            vw_consolidate_mark
                            where \"offeredModuleID\"=:offeredModuleID;   
                          ";
             $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mreOfmID']));
            
            
            //if(yii::app()->session['mreHalf']==1)
            //{
               
                 $html = $this->renderPartial('get60MarksListPDF', array(
			'moduleReg'=>$moduleReg
		), true);
            //}
               $pdf = new TCPDF('',PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('60 Mark Sheet');
		//$pdf->SetSubject('Spring Term Examinatyion 2013');
		//$pdf->SetKeywords('example, text, report');
		//$pdf->SetHeaderData('', 0, "Tabulation Data", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 50, "MARK SHEET (60 Marks)",'');
		$pdf->setHeaderFont(Array('times', '', 25));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 20, 30);
		$pdf->SetHeaderMargin(5);
		//$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('times', '', 7);
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("60MarkSheet.pdf", "I");      
 
        }
        
        

         public function actionResultSheet()
	{
      //echo $_REQUEST['batchName'];
      //exit();
                        
                $model = new Examination();
		                 
                $dataProvider = $model->searchTabulationByOfferedModuleID( yii::app()->session['mreOfmID']);
                
                $this->render('resultSheet',array('model'=>$model,'dataProvider'=>$dataProvider));
         
	}
        
        
        public function actionGenerateGradeSheet()
	{
                  
           // echo yii::app()->session['mreOfmID']; exit();
                   $session=new CHttpSession;
                   $session->open();
                   Yii::import('application.modules.admin.extensions.bootstrap.*');
                    
                      
                   require_once(Yii::app()->params['tcpdf']);
                   require_once(Yii::app()->params['tcpdfConf']);
                   $model = new Examination();
                   
                    $rows = $model->searchGradeSheetReturnRows( yii::app()->session['mreProCode'],yii::app()->session['mreBatch'], yii::app()->session['MainCurTerm'], yii::app()->session['MainCurYear'],yii::app()->session['mreSection']);
                    $subjectRows = $model->searchNoOfSubject( yii::app()->session['mreProCode'],yii::app()->session['mreBatch'], yii::app()->session['MainCurTerm'], yii::app()->session['MainCurYear']);
                    $split = array();
                    
                    $split = explode(':',yii::app()->session['mreModule']);
                    
                    yii::app()->session['mreModuleCode']= $split[0];
                    
                    
                    $pCode= yii::app()->session['mreProCode'];
                    $bCode = yii::app()->session['mreBatch'];
                    $term = yii::app()->session['MainCurTerm'];
                    $year = yii::app()->session['MainCurYear'];
                    $sectionName = yii::app()->session['mreSection'];
                    $sql = "SELECT r.\"letterGrade\",
                                count (r.\"letterGrade\") as \"gradeSummaryTotal\"
                            FROM 
                                public.vw_result_final_exam r
                            WHERE 
                                r.\"moduleCode\" = '{$split[0]}' AND  r.\"exm_examTerm\" = {$term} AND  r.\"exm_examYear\" = {$year} AND r.\"sectionName\" = '{$sectionName}' AND r.\"programmeCode\"='{$pCode}' AND r.\"batchName\"={$bCode}
                            GROUP BY r.\"letterGrade\" ORDER BY r.\"letterGrade\" ";
                    /*$sql = "SELECT 
                          vw_result_final_exam.\"letterGrade\",
                          count (vw_result_final_exam.\"letterGrade\") as \"gradeSummaryTotal\"
                        FROM 
                          public.vw_result_final_exam
                        WHERE 
                          vw_result_final_exam.\"moduleCode\" =  '{$split[0]}' AND 
                          vw_result_final_exam.\"exm_examTerm\" = {$term} AND 
                          vw_result_final_exam.\"exm_examYear\" = {$year} AND
                          vw_result_final_exam.\"sectionName\" = '{$sectionName}'
                        GROUP BY 
                          vw_result_final_exam.\"letterGrade\"
                        ORDER BY
                          vw_result_final_exam.\"letterGrade\"
                      ";
                      */    
                          
                    $gradeSummary = Yii::app()->db->createCommand($sql)->queryAll();
                    
                      
//Yii::app()->db->createCommand($sql)->queryAll();
                    $pdf = new TCPDF('',PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor(Yii::app()->name);
                    $pdf->SetTitle('60 Mark Sheet');
                    //$pdf->SetSubject('Spring Term Examinatyion 2013');
                    //$pdf->SetKeywords('example, text, report');
                    //$pdf->SetHeaderData('', 0, "Tabulation Data", '');
                    $pdf->SetHeaderData(PDF_HEADER_LOGO, 50, "Grade Sheet (100 Marks)",'');
                    $pdf->setHeaderFont(Array('times', '', 25));
                    $pdf->setFooterFont(Array('times', '', 6));
                    $pdf->SetMargins(15, 20, 30);
                    $pdf->SetHeaderMargin(5);
                    //$pdf->SetFooterMargin(10);
                    $pdf->SetAutoPageBreak(TRUE, 0);
                    $pdf->SetFont('times', '', 7);
                    
                    
                     $sql="SELECT 
                            * 
                          FROM 
                            vw_getfirsthalfmarkslist
                            where reg_type <> 2 AND  \"offeredModuleID\"=:offeredModuleID;   
                          ";
                    $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mreOfmID']));
                    
                    $html = $this->renderPartial('GradeSheetPDF', array(
                                'rows'=>$rows,'subjectRows'=>$subjectRows,'pdf'=>$pdf,
                                'gradeSummary'=>$gradeSummary,
                        ), true);

                    $fileName = 'GradeSheet'.'.pdf';//.DBhelper::getProgrammeShortName(yii::app()->session['reProCode']).'_'.yii::app()->session['reBatName'].FormUtil::getBatchNameSufix(yii::app()->session['reBatchName']).'_'.FormUtil::getTerm(yii::app()->session['reTerm']).'_'.yii::app()->session['reYear'].' (Regular)';
                    $pdf->Output($fileName, "I");

             

	}

        
        public function actionSaveApproval($id)
        {
            
                Yii::import('bootstrap.widgets.TbEditableSaver');
                    $es = new TbEditableSaver('offeredModule');
                    $es->update();
            
        }
        
        public function  searchGrade($grade, $gradeSummary)
        {
                foreach ($gradeSummary as $r) 
                {
                    if($r['letterGrade'] == $grade)
                        return $r['gradeSummaryTotal'];
                }
                return 0;                
       }
            
        public function actionGetRegModuleMarksList()
        {
            yii::app()->session['mreUrlFlag']=FALSE;
            
            if(isset($_POST['offeredModuleID']))
            {
                yii::app()->session['mreOfmID']=(int)$_POST['offeredModuleID'];
                yii::app()->session['mreTerm']=(int)$_POST['mreTerm'];
                yii::app()->session['mreYear']=(int)$_POST['mreYear'];
                
            }
            
            
            
            
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\", h.\"facultyID\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreOfmID']));
            
            $person = Person::model()->findByPk($module->facultyID);
            
            //echo count([$person]);
            //exit(1);
            if(isset($person)){
                yii::app()->session['mreFacultyName']=$person->per_title.' '.$person->per_firstName.' '.$person->per_lastName;
            }
            else {
                yii::app()->session['mreFacultyName']='N/A';
            }
            
            yii::app()->session['mreModule']=$module->moduleCode.':'.$module->mod_name;
            
            
             $sql="SELECT 
                            * 
                          FROM 
                            vw_getfirsthalfmarkslist
                            where reg_type <> 2 AND
                            \"offeredModuleID\"=:offeredModuleID;   
                          ";
             
            $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mreOfmID']));
              
            if(count($moduleReg)==0)
            {
                Yii::app()->user->setFlash('warning',' No Admited Students Found For Selected Term !!!');
                        
                $this->redirect(array('index')); 
                
                        
                        //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('getRegisteredModule'));
            }
            
            
               yii::app()->session['mreProCode']=$moduleReg[0]->programmeCode;
               yii::app()->session['mreBatch']=$moduleReg[0]->batchName;
               yii::app()->session['mreSection']=$moduleReg[0]->sectionName;
              
               yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>1,'exm_examTerm'=>yii::app()->session['mreTerm'],'exm_examYear'=>yii::app()->session['mreYear']))->examinationID;
              
                $this->render('getRegModuleMarksList',array('moduleReg'=>$moduleReg));
            
                
        }
        
       public function actionGetMarksListForBatch()
       {
            yii::app()->session['mreUrlFlag']=2;
            
            if(isset($_POST['offeredModuleID']))
            {
                yii::app()->session['mreOfmID']=(int)$_POST['offeredModuleID'];
                yii::app()->session['mreTerm']=(int)$_POST['mreTerm'];
                yii::app()->session['mreYear']=(int)$_POST['mreYear'];
                yii::app()->session['mreType']=(isset($_POST['mreType'])?(int)$_POST['mreType']:2);
            }
            
            
            
            
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\", h.\"facultyID\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreOfmID']));
            
            $person = Person::model()->findByPk($module->facultyID);
            if(isset($person)){
                yii::app()->session['mreFacultyName']=$person->per_title.' '.$person->per_firstName.' '.$person->per_lastName;
            }
            else {
                yii::app()->session['mreFacultyName']='N/A';
            }
            
            yii::app()->session['mreModule']=$module->moduleCode.':'.$module->mod_name;
            
            
             $sql="SELECT 
                            * 
                          FROM 
                            vw_getfirsthalfmarkslist
                            where reg_type <> 2 AND 
                            \"offeredModuleID\"=:offeredModuleID;   
                          ";
             
            $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mreOfmID']));
              
             //exit();
            if(count([$moduleReg])===0)
            {
                Yii::app()->user->setFlash('warning',' No Admited Students Found For Selected Term !!!');
                        
                $this->redirect(array('index')); 
                
                        
                        //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('getRegisteredModule'));
            }
            
            
               yii::app()->session['mreProCode']=$moduleReg[0]->programmeCode;
               yii::app()->session['mreBatch']=$moduleReg[0]->batchName;
               yii::app()->session['mreSection']=$moduleReg[0]->sectionName;
              
               yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>1,'exm_examTerm'=>yii::app()->session['mreTerm'],'exm_examYear'=>yii::app()->session['mreYear']))->examinationID;
              
               if(yii::app()->session['mreType']==2)
               {
                   $this->render('getRegModuleMarksEntry',array('moduleReg'=>$moduleReg));
               }
               else
               {
                   $this->render('getRegModuleMarksList',array('moduleReg'=>$moduleReg));
               }
               
                
        }
 
        
        public function actionVarifyMarks($offeredID)
        {
            yii::app()->session['mreUrlFlag']=true;
           // yii::app()->session['mreUrlFlag']=(isset($offeredID)?true:false);
            //yii::app()->session['mreUrlFlag']=(isset($_POST['offeredModuleID'])?true:false);
            
           // echo yii::app()->session['mreUrlFlag'];
            
            
            if(isset($offeredID))
            {
                yii::app()->session['mreOfmID']=$offeredID;
                
            }
            yii::app()->session['mreTerm']= yii::app()->session['caTerm'];
            yii::app()->session['mreYear']= yii::app()->session['caYear'];
            
            
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\", h.\"facultyID\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreOfmID']));
            
            if( isset($module->facultyID))
            {
                $person = Person::model()->findByPk($module->facultyID);

                if(count([$person])>0){
                    yii::app()->session['mreFacultyName']=$person->per_title.' '.$person->per_firstName.' '.$person->per_lastName;
                }
                
            }
            else {
                    yii::app()->session['mreFacultyName']='N/A';
            }
                
            yii::app()->session['mreModule']=$module->moduleCode.':'.$module->mod_name;
            
            
             $sql="SELECT 
                            * 
                          FROM 
                            vw_getfirsthalfmarkslist
                            where reg_type <> 2 AND
                             \"offeredModuleID\"=:offeredModuleID;   
                          ";
             
             $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mreOfmID']));
              //;
             //exit();
            if(count($moduleReg)===0)
            {
                Yii::app()->user->setFlash('warning',' No Admited Students Found For Selected Course !!!');
                        
                $this->redirect(array('HeadsFunction/courseAuthentication')); 
                
                        
                        //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('getRegisteredModule'));
            }
            
            
               yii::app()->session['mreProCode']=$moduleReg[0]->programmeCode;
               yii::app()->session['mreBatch']=$moduleReg[0]->batchName;
               yii::app()->session['mreSection']=$moduleReg[0]->sectionName;
              
               yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>1,'exm_examTerm'=>yii::app()->session['mreTerm'],'exm_examYear'=>yii::app()->session['mreYear']))->examinationID;
               
                $this->render('getRegModuleMarksList',array('moduleReg'=>$moduleReg));
            
                
        }
        
       public function actionGetMarksListForSR()
       {
            
            
            if(isset($_POST['offeredModuleID']))
            {
                yii::app()->session['mestOfmID']=(int)$_POST['offeredModuleID'];
               
                
            }
            
            
            
            
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\", h.\"facultyID\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mestOfmID']));
            
            $person = Person::model()->findByPk($module->facultyID);
            if(isSet($person)){
                yii::app()->session['mestFacultyName']=$person->per_title.' '.$person->per_firstName.' '.$person->per_lastName;
            }
            else {
                yii::app()->session['mestFacultyName']='N/A';
            }
            
            yii::app()->session['mestModule']=$module->moduleCode.':'.$module->mod_name;
            
            
             $sql="SELECT 
                            * 
                          FROM 
                            vw_getfirsthalfmarkslist
                            where 
                            reg_type = 2 AND
                            \"offeredModuleID\"=:offeredModuleID;   
                          ";
             
            $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':offeredModuleID'=>yii::app()->session['mestOfmID']));
              ;
             //exit();
            if(count([$moduleReg])===0)
            {
                Yii::app()->user->setFlash('warning',' No Admited Students Found For Selected Term !!!');
                        
                $this->redirect(array('index')); 
                
                        
                        //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('getRegisteredModule'));
            }
            
            
               yii::app()->session['mestProCode']=$moduleReg[0]->programmeCode;
               yii::app()->session['mestBatch']=$moduleReg[0]->batchName;
               yii::app()->session['mestSection']=$moduleReg[0]->sectionName;
              
               yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>1,'exm_examTerm'=>yii::app()->session['mestTerm'],'exm_examYear'=>yii::app()->session['mestYear']))->examinationID;
              
               
               $this->render('getRegModuleMarksListSpecialRetake',array('moduleReg'=>$moduleReg));
               
               
                
        }
        
        public function actionSaveTotalMarks()
        {
                         // echo "Bismillah Hir Rahmanir Rahim!!";                 
        
                        $flag=false;
                     
                        if(isset($_REQUEST['attendance'],$_REQUEST['classTest'],$_REQUEST['midterm'])){
                            
                        $examinationID = yii::app()->session['examinationID'];
                            //echo count($_REQUEST['moduleRegistrationID']);
                              //  exit();
                            
                            foreach ($_REQUEST['id'] as $item)
                            {   
                                //echo "test";
                                //echo isset($_REQUEST['pass'][$item]);
                                //exit(1);
                                
                                if(isset($_REQUEST['pass'][$item]))
                                {
                                    $att = (!isset($_REQUEST['attendance'][$item])?0:($_REQUEST['attendance'][$item]==null?0:$_REQUEST['attendance'][$item]));
                                    $cst = (!isset($_REQUEST['classTest'][$item])?0:($_REQUEST['classTest'][$item]==null?0:$_REQUEST['classTest'][$item]));
                                    $mdt = (!isset($_REQUEST['midterm'][$item])?0:($_REQUEST['midterm'][$item]==null?0:$_REQUEST['midterm'][$item]));
                                    //echo $att;
                                     //if($att!=0 && $cst!=0 && $mdt!=0){
                                    $sql = "UPDATE {{s_moduleregistration}}
                                    SET reg_attendence={$att}, \"reg_classTest\"={$cst}, reg_midterm={$mdt} 
                                    WHERE \"moduleRegistrationID\"={$item};";
                                    // }

                                    //echo $sql;
                                   // if(yii::app()->session['mrePubFlag'] && FormUtil::getSuperAdminFlag(yii::app()->user->getState('role'), yii::app()->session['mreTerm'], yii::app()->session['mreYear']))
                                    //{
                                      Yii::app()->db->createCommand($sql)->execute(); 
                                    //}        
                                }
                                
                                if(isset($_REQUEST['passFinal'][$item]))
                                {
                                    $fid= yii::app()->session['MainFacultyID']; 

                                    $att2 = (!isset($_REQUEST['fi'][$item])?0:($_REQUEST['fi'][$item]==null?0:$_REQUEST['fi'][$item]));

                                     $ab= (!isset($_REQUEST['absent'][$item])?'f':($_REQUEST['absent'][$item]==0?'f':'t'));

                                    //echo $_REQUEST['fi'][$item];

                                    //exit();
                                    $sql2 = "UPDATE {{u_exammarks}}
                                    SET emr_mark={$att2}, emr_date=now(), emr_absent='{$ab}', \"facultyID\"={$fid}  
                                    WHERE \"moduleRegistrationID\"={$item} and \"examinationID\"={$examinationID};";
                                     //echo $sql2;
                                     //exit();
                                   // if(yii::app()->session['mrePubFlag'] && FormUtil::getSuperAdminFlag(yii::app()->user->getState('role'), yii::app()->session['mreTerm'], yii::app()->session['mreYear']))
                                    //{
                                      Yii::app()->db->createCommand($sql2)->execute();
                                    //}         
                                }
                               
                            }
                           //exit();
                            //echo $sql;
                   //         echo count($_REQUEST['attendance']);
                    
                        $this->redirect(array('GetRegModuleMarksList'));
                    
                   
            
            }
        
        }
        
        public function actionSaveTotalMarksDataEntry()
        {
                          //echo "Bismillah Hir Rahmanir Rahim!!";                 
                          
                        $flag=false;
                     
                        if(isset($_POST['total'],$_POST['fi'])){
                            
                        $examinationID = yii::app()->session['examinationID'];
                            //echo count($_POST['moduleRegistrationID']);
                              //  exit();
                            
                            foreach ($_POST['id'] as $item)
                            {   
                                if(isset($_REQUEST['passFinal'][$item]))
                                {
                                     $total = (!isset($_POST['total'][$item])?0:($_POST['total'][$item]==null?0:$_POST['total'][$item]));
                                     $total = ($total>60?0:$total);

                                     $att = round($total*10/60);
                                     $cst = round($total*20/60);
                                     $mdt = round($total*30/60);
                                     $temp = $att+$cst+$mdt;
                                     
                                     if($temp!= $total)
                                     {
                                         
                                         if(($temp)<$total)
                                         {
                                             $mdt = $mdt+($total-$temp);
                                         }
                                         else
                                         {
                                             $mdt = $mdt-($temp-$total);
                                         }
                                     }
                                     //$temp = $att+$cst+$mdt;
                                     //echo $temp.' '.$total; exit();
                                    
                                    //echo $att;
                                     //if($att!=0 && $cst!=0 && $mdt!=0){
                                    $sql = "UPDATE {{s_moduleregistration}}
                                        SET reg_attendence={$att}, \"reg_classTest\"={$cst}, reg_midterm={$mdt} 
                                        WHERE \"moduleRegistrationID\"={$item};";
                                    // }

                                    if(yii::app()->session['mrePubFlag'] && FormUtil::getSuperAdminFlag(yii::app()->user->getState('role'), yii::app()->session['mreTerm'], yii::app()->session['mreYear']))
                                    {
                                      Yii::app()->db->createCommand($sql)->execute();         
                                    }
                                    
                                    $fid= yii::app()->session['MainFacultyID']; 

                                    $final = (!isset($_POST['fi'][$item])?0:($_POST['fi'][$item]==null?0:$_POST['fi'][$item]));
                                    $final =($final>40?0:$final);

                                    $ab= (!isset($_POST['absent'][$item])?'f':($_POST['absent'][$item]==0?'f':'t'));

                                    //echo $_POST['fi'][$item];

                                    //exit();
                                    $sql2 = "UPDATE {{u_exammarks}}
                                    SET emr_mark={$final}, emr_date=now(), emr_absent='{$ab}', \"facultyID\"={$fid}  
                                    WHERE \"moduleRegistrationID\"={$item} and \"examinationID\"={$examinationID};";
                                    // echo $sql2;
                                     //exit();

                                    if(yii::app()->session['mrePubFlag'] && FormUtil::getSuperAdminFlag(yii::app()->user->getState('role'), yii::app()->session['mreTerm'], yii::app()->session['mreYear']))
                                    {
                                      Yii::app()->db->createCommand($sql2)->execute();
                                    } 

                                }
                            }
                            
                            //echo $sql;
                   //         echo count($_POST['attendance']);
                    
                        $this->redirect(array('GetMarksListForBatch'));
                    
                   
            
            }
        
        }
        
        public function actionSaveTotalMarksSpecialRetake()
        {
                         // echo "Bismillah Hir Rahmanir Rahim!!";                 
        
                        $flag=false;
                     
                        if(isset($_REQUEST['attendance'],$_REQUEST['classTest'],$_REQUEST['midterm'])){
                            
                        $examinationID = yii::app()->session['examinationID'];
                            //echo count($_REQUEST['moduleRegistrationID']);
                              //  exit();
                            
                            foreach ($_REQUEST['id'] as $item)
                            {   
                            
                                if(isset($_REQUEST['pass'][$item]))
                                {
                                    $att = (!isset($_REQUEST['attendance'][$item])?0:($_REQUEST['attendance'][$item]==null?0:$_REQUEST['attendance'][$item]));
                                    $cst = (!isset($_REQUEST['classTest'][$item])?0:($_REQUEST['classTest'][$item]==null?0:$_REQUEST['classTest'][$item]));
                                    $mdt = (!isset($_REQUEST['midterm'][$item])?0:($_REQUEST['midterm'][$item]==null?0:$_REQUEST['midterm'][$item]));
                                    //echo $att;
                                     //if($att!=0 && $cst!=0 && $mdt!=0){
                                    $sql = "UPDATE {{s_moduleregistration}}
                                    SET reg_attendence={$att}, \"reg_classTest\"={$cst}, reg_midterm={$mdt} 
                                    WHERE \"moduleRegistrationID\"={$item};";
                                    // }

                                    //echo $sql;
                                    Yii::app()->db->createCommand($sql)->execute();         
                                }
                                
                                if(isset($_REQUEST['passFinal'][$item]))
                                {
                                    $fid= yii::app()->session['MainFacultyID']; 

                                    $att2 = (!isset($_REQUEST['fi'][$item])?0:($_REQUEST['fi'][$item]==null?0:$_REQUEST['fi'][$item]));

                                     $ab= (!isset($_REQUEST['absent'][$item])?'f':($_REQUEST['absent'][$item]==0?'f':'t'));

                                    //echo $_REQUEST['fi'][$item];

                                    //exit();
                                    $sql2 = "UPDATE {{u_exammarks}}
                                    SET emr_mark={$att2}, emr_date=now(), emr_absent='{$ab}', \"facultyID\"={$fid}  
                                    WHERE \"moduleRegistrationID\"={$item} and \"examinationID\"={$examinationID};";
                                     //echo $sql2;
                                     //exit();
                                    Yii::app()->db->createCommand($sql2)->execute();         
                                }
                               
                            }
                           //exit();
                            //echo $sql;
                   //         echo count($_REQUEST['attendance']);
                    
                        $this->redirect(array('getMarksListForSR'));
                    
                   
            
            }
        
        }
        
        public function actionGetSuppleCourse()
        {
            //------------ for testing----------
           //echo CHtml::tag('option',array('value'=>'test'),CHtml::encode('test'),true);
           //echo CHtml::tag('option',array('value'=>$_REQUEST['programmeCode3']),CHtml::encode('test'),true);
           //exit();
           //-------------------------------
//                echo "test";
                yii::app()->session['suppleTerm']= $_REQUEST['suppleTerm']; 
                yii::app()->session['suppleYear']= $_REQUEST['suppleYear'];
                yii::app()->session['suppleType']= $_REQUEST['suppleType'];
                yii::app()->session['suppleProCode'] = $_REQUEST['programmeCode3'];
    //            echo CHtml::tag('option',array('value'=>$_REQUEST['suppleTerm']),CHtml::encode($_REQUEST['suppleYear']),true);
      //          exit();
                
                
                $examinationID= Examination::model()->findByAttributes(array('exm_type'=>$_REQUEST['suppleType'],'exm_examTerm'=>$_REQUEST['suppleTerm'],'exm_examYear'=>$_REQUEST['suppleYear']))->examinationID;
                
                //echo CHtml::tag('option',array('value'=>$_REQUEST['suppleTerm']),CHtml::encode($examinationID),true);
                 //exit();
		if(isset($_REQUEST['programmeCode3']))
		{
                    //echo CHtml::tag('option',array('value'=>$_REQUEST['suppleTerm']),CHtml::encode($examinationID),true);
                 //exit();
			//echo "programme code:".$_REQUEST['programmeCode'];
		//,e.\"syllabusCode\"
                   
                    
                    $sql="SELECT distinct
                        e.mod_name,
                        e.mod_group,
                        e.\"moduleCode\"
                        
                      FROM 
                        public.tbl_u_exammarks u, 
                        public.tbl_s_moduleregistration s, 
                        public.tbl_h_offeredmodule h, 
                        public.tbl_e_module e
                      WHERE 
                        u.\"moduleRegistrationID\" = s.\"moduleRegistrationID\" AND
                        h.\"offeredModuleID\" = s.\"offeredModuleID\" AND
                        h.\"moduleCode\" = e.\"moduleCode\" AND
                        h.\"syllabusCode\" = e.\"syllabusCode\" AND
                        u.\"examinationID\" = :exmID AND 
                        h.\"programmeCode\" = :proCode order by e.\"moduleCode\" ";
            
                    $model = OfferedModule::model()->findAllBySql($sql,array(':proCode'=>$_REQUEST['programmeCode3'],':exmID'=>$examinationID));
                    
                    if(!$model)
                    {
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("--No Course Found--"),true);
                    }
                    else    
                    {
                 
                        echo CHtml::tag('option',array('value'=>0),CHtml::encode("-Please Select-"),true);
                        
               
                        
                        foreach($model as $item)
                        {
            
                            echo CHtml::tag('option',array('value'=>$item->moduleCode.':'.$item->syllabusCode),CHtml::encode($item->moduleCode.':'.$item->mod_name),true);
                           
                        }

                     }  
                   
                }
            
                
        }
        
        
        public function actionSuppleModuleMarksList()
        {
            yii::app()->session['mreUrlFlag']=FALSE;
            
            if(isset($_POST['moduleCode']))
            {
                
                $split = array();
                $split = explode(':',$_POST['moduleCode']);
                yii::app()->session['suppleModCode']=$split[0];
                yii::app()->session['suppleSylCode']=$split[1];
                //yii::app()->session['suppleTerm']=(int)$_POST['suppleTerm'];
                //yii::app()->session['suppleYear']=(int)$_POST['suppleYear'];
                yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['suppleType'],'exm_examTerm'=>yii::app()->session['suppleTerm'],'exm_examYear'=>yii::app()->session['suppleYear']))->examinationID; 
            }
            
            
          
          /*
            $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\", h.\"facultyID\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
            $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['suppleOfmID']));
            
            $person = Person::model()->findByPk($module->facultyID);
            if(count($person)){
                yii::app()->session['mreFacultyName']=$person->per_title.' '.$person->per_firstName.' '.$person->per_lastName;
            }
            else {
                yii::app()->session['mreFacultyName']='N/A';
            }
           */
            
            //$module= Module::model()->findByAttributes(array('moduleCode'=>yii::app()->session['suppleModCode'],'syllabusCode'=>yii::app()->session['suppleSylCode']));
            
            $sql ="SELECT  m.\"moduleCode\",  m.mod_name
            FROM public.tbl_e_module as m, tbl_d_syllabus as s where   m.\"syllabusCode\" = s.\"syllabusCode\" 
            and m.\"moduleCode\"=:modCode and s.\"programmeCode\"= :proCode  order by s.\"syllabusCode\" desc limit 1;";
            
            
            $module = Module::model()->findBySql($sql,array(':modCode'=>yii::app()->session['suppleModCode'],':proCode'=>yii::app()->session['suppleProCode']));
            
            
            
            //$module= Module::model()->findByAttributes(array('moduleCode'=>yii::app()->session['suppleModCode']));
            //echo $module->mod_name; exit();
            yii::app()->session['mreModule']=$module->moduleCode.':'.$module->mod_name;
            
            
            /* $sql="SELECT 
                            * 
                          FROM 
                            vw_getsupplemarkslist
                            where \"moduleCode\"=:modCode and \"syllabusCode\"=:sylCode AND \"examinationID\"=:examinationID ;   
                          "; */
             $sql="SELECT 
                            * 
                          FROM 
                            vw_getsupplemarkslist
                            where \"moduleCode\"=:modCode AND \"programmeCode\"=:proCode AND \"examinationID\"=:examinationID ;   
                          ";
             
            $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':modCode'=>yii::app()->session['suppleModCode'],':proCode'=>yii::app()->session['suppleProCode'],':examinationID'=>yii::app()->session['examinationID']));
            //$moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':modCode'=>yii::app()->session['suppleModCode'],':sylCode'=>yii::app()->session['suppleSylCode'],':examinationID'=>yii::app()->session['examinationID']));  
             //exit();
            if(count($moduleReg)===0)
            {
                Yii::app()->user->setFlash('warning',' No Registered Students Found For Selected Term !!!');
                        
                $this->redirect(array('index')); 
                
                        
                        //$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('getRegisteredModule'));
            }
            
            
               yii::app()->session['mreProCode']=$moduleReg[0]->programmeCode;
               yii::app()->session['mreBatch']=$moduleReg[0]->batchName;
               yii::app()->session['mreSection']=$moduleReg[0]->sectionName;
              
               
              
                $this->render('suppleModuleMarksList',array('moduleReg'=>$moduleReg));
            
                
        }
        
        public function actionSaveSuppleMarks()
        {
                         // echo "Bismillah Hir Rahmanir Rahim!!";                 
        
                        $flag=false;
                     
                        if(isset($_REQUEST['fi']) || isset($_REQUEST['absent']))
                        {
                           $examinationID = yii::app()->session['examinationID'];
                        
                            //echo count($_REQUEST['moduleRegistrationID']);
                              //  exit();
                            
                            foreach ($_REQUEST['id'] as $item)
                            {   
                            
                   /*             
                                 $att = (!isset($_REQUEST['attendance'][$item])?0:($_REQUEST['attendance'][$item]==null?0:$_REQUEST['attendance'][$item]));
                                 $cst = (!isset($_REQUEST['classTest'][$item])?0:($_REQUEST['classTest'][$item]==null?0:$_REQUEST['classTest'][$item]));
                                 $mdt = (!isset($_REQUEST['midterm'][$item])?0:($_REQUEST['midterm'][$item]==null?0:$_REQUEST['midterm'][$item]));
                                //echo $att;
                                 //if($att!=0 && $cst!=0 && $mdt!=0){
                                $sql = "UPDATE {{s_moduleregistration}}
                                SET reg_attendence={$att}, \"reg_classTest\"={$cst}, reg_midterm={$mdt} 
                                WHERE \"moduleRegistrationID\"={$item};";
                                // }
                                
                               Yii::app()->db->createCommand($sql)->execute();
                     */          
                               $fid= yii::app()->session['MainFacultyID']; 
                               
                                $att2 = (!isset($_REQUEST['fi'][$item])?0:($_REQUEST['fi'][$item]==null?0:$_REQUEST['fi'][$item]));
                                
                                 $ab= (!isset($_REQUEST['absent'][$item])?'f':($_REQUEST['absent'][$item]==0?'f':'t'));
                                
                                //echo $_REQUEST['fi'][$item];
                                
                                //exit();
                                $sql2 = "UPDATE {{u_exammarks}}
                                SET emr_mark={$att2}, emr_date=now(), emr_absent='{$ab}', \"facultyID\"={$fid}  
                                WHERE \"moduleRegistrationID\"={$item} and \"examinationID\"={$examinationID};";
                                 //echo $sql2;
                                 //exit();
                                Yii::app()->db->createCommand($sql2)->execute();         
                               
                            }
                            
                            //echo $sql;
                   //         echo count($_REQUEST['attendance']);
                    
                        $this->redirect(array('suppleModuleMarksList'));
                    
                   
            
            }
        
        }
        
        public function actionSupplyTemplateXLS()
        {

             $sql="SELECT 
                            * 
                          FROM 
                            vw_getsupplemarkslist
                            where \"moduleCode\"=:modCode  AND \"examinationID\"=:examinationID ;   
                          ";
             
            $moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':modCode'=>yii::app()->session['suppleModCode'],':examinationID'=>yii::app()->session['examinationID']));
            
            //Yii::app()->request->sendFile(yii::app()->session['mreModule'].'_supply_template.xls',$this->renderPartial('suppleTemplateXLS',array('moduleReg'=>$moduleReg), true) ); 
            $this->render('suppleTemplateXLS',array('moduleReg'=>$moduleReg));
            
             
         
        }
}