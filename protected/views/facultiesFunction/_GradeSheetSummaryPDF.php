<table border="0"  style="font-size:28px; text-align: left; ">
    <tr>
        <th>Summary</th>
        <th style="width: 50%; text-align: right;"><i>** R = Retake, S = Supplementary</i></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
    </tr>
</table>

<table border="0"  style="font-size:28px; text-align: left; ">
        <thead>
                   
                  <tr>
                      
                      <th>                        
                        <?php 
                            echo 'A+'.' = '.$this->searchGrade('A+',$gradeSummary) ;
                        ?>
                      </th>                   
                      <th>                        
                        <?php 
                            echo 'B+'.' = '.$this->searchGrade('B+',$gradeSummary) ;
                        ?>
                      </th>
                      <th>                        
                        <?php 
                            echo 'C+'.' = '.$this->searchGrade('C+',$gradeSummary) ;
                        ?>
                      </th>
                      <th>                        
                        <?php 
                            echo 'D'.' = '.$this->searchGrade('D',$gradeSummary) ;
                        ?>
                      </th>
                  </tr>
                  <tr>
                      <th>                        
                        <?php 
                            echo 'A '.' = '.$this->searchGrade('A',$gradeSummary) ;
                        ?>
                      </th>
                      <th>                        
                        <?php 
                            echo 'B '.' = '.$this->searchGrade('B',$gradeSummary) ;
                        ?>
                      </th>
                      <th>                        
                        <?php 
                            echo 'C '.' = '.$this->searchGrade('C',$gradeSummary) ;
                        ?>
                      </th>
                      <th>                        
                        <?php 
                            echo 'F*(R)'.' = '.$this->searchGrade('F*(R)',$gradeSummary) ;
                        ?>
                      </th>                                           
                  </tr>
                  <tr>
                      <th>                        
                        <?php 
                            echo 'A-'.' = '.$this->searchGrade('A-',$gradeSummary) ;
                        ?>
                      </th>
                      
                      <th>                        
                        <?php 
                            echo 'B-'.' = '.$this->searchGrade('B-',$gradeSummary) ;
                        ?>
                      </th>
                      <th>                        
                        <?php 
                            echo 'C-'.' = '.$this->searchGrade('C-',$gradeSummary) ;
                        ?>
                      </th>
                      <th>                        
                        <?php 
                            echo 'F*(S)'.' = '.$this->searchGrade('F*(S)',$gradeSummary) ;
                        ?>
                      </th>                                           
                      
                  </tr>                                      
                  <tr>
                      <th>                        
                        <?php 
                            echo 'AB'.' = '.$this->searchGrade('AB',$gradeSummary) ;
                        ?>
                      </th>
                  </tr>
        </thead>
        
</table>

<br></br>

 
<table border="0"  style="font-size:28px; text-align: left; ">
        <thead>
            <tr><th></th><th></th></tr>
            <tr><th></th><th></th></tr>
            
            <tr>
                <th>-------------------------------------------------</th>
                <th>-------------------------------------------------</th>
            </tr>
        <tr>
            <th>Signature</th>
            <th>Signature</th>
        </tr>
        <tr><th>Teacher Name: <?php echo yii::app()->session['MainFacultyName'];?></th>
            <th>Department Head</th></tr>
        </thead>
        
</table>
    

    
    
