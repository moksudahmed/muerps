<div class="title span-10">
    <h5><strong>Performance Report </strong></h5>
<?php 
$data = array();
    foreach ($result as $row):
        $data[$k++]= $row;        
    endforeach; 


?>
    
</div>

<span></span>
<div class ="span-6">
  <table border="0"  style="font-size:25px; text-align: left;">
        <thead>
                        <tr>
                            <th>
                                Year
                            </th>

                            <th>
                                Term
                            </th>
                           <th>
                               Result
                            </th>
                
                        </tr>
                </thead>

                <tbody>
<?php

$data = array();

          foreach ($result as $row)
          {
              ?>
           <tr>
            <td>
                   <?php echo CHtml::encode($row['tra_year'])?>
                   
            </td>
                        <td>
                   <?php echo CHtml::encode($row['tra_term'])?>
            </td>

             <td>
                   <?php echo CHtml::encode($row['total'])?>
            </td>
            </tr>
          <?php
          }
          
         ?>
         </tbody>
    </table>
</div>
<div class ="span-6">
<?php

    OpenFlashChart2Loader::load();
     

 $data = array();

 //for( $i=0; $i<8; $i+=0.2 )
foreach ($result as $row)
 {
    
     $data[] = new pie_value(abs($row['total']), " ");        // <-- blue
     
 }

  

  

 $default_dot = new dot();

 $default_dot->size(3)->colour('#DFC329')->tooltip( '#x_label#:#val#' );

  

 $line_dot = new line();

 $line_dot->set_default_dot_style($default_dot);

 $line_dot->set_width( 2 );

 $line_dot->set_colour( '#DFC329' );

 $line_dot->set_values( $data );

  

 $y = new y_axis();

 $y->set_range( 0, 15, 1 );

  

 $chart = new open_flash_chart();

 $chart->set_title( new title( 'Student Result' ) );

 $chart->set_y_axis( $y );

 //

 // here we add our data sets to the chart:

 //

 $chart->add_element( $line_dot );

  
        $this->widget(
          'application.extensions.OpenFlashChart2Widget.OpenFlashChart2Widget',
          array(
            'chart' => $chart,
            'width' => '100%'
          )
        );
   
?>
</div>