<?php


    // Great PDF Page
    // show templete PDF
    require 'header.php';
    require 'Class/resume.inc';
    require 'Class/topdf.inc';
    function Secure($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        strip_tags($data);
        return $data;
    }
    if($_GET)
    {
       $hashid = Secure($_GET['hashid']);
       if(empty($hashid))
       {
           echo 'لا يوجد معلومات';
       }else 
       {
           $resume = new resume();
           $getinfo = $resume->Operatins($connectdb,$hashid);
           if($getinfo)
           {
               // connection to class working
                //$topdf = new PDF();
              // $createpdf = $topdf->PDF($getinfo);
              if(strlen($getinfo['aboutyou'])>150 || $getinfo['aboutyou']==null)
              {
                  echo 'Profile ->You have not add About you or About you should be less than 100 chart';
              }elseif($getinfo['skillnum']== null || $getinfo['skillnum'] >6) 
              {
                echo 'Skills ->You have not add skills or Number of skills should be less than 7';
            }elseif($getinfo['languagesnum']== null || $getinfo['languagesnum'] >6)
            {
                echo 'Languages -> You have not add Languages or The  Number of Languages more than 7';
            }elseif($getinfo['experiencenum'] == null || $getinfo['experiencenum']>3)
            {
                echo 'Experience ->You have not add Experience or Number of Experience should be less than 3';
            }elseif($getinfo['educationnum'] == null || $getinfo['educationnum'] >3)
            {
                echo 'Education ->You have not add Education or Number of Education should be less than 3';
            }
            elseif($getinfo['certificationsnum']== null || $getinfo['certificationsnum'] >5)
            {
                echo 'Certifications ->You have not add Certifications or Number of Certifications should be less than 3';
            }elseif($getinfo['imgnum']== null )
            {
                echo 'Profile Photo -> You should have a profile photo to get PDF Resume';
            }
            else {
                $pdf = new PDF();
                $pdf->cells($getinfo);
               
                $pdf->AliasNbPages();
               // $pdf->AddPage();
                $pdf->SetFont('Times','',12);
                
                $pdf->Output();
            }
        }
       }
    }

    
 ?>