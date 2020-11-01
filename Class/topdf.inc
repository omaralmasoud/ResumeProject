<?php 

require 'fpdf.php';
ob_end_clean();
// Create new instance from Resume and get information
$resume = new resume();

class PDF extends FPDF
    {
    // Page header
    function Header()
    {
        // Logo
       // $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        
        $this->SetXY(10,0);
        
        // Title
        $this->SetFillColor(165,42,42);
        $this->Cell(80,300,'',0,1,'L',true);
        $this->SetFillColor(6,0,255);
        /* --- Cell --- */
        

        // Line break
        $this->Ln(20);
    }
    function cells($info)
    {
        $color =array(165,42,42);
        $this->AddPage();
        $this->Image($info['img0']['img'],25,5,40);
        $this->SetXY(10, 45);

        $this->SetTextColor(255,249,233);
        $this->SetFont('Arial','B',20);
        $this->Cell(70, 16, ''.$info['fullname'].'', 0, 1, 'C', false);
        $this->SetXY(10,52);
            $this->SetFont('Arial','',15);
            $this->Cell(70, 16, ''.$info['birthdate'].'', 0, 1, 'C', false);
        $this->SetXY(15, 60);
        $this->SetTextColor(255,249,233);
        $this->SetFont('Arial','B',15);
        $this->Cell(78, 16, 'Profile', 0, 1, 'L', false);
     
        
        


        $this->SetDrawColor(253,253,255);
        $this->Line(16, 72, 40, 72);
        
        //$this->Image('img/user.png',12,34,7);
        $this->SetXY(15, 75);
            $this->SetFont('Arial','',12);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor($color[0],$color[1],$color[2]);
            $this->MultiCell(65, 5, ''.$info['aboutyou'].'', 0, 1, 'C', false);
        $x = 100;
        $this->SetXY(15,88);
        $this->SetFont('Arial','B',15);
        $this->SetTextColor(255,249,233);
        $this->Cell(70, 16, 'Contact', 0, 1, 'L', false);
        $this->SetDrawColor(253,253,255);
        $this->Line(16, 100, 40, 100);

        for($i=0;$i<2;$i++)
        {
            if($i == 0){
            $value = $info['phone'];
            $img = 'phone';
            }else {
            $value = $info['email'];
            $img = 'email';
            }
            $this->Image('img/'.$img.'.png',13,$x+5,6);
            $this->SetXY(20 , $x);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Arial','I',12);
            $this->Cell(70, 16, ''.$value.'', 0, 1, 'L', false);
            $x = $x +10;
        }
        
        $this->SetXY(15,130);
        $this->SetFont('Arial','B',15);
        $this->SetTextColor(255,249,233);
        $this->Cell(70, 16, 'Skills', 0, 1, 'L', false);
        $this->SetDrawColor(253,253,255);
        $this->Line(16, 142, 40, 142);
        
        $skillnum = $info['skillnum'];
        $s = 140;
        for($i=0;$i<$skillnum;$i++)
        {
           // if($i == 0)
            $value = $info['skill'.$i]['skill'];
           
            $this->Image('img/pointw.png',16,$s+7,2);
            
           
            $this->SetXY(20 , $s);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Arial','',12);
            $this->Cell(70, 16, ''.$value.'', 0, 1, 'L', false);
            $s = $s +8;
        }

        $this->SetXY(15,190);
        $this->SetFont('Arial','B',15);
        $this->SetTextColor(255,249,233);
        $this->Cell(70, 16, 'Languages', 0, 1, 'L', false);
        $this->SetDrawColor(253,253,255);
        $this->Line(16, 202, 40, 202);
        
        $languagesnum = $info['languagesnum'];
        $la = 200;
        for($i=0;$i<$languagesnum;$i++)
        {
           // if($i == 0)
            $value = $info['language'.$i]['language'];
           
            $this->Image('img/pointw.png',16,$la+7,2);
            
           
            $this->SetXY(20 , $la);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Arial','',12);
            $this->Cell(70, 16, ''.$value.'', 0, 1, 'L', false);
            $la = $la +8;
        }
        
        
        // experience
        $this->SetXY(95,20);
        $this->SetFillColor($color[0],$color[1],$color[2]);
        $this->Cell(90,12,'',0,1,'L',true);
        $this->SetXY(100,18);
        $this->SetFont('Arial','B',15);
        $this->SetTextColor(255,249,233);
        $this->Cell(70, 16, 'Work Experience', 0, 1, 'L', false);
        $experiencenum = $info['experiencenum'];
        $e = 40;
        $ey = 30;
        for($i=0;$i<$experiencenum;$i++)
        {
           // if($i == 0)
            $value = $info['experience'.$i]['experience'];
            $year = $info['experience'.$i]['year'];
            
            $eimg= 'time';
            $this->SetXY(105,$ey);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Arial','B',10);
            $this->Cell(50, 16, ''.$year.'', 0, 1, 'L', false);
            $this->Image('img/'.$eimg.'.png',96,$e,6);
            $this->SetXY(105,$e);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(255,249,233);
            $this->SetFont('Arial','',12);
            $this->MultiCell(95, 5, ''.$value.'', 0, 1, 'L', false);
            $this->Ln();
           
            $e = $e +20;
            $ey = $ey + 20;
        }
        
        // Education
        $this->SetXY(95,100);
        $this->SetFillColor($color[0],$color[1],$color[2]);
        $this->Cell(90,12,'',0,1,'L',true);
        $this->SetXY(100,98);
        $this->SetFont('Arial','B',15);
        $this->SetTextColor(255,249,233);
        $this->Cell(70, 16, 'Education', 0, 1, 'L', false);
        $educationnum = $info['educationnum'];
        $e = 120;
        $ey = 110;
        for($i=0;$i<$educationnum;$i++)
        {
           // if($i == 0)
           $value = $info['education'.$i]['education'];
            $year = $info['education'.$i]['year'];
            
            $eimg= 'time';
            $this->SetXY(105,$ey);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Arial','B',10);
            $this->Cell(50, 16, ''.$year.'', 0, 1, 'L', false);
            $this->Image('img/'.$eimg.'.png',96,$e,6);
            $this->SetXY(105,$e);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(255,249,233);
            $this->SetFont('Arial','',12);
            $this->MultiCell(95, 5, ''.$value.'', 0, 1, 'L', false);
            $this->Ln();
           
            $e = $e +20;
            $ey = $ey + 20;
        }
        
        // Certifications
        $this->SetXY(95,180);
        $this->SetFillColor($color[0],$color[1],$color[2]);
        $this->Cell(90,12,'',0,1,'L',true);
        $this->SetXY(100,178);
        $this->SetFont('Arial','B',15);
        $this->SetTextColor(255,249,233);
        $this->Cell(70, 16, 'Certifications', 0, 1, 'L', false);
        $certificationsnum = $info['certificationsnum'];
        $e = 200;
        $ey = 190;
        for($i=0;$i<$certificationsnum;$i++)
        {
           // if($i == 0)
           $value = $info['certifications'.$i]['certifications'];
            $year = $info['certifications'.$i]['year'];
            
            $eimg= 'time';
            $this->SetXY(105,$ey);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Arial','B',10);
            $this->Cell(50, 16, ''.$year.'', 0, 1, 'L', false);
            $this->Image('img/'.$eimg.'.png',96,$e,6);
            $this->SetXY(105,$e);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(255,249,233);
            $this->SetFont('Arial','',12);
            $this->MultiCell(95, 5, ''.$value.'', 0, 1, 'L', false);
            $this->Ln();
           
            $e = $e +20;
            $ey = $ey + 20;
        }
        
        
    }
   
    
    // Page footer
    
    }
    
    // Instanciation of inherited class
    