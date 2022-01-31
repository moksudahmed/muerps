  <?php

class ExamDepartmentController extends Controller
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
            $rules= array();

            $option = new Options;            
      
            
           
            
            if(yii::app()->user->getState('role')==='super-admin2')
            {
              $capabilities = $option->getControllerOptions( 'exam_department_controller', yii::app()->user->getState('role'));
               return array(
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                                'actions'=>$capabilities,
                                //'actions'=>array_merge($option->getOptions('generate_transcript'),$option->getOptions('generate_result_and_tabulation')),
       				//'actions'=>array('admin','delete','ReportTabulation','TabulationPDF','ResultPDF','TabulationRetakePDF','ResultRetakePDF','getBatch','result','TranscriptIndex','academicRecord','TranscriptPDF','GetGroup','GetSuppleCourse','TabulationSupplyPDF','ResultSheetSupplyPDF','Transcript','TranscriptBackpage','TranscriptXLS','GenerateWord'),
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
                
            }
            elseif(yii::app()->user->getState('role')==='super-admin')
            
            {
		        $rules = array('create','update','GetBatch','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligibleListFinal','ExamEligibleListFinalPDF','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','ExamEligibleListSupple','ExamEligibleListSupplePDF','ExamEligibleListSuppleXLS','PublishResultSupple','Transcript','TermAdmissionListExcel');
		
                
            }
            elseif(yii::app()->user->getState('role')==='admin')
            {
		
			
		$rules = array('create','update','GetBatch','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligibleListFinal','ExamEligibleListFinalPDF','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','ExamEligibleListSupple','ExamEligibleListSupplePDF','ExamEligibleListSuppleXLS','PublishResultSupple');
			
		
                
            }
            elseif(yii::app()->user->getState('role')==='head')
            {
		
			
		$rules = array('create','update','GetBatch','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','ExamEligibleListSupple','ExamEligibleListSuppleXSL','PublishResultSupple');
			
		
                
            }
            elseif(yii::app()->user->getState('role')==='coordinator')
            {
		
		$rules = array('create','update','GetBatch','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','ExamEligibleListSupple','PublishResultSupple');
		
                
            }
            elseif(yii::app()->user->getState('role')==='faculty')
            {
		
		$rules =array('create','update','GetBatch','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligableList','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','PublishResultSupple');
		
                
            }
            
            elseif(yii::app()->user->getState('role')==='exam')
            {
		$rules = array('create','update','GetBatch','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligibleListFinal','ExamEligibleListFinalPDF','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','ExamEligibleListSupple','ExamEligibleListSupplePDF','ExamEligibleListSuppleXLS','PublishResultSupple','Transcript','TermAdmissionListExcel');
		
                
            }
            elseif(yii::app()->user->getState('role')==='registry')
            {

		$rules = array('create','update','GetBatch','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligableList','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF');
			
                
            }
            elseif(yii::app()->user->getState('role')==='basic-user')
            {

		$rules = array('GetBatch','GetModules','index','view','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF');
			
                
            }
            elseif(yii::app()->user->getState('role')==='admission')
            {
		
		
		$rules = array('AcademicRecord','AcademicRecordXLS','AcademicRecordPDF');
				
			
                
            }
            elseif(yii::app()->user->getState('role')==='deo')
            {
		
		
                $rules = array('create','update','GetBatch','GetModules','index','view','SMEmarksEntry','SMEgetModules','SMEstudentList','SMEsave','SMESave2','PublishResult','ExamEligibleListFinal','ExamEligibleListFinalPDF','AcademicRecord','AcademicRecordXLS','AcademicRecordPDF','ExamEligibleListSupple','ExamEligibleListSupplePDF','ExamEligibleListSuppleXLS','PublishResultSupple','Transcript','TermAdmissionListExcel');
		
      		
                
            }
            else
            {
                    $rules=array('');
            }
            
            
            
            return array(
                     /*   array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),	
                */
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>$rules,
				'users'=>array(yii::app()->user->id),
			),
			array('deny',  // deny all users
                            
				'users'=>array('*'),
			),
		);
            
	}

	public function actionIndex()
	{
            $data = Admission::searchAdmission();
		$this->render('index',array(
			'data'=>$data,
		));
	}

        public function actionGetBatch()
        {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if(isset($_REQUEST['programmeCode']))
		{
                     yii::app()->session['proCode']=$_REQUEST['programmeCode'];
			//echo "programme code:".$_REQUEST['programmeCode'];
		
                    //$sql = 'select * from tbl_f_batch where "programmeCode"='.$_REQUEST['programmeCode'].';';
                    $sql = 'select * from tbl_f_batch where "programmeCode"=:x order by "batchName";';
                    
                    $model = Batch::model()->findAllBySql($sql,array(':x'=>$_REQUEST['programmeCode']));
                    //$model = Batch::model()->findAllByAttributes(array('programmeCode'=>$_REQUEST['programmeCode']));
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
                            $batchName=$item->batchName.FormUtil::getBatchNameSufix($item->batchName)." Batch"."  --   ".FormUtil::getTerm($item->bat_term)." ".$item->bat_year;
                            //echo "<optgroup label='{$batchName}'>";
                           // foreach(Section::model()->findAllByAttributes(array('batchName'=>$item->batchName,'programmeCode'=>$item->programmeCode)) as $item2)
                           // {
                            //    $sectionName="Section ".$item2->batchName.FormUtil::getBatchNameSufix($item2->batchName)." ".$item2->sectionName;
                                echo CHtml::tag('option',array('value'=>$item->batchName),CHtml::encode($batchName),true);
                           // }
                            //echo"</optgroup>";
                            
                        
                            
                        }

                    }  
                   
                }
                
                
        }
        
        
        public function actionGetSection()
        {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if(isset($_REQUEST['programmeCode']))
		{
                     yii::app()->session['proCode']=$_REQUEST['programmeCode'];
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
        
        
        
      public function actionSMEmarksEntry()
      {  
             
           if(isset($_REQUEST['exrEntTerm']))
           {
               yii::app()->session['exrEntTerm']=$_REQUEST['exrEntTerm'];
               yii::app()->session['exrEntYear']=$_REQUEST['exrEntYear'];
           }
               
          
              $this->render('SMEmarksEntry',array('data'=>''
                   
                   ));
          
      }
      
      
       public function actionSMEGetModules()
       {
             
            if(isset($_REQUEST['programmeCode']))
            {
                yii::app()->session['exrEntProCode']=$_REQUEST['programmeCode'];
                
            }
                    $sql="SELECT 
                            h.\"offeredModuleID\", 
                            h.\"moduleCode\", 
                            h.\"syllabusCode\", 
                            h.\"batchName\",
                            h.\"sectionName\",
                            e.mod_name, 
                            e.mod_group
                          FROM 
                            {{e_module}} as e, 
                            {{h_offeredmodule}} as h
                          WHERE 
                            e.\"moduleCode\" = h.\"moduleCode\" AND
                            e.\"syllabusCode\" = h.\"syllabusCode\" AND
                            
                            h.\"programmeCode\" = :programmeCode AND 
                            h.ofm_term = :ofm_term AND 
                            h.ofm_year = :ofm_year ";
                    
               //     echo $sql;
                    $ofmModule = OfferedModule::model()->findAllBySql($sql,array(':programmeCode'=>yii::app()->session['exrEntProCode'],':ofm_term'=>yii::app()->session['exrEntTerm'],':ofm_year'=>yii::app()->session['exrEntYear']));
                    
                    yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['exrEntTerm'],'exm_examYear'=>yii::app()->session['exrEntYear'],'exm_type'=>2))->examinationID;
                    
                    if($ofmModule)
                    {
                        $this->renderPartial('_SMEgetModules',array('ofmModule'=>$ofmModule),false,true);
                    }
                    else
                    {
                        //echo "test"; exit();
                        Yii::app()->user->setFlash('warning',' No Registered Module Found For Selected Term !!!');
                       $this->renderPartial('_noDataFound');
                    }
                    
             
        }
      
       public function actionSMEstudentList()
        {
           // echo $_REQUEST['offeredModuleID'];           // exit();
             
            $split= array();
            
            //echo yii::app()->session['mreSupModuleCode'];
            
            if(isset($_REQUEST['offeredModuleID']))
            {
                
                $ofm = Offeredmodule::model()->findByPk($_REQUEST['offeredModuleID']);
                
                
                yii::app()->session['mreSupModuleCode']=$ofm->moduleCode;
                yii::app()->session['mreSupSyllabusCode']=$ofm->syllabusCode;
                
                $module = Module::model()->findByPk(array('moduleCode'=>$ofm->moduleCode,'syllabusCode'=>$ofm->syllabusCode));
                
                yii::app()->session['mreSupModuleTitle']=$module->moduleCode.": ".$module->mod_name;
            }
            
            $data= array();
            $data = FormUtil::getDateRangeByTerm(yii::app()->session['exrEntTerm'], yii::app()->session['exrEntYear']); 
            
     //       $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
       //     $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreSupOfmID']));
            
            yii::app()->session['mreModule']=yii::app()->session['mreSupModuleCode'];
            
            
             $sql="SELECT 
                          * 
                          FROM 
                            vw_getsupplemarkslist
                            where \"moduleCode\"=:modCode and \"syllabusCode\"=:sylCode and
                             
                            \"reg_suppleExamReg\"='t' and \"examinationID\"=:examID;   
                          ";
             
             //echo $sql;
             /*
             $sql="SELECT 
                          * 
                          FROM 
                            vw_getsupplemarkslist
                            where \"moduleCode2\"=:modCode and \"syllabusCode\"=:sylCode and
                            \"reg_suppleExamRegDate\">:startDate and \"reg_suppleExamRegDate\"<:endDate and 
                            \"reg_suppleExamReg\"='t';   
                          ";
             */
             
            if(!$moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':modCode'=>yii::app()->session['mreSupModuleCode'],':sylCode'=>yii::app()->session['mreSupSyllabusCode'],':examID'=>yii::app()->session['examinationID'])))
            {
                Yii::app()->user->setFlash('warning',' No Registered Student Found For This Course!!!');
                        $this->redirect(array('SMEmarksEntry')); 
            }
            
            else
            {
                //echo "test"; exit();
                $this->render('SMEgetRegModuleMarksListSupple',array('moduleReg'=>$moduleReg));
            }
            
                
        }
        
        public function actionMarksEntry()
        {
           // echo $_REQUEST['offeredModuleID'];           // exit();
             
            $split= array();
            
            //echo yii::app()->session['mreSupModuleCode'];
            
            if(isset($_REQUEST['offeredModuleID']))
            {
                
                $split= explode(':', $_REQUEST['offeredModuleID']);
                yii::app()->session['mreSupModuleCode']=$split[0];
                yii::app()->session['mreSupSyllabusCode']=$split[1];
                
                $module = Module::model()->findByPk(array('moduleCode'=>$split[0],'syllabusCode'=>$split[1]));
                
                yii::app()->session['mreSupModuleTitle']=$module->moduleCode.": ".$module->mod_name;
            }
            
            $data= array();
            $data = FormUtil::getDateRangeByTerm(yii::app()->session['exrEntTerm'], yii::app()->session['exrEntYear']); 
            
     //       $sql1="select e.\"moduleCode\", e.mod_name, e.\"mod_shortName\" from {{e_module}} as e , {{h_offeredmodule}} as h where e.\"moduleCode\"=h.\"moduleCode\" and e.\"syllabusCode\"=h.\"syllabusCode\" and h.\"offeredModuleID\"=:id ";
       //     $module = Module::model()->findBySql($sql1,array(':id'=>yii::app()->session['mreSupOfmID']));
            
            yii::app()->session['mreModule']=yii::app()->session['mreSupModuleCode'];
            
            
             $sql="SELECT 
                          * 
                          FROM 
                            vw_getsupplemarkslist
                            where \"moduleCode\"=:modCode and \"syllabusCode\"=:sylCode and
                             
                            \"reg_suppleExamReg\"='t' and \"examinationID\"=:examID;   
                          ";
             
             //echo $sql;
             /*
             $sql="SELECT 
                          * 
                          FROM 
                            vw_getsupplemarkslist
                            where \"moduleCode2\"=:modCode and \"syllabusCode\"=:sylCode and
                            \"reg_suppleExamRegDate\">:startDate and \"reg_suppleExamRegDate\"<:endDate and 
                            \"reg_suppleExamReg\"='t';   
                          ";
             */
            if(!$moduleReg = ModuleRegistration::model()->findAllBySql($sql,array(':modCode'=>yii::app()->session['mreSupModuleCode'],':sylCode'=>yii::app()->session['mreSupSyllabusCode'],':examID'=>yii::app()->session['examinationID'])))
            {
                Yii::app()->user->setFlash('warning',' No Admited Students Found For Selected Term !!!');
                        $this->redirect(array('MarksEntry')); 
            }
            
            else
            {
                //echo "test"; exit();
                $this->render('SMEgetRegModuleMarksListSupple',array('moduleReg'=>$moduleReg));
            }
            
                
        }
        
        
        public function actionSMESave()
        {
        //    echo "Allah please help me";
            $i= $_REQUEST['i'];
            $regSup = unserialize(yii::app()->session['regSup'.$i]);
            $regSup->final = (isset($_REQUEST['final-'.$i])?$_REQUEST['final-'.$i]:0);
            
            $regSup->absent = (isset($_REQUEST['absent-'.$i])?'t':'f');
            //echo $regSup->absent;
            
           // $exm = Examination::model()->findByAttributes(array('exm_examTerm'=>yii::app()->session['exrEntTerm'],'exm_examYear'=>yii::app()->session['exrEntYear'],'exm_type'=>1));
            $examID= yii::app()->session['examinationID'];
            //echo $regSup->moduleRegistrationID;
            $sql="update tbl_u_exammarks set emr_mark={$regSup->final}, emr_absent='{$regSup->absent}' where \"moduleRegistrationID\"={$regSup->moduleRegistrationID}
                and \"examinationID\"={$examID}
            ;";
            //echo $sql;
                Yii::app()->db->createCommand($sql)->query();
               $this->renderPartial('_SMEsecondHalfSupple',array('regSup'=>$regSup,'i'=>$i));      
        
        }
        
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
        public function actionPublishResult()
        {
          
                if(isset($_REQUEST['programmeCode'],$_REQUEST['rpTerm'],$_REQUEST['rpYear']))
                {
                    yii::app()->session['reProCode']=$_REQUEST['programmeCode'];
                    yii::app()->session['reTerm']=$_REQUEST['rpTerm'];
                    yii::app()->session['reYear']=$_REQUEST['rpYear'];
                    yii::app()->session['reType']=$_REQUEST['rpType'];
                    yii::app()->session['examinationID'] = Examination::model()->findByAttributes(array('exm_type'=>yii::app()->session['reType'],'exm_examTerm'=>yii::app()->session['reTerm'],'exm_examYear'=>yii::app()->session['reYear']))->examinationID; 
                    // echo  yii::app()->session['reType'];
                    //exit();
                }     
           
                              
               $model = new Examination();
		                 
                $dataProvider = $model->searchConfirmedResult(yii::app()->session['reProCode'],yii::app()->session['reTerm'],yii::app()->session['reYear']);
          
                $dataProvider2 = $model->searchRetakeResultByBatchs(yii::app()->session['reProCode'],yii::app()->session['reTerm'],yii::app()->session['reYear']);
                //echo var_dump($dataProvider2); exit(0);
                $this->render('publishResult',array('dataProvider'=>$dataProvider,'dataProvider2'=>$dataProvider2));
         
            
        }
        
        public function actionPublishResultSupple()
        {
          
                if(isset($_REQUEST['programmeCode'],$_REQUEST['reTerm'],$_REQUEST['reYear']))
                {
                    yii::app()->session['reProCode']=$_REQUEST['programmeCode'];
                    yii::app()->session['reTerm']=$_REQUEST['reTerm'];
                    yii::app()->session['reYear']=$_REQUEST['reYear'];
                    yii::app()->session['reType']=$_REQUEST['reType'];
                   
                }     
                              
               $model = new Examination();
		                 
                
          
                $dataProvider = $model->searchSuppleResultByBatchs(yii::app()->session['reProCode'], yii::app()->session['reTerm'], yii::app()->session['reYear'], yii::app()->session['reType']);
                
                $this->render('publishResultSupple',array('dataProvider'=>$dataProvider,'examType'=>yii::app()->session['reType']));
         
            
        }
         
        public function actionExamEligibleListFinal()
        {
                if(isset($_REQUEST['eligibleTerm'],$_REQUEST['eligibleYear']))
                {
                    
                    yii::app()->session['eligibleTerm']=$_REQUEST['eligibleTerm'];
                    yii::app()->session['eligibleYear']=$_REQUEST['eligibleYear'];                    
                                       
                    
                }
                
                
              
                    
		
                    $model = new Examination();

                    
                    $title = FormUtil::getTermYear(yii::app()->session['eligibleTerm'], yii::app()->session['eligibleYear']);
                    $author ='Office of the Controller of Examination';


    
                    $dataProvider =$model->searchEligiableStudentSummery(yii::app()->session['eligibleTerm'],yii::app()->session['eligibleYear']);
         //           $this->renderPartial('_eligableStudentSummaryPage',array('dataProvider'=>$dataProvider,),true);
   

                    //$dataProvider2 = $model->searchEligableList(yii::app()->session['eligableTerm'],yii::app()->session['eligableYear']);
  //                  $this->renderPartial('_eligableStudentList',array('rows'=>$dataProvider2,),true);
                   
                    $this->render('eligibleListFinal',array('dataProvider'=>$dataProvider,));
                
       
        }
        public function actionTermAdmissionListExcel()
        {
            $model = new Examination();
            $term = yii::app()->session['eligibleTerm'];
            $year = yii::app()->session['eligibleYear'];

          //  $rows = $model->searchStudentTermAdmiisionList(yii::app()->session['eligibleTerm'],yii::app()->session['eligibleYear']);
            $title = FormUtil::getTermYear(yii::app()->session['eligibleTerm'], yii::app()->session['eligibleYear']);
            $author ='Office of the Controller of Examination';
            $sql ="SELECT
            t.\"studentID\",
            t.\"batchName\", 
            d.dpt_code as id, 
            p.\"pro_shortName\"
          FROM 
            public.tbl_b_department d, 
            public.tbl_c_programme p, 
            public.tbl_q_termadmission t
          WHERE 
            d.\"departmentID\" = p.\"departmentID\" AND
            p.\"programmeCode\" = t.\"programmeCode\" AND
            t.tra_term = {$term} AND 
            t.tra_year = {$year}
          ORDER BY  p.\"pro_shortName\", t.\"batchName\",t.\"studentID\" ";
           
           $rows = Yii::app()->db->createCommand($sql)->queryAll();
            
                    Yii::app()->request->sendFile(date('YmdHis').'.xls',
                    $this->renderPartial('termAdmissionListExcel', array(
                        'rows'=>$rows
                    ), true)
                );
        }
    
       
        
        public function actionExamEligibleListFinalPDF()
        {
                    
              
                Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                $model = new Examination();
		                 
                $dataProvider = $model->searchEligableList(yii::app()->session['eligibleTerm'],yii::app()->session['eligibleYear']);
                $title = FormUtil::getTermYear(yii::app()->session['eligibleTerm'], yii::app()->session['eligibleYear']);
                $author ='Office of the Controller of Examination';
                
                require_once(Yii::app()->params['tcpdf']);
		require_once(Yii::app()->params['tcpdfConf']);
                
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                
                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Office of the Controller of Examination');
                $pdf->SetTitle($title);
                $pdf->SetSubject('');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

                // set default header data
                $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title.' Eligible Student List', $author, array(0,64,255), array(0,64,128));
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
                $dataProvider =$model->searchEligiableStudentSummery(yii::app()->session['eligibleTerm'],yii::app()->session['eligibleYear']);
                $html = $this->renderPartial('_eligableStudentSummaryPage',array('pdf'=>$pdf,'dataProvider'=>$dataProvider,),true);
   //                   $html = $this->renderPartial('_eligableStudentSummaryPage',array('pdf'=>$pdf,'dataProvider'=>$dataProvider,),true);
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                
                $pdf->AddPage();

                $rows = $model->searchEligableList(yii::app()->session['eligibleTerm'],yii::app()->session['eligibleYear']);
                $html = $this->renderPartial('_eligableStudentList',array('pdf'=>$pdf,'rows'=>$rows,),true);
             
                // Print text using writeHTMLCell()
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

                // ---------------------------------------------------------

                // Close and output PDF document
                // This method has several options, check the source code documentation for more information.
                $pdf->Output('example_001.pdf', 'I');
        }
      
        public function actionExamEligibleListSupple()
        {
                if(isset($_REQUEST['eligibleTerm'],$_REQUEST['eligibleYear'],$_REQUEST['exrType']))
                {
                    
                    yii::app()->session['eligibleTerm']=$_REQUEST['eligibleTerm'];
                    yii::app()->session['eligibleYear']=$_REQUEST['eligibleYear'];                    
                    yii::app()->session['exrType']=$_REQUEST['exrType'];                    
                                       
                    
                }
                
                    $model = new Examination();

                    
                    $title = FormUtil::getTermYear(yii::app()->session['eligibleTerm'], yii::app()->session['eligibleYear']);
                    $author ='Office of the Controller of Examination';


                    $dataProvider =$model->searchEligiableStudentSupple(yii::app()->session['eligibleTerm'],yii::app()->session['eligibleYear'],yii::app()->session['MainDepartmentID'], yii::app()->session['exrType']);
                   
                    $this->render('eligibleListSupple',array('dataProvider'=>$dataProvider,));
                
       
        }
        
        public function actionExamEligibleListSuppleXLS()
        {
                
		
                    $model = new Examination();

                    
                   


    
                    $dataProvider =$model->searchEligiableStudentSupple(yii::app()->session['eligibleTerm'],yii::app()->session['eligibleYear'],yii::app()->session['MainDepartmentID']);
         
                    
                        Yii::app()->request->sendFile('SuppleEligibleList_'.yii::app()->session['eligibleTerm'].'_'.yii::app()->session['eligibleYear'].'_'.date('dmY').'.xls',
			$this->renderPartial('_eligibleListSuppleXLS', array(
				'dataProvider'=>$dataProvider,
			), true)
		);
       
        }
        
        public function actionExamEligibleListSupplePDF()
        {
                
                    $model = new Examination();

                    
                    $title = FormUtil::getTermYear(yii::app()->session['eligibleTerm'], yii::app()->session['eligibleYear']);
                    $author ='Office of the Controller of Examination';


    
                    $dataProvider =$model->searchEligiableStudentSupple(yii::app()->session['eligibleTerm'],yii::app()->session['eligibleYear'],yii::app()->session['MainDepartmentID']);
         //           $this->renderPartial('_eligableStudentSummaryPage',array('dataProvider'=>$dataProvider,),true);
   

                    //$dataProvider2 = $model->searchEligableList(yii::app()->session['eligableTerm'],yii::app()->session['eligableYear']);
  //                  $this->renderPartial('_eligableStudentList',array('rows'=>$dataProvider2,),true);
                   
                    $this->render('eligibleListSupple',array('dataProvider'=>$dataProvider,));
                
        }
        
        public function actionACIndex()
        {
                  $data = Admission::searchAdmission();
           //print_r($data);     
                
                
                $this->render('ACIndex',array(
			'data'=>$data,
		));
            
            
        }
        
        
        public function actionAcademicRecord($studentID)
        {
            
            
            if(isset($_REQUEST['studentID']))
            {
                yii::app()->session['trnsStudentID']=$_REQUEST['studentID'];
                
            }   
            elseif(isset($studentID))
            {
                yii::app()->session['trnsStudentID']=$studentID;
            }
                
            $result = Admission::model()->searchStudentPerformance(yii::app()->session['trnsStudentID']);
            $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['trnsStudentID']),"ex_adm_active=true");
                
                if($admission)
                {
                    
                         $student = Student::model()->findByPk($admission->studentID);
                         $person = Person::model()->findByPk($student->personID);
                            //$person->per_title." ".
                            yii::app()->session['trnsStudentName'] = $person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['trnsAcTerm'] = $student->stu_academicTerm;
                            yii::app()->session['trnsAcYear'] = $student->stu_academicYear;
                            yii::app()->session['trnsProCode'] = $admission->programmeCode;
                            yii::app()->session['trnsBatName'] = $admission->batchName;
                            yii::app()->session['trnsSecName'] = $admission->sectionName;
                            yii::app()->session['trnsProgramme'] = DBhelper::getProgrammeByCode($admission->programmeCode);
                           
                            $dataProvider = ModuleRegistration::model()->searchAcademicRecord(yii::app()->session['trnsStudentID']);
                            
                             $this->render('academicRecord',array('dataProvider'=>$dataProvider,'result'=>$result));
                            
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('index'));                
                }
              
            
              
	}
       
        public function actionTranscript()
        {
            
           
            if(isset($_REQUEST['studentID']))
            {
                yii::app()->session['trnsStudentID']=$_REQUEST['studentID'];
                
            }   
            yii::app()->session['lines'] = 24;
            if(isset($_REQUEST['lines']))          
            {
                yii::app()->session['lines'] = $_REQUEST['lines'];
             
            }            
            if(isset($_REQUEST['passYear']))          
            {
                yii::app()->session['passYear'] = $_REQUEST['passYear'];
             
            }
            if(isset($_REQUEST['absoluteCGPA']))          
            {
                yii::app()->session['absoluteCGPA'] = 1;             
            }
            if(isset($_REQUEST['customPassYear']))          
            {
                yii::app()->session['customPassYear'] = $_REQUEST['customPassYear'];
                if(isset($_REQUEST['resultYear']))       
                 {
                         yii::app()->session['completionYear'] = $_REQUEST['resultYear'];                    
                
                }
             
            }
            
            
           
            else
            {
                yii::app()->session['absoluteCGPA'] = 0;             
            }
          //  echo (yii::app()->session['completionYear']);
        //    exit();
         //   echo yii::app()->session['lines']; exit();
            $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['trnsStudentID']),"ex_adm_active=true");
                
                if($admission)
                {
                    
                         $student = Student::model()->findByPk($admission->studentID);
                         $person = Person::model()->findByPk($student->personID);
                            //$person->per_title." ".
                            yii::app()->session['trnsStudentName'] = $person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['trnsAcTerm'] = $student->stu_academicTerm;
                            yii::app()->session['trnsAcYear'] = $student->stu_academicYear;
                            yii::app()->session['trnsProCode'] = $admission->programmeCode;
                            yii::app()->session['trnsBatName'] = $admission->batchName;
                            yii::app()->session['trnsSecName'] = $admission->sectionName;
                            yii::app()->session['trnsProgramme'] = DBhelper::getProgrammeByCode($admission->programmeCode);
                           
                            $dataProvider = ModuleRegistration::model()->searchAcademicRecord(yii::app()->session['trnsStudentID']);
                            
                            $this->render('transcript',array('dataProvider'=>$dataProvider,));
                            
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('index'));                
                }
              
            
              
	}
        
        
        public function actionAcademicRecordXLS()
	{
         
             $dataProvider = ModuleRegistration::model()->searchAcademicRecord(yii::app()->session['trnsStudentID']);
              
                
             Yii::app()->request->sendFile('AC-Record_'.yii::app()->session['trnsStudentID'].'_'.date('dmY').'.doc',
			$this->renderPartial('_academicRecordXLS', array(
				'dataProvider'=>$dataProvider,
			), true)
		);
	}
        
          public function actionAcademicRecordPDF()
	{
              Yii::import('application.modules.admin.extensions.bootstrap.*');
		
                
                 require_once(Yii::app()->params['tcpdf']);
                 require_once(Yii::app()->params['tcpdfConf']);
                 $sid = yii::app()->session['trnsStudentID'];

              //   require_once('/your_path_to/tcpdf.php');
		
                $result = Admission::model()->searchStudentPerformance(yii::app()->session['trnsStudentID']);
                $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['trnsStudentID']),"ex_adm_active=true");
                if($admission)
                {
                    
                         $student = Student::model()->findByPk($admission->studentID);
                         $person = Person::model()->findByPk($student->personID);
                            //$person->per_title." ".
                            yii::app()->session['trnsStudentName'] = $person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['trnsAcTerm'] = $student->stu_academicTerm;
                            yii::app()->session['trnsAcYear'] = $student->stu_academicYear;
                            yii::app()->session['trnsProCode'] = $admission->programmeCode;
                            yii::app()->session['trnsBatName'] = $admission->batchName;
                            yii::app()->session['trnsSecName'] = $admission->sectionName;
                            yii::app()->session['trnsProgramme'] = DBhelper::getProgrammeByCode($admission->programmeCode);
                           
                            $dataProvider = ModuleRegistration::model()->searchAcademicRecord(yii::app()->session['trnsStudentID']);
                            
                       
                }
            
        $pdf = new AcademicRecordPDF('', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Academic Record');
		$pdf->SetSubject('Academic Record');
                //$pdf->SetPrintHeader(false);
		//$pdf->SetKeywords('example, text, report');
		//$pdf->SetHeaderData('', 0, "Tabulation Data", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, "Academic Record",'');
               // $pdf->setFooterData('Triwulan ');
               // $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
		$pdf->setHeaderFont(Array('times', '', 25));
		$pdf->setFooterFont(Array('times', '', 6));
		$pdf->SetMargins(15, 10, 15);
		//$pdf->startColumn(0)
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(0);
		$pdf->SetAutoPageBreak(TRUE, 15);
		$pdf->SetFont('times', '', 10);
        $pdf->SetPrintHeader(false);
               // $pdf->SetPrintFooter(false);
			 
        $pdf->AddPage();  
                //$this->render('_academicRecordPDF',array('dataProvider'=>$dataProvider,'result'=>$result));
                //$this->render('_academicRecordPDF',array('dataProvider'=>$dataProvider,'result'=>$result),true);
               
		$html = $this->renderPartial('_academicRecordPDF',array('pdf'=>$pdf,'dataProvider'=>$dataProvider,'result'=>$result),true);
                //$html = $this->renderPartial('_academicRecordPDF',array('dataProvider'=>$dataProvider,'result'=>$result));
			
		$pdf->writeHTML($html, true, false, true, false, '');
 
		$pdf->lastPage();
		ob_end_clean();

		$pdf->Output('AC_record_'.$sid.'-'.date('dmY').'.pdf', 'I');

	}
        
        public function actionAcTranscript($studentID=null)
        {
            
            if(isset($_REQUEST['studentID']))
            {
                yii::app()->session['trnsStudentID']=$_REQUEST['studentID'];
                
            }   
            elseif(isset($studentID))
            {
                yii::app()->session['trnsStudentID']=$studentID;
            }
                
            
            $admission = Admission::model()->findByAttributes(array('studentID'=>yii::app()->session['trnsStudentID']),"ex_adm_active=true");
                
                if($admission)
                {
                    
                         $student = Student::model()->findByPk($admission->studentID);
                         $person = Person::model()->findByPk($student->personID);
                            //$person->per_title." ".
                            yii::app()->session['trnsStudentName'] = $person->per_firstName." ".$person->per_lastName;
                            yii::app()->session['trnsAcTerm'] = $student->stu_academicTerm;
                            yii::app()->session['trnsAcYear'] = $student->stu_academicYear;
                            yii::app()->session['trnsProCode'] = $admission->programmeCode;
                            yii::app()->session['trnsBatName'] = $admission->batchName;
                            yii::app()->session['trnsSecName'] = $admission->sectionName;
                            yii::app()->session['trnsProgramme'] = DBhelper::getProgrammeByCode($admission->programmeCode);
                           
                            $sql= "select distinct * from vw_transcript  where \"studentID\"='{$admission->studentID}' ;"; 
                            $data = Yii::app()->db->createCommand($sql)->queryAll();


                            $k=1;
                            $result = array();

                            foreach($data as $item)
                            {
                                $result[$k++] = $item;
                            }
                            
                              $this->render('academicRecord2',array('result'=>$result));
                            
                }
                else
                { 
            
                    Yii::app()->user->setFlash('warning','ID does not match!!!');
                    $this->redirect(array('index'));                
                }
              
            
              
	}
        
        
        
        
        
        
        
      
}