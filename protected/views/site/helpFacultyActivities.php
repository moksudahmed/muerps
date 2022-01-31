<?php
/* @var $this RegistryController */

$this->breadcrumbs=array(
    'Help'=>array('site/help'),
	'Help','Student Info',
);
?>
<!--h1><?php echo $this->id . '/' . $this->action->id; ?></h1-->
<div class="container-fluid">
  <div class="row-fluid">    
      <div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav affix">
          <li class="active"><a href="#marks-entry"><i class="icon-chevron-right"></i>Marks Entry</a></li>
          <li class=""><a href="#attendance"><i class="icon-chevron-right"></i>Print Attendance</a></li>          
        </ul>
      
      
      <!--Sidebar content-->
    </div>
    <div class="span9">
         <section id="marks-entry">
          <div class="page-header">
            <h1>Marks Entry</h1>
          </div>

          <h3>How to entry marks?</h3>
          <p>Student Registration process. When a student take new admission in Undergraduate or Postgraduate course. Here you can create and update a student record and their employment hesotry and academic hestory.</p>          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/faculty/marks-entry/1.png' , ' ')?>
                </div>     
              </div>
            </div>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 2</h4></span>
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/faculty/marks-entry/2.png' , ' ')?>
                </div>     
              </div>
            </div>
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 3</h4></span>
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/faculty/marks-entry/3.png' , ' ')?>
                </div>     
              </div>
            </div>
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 4</h4></span>
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/faculty/marks-entry/4.png' , ' ')?>
                </div>     
              </div>
            </div>
          
              <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 5</h4></span>
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/faculty/marks-entry/5.png' , ' ')?>
                </div>     
              </div>
            </div>                 
                   
        </section>
        
       <section id="attendance">
          <div class="page-header">
            <h1>Attendance</h1>
          </div>

          <h3>How to print attendance?</h3>
          <p>Each student must take admission in each term. When a student take admission in a term he/she needs to advice.  For credit based student needs to assign courses for each advice according to the course are offered by the Department. And a invoice will be generated for this admitted student. Admit card of this student will be generate also.</p>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/faculty/attendance/1.png' , ' ')?>
                </div>     
              </div>
            </div>          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 2</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/faculty/attendance/2.png' , ' ')?>
                </div>     
              </div>
            </div>          
                  
        </section>
        
        
        
        
        
      <!--Body content-->
      
    </div>
      
    
  </div>
</div>
 


