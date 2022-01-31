


<?php
/* @var $this ModuleController */
/* @var $model Module */

        
            $this->breadcrumbs=array(
                'Faculty Activities'=>array('facultiesFunction/index'),
                
                'Supplementary Marks Entry'
                );
        


?>

<div class="title ">
        <div class="span-16">
            <h3 >Supplementary Marks Entry</h3>

            <!--h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['mreSection'],yii::app()->session['mreBatch'],yii::app()->session['mreProCode'] ); ?></h4-->
            <h4><strong>Course: </strong><span class="label label-success"><?php echo yii::app()->session['mreModule']; ?></span></h4>
            <!--h4><strong>Faculty Name: </strong><span class="label label-info"><?php echo yii::app()->session['mreFacultyName']; ?></span></h4-->
            
            
              
        </div>
</div>
<div class="span-7">
            <h4><strong>Term: </strong><span class="label label-warning"> <?php echo FormUtil::getTerm(yii::app()->session['suppleTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php echo yii::app()->session['suppleYear']; ?></span></h4>
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?></h6>
            <h6> <?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?> <?php echo "Term Supplementary Examination ".yii::app()->session['mreYear'];?></h6>
</div>

<?php 

//$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('facultiesFunction/index') : Yii::app()->controller->createUrl('headsFunction/courseAuthentication'));
//$backTitle = (!yii::app()->session['mreUrlFlag']?'Faculty Activities' : 'Course Authentication');

$backUrl = Yii::app()->controller->createUrl('facultiesFunction/SuppleModuleMarksList');
$backTitle = (!yii::app()->session['mreUrlFlag']?'Faculty Activities' : 'Course Authentication');


$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>$backTitle,), 'visible'=>true),	
	//array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
            array('label'=>'XLS-template', 'icon'=>'icon-download' , 'url'=>'#', 'linkOptions'=>array('id'=>'xlsx','style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download',), 'visible'=>true),
	),
));

            
                ?>

<script type="text/javascript">
    $(document).on('ready',()=>{
        $('#data').hide();
    });
    $('#xlsx').on("click",()=>{
        
        var htmlstr = document.getElementById('data').outerHTML;
        var workbook = XLSX.read(htmlstr, {type:'string'});
        XLSX.writeFile(workbook, '<?php echo yii::app()->session['mreModule']; ?>_template.xlsx');
        });

</script>


    
<?php  if ($moduleReg !== null):?>
    
    
  
                    

<table id="data" class="table table-bordered span-24">
    <tr>
            <td colspan="4">
                <?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?> <?php echo "Term Supplementary Examination ".yii::app()->session['mreYear'];?>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                      <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                    <?php echo yii::app()->session['mreModule']; ?>
            </td>
        </tr>
	<tr>
                <td>
		      Student ID		
                </td>
		<td>
		      Name	
                </td>
 		<td>
                    Attendance
                </td>
                <td>
                    Class Test
                </td>
                <td>    
                    Midterm
                </td>
                <td>
                    total 60
                </td>
                <td>
                    Final
                </td>
                
                
        </tr>
   
    
         
	<?php  foreach($moduleReg as $row): ?>
            
            <?php $reg= ModuleRegistration::model()->findByPk($row['moduleRegistrationID']); 
                    $total = $reg->reg_attendence+$reg->reg_classTest+$reg->reg_midterm;
                    
                    $examID=yii::app()->session['examinationID'];
                    
                    $sql = "select * from vw_getsecondhalfmarkslist where \"moduleRegistrationID\"={$reg->moduleRegistrationID} and \"examinationID\"={$examID};";
                    
                       
                    $regFinal= ModuleRegistration::model()->findBySql($sql); 
                    
                    
                    ?>
	<tr>
                <td style="font-weight:bold;" class="span-2">
			<?php echo $row['studentID']; ?>
		</td>
       		<td class="span-3">
			<?php echo $row['per_name']; ?>
		</td>
                
                <td class="span-1">
                <?php echo ($reg->reg_attendence==0?null:$reg->reg_attendence) ?>
                </td>
                
                <td class="span-1">      
                <?php echo ($reg->reg_classTest==0?null:$reg->reg_classTest) ?>  
                </td>
                <td class="span-1">      
                <?php echo ($reg->reg_midterm==0?null:$reg->reg_midterm) ?>  
                </td>
                <td class="span-1">      
                 <?php echo ($total==0?null:$total) ?> 
                </td>
                            
                <td class="span-1">      
                  <?php  echo ($regFinal['final']==0?null:$regFinal['final']) ?>
                </td>
             
               
         
                <!--td class="span-1">      
                  <?php // echo ($regFinal['final']==0?null:$regFinal['subTotal']+$regFinal['final']) ?>
                </td-->
               
                </tr>
                <?php  endforeach; ?>
              
                
   
     

    </table>
<?php endif; ?>
    
    




