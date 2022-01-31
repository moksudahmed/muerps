
<div class ="span-10">
<?php



    OpenFlashChart2Loader::load();
       
    $title = new title( $pname );
  
     $d = array();

     $d[] = new pie_value($male, "Male $male");        // <-- blue

     $d[] = new pie_value($female, "Female $female");       // <-- grey

    

     $tmp = new pie_value(6.5, "45");

     $pie = new pie();

     $pie->start_angle(35)

         ->add_animation( new pie_fade() )

         ->add_animation( new pie_bounce(4) )

         // ->label_colour('#432BAF') // <-- uncomment to see all labels set to blue

         ->gradient_fill()

         ->tooltip( '#val# of #total#<br>#percent# of 100%' )

         ->colours(

             array(

                 '#1F8FA1',    // <-- blue

                 '#848484',    // <-- grey

             ) );



     $pie->set_values( $d );



     $chart = new open_flash_chart();

     $chart->set_title( $title );

     $chart->add_element( $pie );

         $this->widget(
          'application.extensions.OpenFlashChart2Widget.OpenFlashChart2Widget',
          array(
            'chart' => $chart,
            'width' => '100%'
          )
        );
   
?>
</div>