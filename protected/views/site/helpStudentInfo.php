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
          <li class="active"><a href="#global"><i class="icon-chevron-right"></i>Admission</a></li>
          <li class=""><a href="#term-advising"><i class="icon-chevron-right"></i>Term Advising</a></li>
          <li class=""><a href="#re-admission"><i class="icon-chevron-right"></i>Re-admission (Batch Transfer)</a></li>
          <li class=""><a href="#term-admission"><i class="icon-chevron-right"></i>Term Admission</a></li>
          <li class=""><a href="#term-admission-adv"><i class="icon-chevron-right"></i> Term Admission (Adv)</a></li>
          <li class=""><a href="#retake"><i class="icon-chevron-right"></i>Retake</a></li>
          <!--<li class=""><a href="#individual-course-regi"><i class="icon-chevron-right"></i>Individual Course Registration</a></li>-->
          <li class=""><a href="#section-transfer"><i class="icon-chevron-right"></i>Section Transfer</a></li>
          <li class=""><a href="#print-admission-register"><i class="icon-chevron-right"></i>Generate Admission Register</a></li>
          <li class=""><a href="#attendance"><i class="icon-chevron-right"></i>Attendance</a></li>
        </ul>
      
      
      <!--Sidebar content-->
    </div>
    <div class="span9">
         <section id="global">
          <div class="page-header">
            <h1>Student Info</h1>
          </div>

          <h3>How to take Admission?</h3>
          <p>Student Registration process. When a student take new admission in Undergraduate or Postgraduate course. Here you can create and update a student record and their employment hesotry and academic hestory.</p>          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>
                  <p>Select Program and batch from the combo box and click on Blue Continue button.</p>
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/admission/1.png' , ' ')?>
                </div>     
              </div>
            </div>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 2</h4></span>                                          
                  <p>List of the student with some button of different color for view, update, add academic history,  add employment history and print the admission form.</p>
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/admission/2.png' , ' ')?>
                </div>                
              </div>
          </div>
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 3</h4></span>                                          
                  <p>Click on New Admission link to start admission process.</p>
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/admission/3.png' , ' ')?>
                </div>                
              </div>
          </div>
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 4</h4></span>                                        
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/admission/4.png' , ' ')?>
                </div>                
              </div>
          </div>
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 5</h4></span>                                         
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/admission/5.png' , ' ')?>
                </div>                
              </div>
          </div>                           
                   
        </section>
        
       <section id="term-advising">
          <div class="page-header">
            <h1>Term advising</h1>
          </div>

          <h3>How to take term advising?</h3>
          <p>Each student must take admission in each term. When a student take admission in a term he/she needs to advice.  For credit based student needs to assign courses for each advice according to the course are offered by the Department. And a invoice will be generated for this admitted student. Admit card of this student will be generate also.</p>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/termadvising/1.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 2</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/termadvising/2.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
        <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 3</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/termadvising/3.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 4</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/termadvising/4.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
        <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 5</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/termadvising/5.png' , ' ')?>
                </div>     
              </div>
            </div>         
                  
        </section>
        
        
         <section id="re-admission">
          <div class="page-header">
            <h1>Re-admission (Batch Transfer)</h1>
          </div>

          <h3>Re-admission (Batch Transfer)</h3>
          <p>When a student drop a term or he/she wants to continue then he take admission to a new batch.</p>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>                    
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/batch-transfer/1.png' , ' ')?>
                </div>     
              </div>
            </div>                  
           <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 2</h4></span>                    
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/batch-transfer/2.png' , ' ')?>
                </div>     
              </div>
            </div>                  
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 3</h4></span>                    
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/batch-transfer/3.png' , ' ')?>
                </div>     
              </div>
            </div> 
        </section>
         <section id="term-admission">
          <div class="page-header">
            <h1>Term admission</h1>
          </div>

          <h3>How to take term admission?</h3>
          <p>Each student must take admission in each term. When a student take admission in a term he/she needs to assign some course according to course are offered by the Department. And a invoice will be generated for this admitted student. Admit card of this student will be generate also.</p>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/termadmission/1.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 2</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/termadmission/2.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
        <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 3</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/termadmission/3.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 4</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/termadmission/4.png' , ' ')?>
                </div>     
              </div>
            </div>                
        
        </section>
        
        
        <section id="retake">
          <div class="page-header">
            <h1>Retake</h1>
          </div>

          <h3>How to retake a student?</h3>
          <p>Retake</p>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/retake/1.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 2</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/retake/2.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
        <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 3</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/retake/3.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 4</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/retake/4.png' , ' ')?>
                </div>     
              </div>
            </div>                
        
        </section>
        
         <section id="section-transfer">
          <div class="page-header">
            <h1>Section Transfer</h1>
          </div>

          <h3>How to transfer a student?</h3>
          <p>Section transfer</p>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/section-transfer/1.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 2</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/section-transfer/2.png' , ' ')?>
                </div>     
              </div>
            </div>                 
              
        </section>
        
        <section id="print-admission-register">
          <div class="page-header">
            <h1>Admission Register</h1>
          </div>

          <h3>How to transfer a student?</h3>
          <p>Admission Register</p>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/admission-register/1.png' , ' ')?>
                </div>     
              </div>
            </div>                               
              
        </section>
        
         <section id="attendance">
          <div class="page-header">
            <h1>Admission Register</h1>
          </div>

          <h3>How to transfer a student?</h3>
          <p>Admission Register</p>
          <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 1</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/attendance/1.png' , ' ')?>
                </div>     
              </div>
            </div>          
          
           <div class="media">               
              <div class="media-body">
                  <span class="label label-info"><h4>Step 2</h4></span>                          
                <!-- Nested media object -->
                <div class="media">
                  <?php echo CHtml::image(Yii::app()->baseUrl . '/images/help/studentinfo/attendance/2.png' , ' ')?>
                </div>     
              </div>
            </div>             
              
        </section>
      <!--Body content-->
      
    </div>
      
    
  </div>
</div>
 


