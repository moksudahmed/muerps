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
          <li class="active"><a href="#global"><i class="icon-chevron-right"></i> Admission</a></li>
          <li class=""><a href="#gridSystem"><i class="icon-chevron-right"></i> Term Admission/ Advising</a></li>
          <li class=""><a href="#fluidGridSystem"><i class="icon-chevron-right"></i> Course Offer</a></li>
          <li class=""><a href="#layouts"><i class="icon-chevron-right"></i> Marks Entry</a></li>
          <li class=""><a href="#responsive"><i class="icon-chevron-right"></i> Result processing</a></li>
        </ul>
      
      
      <!--Sidebar content-->
    </div>
    <div class="span9">
         <section id="global">
          <div class="page-header">
            <h1>Student Info</h1>
          </div>

          <h3>Student Info</h3>
          <p>Student Registration process. When a student take new admission in Undergraduate or Postgraduate course. Here you can create and update a student record and their employment hesotry and academic hestory.</p>
          <pre class="prettyprint linenums"><ol class="linenums"><li class="L0"><span class="dec"><?php echo CHtml::link('New Admission', CController::createUrl('site/helpAdvice'),array()) ?></span></li><li class="L1"><span class="tag">Update</span><span class="pln"> </span><span class="atn">Add academic record</span></li><li class="L2"><span class="pln">View record</span></li><li class="L3"><span class="tag">Print admission form</span></li></ol></pre>

          <h3>Term Admission/Advising</h3>
          <p>Each student must take admission in each term. When a student take admission in a term he/she will be assigned with courses according to courses offered by the Department. And a invoice will be generated for this admitted student. Admit card of this student will be generate also.</p>
          <ul>
            <li>Department Activities</li>            
            <li>Term advising</li>
          </ul>         

          <h3>Re-admission (Batch Transfer)</h3>
          <p>When a student drop a term or he/she wants to continue then the student take admission to a new batch.</p>
        </section>
        
      <!--Body content-->
    </div>
      
    
  </div>
</div>
 


