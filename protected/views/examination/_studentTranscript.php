<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

    $this->breadcrumbs=array(
	
	
    
     'Exam Activities'=>array('examDepartment/index'),
    
        'Individual Result'
);



?>


<div class="title span-13">
                <h3 >Individual Result</h3>
                <h4><strong>ID:</strong> <span class="label label-info"><?php echo yii::app()->session['trnsStudentID']; ?> </span><br/></h4>
                <h4><strong>Name: </strong> <span class="label label-important "><?php  echo yii::app()->session['trnsStudentName']; ?></span></h4>
                <h4><strong>Academic Term: </strong><span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['trnsAcTerm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['trnsAcYear'];  ?></span></h4>
</div>           
<div class="title span-8">            
 <h5> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['trnsSecName'],yii::app()->session['trnsBatName'],yii::app()->session['trnsProCode'] ); ?></h5>   
     
         
            <h6>Programme:<?php  echo yii::app()->session['trnsProgramme']; ?></h6>
<?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Personal Profile', 'icon'=>'icon-search', 'url'=>Yii::app()->controller->createUrl('student/studentProfile', array('id'=>yii::app()->session['trnsStudentID'])), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		array('label'=>'Transcript', 'icon'=>'icon-print', 'url'=>Yii::app()->controller->createUrl('transcriptPDF'), 'linkOptions'=>array('target'=>'_blank','data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'PDF',), 'visible'=>true),
		
	),
));

?>
</div>
<div class="img-polaroid span-3" >
                <?php echo CHtml::image('./photograph/'.yii::app()->session['studentID'].'.jpg',yii::app()->session['studentName']); ?>
            </div>
<hr/>
        
            
                   
<div class="span-24">


<?php  
   // $sid = yii::app()->session['trnsStudentID'];
    $headerData = Examination::model()->searchTranscriptHeaderData($sid);

   // $sql= "select * from vw_transcript  where \"studentID\"='{$sid}' ORDER BY
     //       tra_year,tra_term,\"moduleCode\";"; 
        
    $sql= "select * from vw_transcript  where \"studentID\"='{$sid}' ;"; 
    $data = Yii::app()->db->createCommand($sql)->queryAll();
    
    $k=1;
    $result = array();
    foreach ($data as $row):
        $result[$k++]=array("studentID"=>$row["studentID"],
                            "batchName"=>$row["batchName"], 
                            "programmeCode"=>$row["programmeCode"],
                            "moduleCode"=>$row["moduleCode"],
                            "mod_name"=>$row["mod_name"], 
                            "mod_creditHour"=>$row["mod_creditHour"],
                            "markFirstHalf"=>$row["markFirstHalf"],            
                            "emr_mark"=>$row["emr_mark"],            
                            "letterGrade"=>$row["letterGrade"],
                            "gradePoint"=>$row["gradePoint"],
                            "cgpa"=>$row["cgpa"],
                            "tra_term"=>$row["tra_term"], 
                            "tra_year"=>$row["tra_year"],
                            "reg_date"=>$row["reg_date"]
                        );
    endforeach; 
    
    //$usersArray = User::model()->findAllByAttributes(array("status"=>1));
  
    
    $result = FormUtil::CheckSupplyResult($result);
    
  //  $dataProvider =   new CArrayDataProvider($result, array('keyField'=>'studentID')); 
   
    
    yii::app()->session['term'] = $result[1]['tra_term'];
    yii::app()->session['year'] = $result[1]['tra_year'];
    
    $start =1;
    
    $total = count($result); 
    
     $end = $total; 
    
     ?>
   


<?php 
$i=$start;

do
{
    $totalGrade = 0;
    $gradePoint  = 0;
    $termYear=FormUtil::getTermYearWithNumber($headerData[0]['batchName'], Student::model()->findByPk($sid)->programmeCode,yii::app()->session['term'],yii::app()->session['year']);
    $cgpa = 0;
    $totalModule =0;    
    if(FormUtil::SearchRow($result,yii::app()->session['term'],yii::app()->session['year']))
    {
        ?>
        <div class="span-23" style="text-align: right; padding-bottom: 5px; ">
            <h4>`    <?php  echo $termYear?></h4>
        </div>
        
        <?php
    
    ?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>
                    Module Code
                </th>
                <th>
                    Course Title
                </th>
                <th>
                    Credit Hour
                </th>
                <th>
                    Registration Date
                </th>
                <th>
                    Out of 60
                </th>
                <th>
                    Final (40)
                </th>
                <th>
                    Letter Grade
                </th>
                <th>
                    Grade Points per credit
                </th>
                <th>
                    Grade Point
                </th>
            </tr>
        </thead>
    <tbody>
<?php 
    for($k=1; $k<=$total; $k++)
    {
        if((yii::app()->session['term'] == $result[$k]['tra_term']) && (yii::app()->session['year'] == $result[$k]['tra_year'])){                 
            ?>
                <tr>
                        <td width="10%">
                           <?php echo  $result[$k]['moduleCode']; ?>
                        </td>
                        <td width="30%">
                            <?php echo  $result[$k]['mod_name']; ?>
                           
                        </td>
                        <td width="10%">
                            <?php 
                                echo  $result[$k]['mod_creditHour']; 
                                $totalGrade += $result[$k]['mod_creditHour']; 
                            ?>
                        </td>
                        <td width="10%">
                            <?php echo  $result[$k]['reg_date']; ?>
                            
                        </td>
                        <td width="10%">
                            <?php echo  $result[$k]['markFirstHalf']; ?>
                            
                        </td>
                        <td width="10%">
                            <?php echo  $result[$k]['emr_mark']; ?>
                            
                        </td>
                        <td width="10%">
                            <?php echo  $result[$k]['letterGrade']; ?>
                            
                        </td>                        
                         
                        <td width="15%">
                            <?php echo  $result[$k]['gradePoint']; 
                            
                            ?>
                            
                        </td>
                        <td width="15%">
                            <?php 
                                    echo  $result[$k]['cgpa']; 
                                    $gradePoint += $result[$k]['cgpa'];
                            ?>
                            
                        </td>
                    </tr>    
                    
            <?php
              
        }

      }
              ?>     
                   <tr class="success">
                        <td colspan ="7" style= "padding:10px;font-size:20px;letter-spacing:2px; text-align:right;">
                        This semester CGPA:
                        </td>
                        <td style= "padding:10px;font-size:20px;letter-spacing:2px; text-align:left;">
                            <?php
                          if($totalGrade!=0){
                                $CGPA = round($gradePoint/$totalGrade, 2);
                                    echo $CGPA;//"Grade:".FormUtil::getGPA(round($gradePoint/$totalGrade, 2)
                            }

                                    yii::app()->session['term'] = yii::app()->session['term']+1;
                                    if(yii::app()->session['term']>3)
                                    {
                                           yii::app()->session['year'] = yii::app()->session['year']+1;
                                           yii::app()->session['term'] = 1;
                                    }

                            ?>
                        </td> 
                        <td></td>
                    </tr>
             </tbody>
            </table> 
            <br></br>
              <?php
        }       
             $i++;
         ?>
            
         <?php
             
}while($i<=$end);

  ?>
</div>