<?PHP

class ZHtml extends CHtml
{
        public static $UsrRole =array('super-admin'=>'super-admin','admin'=>'admin','head'=>'head','faculty'=>'faculty','exam'=>'exam','registry'=>'registry');
        public static $Terms =array('1'=>'Spring','2'=>'Summer','3'=>'Autumn');

        private static $ExamType =array('1'=>'Final','2'=>'Supplementary',/*'3'=>'Special Supplementary'*/);
        private static $SupplyExamType =array(2=>'Supplementary',3=>'Special Supplementary');
        private static $DeanStatus =array('Dean'=>'Dean','Dean in Charge'=>'Dean in Charge');
        private static $HeadStatus =array('Head'=>'Head','Head in Charge'=>'Head in Charge');
        
        private static $Title =array('Mr.'=>'Mr.','Ms.'=>'Ms.','Mrs.'=>'Mrs.','Dr.'=>'Dr.','Prof.'=>'Prof.','Engr.'=>'Engr.','Adv.'=>'Adv.');
        private static $BloodGroup =array('O+'=>'O+','A+'=>'A+','B+'=>'B+','AB+'=>'AB+','O-'=>'O-','A-'=>'A-','B-'=>'B-','AB-'=>'AB-','unknown'=>'unknown');
        private static $Gender =array('male'=>'male','female'=>'female');
        private static $MaritalStatus =array('single'=>'single','married'=>'married');
        
        public static $Degree =array('S.S.C.'=>'S.S.C.','H.S.C.'=>'H.S.C.','DAKHIL'=>'DAKHIL','ALIM'=>'ALIM','GCSE'=>'GCSE','GCE O-Level'=>'GCE 0-Level','GCE A-Level'=>'GCE A-Level','Graduation'=>'Graduation','Post Graduation'=>'Post Graduation','Diploma'=>'Diploma','Post Graduatoin Diploma'=>'Post Graduation Diploma','M.Phil'=>'M.Phil','PhD'=>'PhD','GED'=>'GED');
        public static $Group =array('Science'=>'Science','Humanities'=>'Humanities','Commerce'=>'Commerce','General'=>'General');
        public static $Board =array('Sylhet'=>'Sylhet','Comilla'=>'Comilla','Dhaka'=>'Dhaka','Chittagong'=>'Chittagong','Rajshahi'=>'Rajshahi','Jessore'=>'Jessore','Barisal'=>'Barisal','Dinajpur'=>'Dinajpur','Madrasah'=>'Madrasah','Technical'=>'Technical','EDEXCEL'=>'EDEXCEL','CAMBRIDGE'=>'CAMBRIDGE','University'=>'University','Open University'=>'Open University','National University'=>'National University');
        
        
        private static $Designation =array('Teachers Assistant'=>'Teachers Assistant','Lecturer'=>'Lecturer','Senior Lecturer'=>'Senior Lecturer','Assistant Professor'=>'Assistant Professor','Associate Professor'=>'Associate Professor','Professor'=>'Professor');
        private static $AccessLevel =array('0'=>'User','1'=>'Advance User','2'=>'Administrator');
        
        /*private $AdmissionStatus =array('0','1','2','3','4','5','6','7','8','9');*/
        
        private static $RegistrationType =array('Regular'=>'Regular','Retake'=>'Retake','Exampted'=>'Exampted');
       
        
        private static $ProgrammeType =array('undergraduate'=>'undergraduate','postgraduate'=>'postgraduate','diploma'=>'diploma');
        private static $ProgrammeMedium =array('English'=>'English','Bangla'=>'Bangla','Bilingual'=>'Bilingual');
        private static $CreditHour =array('1'=>'1','1.5'=>'1.5','2'=>'2','2.5'=>'2.5','3'=>'3','3.5'=>'3.5','4'=>'4','4.5'=>'4.5','5'=>'5','5.5'=>'5.5','6'=>'6');
        
        private static $moduleType = array('Lab'=>'Lab','None Lab'=>'None Lab');
        
        private static $YesNo =array('yes'=>'Yes','no'=>'No');
        private static $TrueFalse =array('t'=>'True','f'=>'False');
        
        private static $ModuleGroup =array('Core'=>'Core','Foundation'=>'Foundation','Advanced'=>'Advanced','General Education'=>'General Education','Science & Mathematics'=>'Science & Mathematics','Optional'=>'Optional','Project'=>'Project','Management'=>'Management','Human Resource Management'=>'Human Resource Management','Finance and Banking'=>'Finance and Banking','Marketing'=>'Marketing','Accounting & Information Systems'=>'Accounting & Information Systems','Management Information Systems'=>'Management Information Systems','Power'=>'Power','Electronics'=>'Electronics','Compulsory GED'=>'Compulsory GED','Optional GED'=>'Optional GED','Banking'=>'Banking','Finance'=>'Finance','Accountion Informaion System'=>'Accountion Informaion System','International Business'=>'International Business','Enterpreneurship & Small Enterprise Management'=>'Enterpreneurship & Small Enterprise Management','Health Service Management'=>'Health Service Management','Hotel, Travel & Tourism Management'=>'Hotel, Travel & Tourism Management', 'Supply Chain Management'=>'Supply Chain Management','Tourism and Hospitality Management'=>'Tourism and Hospitality Management');
        
         private static $roomType = array('Computer Lab'=>'Computer Lab','Theory'=>'Theory','Electronic Lab'=>'Electronic Lab','Electrical Lab'=>'Electrical Lab','Conference'=>'Conference','Library'=>'Library');
        private static $PaymentMethod = array(1=>'Credit Hour Basis',2=>'Monthly Basis');

       public static function enumItem($attribute)
       {
                
                if($attribute=='mod_type')
                {
                    
                    return self::$moduleType;
                }
                elseif($attribute=='usr_role')
                {
                    return self::$UsrRole;
                }
                elseif($attribute=='mod_creditHour')
                {
                    return self::$CreditHour;
                }
                elseif($attribute=='mod_group')
                {
                    return self::$ModuleGroup;
                
                }
                elseif($attribute=='mod_labIncluded')
                {
                    return self::$YesNo;
                }
                elseif($attribute=='usr_active')
                {
                    return self::$TrueFalse;
                }
                elseif($attribute=='mod_mejor')
                {
                    return self::$YesNo;
                }
                elseif(substr($attribute, -4)=='Term')
                {
                    
                    return self::$Terms;
                
                }
                
                elseif($attribute=='per_title')
                {
                    return self::$Title;
                
                }
                elseif($attribute=='per_gender')
                {
                    return self::$Gender;
                
                }
                elseif($attribute=='per_bloodGroup')
                {
                    return self::$BloodGroup;
                
                }
                elseif($attribute=='per_maritalStatus')
                {
                    return self::$MaritalStatus;
                
                }
                elseif($attribute=='stu_paymentMethod')
                {
                    return self::$PaymentMethod;
                
                }
                elseif($attribute=='ach_degree')
                {
                    return self::$Degree;
                
                }
                elseif($attribute=='ach_group')
                {
                    return self::$Group;
                
                }
                elseif($attribute=='ach_board')
                {
                    return self::$Board;
                
                }
                elseif($attribute=='pro_type')
                {
                    return self::$ProgrammeType;
                
                }
                elseif($attribute=='rom_type')
                {
                    return self::$roomType;
                
                }
                elseif($attribute=='pro_medium')
                {
                    return self::$ProgrammeMedium;
                
                }
                elseif(substr($attribute, -11)=='accessLevel')
                {
                    return self::$AccessLevel;
                
                }
                elseif($attribute=='fac_designation')
                {
                    return self::$Designation;
                
                }
                elseif($attribute=='exm_type')
                {
                    return self::$ExamType;
                
                }
                elseif($attribute=='exm_supple_type')
                {
                    return self::$SupplyExamType;
                
                }
                elseif($attribute == 'regi_type'){
                    return self::$RegistrationType;
                }
                
                
                
       }

       public static function enumActiveDropDownList($model, $attribute, $htmlOptions = array('prompt' => '-- Select --','value' => NULL,))
       {
          return CHtml::activeDropDownList( $model, $attribute,  self::enumItem($attribute), $htmlOptions);
       
       }

       public static function enumDropDownList($attribute, $select, $htmlOptions= array('prompt' => '-- Select --','value' => NULL,))
       {
           
           if(strpbrk($name, '[]'))
           {
               $attribute = str_replace(substr($name, -3), '', $name);
           }
           
           //echo $name;
           

          return CHtml::dropDownList( $attribute, $select,  self::enumItem($attribute), $htmlOptions);
       
       
       }
       
        public static function enumActiveRadioButtonList($model, $attribute, $htmlOptions=array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',))
        {            
            return CHtml::activeRadioButtonList( $model, $attribute, self::enumItem($attribute), $htmlOptions);
        }
       
         public static function enumCheckBox($model,$attribute, $htmlOptions=array())
        {
            
            return CHtml::checkBoxList( $attribute, self::enumItem($attribute), $htmlOptions);
        }
    
    
    /*   //works in mySql.
    private function enumItem($model,$attribute)
        {
                $attr=$attribute;
                self::resolveName($model,$attr);
                preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
                foreach(explode(',', $matches[1]) as $value)
                {
                        $value=str_replace("'",null,$value);
                        $values[$value]=Yii::t('enumItem',$value);
                }
                
                return $values;
        }
      
        

       public static function enumActiveDropDownList($model, $attribute, $htmlOptions)
       {
          return CHtml::activeDropDownList( $model, $attribute,ZHtml::enumItem($model,  $attribute), $htmlOptions);
       
       
       }

       public static function enumDropDownList($name, $select,$model, $htmlOptions)
       {
           if(strpbrk($name, '[]'))
           {
               $attribute = str_replace(substr($name, -3), '', $name);
           }
           
           //echo $name;
           

           return CHtml::dropDownList( $name, $select,ZHtml::enumItem($model,  $attribute), $htmlOptions);
       
       
       }
       
        public static function enumActiveRadioButtonList($model, $attribute, $htmlOptions=array())
        {
            return CHtml::activeRadioButtonList( $model, $attribute, self::enumItem($model,  $attribute), $htmlOptions);
        }
       
         public static function enumCheckBox($model,$attribute, $htmlOptions=array())
        {
            
            return CHtml::checkBoxList( $attribute, self::enumItem($model,  $attribute), $htmlOptions);
        }
        */// works in mySql end here.       
}

?>