<?php
require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);





// set default header data
$pdf->SetHeaderData(0, 0, 'IGB Postdoc Mentoring Plan for '. $_POST['formdata']['Research Accomplishments']['name'], '', array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setPrintHeader();
$pdf->setPrintFooter();
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE,  1);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


$pdf->setFontSubsetting(true);

// Set font
// helvetica is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 14, '', true);
$pdf->SetFillColor(255, 255, 255);
$pdf->setCellPaddings(2,2,2,2);
$pdf->setPrintHeader(true);
$pdf->SetMargins(PDF_MARGIN_LEFT, 12, PDF_MARGIN_RIGHT);



generateSplash();

foreach(array_keys($_POST['formdata']) as $i=>$heading){
      generateTable($i,$heading);
}
//generateSignature();



function generateSplash(){
    global $pdf;
    $i+=1;
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'b', 14 );
    $pdf->MultiCell(0,0, "Institute For Genomic Biology (IGB)", 'LTR', 'C', 1, 0, '', '', true);
    $pdf->Ln();
    $pdf->MultiCell(0,0, "Postdoc Mentoring Plan", 'LRB', 'C', 1, 0, '', '', true); 
    $pdf->Ln();

   


  //Hide the Header!!
   $pdf->SetFillColor(255,255,255);
   $array = array('');
   $pdf->Rect(0, 0, 100, 10, 'DF', $array);
   $pdf->SetFillColor(255,255,255);
 

    $array = array('Postdoctoral Associate or Scholar','Faculty Supervisor','Faculty Mentor 1','Faculty Mentor 2', 'Theme Leader', 'IGB Director');
 	$heading = 'Research Accomplishments';   
        $heading = 'Research Accomplishments';
    foreach(($array) as $key){
      
       switch($key){
          case 'Postdoctoral Associate or Scholar':
             $name = $_POST['formdata'][$heading]['name'];
             break;
         case 'Faculty Supervisor':
             $name = $_POST['formdata'][$heading]['supervisor'];
	     break;
        case 'Faculty Mentor 1':
             $name = $_POST['formdata'][$heading]['mentor1'];     
             break;
        case 'Faculty Mentor 2':
            $name = $_POST['formdata'][$heading]['mentor2'];
             break;
        case 'Theme Leader':
             $name = $_POST['formdata'][$heading]['theme'];
             break; 
        case 'IGB Director':
             $name = 'Gene Robinson';
             break;    

       }

       $pdf->Ln();                  
       $pdf->SetFont('helvetica', 'b', 13 ); 
       $pdf->MultiCell(85, 9, "{$key}", 1, 'L', 1, 0, '', '', true);
       $pdf->SetFont('helvetica', 'ib', 9 ); 
       $pdf->cMargin = 0;
       $pdf->MultiCell(70, 9.75, "{$name}", 1, 'L', 1, 0, '', '', true);       
       $pdf->MultiCell(72, 9.75, "Signature", 1, 'L', 1, 0, '', '', true);
       $pdf->MultiCell(40, 9.75, "Date: ____/____/______", 1, 'L', 1, 0, '', '', true);
       $pdf->Ln();
	
	$pdf->SetFillColor(200, 200, 200);
        $pdf->SetFont('helvetica', 'b', 5, '', true);
        $pdf->MultiCell(0, 1, '', 1, 'C', 1, 0, '', '', true);
        $pdf->SetFillColor(255, 255, 255);
   

 }




}


function generateSignature(){
    global $pdf;
    $pdf->SetFont('helvetica', 'i', 8.0 );
    $pdf->MultiCell(120, 9, "Postdoctoral Associate or Scholar", 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(37, 9, "Date: ____/____/______", 1, 'L', 1, 0, '', '', true);	
    $pdf->MultiCell(73, 9, "Theme Leader", 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(37, 9, "Date: ____/____/______", 1, 'L', 1, 0, '', '', true);
    $pdf->Ln();

    $pdf->SetFont('helvetica', 'i', 8 );
    $pdf->MultiCell(120, 9, "Faculty Mentor/Supervisor", 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(37, 9, "Date: ____/____/______", 1, 'L', 1, 0, '', '', true); 
    $pdf->MultiCell(73, 9, "IGB Director", 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(37, 9, "Date: ____/____/______", 1, 'L', 1, 0, '', '', true);
}

$pdf->Output('example_001.pdf', 'I');



function generateTable($i,$heading){
    global $pdf;
    $i+=1;
    $pdf->AddPage();
    
    
	#$pdf->Cell(0, 10, " {$i}.  {$heading}", 1, 1, 'L', 0, '', 0);
    $pdf->SetFont('helvetica', 'b', 14 );
    $pdf->Cell(0, 10, " {$heading}", 1, 1, 'C', 0, '', 0);
    
    for( $i=1; $i <= 3; $i++){
        $j = $i;
        
        //Get formdata
        $goal = $_POST['formdata'][$heading]['goal'][$j];
        $steps = $_POST['formdata'][$heading]['steps'][$j];
        $steps_timeline = $_POST['formdata'][$heading]['timelineSteps'][$j];
        $outcomes = $_POST['formdata'][$heading]['outcome'][$j];
        $outcomes_timeline = $_POST['formdata'][$heading]['timelineOutcomes'][$j];
        
        
        #remove \n and replace with '\s'
        
        $goal = str_replace("\n"," ",$goal);
        $steps = str_replace("\n"," ",$steps);
        $steps_timeline = str_replace("\n"," ",$steps_timeline);
        $outcomes = str_replace("\n"," ",$outcomes);
        $outcomes_timeline = str_replace("\n"," ",$outcomes_timeline);
        
               
        
        #timeline steps
        
        //Goal
        $pdf->SetFont('helvetica', 'b', 13 , '', true);
        $pdf->MultiCell(50, 11, "Goal #{$i}", 1, 'L', 1, 0, '', '', true);
        $pdf->SetFont('helvetica', '', 8.5 );
        $pdf->MultiCell(167, 11, $goal, 1, 'L', 1, 0, '', '', true);
        $pdf->SetFont('helvetica', 'b', 13 );
        $pdf->MultiCell(50, 11, "Timeline", 1, 'L', 1, 0, '', '', true);
        $pdf->Ln();
        
        
        //Steps
        $pdf->SetFont('helvetica', 'b', 13, '', true);
        $pdf->MultiCell(50, 17, 'Steps/Training', 1, 'L', 1, 0, '', '', true);
        $pdf->SetFont('helvetica', '', 8.5, '', true);
        $pdf->MultiCell(167,17, $steps, 1, 'L', 1, 0, '', '', true);
         $pdf->SetFont('helvetica', '', 10, '', true);
        $pdf->MultiCell(50, 17, $steps_timeline, 1, 'L', 1, 0, '', '', true);
        $pdf->Ln();
        
        //Outcomes
        $pdf->SetFont('helvetica', 'b', 13, '', true);
        $pdf->MultiCell(50, 17, 'Outcomes', 1, 'L', 1, 0, '', '', true);
        $pdf->SetFont('helvetica', '', 8.5, '', true);
        $pdf->MultiCell(167, 17, $outcomes, 1, 'L', 1, 0, '', '', true);
          $pdf->SetFont('helvetica', '', 10, '', true);
        $pdf->MultiCell(50 , 17, $outcomes_timeline, 1, 'L', 1, 0, '', '', true);
        $pdf->Ln();
        
        //Blank
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
        $signatures ='';
	$font_size = 10;
	if($heading =='Customized Career Criteria Relevant to Career Goal' && $j==3){
		$font_size = 8.5;	
	//	$signatures='SIGNATURES';	
	}
        
	$pdf->SetFillColor(211, 211, 211);  
        $pdf->SetFont('helvetica', 'b', $font_size, '', true);
        $pdf->MultiCell(0, 1, $signatures, 1, 'C', 1, 0, '', '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Ln();
        
    }
}



?>
