<?php

    // View Resume Page
    require 'header.php';
    require 'Class/viewresume.inc';
    
        if($login == 1)
        {
            // make a connection to database
            $viewresume = new viewresume();
            $getresume = $viewresume->viewresumes($connectdb,$userid);
            //echo print_r($getresume);
        
        }

 ?>
 <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>Resume </strong> User
            </div>
            <div class="card-body card-block">
           
                        
                       
                            <form  action="index.php" >
                           <input class="btn btn-outline-warning" type="submit" value="Go Back">
                            </form>
                       
                        
                    
                    </div>
            <div class="card-body card-block">
                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Username</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?php echo strtoupper($username); ?></p>
                        </div>
                    </div>
                   
                    <div class="card">
                        <div class="card-header">
                            <strong>Resumes</strong> Information
                        </div>
                        
                        <table class="table" style="width:900px;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Resume Name</th>
                            <th scope="col">Resume Email</th>
                            <th scope="col">Resume ID</th>
                            <th scope="col">Resume date added</th>
                            <th scope="col">Tool</th>
                            <th scope="col">PDF</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        // echo  $getresume[1]['skill'];
                        if (isset($getresume['numeresume'])) {
                            $resumenumber = $getresume['numeresume'];

                            for ($i = 0; $i < $resumenumber; $i++) {
                                $no = $i + 1;
                                $resumedeleid = $getresume['resume' . $i]['id'];

                                echo '<tr>
                                            <th scope="row">' . $no . '</th>
                                            <td>' . $getresume['resume' . $i]['fullname'] . '</td>
                                            <td>' . $getresume['resume' . $i]['email'] . '</td>
                                            <td>' . $getresume['resume' . $i]['hashid'] . '</td>
                                            <td>' . $getresume['resume' . $i]['date'] . '</td>
                                            <td><div class="fa-hover col-lg-3 col-md-6"><a href="?skilldelete=' . $resumedeleid . '"><i class="fa fa-times-circle"></i></a></div>
                                            
                                            <div class="fa-hover col-lg-3 col-md-6"><a href=editresume.php?hashid=' . $getresume['resume' . $i]['hashid'] . '><i class="fa fa-edit"></i></a></div></td>
                                            <td><div class="fa-hover col-lg-3 col-md-6"><a href="topdf.php?hashid='  . $getresume['resume' . $i]['hashid'] . '" target="_blank"><i class="fa fa-print"></i></a></div></td>
                                            </tr>';
                            }
                        } else {
                            echo '<tr>
                                        <th scope="row">1</th>
                                        <td>Please add skill to view</td>
                                        
                                        
                                        </tr>';
                        }
                        ?>






                    </tbody>
                </table>

                    </div>
                  
