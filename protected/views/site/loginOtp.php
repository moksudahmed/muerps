<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>



<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'loginForm',
        //'formName'=>'loginForm',
	'enableClientValidation'=>true,
        'action'=>CController::createUrl('site/loginOtp'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>(array('name'=>'loginForm','autocomplete'=>'off',)),
)); 

            echo CHtml::hiddenField('otp_username', $model->username);
            echo CHtml::hiddenField('otp_password', $model->password);

?>

	

	<h6 ><strong style="padding-right: 10px;">You Are:</strong><span class="label label-success"><?php echo yii::app()->session['MainFacultyName']; ?></span></h6>
        <h6 ><strong style="padding-right: 10px;">From:</strong><span class="label label-info"><?php echo FormUtil::getDepartmentByID(yii::app()->session['MainDepartmentID'],yii::app()->session['MainUserType']); ?></span></h6>
        <h6 ><strong style="padding-right: 10px;">Your Email:</strong><span class="label label-important"><?php echo yii::app()->session['MainEmail']; ?></span></h6>
        <div id="otpDiv" class="row">
		
		<?php echo $form->error($model,'msg'); ?>
		
	</div>
        <div  class="row">
		<?php echo $form->labelEx($model,'otp'); ?>
		<?php echo $form->textField($model,'otp'); ?>
		<?php echo $form->error($model,'otp'); ?>
		
	</div>
        
        <div id="data" class="row buttons">
        <?php // echo CHtml::ajaxButton('OTG', CController::createUrl('site/loginOTP'), array('type'=>'POST','update'=>'#otp'), array('class' =>'btn btn-success btn-large','data-loading-text'=>'Loading...')); ?>
	
	
	<?php  echo  CHtml::submitButton('login', array('id'=>'login','class' =>'btn btn-success btn-large','data-loading-text'=>'Loading...')); ?>	
        </div>
        

<?php $this->endWidget(); ?>
</div><!-- form -->

<script type="text/javascript">
 /*   $(function(){
            $(window).on("load", ()=>{
                //alert('Bismillah Hir Rahmanir Rahim');
               // $("#otpDiv").hide();
                $("#login").hide();
            });
            
            
            $( "#otp" ).on( "click", ( ) => { 
               // alert('ok');
              var formData = new FormData(document.forms.loginForm);  
              var res;
                var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  //document.getElementById("data").innerHTML = this.responseText;
                  res = this.responseText;
                  ok(res);
                }
              };
              xhttp.open("POST", "<?php echo CController::createUrl('site/loginOTP') ?>", true);
              //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send(formData); 
            });
            
            function ok(res){
             //alert(res);
                if(res)
                {
                    $("#otp").hide('slow');
                    //$("#otpDiv").show('slow');
                    $("#login").show('slow');
                }
                else
                {
                     alert('no');
                }
            }

}); */
</script>