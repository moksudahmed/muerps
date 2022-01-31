<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Registry'=>array('site/registry'),
    
	'Administrative Report'=>array('index'),
	'Yearly Admission Report Graph',
);
?>
<div class="title">
    <h3>Yearly Admission Report Graph</h3>        
</div>



<div class="title span-10">

<?php 


$this->widget('bootstrap.widgets.TbGroupGridView', array(
   // 'filter'=>$person,
    'type'=>'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}\n{extendedSummary}",
    'columns' => array(
                   // $groupGridColumns,
                    array('name' => 'stu_academicYear','header' => 'Year'),
                    array('name' => 'total','header' => 'Total'),
                   
            
                ),
    'chartOptions' => array(
        'defaultView' => true,
        'data' => array(
            'series' => array(
                array(
                    'name' => 'Total',
                    'attribute' => 'total'
                )
            ),
            'xAxis' => array(
                'categories' => 'firstName',
            ),
        ),
        'config' => array(
            'chart' => array(
                // 'width' => '800' // default reflow
            )
        ),
    ),
));


?>
</div>
<span></span>
 <div class ="span-12">
    <?php
/*
        OpenFlashChart2Loader::load();





        $year = array();

        $data = array();
        $count =0;
        $y = 0;
        foreach ($result as $row)
         {
             $y = $row['stu_academicYear'];
            
             $year[] =  (string)$y;
             $data[] = new pie_value(abs($row['total']), "");        // <-- blue
             $count++;
         }

        $chart = new open_flash_chart();



         $title = new title( 'Admission Report' );

         $title->set_style( "{font-size: 20px; color: #A2ACBA; text-align: center;}" );

         $chart->set_title( $title );



         $area = new area();

         $area->set_colour( '#5B56B6' );

         $area->set_values( $data );

         //$area->set_key( '', 12 );

         $chart->add_element( $area );



         $x_labels = new x_axis_labels();

         $x_labels->set_steps( 1 );

         $x_labels->set_vertical();

         $x_labels->set_colour( '#A2ACBA' );

         $x_labels->set_labels( $year );



         $x = new x_axis();

         $x->set_colour( '#A2ACBA' );

         $x->set_grid_colour( '#D7E4A3' );

         $x->set_offset( false );

         $x->set_steps(4);

         // Add the X Axis Labels to the X Axis

         $x->set_labels( $x_labels );



         $chart->set_x_axis( $x );



         //

         // LOOK:

         //
         $count--; 
         $range = $year[0].' to '.$year[$count];
         $x_legend = new x_legend( $range);

         $x_legend->set_style( '{font-size: 20px; color: #778877}' );

         $chart->set_x_legend( $x_legend );



         //

         // remove this when the Y Axis is smarter

         //

         $y = new y_axis();

         $y->set_range( 0, 2000, 500 );

         $chart->add_y_axis( $y );
                $this->widget(
                  'application.extensions.OpenFlashChart2Widget.OpenFlashChart2Widget',
                  array(
                    'chart' => $chart,
                    'width' => '100%',
                      
                  )
                );*/

        ?>
    </div>
   