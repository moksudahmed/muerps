<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author ron
 */
class FormUtil 
{
    //put your code here
    
        
    public static function countGender($programCode,$year,$term=null,$batchCode=null)
    {
        $student = new Student();
        return $student->countStudentByGender($programCode,$year,$batchCode,$term);
    }
    
    public static function countGenderNewlyAdmittedStudent($programCode,$year,$term=null,$batchCode=null)
    {
        $student = new Student();
        return $student->countNewlyAdmittedStudentByGender($programCode,$year,$term);
    }
    
    public static function getSemesterCGPA($terms, $result)
    {
        return  round($result/$terms, 2);
        
    }
    
    public function arrangeGroupItems($items = array(), $group = array()){
      
        $list = array();
        $k = 0;
        for($i=0; $i<count([$group]); $i++){     
           for($j=0; $j<count([$items]); $j++){
                if($items[$j] ["c_mod_group"] == $group[$i]["c_mod_group"])
                {
                  $list[$k++] = $items[$j]; 
                 }
                              
                }      
            
         }
      
        return $list;
    }
    
   function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}
    public function arrangeGroups($grouplist=array(), $groups = array())
    {
        $list = array();
        $k=0;
           
        for($i=0; $i<count([$grouplist]); $i++){         
             for($j=0; $j<count([$groups]); $j++){
                if($grouplist[$i] == $groups[$j]["c_mod_group"]){                  
                        $list[$k++]["c_mod_group"] = $groups[$j]["c_mod_group"];                  
                }
            } 
        } 
        
        return array_values(FormUtil::unique_multidim_array($list,'c_mod_group'));
    }
    public function getCourseName($groupName){
        if($groupName =='Core' || $groupName =='Advanced' || $groupName =='General Education' || $groupName =='Optional' || $groupName =='Science & Mathematics' || $groupName =='Compulsory GED' || $groupName =='Optional GED' || $groupName =='Open Elective')
             return $groupName.' Courses';        
        else if($groupName =='Marketing'|| $groupName =='Management'|| $groupName =='Banking'|| $groupName =='Finance'|| $groupName =='Accounting Informaion System'|| $groupName =='International Business'|| $groupName =='International Business'|| $groupName =='Human Resource Management' || $groupName =='Finance and Banking' || $groupName =='Accounting &amp; Information Systems' ||  $groupName =='Management Information Systems'||  $groupName =='Power'||  $groupName =='Electronics')
             return 'Specialisation Courses: '.$groupName;
        else return $groupName;
    }
    public function getMonthNameFromAcademicTerm($term){
       if($term ==1)return "January";
       else if($term == 2) return "May";
       else return "September";
   }
   public static function checkItemExists($group_name, $start, $end, $rows=array()){
         for($k=$start; $k<=$end; $k++){
			  if(isset($rows[$k])== TRUE)
            {
           
                if($group_name != $rows[$k]['c_mod_group']){
                    return true;
                }
            } 
		 }
        return false;
    }
    public static function checkHowManyItemExists($group_name, $start, $end, $rows=array()){
        $item = 0; 
      
        for($k=$start; $k<=$end; $k++){
			 if(isset($rows[$k])== TRUE)
            {
           
                if($group_name == $rows[$k]['c_mod_group']){
                    ++$item;                                      
                }
            }
		}			
        return $item;
    }
	public static function checkHowManyGroupExists($group_name, $start, $end, $rows=array()){
        $item = 1; 
        
        for($k=$start; $k<=$end; $k++){
            if(isset($rows[$k])== TRUE)
            {
                 if($group_name != $rows[$k]['c_mod_group']){                    
                    $item = $item +1;
                    $group_name = $rows[$k]['c_mod_group'];
                    echo $group_name;
                }
            }
        }
       // echo $item;exit();
            return $item;
    }

    public static function getGPA($CGPA)
    {
        IF ($CGPA == 4.00)
		return $gpa ="A+";
	ELSEIF ($CGPA >=3.75 && $CGPA <4.00) 
		return $gpa ="A";
	ELSEIF ($CGPA >=3.50 && $CGPA <3.75) 
		return $gpa ="A-";
	ELSEIF ($CGPA >=3.25 && $CGPA <3.50) 
		return $gpa ="B+";
	ELSEIF ($CGPA >=3.00 && $CGPA <3.25) 
		return $gpa ="B";
	ELSEIF ($CGPA >=2.75 && $CGPA <3.00)
		return $gpa ="B-";
	ELSEIF ($CGPA >=2.50 && $CGPA <2.75)
		return $gpa ="C+";
	ELSEIF ($CGPA >=2.25 && $CGPA <2.50) 
		return $gpa ="C";
	ELSEIF ($CGPA >=2.00 && $CGPA <2.25) 
		return $gpa ="D";
	ELSE		
		return $gpa ="F*";
    }
     public static function SearchRowByGroupName($dataArray,$group) 
      {
            for($i=1; $i<=count([$dataArray]); $i++)
            {
                if(($group == $dataArray[$i]['mod_group']))
               {
                    return true;
                }
            }
            return false;
        }
   
        
        public static function object_to_array($data)
        {
            if (is_array($data) || is_object($data))
            {
                $result = array();
                foreach ($data as $key => $value)
                {
                    $result[$key] = object_to_array($value);
                }
                return $result;
            }
            return $data;
        }
        
        
     public static function SearchRow($dataArray,$term,$year) 
      {
            for($i=1; $i<=count([$dataArray]); $i++)
            {
                if(($term == $dataArray[$i]['tra_term']) && ($year == $dataArray[$i]['tra_year']))
               {
                    return true;
                }
            }
            return false;
        }
         
      public static function getCGPA($id){
        
           $sql="SELECT * 
                   FROM  calculate_cgpa('{$id}')";                   
            
           $rows = Yii::app()->db->createCommand($sql)->queryAll();
            
            $data = $rows[0]["calculate_cgpa"];
            
            //echo var_dump($data);
          //  exit();
              
            return $data;
    }
        
        public static function CheckRetakeSupplyResult($data,$dataMax)
        {
             $result = array();
         
            for($i = 1; $i <= count([$dataMax]); $i++)
                  {
                    for ($j=1; $j <= count([$data]) ; $j++)
                     {
                        if ($data[$j]['moduleCode']== $dataMax[$i]['moduleCode'] && $dataMax[$i]['markFirstHalf'] == $data[$j]['markFirstHalf'] && $dataMax[$i]['emr_mark'] == $data[$j]['emr_mark'])      // ascending order simply changes to <
                        { 
                            $result[$i]["moduleCode"] = $data[$j]["moduleCode"]; 
                            $result[$i]["mod_group"] = $data[$j]["mod_group"];                             
                            $result[$i]["mod_name"] = $data[$j]["mod_name"];  
                            $result[$i]["mod_creditHour"] = $data[$j]["mod_creditHour"];                             
                            $result[$i]["markFirstHalf"] = $dataMax[$i]["markFirstHalf"];  
                            $result[$i]["letterGrade"] = $data[$j]["letterGrade"];  
                            $result[$i]["gradePoint"] = $data[$j]["gradePoint"];  
                            $result[$i]["cgpa"] = $data[$j]["cgpa"];  
                            $result[$i]["tra_term"] = $data[$j]["tra_term"];  
                            $result[$i]["tra_year"] = $data[$j]["tra_year"];  
                            $result[$i]["emr_mark"] = $dataMax[$i]["emr_mark"];                               
                        }
                      }
                  }
                            
           return $result;
        }
        public static function SearchSupplyData($dataArray,$courseCode){
            for($i=1; $i<=count([$dataArray]); $i++)
            {
                if(($courseCode == $dataArray[$i]['moduleCode']))
                {
                    return $i;
                }
            }
            return 0;
        }
        public static function countCompletedCredit($result)
        {
            
        }
        
       public static function ReorderData($dataArray,$pos,$previousPos)
       {                   
            $temp =  array();
            $j=1;
            for($i=1; $i<=count([$dataArray]); $i++)
            {
                if($i==$pos)
                {                    
                    $temp[$previousPos] = $dataArray[$i];
                    $temp[$previousPos]['letterGrade'] = $temp[$previousPos]['letterGrade'].'*';
                }
                else
                {
                    $temp[$j++] = $dataArray[$i];
                }
            }
            
            return $temp;
        }
        
        
        
      public static function countTotalTerm($dataArray) {
            $count = 1;
            $term = $dataArray[1]['tra_term'];
            $year = $dataArray[1]['tra_year'];
            for($i=2; $i<=count([$dataArray]); $i++)
            {
                if(($term != $dataArray[$i]['tra_term']) || ($year != $dataArray[$i]['tra_year']))
               {
                    $count++;
                    $term = $dataArray[$i]['tra_term'];
                    $year = $dataArray[$i]['tra_year'];
                }                
            }
            
            return $count;
            
        }
        
    public static function getModuleRegistrationType($type,$section,$batch)
    {
        
        
         if($type==1)
             $string = ' ';
         elseif($type==2)
             $string = "Retake With Section: {$section}, Batch: {$batch}".  FormUtil::getBatchNameSufix($batch);
         else $string ='Not Specified';
       
            return $string;
            
    }
    
    public static function get_convert_number( $num)
    {
            if($num == 0)
                    return 'ziro';
            else if($num == 1)
                    return 'one';
            else if($num == 2)
                    return 'Two';
            else if($num == 3)
                    return 'Three';
            else if($num == 4)
                    return 'Four';
            else if($num == 5)
                    return 'Five';
            else if($num == 6)
                    return 'Six';
            else if($num == 7)
                    return 'Seven';
            else if($num == 8)
                    return 'Eight';
            else if($num == 9)
                    return 'Nine';
            else if($num == 10)
                    return 'Ten';
            else if($num == 11)
                    return 'Eleven';
            else if($num == 12)
                    return 'Twelve';
            else if($num == 13)
                    return 'Thirteen';
            else if($num == 14)
                    return 'Fourteen';
            else if($num == 15)
                    return 'Fifteen';
            else if($num == 16)
                    return 'Sixteen';
            else if($num == 17)
                    return 'Seventeen';
            else if($num == 18)
                    return 'Eighteen';
            else if($num == 19)
                    return 'Ninteen';
            else if($num == 20)
                    return 'Twenty';
            else
                return 'out of range';


            
            
    }   
    
    public static  function gradePoint($totalmark){
                        
        if($totalmark>=80 && $totalmark<=100){ return 'A+';}
	else if($totalmark>=75 && $totalmark<80){return 'A';}
	else if ($totalmark>=70 && $totalmark<75){ 
		return 'A-';}
	else if ($totalmark>=65 && $totalmark<70) {
		return 'B+';}
	else if ($totalmark>=60 && $totalmark<65) {
		return 'B';}
	else if ($totalmark>=55 && $totalmark<60) {
		return 'B-';}
	else if ($totalmark>=50 && $totalmark<55) {
		return 'C+';}
	else if ($totalmark>=45 && $totalmark<50) {
		return 'C';}
	else if ($totalmark>=40 && $totalmark<45) {
		return 'D';}
	else { return 'F*';}

    }

    public static function getFormatedDate($date)
    {
        return date("jS, M Y",strtotime($date));
    }

    public static function getDateRangeByTerm($term, $year)
    {
        $date = array();
        
        if($term==1)
        {
         $date[0]= $year.'-01-01'; 
         $date[1]= $year.'-04-30';
        }
        elseif ($term==2)
        {
         $date[0]= $year.'-05-01'; 
         $date[1]= $year.'-08-31';   
        }
        elseif ($term==3) {
         $date[0]= $year.'-09-01'; 
         $date[1]= $year.'-12-31';
            
        }
        
        return $date;
        
    
        
    }

    public static function getOfferedGroupByBatch($batchName,$proCode,$ofmTerm,$ofmYear)
    {
        /*
        return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
                $sql="SELECT 
                    distinct
                    e.mod_group

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
            
                $dpt = Module::model()->findAllBySql($sql,array(':batchName'=>$batchName,':proCode'=>$proCode,':ofmTerm'=>$ofmTerm,':ofmYear'=>$ofmYear));
            
            $data =array();
            $i=0;
            
            foreach ($dpt as $item)
            {
        
        
                     $data[$i]= array('programmeCode'=>$item->mod_group,'pro_name'=>$item->mod_group);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    
                
            }
            
              
            return $data;
            
    }
    
    public static function getModuleType($type)
    {
        
        
         if($type=='None Lab')
             return ' ';
         else 
            return $type;
            
    }
    
    public static function getModuleLabIncluded($type)
    {
        
        
         if($type=='yes')
             return 'Lab Included';
         else 
            return ' ';
            
    }
    
    
    
    public static function getYear()
    {
        $date= CTimestamp::getDate();
        
         
       
        return $date['year'];
        
    }
    
    public static function getCurrentTerm()
    {
        //$month= parent::formatMonth('M', CTimestamp::getDate());
        
        $month= date('m');
        //$month=2;
        if ($month<=4 && $month >=0)
            return 1;
        elseif ($month<=8 && $month >=5) 
            return 2;
        elseif ($month<=12 && $month >=9) 
            return 3;
        
    }
    
    public static function getDeleteButtonStatus()
    {
        //$month= parent::formatMonth('M', CTimestamp::getDate());
        
        
            return 'none';
        
    }

    public static function yearForDropDown($range=2003)
    {
        $date= CTimestamp::getDate();
        
         
        $string = array();
        //$string[$date['year']-$range]='  ';
            
            for($i= $range;$i<=$date['year']+1;$i++)
            {
            
                $string[$i] =   $i;
                
            }
            
       
            return $string;
        
    }
    
    
    
    public static function getBatchNameSufix1($batch)
    {
        $number=0;
        if($batch<4 || $batch>13)
          $number = $batch%10;
        
        if($number ==1 )
            return "st";
        elseif($number == 2)
            return "nd";
        elseif($number == 3)
            return "rd";
        else   
            return "th";
        
    }

    public static function getBatchNameSufix($batch)
    {
        
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        $number=0;
        if (($batch %100) >= 11 && ($batch%100) <= 13)
           return "th";
        else
            return $ends[$batch % 10];       
        
    }

    public static function getTerm($term)
    {
        
        
         if($term==1)
             $string = 'Spring';
         elseif($term==2)
             $string = 'Summer';
         elseif($term==3)
             $string = 'Autumn';
         else {
             $string ='Not Specified';
         }
                 
       
            return $string;
        
    }
    
    public static function getTermYear($term, $year)
    {
        
        
         if($term==1)
             $string = 'Spring';
         elseif($term==2)
             $string = 'Summer';
         elseif($term==3)
             $string = 'Autumn';
         else {
             $string ='Not Specified';
         }
                 
       
            return $string." ".$year;
        
    }
    
    public static function getTermYearWithNumber($studentID,$term, $year)
    {
        
        
         if($term==1)
             $string = 'Spring';
         elseif($term==2)
             $string = 'Summer';
         elseif($term==3)
             $string = 'Autumn';
         else {
             $string ='Not Specified';
         }
            //echo $studentID.' '.$term.' '.$year;
            //exit();
       
         return FormUtil::getTermNumberByStudentID($studentID, $term, $year)." ".$string." ".$year;
        
    }
    
    public static function getTermYearWithNumberHTMLspan($studentID,$term, $year)
    {
        
        
         if($term==1)
         {
             $string = 'Spring';
             $color='success';
         }
         elseif($term==2)
         {
             $string = 'Summer';
             $color='warning';
         }
             
         elseif($term==3)
         {
             $string = 'Autumn';
             $color='info';
         }
             
         else 
         {
             $string ='Not Specified';
         }
                 
       
         return " <span style=\"color: #595959; font-size:15px;\">".$string." ".$year." </span> <sapn class=\"badge badge-{$color}\" style=\"padding:7px 5px 5px 5px; \" >".FormUtil::getTermNumberByStudentID($studentID, $term, $year)."</span>" ;
        
    }
    
    public static function getTermYearWithoutNumberHTMLspan($studentID,$term, $year)
    {
        
        
         if($term==1)
         {
             $string = 'Spring';
             
         }
         elseif($term==2)
         {
             $string = 'Summer';
             
         }
             
         elseif($term==3)
         {
             $string = 'Autumn';
             
         }
             
         else 
         {
             $string ='Not Specified';
         }
                 
       
         return FormUtil::getTermNumberByStudentID($studentID, $term, $year).' '.$string." ".$year;
        
    }
    public static function getTermYearWithNumberByBatch($batch,$programme,$term, $year)
    {
        
        
         if($term==1)
             $string = 'Spring';
         elseif($term==2)
             $string = 'Summer';
         elseif($term==3)
             $string = 'Autumn';
         else {
             $string ='Not Specified';
         }
                 
       
         return FormUtil::getTermNumber($batch,$programme, $term, $year)." ".$string." ".$year;
        
    }
    
    
    public static function getTermYearWithNumberByBatchHTMLspan($batch,$progrmme,$term, $year)
    {
        
        
         if($term==1)
         {
             $string = 'Spring';
             $color='success';
         }
         elseif($term==2)
         {
             $string = 'Summer';
             $color='warning';
         }
             
         elseif($term==3)
         {
             $string = 'Autumn';
             $color='info';
         }
             
         else 
         {
             $string ='Not Specified';
         }
                 
       
         return " <span style=\"color: #595959; font-size:15px;\">".$string." ".$year." </span> <sapn class=\"badge badge-{$color}\" style=\"padding:7px 5px 5px 5px; \" >".FormUtil::getTermNumber($batch, $progrmme, $term, $year)."</span>" ;
        
    }
    
    
    public static function getCreditHourByRegStatus($status,$credit)
    {
        return ($status==='Retaken'?' ':$credit);
        
    }

    public static function removeCreditHourByLG($lg,$credit)
    {
        return (strstr($lg,'F')!=false || $lg=='AB' ?' ':$credit);
        
    }
    


    public static function batchFlag($batTerm,$batYear,$traTerm,$traYear)
    {
        $flag = true;
        if($traYear < $batYear)
        {
        
            $flag = false;
        }
        elseif($traYear == $batYear)
        {
            if($traTerm < $batTerm) $flag = false;
        }
            
            
        return $flag;
    }
    
    
    public static function getProgrammeByGroup()
        {
               /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
            $dpt = Department::model()->findAll();
            
            $data =array();
            $i=0;
            foreach ($dpt as $itme)
            {
                    $pro = Programme::model()->findAllByAttributes(array('departmentID'=>$itme->departmentID));
                    
                    
                    foreach ($pro as $item2) {

        
                     $data[$i]= array('programmeCode'=>$item2->programmeCode,'pro_name'=>$item2->pro_name,'group'=>$itme->dpt_name);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    }
                
            }
            
               
            return $data;
             
        }
    
        public static function getProgrammeByGroupByDepartmentID($id)
        {
               /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
            if(yii::app()->user->getState('role')=='super-admin'|| yii::app()->user->getState('role')=='admin' || yii::app()->user->getState('role')=='exam' || yii::app()->user->getState('role')=='admission'|| yii::app()->user->getState('role')=='registry' || yii::app()->user->getState('role')=='deo')
            {
                    $dpt = Department::model()->findAll(); 
                
            }
            else
            {
                    $dpt = Department::model()->findAllByAttributes(array('departmentID'=>$id));
            }
                
            
            $data =array();
            $i=0;
            foreach ($dpt as $itme)
            {
                    $pro = Programme::model()->findAllByAttributes(array('departmentID'=>$itme->departmentID));
                    
                    
                    foreach ($pro as $item2) {

        
                     $data[$i]= array('programmeCode'=>$item2->programmeCode,'pro_name'=>$item2->pro_name,'group'=>$itme->dpt_name);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    }
                
            }
            
               
            return $data;
             
        }
        
    public static function getBatchSection($programmeCode,$startBatch)
    {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if($programmeCode)
		{
			
		
                    $model = Batch::model()->findAllByAttributes(array('programmeCode'=>$programmeCode,'ex_bat_active'=>true));
                    
                          /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/

                    

                    $data =array();
                    $i=0;
                    foreach ($model as $item)
                    {   //echo $item->batchName;
                            $sec = Section::model()->findAllByAttributes(array('batchName'=>$item->batchName,'programmeCode'=>$item->programmeCode));

                            
                            foreach ($sec as $item2) {
                                if($item2->batchName>$startBatch)
                                {
                                    $group = $item->batchName.FormUtil::getBatchNameSufix($item->batchName)." -- ".  FormUtil::getTerm($item->bat_term)." ".$item->bat_year;
                                    $value =$item2->sectionName."-".$item2->batchName."-".$item2->programmeCode."-".$item->bat_term."-".$item->bat_year;
                                    $text="Section: ".$item->batchName.FormUtil::getBatchNameSufix($item->batchName)." ".$item2->sectionName;
                                    $data[$i]= array('section-batch'=>$value,'sectionName'=>$text,'group'=>$group);   
                                 //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');

                                    $i++;
                                }
                            }

                    }
                    return $data;
        }
        
    }
    
    public static function getRegWithBatchSection($batchName,$sectionName)
    {
                   return $batchName.FormUtil::getBatchNameSufix($batchName).'['.$sectionName.']';
        
    }
    
    public static function getOfferedModuleTerm($sectionName,$batchName,$programmeCode)
    {
            
                //yii::app()->session['batName']=$_REQUEST['batchName'];
		if($programmeCode && $batchName)
		{
			
		
                    $model = Batch::model()->findByAttributes(array('programmeCode'=>$programmeCode,'batchName'=>$batchName,'ex_bat_active'=>true));
                    
                          /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
                    $data =array();
                    if( $model->bat_term==1 )
                    {
                              
                              $x=0;
                              for($i=$model->bat_year;$i<$model->bat_year+4;$i++)
                              {
                                  
                                  
                                  for($j=1;$j<4;$j++)
                                  {
                                      
                                      
                                        $class=(OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$programmeCode,'batchName'=>$batchName,'sectionName'=>$sectionName,'ofm_term'=>$j,'ofm_year'=>$i))?' -Already Offered- ':'');
                          
                                        $term =FormUtil::getTerm($j).$class;
                                        $data[$x]= array('ofmTermYear'=>$j.'-'.$i,'ofm_term'=>$term,'group'=>$i);   
                                        $x++;    
                                  }
                                  
                      
                              }
                              
                     }
                     else
                     {
                              
                              
                            $x=0;
                              for($i=$model->bat_year;$i<$model->bat_year+5;$i++)
                              {
                              
                                  
                                  if($i==$model->bat_year)
                                  {
                                        for($j=$model->bat_term;$j<4;$j++)
                                        {
                                        
                                           $class=(OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$programmeCode,'batchName'=>$batchName,'sectionName'=>$sectionName,'ofm_term'=>$j,'ofm_year'=>$i))?' -Already Offered- ':'');
                          
                                            $term =FormUtil::getTerm($j).$class;
                                           $data[$x]= array('ofmTermYear'=>$j.'-'.$i,'ofm_term'=>$term,'group'=>$i);        
                                           $x++;
                                        }
                                  }
                                  elseif($i==$model->bat_year+4)
                                  {
                                      
                                      for($j=1;$j<$model->bat_term;$j++)
                                        {
                                            $class=(OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$programmeCode,'batchName'=>$batchName,'sectionName'=>$sectionName,'ofm_term'=>$j,'ofm_year'=>$i))?' -Already Offered- ':'');
                          
                                        $term =FormUtil::getTerm($j).$class;
                                            $data[$x]= array('ofmTermYear'=>$j.'-'.$i,'ofm_term'=>$term,'group'=>$i);        
                                            $x++;

                                        }
                                      
                                  }
                                  else
                                  {
                                      for($j=1;$j<4;$j++)
                                        {
                                           $class=(OfferedModule::model()->findAllByAttributes(array('programmeCode'=>$programmeCode,'batchName'=>$batchName,'sectionName'=>$sectionName,'ofm_term'=>$j,'ofm_year'=>$i))?' -Already Offered- ':'');
                          
                                        $term =FormUtil::getTerm($j).$class;
                                            $data[$x]= array('ofmTermYear'=>$j.'-'.$i,'ofm_term'=>$term,'group'=>$i);        
                                            $x++;


                                        }
                                      
                                  }
                                  
                                  
                              }
                              
                          }

                    
                    return $data;
        }
        
    }
    
    public static function getAdmissionStatus($status)
    {
        
        if($status==0)
        {
            return '';
        }
        else
        {
            return $status.FormUtil::getBatchNameSufix($status)." re-admission (batch-transfer)";
        }
    }
    
    public static function getModuleRegistrationBatchSectionNew($batch,$section,$proCode)
    {
        return FormUtil::getAcademicYear($batch, $proCode)." [".$section."]";
    }
    
    
    
    
    public static function getModuleRegistrationBatchSection($batch,$section)
    {
        return $batch.FormUtil::getBatchNameSufix($batch)." [".$section."]";
    }
    
    public static function getBatchTermName($section,$batch,$proCode,$semesterYear=2021,$semesterTerm=3)
    {
        $batchObj = Batch::model()->findByAttributes(array('batchName'=>$batch,'programmeCode'=>$proCode));
        
        if($batchObj->bat_term==1)$label="label-success";
        elseif($batchObj->bat_term==2)$label="label-warning";
        else $label="label-info";
        
        $batchAC= "<strong style=\"\">Batch: </strong><span class=\"label {$label}\" style=\" padding:10px 3px 3px 15px; font-size:20px;\">".$batch.FormUtil::getBatchNameSufix($batch)."</span><strong style=\"\"> Section: </strong><span class=\"label label-important\" style=\" padding:10px 3px 3px 15px; font-size:20px; \">".$section."</span>
                <i class=\"icon-info-sign\"  data-toggle=\"tooltip\" title=\"".FormUtil::getTerm($batchObj->bat_term)." ".$batchObj->bat_year."\"></i>";
        
        $semester= "<strong>Semester: </strong><span class=\"label {$label}\" style=\" padding:10px 3px 3px 15px;\" >".FormUtil::getTerm($batchObj->bat_term)." ".$batchObj->bat_year."</span> <span class=\"label label-important\" style=\" padding:10px 3px 3px 15px;\" >".$section."</span>
                <sup><i class=\"icon-info-sign\"   data-toggle=\"tooltip\" title=\"".$batch.FormUtil::getBatchNameSufix($batch)." ".$section."\"></i></sup>";
        if($batchObj->bat_year == $semesterYear && $batchObj->bat_term>=$semesterTerm) 
        {
            return $semester; 
            
        }
        elseif($batchObj->bat_year >= $semesterYear+1)
        {
           // return "Sem: ".FormUtil::getTerm($batchObj->bat_term)." ".$batchObj->bat_year."    [".$batch.FormUtil::getBatchNameSufix($batch)." ".$section."]";
            return $semester;
        }
        else
        {
            return $batchAC;
        }
        
    }

    public static function getBatchTermHTMLspan($section,$batch,$proCode,$semesterTerm=3, $semesterYear=2020)
    {
        $batchObj = Batch::model()->findByAttributes(array('batchName'=>$batch,'programmeCode'=>$proCode));
        
        if($batchObj->bat_term==1)$label="label-success";
        elseif($batchObj->bat_term==2)$label="label-warning";
        else $label="label-info";
        
        $batchAC= "<strong>Batch: </strong><span class=\"label {$label}\">".$batch.FormUtil::getBatchNameSufix($batch)."</span><strong> Section: </strong><span class=\"label label-important\">".$section."</span>
                <i class=\"icon-info-sign\"  data-toggle=\"tooltip\" title=\"".FormUtil::getTerm($batchObj->bat_term)." ".$batchObj->bat_year."\"></i>";
        
        $semester= "<strong>Semester: </strong><span class=\"label {$label}\">".FormUtil::getTerm($batchObj->bat_term)." ".$batchObj->bat_year."</span>
                <sup><i class=\"icon-info-sign\"   data-toggle=\"tooltip\" title=\"".$batch.FormUtil::getBatchNameSufix($batch)." ".$section."\"></i></sup>";
        if($batchObj->bat_year == $semesterYear && $batchObj->bat_term>=$semesterTerm) 
        {
            return $semester; 
            
        }
        elseif($batchObj->bat_year >= $semesterYear+1)
        {
           // return "Sem: ".FormUtil::getTerm($batchObj->bat_term)." ".$batchObj->bat_year."    [".$batch.FormUtil::getBatchNameSufix($batch)." ".$section."]";
            return $semester;
        }
        else
        {
            return $batchAC;
        }
        
        
    }

    public static function getModuleTitleHTMLspan($moduleTitle,$facultyID)
    {
       // $batchObj = Batch::model()->findByAttributes(array('batchName'=>$batch,'programmeCode'=>$proCode));
        
       return $moduleTitle."<i class=\"icon-info-sign\"  data-toggle=\"tooltip\" title=\"{$facultyID}\"></i>";
        
        
        
        
    }
    
    public static function getBatchName($batch)
    {
        return $batch.FormUtil::getBatchNameSufix($batch);
    }
    
    public static function getAdmitPrintStatus($status)
    {
        if($status)
            return "Ready To Print";
        else return "not";
    }

    
    public static function getRegisteredModuleNameCode($model)
    {/*
               return array(
                        array('offeredModuleID'=>count($model),'mod_name'=>count($model),'mod_group'=>'Electrical'),
                        array('offeredModuleID'=>257,'mod_name'=>'Radio','mod_group'=>'Electrical'),
                        
                );
       */
            
            $data =array();
            $i=0;
            foreach ($model as $item)
            {
                    
                    //$value= $item->moduleCode.':'.$item->syllabusCode;
                    $text =$item->moduleCode.':'.$item->mod_name.'---'.$item->batchName.FormUtil::getBatchNameSufix($item->batchName).' '.$item->sectionName;
                     $data[$i]= array('offeredModuleID'=>$item->offeredModuleID,'mod_name'=>$text,'mod_group'=>$item->mod_group);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    
                
            }
            
               
            return $data;
            
        }
    
        public static function getRegisteredModulesNameWithBatch($model)
        {
               /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
            
            $data =array();
            $i=0;
            foreach ($model as $item)
            {
                //echo $item->syllabusCode;
                    //$value= $item->moduleCode.':'.$item->syllabusCode;
                    $text =$item->moduleCode.":".$item->mod_name." -- -- ".$item->batchName."[".$item->sectionName."]";
                     $data[$i]= array('offeredModuleID'=>$itme->offeredModuleID,'mod_name'=>$text,'mod_group'=>$item->mod_group);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    
                
            }
            
               
            return $data;
             
        }
        
        public static function getSMEgetModules($model)
        {
               /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
            
            $data =array();
            $i=0;
            foreach ($model as $item)
            {
                //echo $item->syllabusCode;
                    $value= $item->moduleCode.':'.$item->syllabusCode;
                    $text =$item->moduleCode.":".$item->mod_name." -- -- ".$item->batchName."[".$item->sectionName."]";
                     $data[$i]= array('offeredModuleID'=>$value,'mod_name'=>$text,'mod_group'=>$item->mod_group);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    
                
            }
            
               
            return $data;
             
        }
        
        public static function getERSregisteredModules($model)
        {
               /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
            
            $data =array();
            $i=0;
            foreach ($model as $item)
            {
                //echo $item->syllabusCode;
                    //$value= $item->moduleCode.':'.$item->syllabusCode;
                    $text =$item->moduleCode.":".$item->mod_name." -- -- ".$item->batchName."[".$item->sectionName."]";
                     $data[$i]= array('offeredModuleID'=>$item->offeredModuleID,'mod_name'=>$text,'mod_group'=>$item->mod_group);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    
                
            }
            
               
            return $data;
             
        }
        
        public static function concateValues($value= array(),$separetor=': ')
        {
            $con='';
            $i=0;
            foreach($value as $item)
            {
                if($i!=count([$value]))
                {
                    $con.= $item.$separetor;
                }
                else{
                    $con.= $item;
                }
                $i++;
            }
            
            return $con;
        }
    
        public static function removeZero($value)
        {
          
                //return  $value!=0?$value:'-';
                return $value=='AB'?$value:($value!=0?$value:'-');
            
    
        }
         public static function getTermYearForTranscript($batchName,$programmeCode,$term, $year)
    {
        
        
         if($term==1)
             $string = 'Spring';
         elseif($term==2)
             $string = 'Summer';
         elseif($term==3)
             $string = 'Autumn';
         else {
             $string ='Not Specified';
         }
                 
       
            return FormUtil::getTermNumber($batchName,$programmeCode, $term, $year)." ".$string." ".$year;
        
    }
        public static function getTermNumber($batchName,$programmeCode, $curTerm, $curYear)
        {
            
             $batch =   Batch::model()->findByPk(array('batchName'=>$batchName,'programmeCode'=>$programmeCode));
             $term = $batch->bat_term;
             $year = $batch->bat_year;
            $string;
            if($curYear>=$year  )
            {
                if($term==1)
                {
                    $string = (($curYear-$year)+1).':'.(($curTerm-$term)+1);
                }
                elseif($term == 2 )
                {
                    if($term >$curTerm)
                    {

                        $string = ($curYear-$year).':3';
                    }
                    else 
                    {
                        $string = (($curYear-$year)+1).':'.(($curTerm-$term)+1);
                    }
                }
                elseif($term==3)
                {
                    if(($curTerm-$term)==-2)
                    {

                        $string = ($curYear-$year).' : 2';
                    }
                    elseif(($curTerm-$term)==-1){
                        $string = ($curYear-$year).' : 3';
                    }
                    else 
                    {
                        $string = (($curYear-$year)+1).' : '.(($curTerm-$term)+1);
                    }
                }
            return $string;
                
           }
           else               return "Not Specified";
            
            
        }
        
        public static function getTermNumberByStudentID($studentID, $curTerm, $curYear)
        {
            //echo $studentID;
            //exit()
             $batch = Student::model()->findByPk(array('studentID'=>$studentID));
             $term = $batch->stu_academicTerm;
             $year = $batch->stu_academicYear;
             $string='';
                
                //echo $term; exit();
            if($curYear>=$year  )
            {
                if($term==1)
                {
                    $string = (($curYear-$year)+1).':'.(($curTerm-$term)+1);
                }
                elseif($term == 2 )
                {
                    if($term >$curTerm)
                    {

                        $string = ($curYear-$year).':3';
                    }
                    else 
                    {
                        $string = (($curYear-$year)+1).':'.(($curTerm-$term)+1);
                    }
                }
                elseif($term==3)
                {
                    if(($curTerm-$term)==-2)
                    {

                        $string = ($curYear-$year).' : 2';
                    }
                    elseif(($curTerm-$term)==-1){
                        $string = ($curYear-$year).' : 3';
                    }
                    else 
                    {
                        $string = (($curYear-$year)+1).' : '.(($curTerm-$term)+1);
                    }
                }
            return $string;
                
           }
           else               return "Not Specified";
            
            
        }
        
        
        public static function getTermNumberWithSufix($batchName,$programmeCode, $curTerm, $curYear)
        {
            
            //$batch =   Batch::model()->findByPk($batchName);
            $batch = Batch::model()->findByPk(array('batchName'=>$batchName,'programmeCode'=>$programmeCode));
             $term = $batch->bat_term;
             $year = $batch->bat_year;
            $string;
            if($curYear>=$year  )
            {
                if($term==1)
                {
                    $string = (($curYear-$year)+1).FormUtil::getBatchNameSufix(($curYear-$year)+1).' year :'.(($curTerm-$term)+1).FormUtil::getBatchNameSufix(($curTerm-$term)+1).' term';
                }
                elseif($term == 2 )
                {
                    if($term >$curTerm)
                    {

                        $string = ($curYear-$year).FormUtil::getBatchNameSufix($curYear-$year).' year :3rd term';
                    }
                    else 
                    {
                        $string = (($curYear-$year)+1).FormUtil::getBatchNameSufix(($curYear-$year)+1).' year:'.(($curTerm-$term)+1).FormUtil::getBatchNameSufix(($curTerm-$term)+1).' term';
                    }
                }
                elseif($term==3)
                {
                    if(($curTerm-$term)==-2)
                    {

                        $string = ($curYear-$year).FormUtil::getBatchNameSufix($curYear-$year).' year : 2nd term';
                    }
                    elseif(($curTerm-$term)==-1){
                        $string = ($curYear-$year).FormUtil::getBatchNameSufix($curYear-$year).' year : 3rd term';
                    }
                    else 
                    {
                        $string = (($curYear-$year)+1).FormUtil::getBatchNameSufix( ($curYear-$year)+1 ).' year : 1st term';
                    }
                }
            return $string;
                
           }
           else               return "Not Specified";
            
            
        }

        
        public static function getFacultyByDepartment()
        {
            /*   return array(
                        array('id'=>256,'text'=>'TV'.'ok','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV'.'oks','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
                                        $sql ="SELECT 
                     concat( 
                      p.\"per_firstName\",' ',
                      p.\"per_lastName\",' -- ',d.dpt_code) as per_name,
                      f.\"facultyID\", 
                      d.dpt_code
                    FROM 
                      tbl_j_person p, 
                      tbl_n_faculty f, 
                      tbl_b_department d
                    WHERE 
                      p.\"personID\" = f.\"facultyID\" AND
                      f.\"departmentID\" = d.\"departmentID\" AND f.ex_fac_active=true 
                      order by d.dpt_code, p.\"per_firstName\"

                        ;
                    ";
            
                    $fac = Faculty::model()->findAllBySql($sql);
                    
                    $i=0;
                    foreach ($fac as $item) {

        
                     $data[$i]= array('id'=>$item->facultyID,'text'=>$item->per_name);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    }
                
            
               
            return $data;
             

        }
        
        
                    
        public static function getFacultyByDepartmentTwo()
        {
            /*   return array(
                        array('id'=>256,'text'=>'TV'.'ok','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV'.'oks','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
                    $sql ="SELECT 
                    concat( p.per_title,' ', 
                     p.\"per_firstName\",' ',
                     p.\"per_lastName\") as per_name,
                     f.\"facultyID\", 
                     f.\"fac_designation\",
                     d.dpt_code
                   FROM 
                     tbl_j_person p, 
                     tbl_n_faculty f, 
                     tbl_b_department d
                   WHERE 
                     p.\"personID\" = f.\"facultyID\" AND
                     f.\"departmentID\" = d.\"departmentID\" AND f.ex_fac_active=true 
                     order by d.dpt_code, p.\"per_firstName\"

                       ;
                   ";

                    $fac = Faculty::model()->findAllBySql($sql);
                    
                    $i=0;
                    foreach ($fac as $item) {

        
                     $data[$i]= array('id'=>$item->facultyID,'text'=>$item->per_name.' --- '.$item->fac_designation ,'group'=>$item->dpt_code);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','depart mentID');
                
                     $i++;
                    }
                
            
               
            return $data;
             

        }
                    
        public static function getTimeSlotList()
        {
            /*   return array(
                        array('id'=>256,'text'=>'TV'.'ok','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV'.'oks','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
       
                    $sql ="select * from \"tbl_v_timeSlot\" order by tst_day";
                    $fac = TimeSlot::model()->findAllBySql($sql);
                    
                    $i=0;
                    foreach ($fac as $item) {

        
                     $data[$i]= array('id'=>$item->timeSlotCode,'text'=>$item->tst_day.'--'.$item->tst_start.' to '.$item->tst_end.' '.$item->tst_duration);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name');
                
                     $i++;
                    }
                
            
               
            return $data;
             

                    }
                    
        public static function getRoom()
        {
            /*   return array(
                        array('id'=>256,'text'=>'TV'.'ok','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV'.'oks','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
       
            
                    $fac = Room::model()->findAll();
                    
                    $i=0;
                    foreach ($fac as $item) {

        
                     $data[$i]= array('id'=>$item->roomCode,'text'=>$item->roomCode);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    }
                
            
               
            return $data;
             

                    }
        
                    
                    public static function getModuleTitleByOfferedModuleID($id)
                    {
                        
                        $sql="SELECT 
                        e.\"moduleCode\", 
                        e.mod_name
                      FROM 
                        public.tbl_e_module e, 
                        public.tbl_h_offeredmodule h
                      WHERE 
                        e.\"moduleCode\" = h.\"moduleCode\" AND
                        e.\"syllabusCode\" = h.\"syllabusCode\" AND
                        h.\"offeredModuleID\" = :id;
                      ";
                        $module =  Module::model()->findBySql($sql,array(':id'=>$id));
                        
                        
                        return $module->moduleCode.":".$module->mod_name;
                    }
  
                    public static function getCreditFeesByBatch($batName,$proCode)
                    {
                        
                        $sql="SELECT distinct
                        a.* 
                      FROM 
                        public.tbl_aa_fees a, 
                        public.tbl_f_batch b, 
                        public.tbl_ac_batchfees c
                      WHERE 
                        a.\"feesID\" = c.\"feesID\" AND
                        b.\"batchName\" = c.\"batchName\" AND
                        b.\"programmeCode\"=c.\"programmeCode\" AND
                        b.\"batchName\" = {$batName} AND 
                        b.\"programmeCode\" = '{$proCode}' AND 
                        a.fee_category = 'Tution Fee Per Credit';
                      ";
                        
                        if($batch = Fees::model()->findBySql($sql))
                        {
                            return $batch->fee_amount;
                            
                        }
                        else return 0;
                    }
                    
                    public static function getCreditFeesByStudentID($studentID,$cat='Tution Fee Per Credit')
                    {
                        
                        $sql="SELECT
                        distinct
                        a.* 
                      FROM 
                        public.tbl_aa_fees a, 
                        public.tbl_o_student o,
                        public.tbl_p_admission p,
                        public.tbl_ac_batchfees c
                      WHERE 
                        a.\"feesID\" = c.\"feesID\" AND
                        p.\"batchName\" = c.\"batchName\" AND
                        p.\"programmeCode\" = c.\"programmeCode\" AND
			p.\"studentID\" = o.\"studentID\" and 
			p.\"adm_startTerm\" = o.\"stu_academicTerm\" and 
			p.\"adm_startYear\" = o.\"stu_academicYear\" and 
			p.\"programmeCode\" = p.\"programmeCode\" and  
			o.\"studentID\"='{$studentID}' AND 
			a.fee_category = '{$cat}';
                      ";
                        
                        if($batch = Fees::model()->findBySql($sql))
                        {
                            return $batch->fee_amount;
                            
                        }
                        else return 0;
                    }
                    


            public static function getWaiverByStudentID($stuID, $ofmID)
            {
               $sql= "SELECT  
                a.wav_limit
              FROM 
                public.tbl_p_admission p, 
                public.tbl_ab_waiver a
              WHERE 
                p.\"waiverID\" = a.\"waiverID\" AND
                p.\"studentID\" = '{$stuID}' order by p.\"batchName\" desc limit 1;";
                $ad= Waiver::model()->findBySql($sql);
                //echo count($ad); exit();
                            if( count([$ad])>0)
                            { 
                               //return  (ModuleRegistration::flagRetakeByOfmIDStudentID($stuID,$ofmID)!=true?$ad->wav_limit:0);
                                return $ad->wav_limit;
                                
                            }
                            else return 0;
            }
            
            public static function getWaiverByStudentID2($stuID)
            {
               $sql= "SELECT 
                a.wav_limit
              FROM 
                public.tbl_p_admission p, 
                public.tbl_ab_waiver a
              WHERE 
                p.\"waiverID\" = a.\"waiverID\" AND
                p.\"studentID\" = '{$stuID}' order by p.\"batchName\" desc limit 1;";

                           return Waiver::model()->findBySql($sql)->wav_limit;
                            
            }
            
            
          public static function  getCreditHourByBatch($batName , $proCode)
          {
              
              
                        $sql="SELECT distinct
                            a.*  
                          FROM 
                            public.tbl_d_syllabus a, 
                            public.tbl_f_batch b
                            
                          WHERE 
                            
                            b.\"syllabusCode\" = a.\"syllabusCode\" AND
                            b.\"programmeCode\"=a.\"programmeCode\" AND
                            
                            b.\"batchName\" = {$batName} AND 
                            b.\"programmeCode\" = '{$proCode}' 
                            
                          ";
  //echo $sql;  exit();
                        if($syl = Syllabus::model()->findBySql($sql))
                        {
                            return  $syl->syl_maxCreditHour;
                        }
                        else 
                            return 0;
          }
          
          public static function  getMonthByBatch($batName , $proCode)
          {
              
              
                        $sql="SELECT distinct
                            a.*  
                          FROM 
                            public.tbl_d_syllabus a, 
                            public.tbl_f_batch b
                            
                          WHERE 
                            
                            b.\"syllabusCode\" = a.\"syllabusCode\" AND
                            b.\"programmeCode\"=a.\"programmeCode\" AND
                            
                            b.\"batchName\" = {$batName} AND 
                            b.\"programmeCode\" = '{$proCode}' 
                            
                          ";
  //echo $sql;  exit();
                        if($syl = Syllabus::model()->findBySql($sql))
                        {
                            return  $syl->syl_minMonth;
                        }
                        else 
                            return 0;
          }
          
          
          public static function  getFeesByBatch($batName , $proCode,$fees='Semester Fee')
          {
              
              
                        $sql="SELECT distinct
                              a.*  
                            FROM 
                              public.tbl_aa_fees a, 
                              public.tbl_f_batch b, 
                              public.tbl_ac_batchfees c
                            WHERE 
                              a.\"feesID\" = c.\"feesID\" AND
                              b.\"batchName\" = c.\"batchName\" AND
                                          b.\"programmeCode\"=c.\"programmeCode\" AND
                              b.\"batchName\" = {$batName} AND 
                              b.\"programmeCode\" = '{$proCode}' AND 
                              a.fee_category ='$fees';
                            ";
  //echo $sql;  exit();
                        if($batch = Fees::model()->findBySql($sql))
                        {
                        return  $batch->fee_amount;
                        }
                        else 
                            return 0;
          }
          
          public static function  getFeeFlagByStudentID($studentID , $Up=12)
          {
              
                        $term = TermAdmission::model()->findAllByAttributes(array('studentID'=>$studentID));
                        
                        if(count($term)>$Up)
                        {
                            return  false;
                        }
                        else 
                            return true;
          }
          
        public static function getBatchByProgramme($id)
        {
               /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
             $sql="select * from {{f_batch}} where \"programmeCode\"=:proCode order by \"batchName\"";
            $model = Batch::model()->findAllBySql($sql,array(':proCode'=>$id));
            
            $data =array();
            $i=0;
            
            
            
            foreach ($model as $item)
            {
                    $sec = Section::model()->findAllByAttributes(array('programmeCode'=>$id,'batchName'=>$item->batchName));
                    
                    
                    foreach ($sec as $item2) {

                        $batchName=$item->batchName.FormUtil::getBatchNameSufix($item->batchName)." Batch  [".FormUtil::getTerm($item->bat_term)." ".$item->bat_year." ]";
                        $sectionName="Section ".$item2->batchName.FormUtil::getBatchNameSufix($item2->batchName)." ".$item2->sectionName;
                        
                     $data[$i]= array('title'=>$item2->batchName.'-'.$item2->sectionName,'value'=>$sectionName,'group'=>$batchName);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
                
                     $i++;
                    }
                    
                     
                        
            }
            
               
            return $data;
            
             
        }
        
          public static function getTimeSlotByOfferedModuleID($id){
              
              
              $rou = Routine::model()->findAllByAttributes(array('offeredModuleID'=>$id));
              
              $timeSlot='';
              foreach($rou as $item)
              {
              $timeSlot= $timeSlot.' '.$item->timeSlotCode.', ';
              }
              
              return $timeSlot;
          }
          
          public static function getAcademicYear($batch,$proCode)
          {
              $bat= Batch::model()->findByPk(array('batchName'=>$batch,'programmeCode'=>$proCode));
              return FormUtil::getTerm($bat->bat_term).' '.$bat->bat_year;
          }
          
          public static function getBatchProgrammeName($proCode, $batch)
            {
               $model=  Programme::model()->findByPk($proCode);
               $name = $model->pro_shortName.$batch.FormUtil::getBatchNameSufix($batch);

                return $name;
            }
          
            
          public static function isNumeric($str)
          {
                                  
               $number = preg_replace('/\D/', '', $str);          
                $text = (string)$number;
                $textlen = strlen($text);
                if ($textlen==0) return 0;
                return 1;
          }
          
          
          
          public static function isID($str)
          {
                                  
               if (preg_match("/(^[0-9]{3})-/",$str, $matches)) 
                       return 1;
               return 0;                 
          }
          
          

          
          public static function getRetakeFlagInfo($id)
          {
              $flag="";
              if($id)
              {
                  $flag="<label>yes</label>";
              }
              
              return $flag;
          }
          
          public static function getExamType($id)
          {
              $exam = Examination::model()->findByPk($id);
              
              return ($exam->exm_type ==1?'Final':'Supplementary');
          }
          
          public static function getStudentIDBySuppleRegistration($proCode,$moduleCode,$term,$year)
          {
              $sql="SELECT 
                    sl.\"studentID\", 
                    sl.\"batchName\"
                  FROM 
                    vw_getsuppleregisteredlistnew sl
                  WHERE 
                    sl.\"moduleCode\" = '$moduleCode' AND 
                    sl.\"programmeCode\" = '$proCode' AND 
                    sl.\"exm_examTerm\" = $term AND 
                    sl.\"exm_examYear\" = $year;";
              $exam = Examination::model()->findAllBySql($sql);
              
              $value='';
              foreach ($exam as $item)
              {
                  $value = $value.$item->studentID.'  ['.$item->batchName.FormUtil::getBatchNameSufix($item->batchName).'], ';
              }
              return $value;
          }
          
          
          
          public static function getFacultyBySuppleRegistration($proCode,$moduleCode,$term,$year)
          {
              $sql="SELECT distinct
                    concat( j.\"per_firstName\", ' ',
                     j.\"per_lastName\") as faculty_name, 
                     j.per_mobile, 
                     j.per_email
                   FROM 
                     public.vw_getsuppleregisteredlistnew sl, 
                     public.tbl_h_offeredmodule h, 
                     public.tbl_j_person j
                   WHERE 
                     sl.\"moduleCode\" = h.\"moduleCode\" AND
                     sl.\"programmeCode\" = h.\"programmeCode\" AND
                     j.\"personID\" = h.\"facultyID\"

                   and
                    sl.\"moduleCode\" = '$moduleCode' AND 
                    sl.\"programmeCode\" = '$proCode' AND 
                    sl.\"exm_examTerm\" = $term AND 
                    sl.\"exm_examYear\" = $year;";
              $exam = Examination::model()->findAllBySql($sql);
              
              $value='';
              foreach ($exam as $item)
              {
                  $value = $value.$item->faculty_name.' [mo:'.$item->per_mobile.' ], ';
              }
              return $value;
          }
          
          public static function SupplyRetakeFilter($lg,$stuID,$modRegID=null,$modCode=null)
          {
              if($lg == 'F*(R)')
              {
                  $sql='SELECT 
                        (s."reg_attendence"+s."reg_classTest"+s."reg_midterm") as emr_mark
                      FROM 
                        public.tbl_s_moduleregistration s, 
                        public.tbl_h_offeredmodule h, 
                        public.tbl_u_exammarks u, 
                        public.tbl_q_termadmission q
                      WHERE 
                        s."offeredModuleID" = h."offeredModuleID" AND
                        s."moduleRegistrationID" = u."moduleRegistrationID" AND
                        q."termAdmissionID" = s."termAdmissionID" AND
                        (s."reg_attendence"+s."reg_classTest"+s."reg_midterm") > 23.5 AND
                        h."moduleCode" =  :modCode AND 
                        q."studentID" = :stuID';
                  $exm = ExamMarks::model()->findAllBySql($sql,array(':modCode'=>$modCode,':stuID'=>$stuID));
                  
                  return (count($exm)>0?'clear(R)':$lg);
                
              }
              elseif($lg == 'F*(S)')
              {
                $exm = ExamMarks::model()->findAllByAttributes(array('moduleRegistrationID' => $modRegID),'emr_mark>=15.5');
                        
      //                  =>':regID','emr_mark'=>':mrk'),array(':regID'=>$modRegID));
              
                //return 'test';
                return (count($exm)>0?"clear(S)":$lg);
              } 
              return $lg;
          }
          
        public static function getOptionGroup()
        {
               /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
            
            //$dpt = Options::model()->findAll(); 
                
            $sql = "SELECT DISTINCT \"option_group\"
                       FROM  tbl_ad_options";                   
            
            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();   
            
            $data =array();
       
            foreach ($rows as $row)
            {
                                           
                    $data[$row['option_group']]= $row['option_group']; //array('group'=>$itme->option_group);                       
                   // $data[$i]= array('group'=>$row['option_group']);                       
               
                   
                
            }
            //echo var_dump($data); exit();
               
            return $data;
             
        }
         public static function getOptionDepartment()
        {
               /*return array(
                        array('id'=>256,'text'=>'TV','group'=>'Electrical'),
                        array('id'=>257,'text'=>'Radio','group'=>'Electrical'),
                        array('id'=>256,'text'=>'TV','group'=>'other'),
                        array('id'=>257,'text'=>'Radio','group'=>'other'),
                );*/
            
            
            //$dpt = Options::model()->findAll(); 
                
            $sql = "SELECT DISTINCT \"dpt_name\"
                       FROM  tbl_b_department";                   
            
            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();   
            
            $data =array();
       
            foreach ($rows as $row)
            {
                                           
                    $data[$row['dpt_name']]= $row['dpt_name']; //array('group'=>$itme->option_group);                       
                   // $data[$i]= array('group'=>$row['option_group']);                       
               
                   
                
            }
            //echo var_dump($data); exit();
               
            return $data;
             
        }
        public static function getPanels(){
            
             $panels = array('Exam Rregistration'=>$this->renderPartial('_examRegistration',null,true,true),
           'Admit Card & Signature Sheet'=>$this->renderPartial('_admitCardIndex',null,true,true));
           return $panels;
        }
        
        public static function getGenderNo($proCode, $batchId){
            $total = 0;
            $sql ="SELECT count (tbl_o_student.\"studentID\") as total FROM public.tbl_o_student,public.tbl_j_person, public.tbl_p_admission
                    WHERE tbl_o_student.\"studentID\" = tbl_p_admission.\"studentID\" AND tbl_j_person.\"personID\" = tbl_o_student.\"personID\" AND tbl_p_admission.\"programmeCode\" = '{$proCode}' AND tbl_p_admission.\"batchName\" = '{$batchId}' AND  tbl_j_person.per_gender ='male' ;";
                     
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $str = 'Male: '. $data[0]['total'].' '; 
            $total = (int)$data[0]['total'];
            $sql ="SELECT count (tbl_o_student.\"studentID\") as total FROM public.tbl_o_student,public.tbl_j_person, public.tbl_p_admission
                    WHERE tbl_o_student.\"studentID\" = tbl_p_admission.\"studentID\" AND tbl_j_person.\"personID\" = tbl_o_student.\"personID\" AND tbl_p_admission.\"programmeCode\" = '{$proCode}' AND tbl_p_admission.\"batchName\" = '{$batchId}' AND  tbl_j_person.per_gender ='female' ;";                     
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            
            $str = $str.'Female:'. $data[0]['total']; 
            $total = $total + (int)$data[0]['total'];
            $str = $str.' '.'Total :'.$total;
           return $str; 
            
        }
     
     public static function generateResultAndTabulationParameter()
	{
            $param = array();
             
             switch(yii::app()->session['reType'])
                    {
                         //Final
                          case '1':
                                    
                                  if(yii::app()->session['retake']!=1)
                                  {
                                         // Final all subject
                                        if(yii::app()->session['group'] == '0')                                             
                                         $param =array ("programmeCode"=>(string)yii::app()->session['reProCode'],"batchName" => (integer)yii::app()->session['reBatName'],"examinationID" => (integer) yii::app()->session['examinationID']);                                                                                         
                                       
                                         // Final with group                                          
                                         else
                                          $param =array ("programmeCode"=> (string)yii::app()->session['reProCode'],"batchName" => (integer)yii::app()->session['reBatName'],"examinationID" => (integer) yii::app()->session['examinationID'], "mod_group" => yii::app()->session['group']);                                                                                            
                                        //echo $_POST['group'];        
                                   }
                                      
                                      else{
                                          
                                          //Retake with group
                                          if(yii::app()->session['group'] == '0')                                            
                                          $param =array ("programmeCode"=> (string)yii::app()->session['reProCode'],"batchName" => (integer)yii::app()->session['reBatName'],"tra_term" =>  yii::app()->session['reTerm'], "tra_year" => yii::app()->session['reYear'],"reg_status" => 'Retake');                                               
                                          
                                        //Retake without group
                                          else
                                          $param =array ("programmeCode"=> (string)yii::app()->session['reProCode'],"batchName" => (integer)yii::app()->session['reBatName'],"tra_term" =>  yii::app()->session['reTerm'], "tra_year" => yii::app()->session['reYear'],"reg_status" => 'Retake',"mod_group" => yii::app()->session['group']);
//                                          $param =array ("programmeCode"=> (string)yii::app()->session['reProCode'],"batchName" => (integer)yii::app()->session['reBatName'],"examinationID" => (integer) yii::app()->session['examinationID'], "mod_group" => yii::app()->session['group']);                                                                                            
                                         }
                                        break;
                              // Supplementry
                              case '2':                                                                
                                        $param =array ("programmeCode"=> (string)yii::app()->session['reProCode'],"batchName" => (integer)yii::app()->session['reBatName'],"examinationID" => (integer) yii::app()->session['examinationID']);                                                                                         
                                        break;                              
                             default:   break;
                         }
                 return $param;
        }
        
    public static function generateResultAndTabulation($output)
    {
        if(yii::app()->session['retake']!=1)
               $view_name = 'vw_result_final_exam';                   
        else
               $view_name = 'vw_result_final_exam_retake';                             
        $model = new Examination();
        $rows = $model->resultProcessor($output, 'vw_result_final_exam', self::generateResultAndTabulationParameter());       
        return $rows;
    }           
   
    public static function selectedSubjectForResultAndTabulation($output){
        $model = new Examination();                      
         if(yii::app()->session['retake']!=1)
            $rows = $model->resultProcessorSubjectList(  self::generateResultAndTabulationParameter());  
         else
            $rows = $model->resultProcessorSubjectList(  self::generateResultAndTabulationParameter(), 'retake');   
        return $rows;
      
    }
    
    
     public static function getOldSyllabusModule($id, $secName, $batchName, $programeCode)
    {
           $sql ="(SELECT 
              tbl_e_module.\"moduleCode\", tbl_e_module.mod_name, tbl_h_offeredmodule.\"offeredModuleID\"
            FROM 
              public.tbl_h_offeredmodule, public.tbl_e_module
            WHERE 
              tbl_h_offeredmodule.\"moduleCode\" = tbl_e_module.\"moduleCode\" AND tbl_h_offeredmodule.\"sectionName\" = '{$secName}' AND tbl_h_offeredmodule.\"batchName\" = {$batchName} AND tbl_h_offeredmodule.\"programmeCode\" = '{$programeCode}')
             EXCEPT 
            (SELECT 
              c.\"moduleCode\", c.mod_name, m.\"offeredModuleID\" 
              FROM 
              public.tbl_p_admission a, public.tbl_q_termadmission t, public.tbl_s_moduleregistration m, public.tbl_h_offeredmodule o, public.tbl_e_module c
            WHERE 
              a.\"studentID\" = t.\"studentID\" AND t.\"termAdmissionID\" = m.\"termAdmissionID\" AND o.\"offeredModuleID\" = m.\"offeredModuleID\" AND c.\"moduleCode\" = o.\"moduleCode\" AND a.\"studentID\" = '{$id}' AND a.\"programmeCode\" = '{$programeCode}' AND a.\"batchName\" = {$batchName} AND a.\"sectionName\" ='{$secName}')";
          
           $rows = Yii::app()->db->createCommand($sql)->queryAll();
           
            $data =array();
            $i=0;
            foreach ($rows as $row)
            {
                    
                    //$value= $item->moduleCode.':'.$item->syllabusCode;
                    $text =$row["moduleCode"].' '. $row["mod_name"];
                    $data[$i]= array('moduleCode'=>$text,'offeredModuleID'=>$row["offeredModuleID"]);   
                     //echo CHtml::listData($item2, 'programmeCode', 'pro_name','departmentID');
             
                     $i++;
                    
                
            }
            return $data;
            
        }
}

?>
