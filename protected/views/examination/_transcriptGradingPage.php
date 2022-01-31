
<strong>Office of the Controller of Examinations</strong><br></br>
<?php echo Options::getOptions('organization_name_with_location'); ?>



<p>
        <span style="min-width: 100px; float: left;"><strong>MU Grading System</strong></span>    
</p>

<?php
if('type' == 'pdf'){
$style = array('width' => 0.6, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
$pdf->Line(15, 50, 180, 50, $style);
}
?>
<div>
        <span style="min-width: 100px; float: left;">Letter grades indicating the quality of course work completed is interpreted as follows:</span>    
</div>
<br></br>
<table border="0"  style="font-size:25px; text-align: left;">
   <thead>
        <tr>
            <th><strong>Numerical Score</strong></th>                
            <th><strong>Letter Grade</strong></th>               
                <th></th>               
                <th><strong>Grade points per credit</strong></th>    
         </tr>
         
    </thead>
    <tbody>
                 	
        <tr>
            <td>80 and above</td>
            <td>A+</td>
            <td></td>
            <td>4.00</td>
        </tr>
        <tr>
            <td>75 to less than 80</td>
            <td>A</td>
            <td></td>
            <td>3.75</td>
        </tr>
        <tr>
            <td>70 to less than 75</td>
            <td>A-</td>
            <td></td>
            <td>3.50</td>
        </tr>
        <tr>
            <td>65 to less than 70</td>
            <td>B+</td>
            <td></td>
            <td>3.25</td>
        </tr><tr>
            <td>60 to less than 65</td>
            <td>B</td>
            <td></td>
            <td>3.00</td>
        </tr>
        <tr>
            <td>55 to less than 60</td>
            <td>B-</td>
            <td></td>
            <td>2.75</td>
        </tr>
        <tr>
            <td>50 to less than 55</td>
            <td>C+</td>
            <td></td>
            <td>2.50</td>
        </tr>        
        <tr>
            <td>45 to less than 50</td>
            <td>C</td>
            <td></td>
            <td>2.25</td>
        </tr>    
        <tr>
            <td>40 to less than 45</td>
            <td>D</td>
            <td></td>
            <td>2.00</td>
        </tr>        
        <tr>
            <td>Less than 40</td>
            <td>F*</td>
            <td>Failure</td>
            <td>0.00</td>
        </tr>        
        <tr>
            <td></td>
            <td>I**</td>
            <td>Incomplete/ Irregular</td>
            <td>0.00</td>
        </tr>     
        <tr>
            <td></td>
            <td>W**</td>
            <td>Withdrawal</td>
            <td>0.00</td>
        </tr>        
        <tr>
            <td></td>
            <td>S**</td>
            <td>Supplementary</td>
            <td>0.00</td>
        </tr>    
        <tr>
            <td></td>
            <td>AB</td>
            <td>Absence</td>
            <td>0.00</td>
        </tr>        
    </tbody>
</table>
<br></br>

<br></br><br></br>
<table border="0"  style="font-size:25px; text-align: left;">
    <tr>
        <th>* Credits for courses with this grade do not apply towards graduation.</th>
    </tr>
    <tr>
        <th>** Credits for courses with this grade do not apply towards graduation and they are not accepted in the calculation of the grade point average.
</th>
    </tr>
    <tr>
        <th>The exact cut off points assigning letter grades is at the discretion of individual instructor. The sample applies to the assignment of + or – after a letter grade. It is meant to give flexibility so that shades of performance can be distinguished and rewarded. The + and – has a value of 0.25 grade point.
</th>
    </tr>
</table>
<div>
    <span style="min-width: 200px; float: left;"><strong>Grade Point Average (GPA)</strong></span>
</div>

<br></br>
<table border="0"  style="font-size:25px; text-align: left;">
    <tr>
        <th>Student’s grade–point averages are numerical values obtained by dividing the total grade points earned by the credits attempted. Only courses graded A+, A, A-, B+, B, B-, C+, C, D and F are used to determine credits attempted.
</th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th>Only the grades earned in the courses that are required for a degree are included in the GPA calculation. Grades earned in other courses are reported on the transcript but are not counted in calculating the GPA.
</th>
    </tr>
</table>

<div>
    <span style="min-width: 200px; float: left;"><strong>GPA – class equivalence</strong></span>
</div>

<br></br>
<table border="0"  style="font-size:25px; text-align: left;">
    <tr>
        <th>
MU students are graded on GPA. Comparison of the GPA earned by MU students to the classes earned by students in other universities in the countries is as follows:
</th>
    </tr>
 </table>
                
<br></br>
<table border="0"  style="font-size:25px; text-align: left;">
    <tr>
        <th></th>
        <th>
        GPA 4.00    
        </th>
        <th>
        = First Class with Distinction
        </th>
    </tr>
    <tr>
        <th></th>
        <th>
        GPA 3.00 and above
        </th>
        <th>
        = First Class 
        </th>
    </tr>
    <tr>
        <th></th>
        <th>
        GPA 2.50.2.99    
        </th>
        <th>
        = Second Class
        </th>
    </tr>
    <tr>
        <th></th>
        <th>
        GPA 2.00 to 2.49    
        </th>
        <th>
        = Third Class
        </th>
    </tr>
 </table>
<br></br>
<br></br>
<table border="0"  style="font-size:25px; text-align: left;">
    
    <tr>
        <th><strong>Controller of Examinations</strong></th>
    </tr>
    
</table>