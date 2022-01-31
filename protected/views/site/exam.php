<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
	'Exam',
);


?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->


<div class="title">
    <h3>
        Exam Department

    </h3>
</div>


<?php
$this->menu=array(
    array('label'=>'Create Module', 'url'=>array('create')),
    array('label'=>'Manage Module', 'url'=>array('admin'),'active'=>true),
	array('label'=>'List Module', 'url'=>array('index','id'=>Yii::app()->session['syllabusCode'])),
	
);

?>

<div class="tree span-16">
    <ul>
        <li>
            <span class="par"><i class="icon-folder-open"></i> Exam</span> <!--a href="">Goes somewhere</a-->
            
            
            <ul>
                
                <li>
                    <span class="label label-info "><i class="icon-minus-sign"></i> Examination</span> <!--a href="">Goes somewhere</a-->
                    <ul>
		                                
                                                    <li>
                                                        <span class="label label-success "><i class="icon-minus-sign"></i> Final</span> <?php echo CHtml::link('Get Details', array('Examination/index','id'=>1)); ?>
                                                        <ul>
                                                                                        <li><span><i class="icon-leaf"></i>Admit card & signature sheet</span> <?php echo CHtml::link('Get Details', array('ExamRegistration/admitCardIndex','id'=>'Final')); ?></li>
                                                                                        <li><span><i class="icon-leaf"></i>Result</span> <?php echo CHtml::link('Get Details', array('Examination/result','id'=>1)); ?></li>
                                                                                        
                                                                                        <li><span><i class="icon-leaf"></i>Transcript</span> <?php echo CHtml::link('Get Details', array('Examination/transcriptIndex')); ?></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <span class="label label-warning "><i class="icon-minus-sign"></i> Supplementary</span> <?php echo CHtml::link('Get Details', array('Examination/index','id'=>2)); ?>
                                                        <ul>

                                                                                        <li><span><i class="icon-leaf"></i>Admit card & signature sheet</span> <?php echo CHtml::link('Get Details', array('ExamRegistration/admitCardIndex','id'=>'Supplementary')); ?></li>
                                                                                        <li><span><i class="icon-leaf"></i>Result</span> <?php echo CHtml::link('Get Details', array('Examination/index','id'=>1)); ?></li>
                                                                                        
                                                                                        
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <span class="label label-important "><i class="icon-minus-sign"></i> Special Supplementary</span> <?php echo CHtml::link('Get Details', array('Examination/index','id'=>3)); ?>
                                                        <ul>
                                                                                        <li><span><i class="icon-leaf"></i>Admit card & signature sheet</span> <?php echo CHtml::link('Get Details', array('ExamRegistration/admitCardIndex','id'=>'Special Supplementary')); ?></li>
                                                                                        <li><span><i class="icon-leaf"></i>Result</span> <?php echo CHtml::link('Get Details', array('Examination/index','id'=>1)); ?></li>
                                                                                        
                                                                                        
                                                        </ul>
                                                    </li>
                    </ul>
                </li>
                
                <li>
                    <span class="label label-info "><i class="icon-plus-sign"></i> Marking Scheme</span> <?php echo CHtml::link('Get Details', array('markingScheme/index')); ?>
                    
                </li>
            </ul >
        </li><!-- end --Exam-- nav -->
        
    </ul>
</div>
<div id="magicBox" class="span-8">
    
    
</div>
     


<script type="text/javascript">
    
$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
});    
</script>