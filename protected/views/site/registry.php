<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
	'Registry',
);


?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->

<div class="title">
    <h3>
        Registry department.

    </h3>
</div>
<!--ol class="list-view">
    <li>
        For accessing the <strong>Academic</strong> information please <?php echo CHtml::link('Click Here', array('School/index')); ?>.
    </li>
    <li>
        For getting the <strong>Administrative</strong> information please <?php echo CHtml::link('Click Here', array('site/Administration')); ?>.
    </li>

    <li>
        Student Attendance <strong></strong> information please <?php echo CHtml::link('Click Here', array('Student/attendance')); ?>.
    </li>
    <li>
        Admission Report <strong>Administrative</strong> information please <?php echo CHtml::link('Click Here', array('Admission/admissionReport')); ?>.
    </li>

    <li>
        Admission Report <strong>Programme</strong> information please <?php echo CHtml::link('Click Here', array('Admission/admissionReport_programm')); ?>.
    </li>
    <li>
        Syllabus <strong></strong> information please <?php echo CHtml::link('Click Here', array('Syllabus/syllabusPrint')); ?>.
    </li>
    <li>
        Faculty Member List <strong></strong> information please <?php echo CHtml::link('Click Here', array('Faculty/getFacultyMemberList')); ?>.
    </li>
</ol-->

<?php
$this->menu=array(
    array('label'=>'Create Module', 'url'=>array('create')),
    array('label'=>'Manage Module', 'url'=>array('admin'),'active'=>true),
	array('label'=>'List Module', 'url'=>array('index','id'=>Yii::app()->session['syllabusCode'])),
	
);

?>

<div class="tree ">
    <ul>
        <li>
            <span class="par"><i class="icon-folder-open"></i> Registry</span> <!--a href="">Goes somewhere</a-->
            <ul>
                <li>
                	<span class="label label-warning "><i class="icon-minus-sign"></i> Academic</span> <!--a href="">Goes somewhere</a-->
                    <ul>
                        <li>
	                                <span class="label label-important "><i class="icon-minus-sign"></i> Schools</span> <?php echo CHtml::link('Schools', array('school/index')); ?>
		                            <ul>
		                                <?php foreach(School::model()->findAll() as $item)
                                                    {
                                                        ?>
                                                    <li><span class="label label-success "><i class="icon-minus-sign"></i><?php echo $item->sch_name; ?></span> <?php echo CHtml::link('Departments', array('department/index', 'id'=>$item->schoolID)); ?>
                                                    
                                                        <ul>
                                                            <?php foreach(Department::model()->findAllByAttributes(array('schoolID'=>$item->schoolID)) as $item2)
                                                                {
                                                                    ?>
                                                                <li><span class="label label-info "><i class="icon-minus-sign"></i><?php echo $item2->dpt_name; ?></span> <?php echo CHtml::link('Programmes', array('programme/index', 'id'=>$item2->departmentID)); ?>
                                                                         <ul>
                                                                            <?php foreach(Programme::model()->findAllByAttributes(array('departmentID'=>$item2->departmentID)) as $item3)
                                                                                {
                                                                                    ?>
                                                                                <li><span><i class="icon-leaf"></i><?php echo $item3->pro_name.'   : ( '.$item3->pro_shortName.' )'; ?></span> <?php echo CHtml::link(' Syllabus', array('Syllabus/index', 'id'=>$item3->programmeCode)).', '.CHtml::link(' Batches', array('batch/index', 'id'=>$item3->programmeCode)); ?></li>

                                                                                <?php
                                                                                }
                                                                                ?>
                                                                         </ul>
                                                                
                                                                
                                                                </li>

                                                                <?php
                                                                }
                                                                ?>
                                                         </ul>
                                                    
                                                    
                                                    </li>

                                                    <?php
                                                    }
                                                    ?>
		                                
		                             </ul>
                        </li>
                    </ul>
                </li>
			<?php
                if(yii::app()->user->getState('role')==='super-admin')
            {            
            ?>               
			   <li>
                	<span class="label label-warning "><i class="icon-minus-sign"></i> Administrative</span> <!--a href="">Goes somewhere</a-->
                    <ul>
                        <li>
	                        <span><i class="icon-leaf"></i> Reports</span> <?php echo CHtml::link('All Reports', array('AdministrativeReport/index')); ?>
                        </li>
                        <li>
	                        <span><i class="icon-leaf"></i> Tools</span> <?php echo CHtml::link('Tools', array('Tools/index')); ?>
                        </li>
                        <li>
	                                <span class="label label-success "><i class="icon-minus-sign"></i> Tasks</span> <!--a href="">Goes somewhere</a-->
		                            <ul>
		                                
                                                    <li><span><i class="icon-leaf"></i><?php echo "Time Slots" ?></span> <?php echo CHtml::link('Time Slots', array('timeSlot/index',)); ?></li>
                                                    <li><span><i class="icon-leaf"></i><?php echo "Rooms" ?></span> <?php echo CHtml::link('Rooms', array('room/index',)); ?></li>

                                                
		                             </ul>
                        </li>
                        <li>
                        	<span class="label label-important "><i class="icon-minus-sign"></i> Human Resource</span> <!--a href="">Goes somewhere</a-->
                            <ul>
                                <li>
	                                <span class="label label-success "><i class="icon-minus-sign"></i> Academic</span> <!--a href="">Goes somewhere</a-->
		                            <ul>
		                                <?php foreach(Department::model()->findAll() as $item)
                                                    {
                                                        ?>
                                                    <li><span><i class="icon-leaf"></i><?php echo $item->dpt_name; ?></span> <?php echo CHtml::link('Faculties', array('faculty/index', 'id'=>$item->departmentID)); ?></li>

                                                    <?php
                                                    }
                                                    ?>
		                             </ul>
                                </li>
                                <li>
	                                <span class="label label-success "><i class="icon-minus-sign"></i> Administrative</span> <?php echo CHtml::link('Administrative Department', array('administration/index',)); ?>
		                            <ul>
		                                
		                                <?php foreach(Administration::model()->findAll() as $item)
                                                    {
                                                        ?>
                                                    <li><span><i class="icon-leaf"></i><?php echo $item->adm_name; ?></span> <?php echo CHtml::link('Staffs', array('employee/index', 'id'=>$item->administrationCode)); ?></li>

                                                    <?php
                                                    }
                                                    ?>
		                             </ul>
                                        
                                </li>
                            </ul>
                        </li>
                        <li>
	                        <span class="label label-important "><i class="icon-leaf"></i> Grand Child</span> <a href="">Goes somewhere</a>
                        </li>
                    </ul>
                </li>
				<?php
			}
				?>
                			<?php
                if(yii::app()->user->getState('role')==='admin')
            {            
            ?>               
			   <li>
                	<span class="label label-warning "><i class="icon-minus-sign"></i> Administrative</span> <!--a href="">Goes somewhere</a-->
                    <ul>
                        <li>
	                        <span><i class="icon-leaf"></i> Reports</span> <?php echo CHtml::link('All Reports', array('AdministrativeReport/index')); ?>
                        </li>
                        <li>
                        	<span class="label label-important "><i class="icon-minus-sign"></i> Human Resource</span> <!--a href="">Goes somewhere</a-->
                            <ul>
                                <li>
	                                <span class="label label-success "><i class="icon-minus-sign"></i> Academic</span> <!--a href="">Goes somewhere</a-->
		                            <ul>
		                                <?php foreach(Department::model()->findAll() as $item)
                                                    {
                                                        ?>
                                                    <li><span><i class="icon-leaf"></i><?php echo $item->dpt_name; ?></span> <?php echo CHtml::link('Faculties', array('faculty/index', 'id'=>$item->departmentID)); ?></li>

                                                    <?php
                                                    }
                                                    ?>
		                             </ul>
                                </li>
                                <li>
	                                <span class="label label-success "><i class="icon-minus-sign"></i> Administrative</span> <?php echo CHtml::link('Administrative Department', array('administration/index',)); ?>
		                            <ul>
		                                
		                                <?php foreach(Administration::model()->findAll() as $item)
                                                    {
                                                        ?>
                                                    <li><span><i class="icon-leaf"></i><?php echo $item->adm_name; ?></span> <?php echo CHtml::link('Staffs', array('employee/index', 'id'=>$item->administrationCode)); ?></li>

                                                    <?php
                                                    }
                                                    ?>
		                             </ul>
                                        
                                </li>
                            </ul>
                        </li>
                        <li>
	                        <span class="label label-important "><i class="icon-leaf"></i> Grand Child</span> <a href="">Goes somewhere</a>
                        </li>
                    </ul>
                </li>
				<?php
			}
				?>
            </ul>
        </li>
        
    </ul>
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