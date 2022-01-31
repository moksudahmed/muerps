<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Department Activities'=>array('headsfunction/index'),
        
	'Routine Management'
);
    


?>


<div class="title span-20">
            <h3 class="title">Routine Management</h3>
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['batNameRtm'].FormUtil::getBatchNameSufix(yii::app()->session['batNameRtm']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['secNameRtm']; ?></span></h4>
            <h6><strong>Academic Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['acTermRtm']); ?> </span><span class="label label-success"> <?php echo yii::app()->session['acYearRtm'];  ?></span></h6>        
            
</div>
<div class="title span2">
    <h4>
    <span class="label label-info"> <?php echo FormUtil::getTermNumberWithSufix(yii::app()->session['batNameRtm'], yii::app()->session['proCodeRtm'],yii::app()->session['MainAdmTerm'] , yii::app()->session['MainAdmYear']);  ?></span>
    <span class="label label-warning"><?php echo FormUtil::getTerm(yii::app()->session['MainAdmTerm']); ?> </span>
        <span class="label label-success"> <?php echo yii::app()->session['MainAdmYear'];  ?></span>
        
        <strong style="letter-spacing:3px;">Selected Term </strong></h4>
    <h6>Programme:<?php  echo DBhelper::getProgrammeByCode(yii::app()->session['proCodeRtm']); ?></h6>
</div>
<hr/>
        </div>
    
<div class="span-24">

    
    
  
                   

<table class="table table-bordered">
    <thead>
	<tr>
            
                <th class="span-2">
		      Module code		
                </th>
		<th >
		      Name	
                </th>
 		<th  >
                     Faculty Name
                </th>
                <th  style="text-align:center;">
                     Time Slot - Room
                </th>
 	</tr>
    </thead>
    <tbody>
    
         
	<?php  $temp ='';  foreach($model as $row): ?>
        <?php  
        if($row['sectionName']!=$temp){
            $temp= $row['sectionName'];
        //echo "test";
        ?>
        <tr>
            <td style="font-weight:bold; font-size: 20px; text-align: right;" class="span-3" colspan="5">
			<?php echo $row['sectionName']; ?>
            </td>
        </tr>             
        <?php 
        }
        ?>
        
	<tr>
            
                <td style="font-weight:bold;" class="span-3">
			<?php echo $row['moduleCode']; ?>
		</td>
       		<td style="font-weight:bold;" class="span-8">
			<?php echo $row['mod_name']; ?>
		</td>
                      
                <td  class="span-4">
                   <?php echo $row['per_name']; ?>
                </td>
                <td id="routine-<?php echo $row['offeredModuleID'] ?>">
                    <?php 
                        $routine= Routine::model()->findAllByAttributes(array('offeredModuleID'=>$row['offeredModuleID']));
                        
                        $this->renderPartial('_routineManager',array('routine'=>$routine,'id'=>$row['offeredModuleID']));
                    ?>
                    
                </td>
                
        </tr>
                
             
                <?php endforeach; ?>
    </tbody>
     

    </table>

    
    
</div>



