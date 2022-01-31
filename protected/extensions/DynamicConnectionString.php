<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class DynamicConnectionString {
        function init()
        {
                
                     if (isset(Yii::app()->user->id))
                      {
                    
                            
                                Yii::app()->db->setActive(false);                           
                                Yii::app()->db->username = Yii::app()->user->id;
                                Yii::app()->db->setActive(true);
                        }
                        else
                        {
                            
                               Yii::app()->db->setActive(false);                           
                               Yii::app()->db->username = 'postgres';                              
                               Yii::app()->db->setActive(true);
                           }
                        
        }
}


?>
