<?php
/* @var $this AdministrationController */
/* @var $model Administration */

$this->breadcrumbs=array(
	'Student Administration'=>array('StudentAdministration'),
	'List Student'=>array('index'),
	'New Admission',
);
$this->menu=array(
    array('label'=>'Student Administration', 'url'=>array('studentAdministration')),
	array('label'=>'List Student', 'url'=>array('index')),
	array('label'=>'New Admission', 'url'=>'#','active'=>true),
);
?>


<div id="form" >
    
    <div class="title span-12">
       
            <h3>New Admission</h3>
               <h3><strong>Student ID: </strong><span class="label label-success"><?php echo $student->studentID;  ?></span></h3>
                  <h4 style="padding-right: 10px;"><strong>Batch: </strong><span class="label label-warning"> <?php echo yii::app()->session['batch']; ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['section']; ?></span></h4>
            <h4><strong>Academic Year: </strong><span class="label label-info"><?php  echo yii::app()->session['academicTerm'];  ?></span></h4>
    
    </div>
    <div class="span-4">
        <h6 style="padding-top: 20px;"><strong>Programme: </strong> <?php  echo yii::app()->session['programme']; ?></h6>
    </div>
<hr/>
<?php 

        /*if ($form=="_form_1")
        {
            echo $this->renderPartial($form, array('admission'=>$admission),false,true); 
        }
        else*/
        if ($form=="_form_2")
        {
            
            echo $this->renderPartial($form, array('admission'=>$admission,'student'=>$student,'person'=>$person,'acHistory'=>$acHistory,'jobExp'=>$jobExp),false,FALSE); 
        }
        elseif ($form=="_form_3")
        {
            echo $this->renderPartial($form, array('admission'=>$admission,'student'=>$student,'person'=>$person,'acHistory'=>$acHistory,'jobExp'=>$jobExp)); 
        }
?>
</div>