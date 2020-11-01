<?php
    require 'header.php';
    // Add Resume Page
    $aboutyou = '';
    function Secure($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        strip_tags($data);
        return $data;
      }
    if(isset($_POST['addresume']))
    {
        $fullname = Secure( $_POST['fullname']);
        $email = Secure($_POST['email']);
        $phone = Secure($_POST['phone']);
        $birthdate = Secure($_POST['birthdate']);
        $aboutyou = htmlentities($_POST['aboutyou']);
        if(empty($fullname) || empty($email) || empty($phone)
        || empty($birthdate) || empty($aboutyou) ) 
        {
            echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">خطأ</span>
            يرجى ملئ الحقول
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }else 
        {
            $randomNumber = rand(1000,9999); 
            $hashid = $randomNumber;
            // Make a query connection
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                echo $emailErr;
              }else {
            $query = 'INSERT INTO `resmue`( `fullname`, `birthdate`, `phone`, `email`, `aboutyou`,`hashid`,`userid`) 
            VALUES ("'.$fullname.'","'.$birthdate.'","'.$phone.'","'.$email.'","'.$aboutyou.'","'.$hashid.'","'.$id.'")';
            $addresmue = mysqli_query($connectdb,$query) or die(mysqli_error($addresmue));
            if($addresmue)
            {
                // Connection work
                echo 'تم اضافة السيرة الذاتية بنجاح';
                header('Location: editresume.php?hashid='.$hashid.'');
                
            }else 
            {
                // connection down
            }
        }
        }
    }elseif(isset($_POST['back']))
    {
        header('Location: index.php');
    }

 ?>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Resume Form</strong> Elements
                            </div>
                            <div class="card-body card-block">
                                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">Username</label></div>
                                        <div class="col-12 col-md-9">
                                            <p class="form-control-static"><?php echo strtoupper($username) ; ?></p>
                                        </div>
                                    </div>

                                    <div class="card">
                            <div class="card-header">
                                <strong>Personal</strong> Information
                            </div>
                            <div class="card-body card-block">
                            <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Full Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="fullname" placeholder="Your Name" class="form-control"><small class="form-text text-muted">Enter You full name</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="birth-input" class=" form-control-label">Birth Date</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="email-input" name="birthdate" placeholder="Enter Birth Date" class="form-control"><small class="help-block form-text">Please enter your Birth Date</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
                                        <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" placeholder="Enter Email" class="form-control"><small class="help-block form-text">Please enter your email</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="Phone-input" class=" form-control-label">Phone</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="Phone-input" name="phone" placeholder="Enter Phone" class="form-control"><small class="help-block form-text">Please enter your phone</small></div>
                                    </div>
                                   
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">About you</label></div>
                                        <div class="col-12 col-md-9"><textarea name="aboutyou" id="textarea-input" rows="9" placeholder="tell us more about you ,Content..." class="form-control"></textarea></div>
                                         
                                    </div>
                            </div>
                            
                        </div>


                        <div class="card-footer">
                        <input class="btn btn-outline-success" type="submit" name="addresume" value="Next">
                                    <input class="btn btn-outline-warning" type="submit" name="back" value="Back">
                                    
                            </div>
                       
                                </form>
                            </div>
                           
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <strong>Thank</strong> You
                            </div>
                            <div class="card-body card-block">
                                
                            </div>
                           
                            </div>
                        </div>
                    </div>