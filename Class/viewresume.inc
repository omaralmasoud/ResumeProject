<?php

Class viewresume 
{
    // information function
    function viewresumes($connectdb,$userid)
    {
        // make a query to get all resumes
        $getresumesquery = 'SELECT * FROM `resmue` WHERE userid="'.$userid.'"';
        $getresumes = mysqli_query($connectdb,$getresumesquery) or die(mysqli_error($getresumes));
        if($getresumes)
        {
            // connection work
            if(mysqli_num_rows($getresumes)>0)
            {
                // we found the user
                $i = 0;
                while($fecthresume = mysqli_fetch_assoc($getresumes))
                {
                    $resume['resume'.$i] = $fecthresume;
                    $i++;
                }
                $numeresume = array('numeresume'=>$i);
                $resume =  array_merge($resume,$numeresume);
                return $resume;
            }
        }else 
        {
            // connection down
        }

    }
}