<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
    'Help'=>array('site/help'),
	'Help',
);
?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->
<div class="container-fluid">
  <div class="row-fluid">    
      <div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav affix">            
          <li class=""><a href="index.php?r=site/helpStudentInfo"><i class="icon-chevron-right"></i>Student Info</a></li>
          <li class=""><a href="index.php?r=site/helpFacultyActivities"><i class="icon-chevron-right"></i> Faculty Activities</a></li>
          <li class=""><a href="index.php?r=site/helpDeptActivities"><i class="icon-chevron-right"></i> Department Activities</a></li>
          <li class=""><a href="index.php?r=site/helpExamActivities"><i class="icon-chevron-right"></i> Exam Activities</a></li>
          
        </ul>
      
      
      <!--Sidebar content-->
    </div>
    <div class="span9">
         <section id="global">
          <div class="page-header">
            <h1>Student Info</h1>
          </div>

          <h3>Department Activities</h3>
          <p>Student Registration process. When a student take new admission in Undergraduate or Postgraduate course. Here you can create and update a student record and their employment hesotry and academic hestory.</p>
          <pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="dec"><?php echo CHtml::link('New Admission', CController::createUrl('site/helpStudentInfo'),array()) ?></span></li><li class="L1"><span class="tag">Update</span><span class="pln"> </span><span class="atn">Add academic record</span></li><li class="L2"><span class="pln">View record</span></li><li class="L3"><span class="tag">Print admission form</span></li></ol></pre>

          <h3>Term Admission/Advising</h3>
          <p>Each student must take admission in each term. When a student take admission in a term he/she needs to assign some course according to course are offered by the Department. And a invoice will be generated for this admitted student. Admit card of this student will be generate also.</p>
          <ul>
            <li>Term admission</li>            
            <li>Term advising</li>
          </ul>         

          <h3>Re-admission (Batch Transfer)</h3>
          <p>When a student drop the term or he/she wants to continue then he take admission to a new batch.</p>
        </section>
        
      <!--Body content-->
    </div>
      
    
  </div>
</div>
 


