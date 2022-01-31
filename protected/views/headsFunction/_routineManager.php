<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<table>
                        <tbody
                            <?php   foreach($routine as $data):?>
                            <?php $i= $data['routineID']; ?>
                            <tr>
                               
                                
                                
                                <td>  <?php  $this->widget(
    'bootstrap.widgets.TbEditableField',
    array(
        
    'type' => 'select',
    'model' => $data,
    'attribute' =>'timeSlotCode',
    'source' =>CHtml::listData(FormUtil::getTimeSlotList(), 'id', 'text','group'),
    'url' => Yii::app()->createUrl("headsFunction/timeSlotEditable", array("id"=>$data['offeredModuleID'])),
    )
    ); ?></td>
                                <td id="roomCode-<?php echo $i; ?>">  <?php  $this->widget(
    'bootstrap.widgets.TbEditableField',
    array(
        
    'type' => 'select',
    'model' => $data,
    'attribute' =>'roomCode',
    'source' =>CHtml::listData(Room::model()->findAll(), 'roomCode', 'roomCode'),
    'url' => Yii::app()->createUrl("headsFunction/roomTest", array("id"=>$data['offeredModuleID'])),
    )
    ); ?></td>
                                <td id="temp-<?php echo $i; ?>"><?php echo $data['roomCode']; ?></td>
                                
                            </tr>
                            <script type="text/javascript">
    
    
    
    
        $(function(){
        $(window).load(function () {
            
            if($("#temp-<?php echo $i; ?> ").text()!==''){    
            $("#roomCode-<?php echo $i; ?> a").text($("#temp-<?php echo $i; ?> ").text()); 
            $("#temp-<?php echo $i; ?> ").hide();    
            }
        });
        
});
</script>
<?php endforeach; ?>                            
                            
                        </tbody>
                    </table>

<div class="span-8" style="text-align: right;">
    
    
                                        <?php  echo CHtml::ajaxButton('Add New',Yii::app()->createUrl("headsFunction/createNewRoutine", array("id"=>$id)),array(
                    'type'=>'POST', //request type
          //'url'=>CController::createUrl('headsFunction/marksEntryProCode'), //url to call.
                    
                    'update'=>'#routine-'.$id, //selector to update
                    
                    ),array('class' => 'btn btn-primary btn-small','data-loading-text'=>'Loading....'));  ?>
                                
                                
</div>

