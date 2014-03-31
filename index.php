<?php

/*
 * 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include 'include/php/header.php';


$headings = array ('Research Accomplishments','Publication Record','Presentation Experience','Professional Development','Customized Career Criteria Relevant to Career Goal',);

echo "<div id='container' class='container'>";

/*generate6Dots();*/
echo '<form name="input" action="genPDF.php" method="post" target="_blank">';

generateName();
generate6Forms($headings);
genSubmit();
#generateSignature();
generateFooter();
echo "</div></body></html>";

/*
 * 
 * Generate 6 Dots
 * Create HTML Hover for each dot to display text and fadein/fadeout on click
 * 
 * Generate 6 forms
 * Stylesheet = Unhide 6 forms 500 char max
 * Stack and print with Signatures
 */


function genSubmit(){
    //echo '<input type="submit" value="GENERATE PDF " style="float:right">';
    echo '<button  class="btn btn-primary" style="float:right">Submit Postdoc Mentoring Plan </button><br><br><br>';
    
    
}

function generateName(){
	echo "
        <table class='table table-bordered' style='margin:1px'>
	<tr>
		<td width='109px'>Your Name </td>
		<td> <input type='text' name='formdata[Research Accomplishments][name]' size='100' style='width:800px'></input>
		 </td>
	<tr>

	    <tr>
                <td width='109px'>Faculty Supervisor </td>
                <td> <input type='text' name='formdata[Research Accomplishments][supervisor]' size='100' style='width:800px'></input>
                 </td>
            <tr>

            <tr>
                <td width='109px'>Faculty Mentor</td>
                <td> <input type='text' name='formdata[Research Accomplishments][mentor1]' size='100' style='width:800px'></input>
                 </td>
            <tr>

            <tr>
                <td width='109px'>Faculty Mentor</td>
                <td> <input type='text' name='formdata[Research Accomplishments][mentor2]' size='100' style='width:800px'></input>
                 </td>
            <tr>

	    <tr>
                <td width='109px'>Theme Leader</td>
                <td> <input type='text' name='formdata[Research Accomplishments][theme]' size='100' style='width:800px'></input>
                 </td>
            <tr>


	</table>";

}




function generateSignature(){
    $div = "<div id='sig'>";
    $div .= "Signatures <hr>";
    $div .=
            "<table class='table-border underlined'>
                <tr>
                
                <td width=350>Postdoctoral Associate or Scholar<hr>Date<hr> </td>
                <td width=500>  </td>
                <td width=350>Faculty Mentor/Supervisor<hr>Date<hr> </td>      
                </tr>
                </table>";
    
    $div .="</div>";
    echo $div;
    
    
    
}


function generate6Dots(){
    $div = "<div id='dots'><div id='dots_heading'>#1 </div>";
    for($i=0; $i < 6; $i++){
        $div .=  "<span class='bull' style='font-size:40px'> &bull; </span>";
                

    }
    $div .='</div>';
    echo $div;
            
}

function generate6Forms($headings){
    #echo "<br><br><br>";
    foreach($headings as $heading => $head){
        $id = $heading+1;
      $div = "<div id={$head}>";
      $table = "
          <table class='table table-bordered'>
          <tr><td colspan=3 style='background-color:lightgray'></td> </tr>
            <tr><td colspan=3><b> {$id}. $head  </b></td> </tr>
                    <tr><td colspan=3 style='background-color:lightgray'></td> </tr>";
            
            
            
      for($i =1; $i <= 3; $i++){
            
            $j = $i;
            $goal               = "formdata[{$head}]" ."[goal][{$j}]"; 
            $steps              = "formdata[{$head}]" ."[steps][{$j}]";
            $outcomes           = "formdata[{$head}]" ."[outcome][{$j}]";        
            $timelineSteps      = "formdata[{$head}]" ."[timelineSteps][{$j}]";
            $timelineOutcomes   = "formdata[{$head}]" ."[timelineOutcomes][{$j}]";
            
            $table .="
            <tr><td> Goal #{$i}</td> <td><input type='text' class='goal' maxlength='100' name='{$goal}'></input></td><td>Timeline</td></tr>
            <tr><td> Steps/Training </td> <td><textarea rows='3' maxlength='310' class='steps' name='{$steps}'></textarea></td><td><input type='text' maxlength=29 style='width:200px' name='{$timelineSteps}'></input></td></tr>
            <tr><td> Outcomes </td> <td><textarea rows='3' maxlength='310' class='outcomes' name='{$outcomes}'></textarea></td><td><input type='text' maxlength=29 style='width:200px' name='{$timelineOutcomes}'></input></td></tr>
                <!--<tr><td> Outcomes </td> <td><input type='text' class='outcomes' maxlength='100' name='{$outcomes}' ></td><td><input type='text' maxlength=29 style='width:200px' name='{$timelineOutcomes}'></input></td></tr> -->
            <tr><td colspan=3 style='background-color:lightgray'></td> </tr>";
            
            }
      
      $table .= "</table>";
      
         $div .= $table . "</div><br><br>";
   
      echo $div;
    }
	echo "<br><br><br>";   
}




function generateTable($index,$heading){
    $index_human = $index+1;
   
    
    for($i = 0; $i < 3; $i++){
        $j = $i+1;
    }
     
        $table.=
"<br><br> <legend> {$heading} 1 </legend>
    <div class=\"controls\">
  <input class=\"span5\" type=\"text\" placeholder=\".span5\">
</div>
<div class=\"controls controls-row\">
  <input class=\"span4\" type=\"text\" placeholder=\".span4\">
  <input class=\"span1\" type=\"text\" placeholder=\".span1\">
</div>";


      echo $table;
        
}

function generateFooter(){

	echo "
		<div style='text-align: center'>
        		<em>&copy 2013 University of Illinois Board of Trustees</em>
        	</div>";
}


?>
