<?php

require 'header.php';
require 'Class/resume.inc';
// Edit resume
function Secure($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    strip_tags($data);
    return $data;
}

$resume = new resume();
if (isset($_GET['hashid'])) {

    $hashid = Secure($_GET['hashid']);
    if (empty($hashid)) {
    } else {
        // Get All resume data
        $resumearry = $resume->Operatins($connectdb, $hashid);
        if(isset($_POST['updateinfo']))
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
            $resume->updateresume($connectdb,$hashid,$fullname,$birthdate,$phone,$email,$aboutyou);
        }
        }
        //echo print_r($resumearry);
        if (isset($_POST['skill'])) {
            $skill = Secure($_POST['skill']);

            if (empty($skill)) {
                echo 'Please add skill';
            } else {
                $resume->addskill($connectdb, $hashid, $skill);
            }
        }
        if (isset($_GET['skilldelete'])) {

            $deleskill = Secure($_GET['skilldelete']);
            $resume->Deleteskill($connectdb, $deleskill, $hashid);
        }
        if (isset($_POST['Language'])) {
            $Language = Secure($_POST['Language']);
            if (empty($Language)) {
                echo 'Please add Language';
            } else {
                $resume->AddLanguage($connectdb, $hashid, $Language);
            }
        }
        if (isset($_GET['languagedelete'])) {

            $languagedelete = Secure($_GET['languagedelete']);
            $resume->DeleteLanguage($connectdb, $languagedelete, $hashid);
        }
        if(isset($_POST['Experience']))
        {
            $experience = Secure($_POST['Experience']);
            $experienceyear = Secure($_POST['Experienceyear']);
            if(empty($experience) || empty($experienceyear))
            {
                echo 'Please add Experience and Year';
            }else 
            {
                $resume->AddExperience($connectdb,$hashid,$experience,$experienceyear);
            }
        }
        if(isset($_GET['experiencedeleid']))
        {
            $experiencedeleid = Secure($_GET['experiencedeleid']);
            $resume->Deleteexperience($connectdb,$experiencedeleid,$hashid);
        }
        if(isset($_POST['Education']))
        {
            $Education = Secure($_POST['Education']);
            $Educationyear = Secure($_POST['Educationyear']);
            if(empty($Education) || empty($Educationyear))
            {
                echo 'Please add Education and year';
            }else 
            {
                $resume->AddEducation($connectdb,$hashid,$Education,$Educationyear);
            }
        }
        if(isset($_GET['educationdeleid']))
        {
            $educationdeleid = Secure($_GET['educationdeleid']);
            $resume->DeleteEducation($connectdb,$educationdeleid,$hashid);
        }
        if(isset($_POST['certification']))
        {
            $certification = Secure($_POST['certification']);
            $certificationyear = Secure($_POST['certificationyear']);
            if(empty($certification) || empty($certificationyear))
            {
                echo 'Please add certification and year';
            }else 
            {
                $resume->Addcertification($connectdb,$hashid,$certification,$certificationyear);
            }
        }
        if(isset($_GET['certificationsdeleid']))
        {
            $certificationsdeleid = Secure($_GET['certificationsdeleid']);
            $resume->Deletecertifications($connectdb,$certificationsdeleid,$hashid);
        }
        
        if(isset($_POST["img"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
                $resume->Uploadimg($connectdb,$hashid);
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            }
    }





?>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>Resume Form</strong> Elements
                
            </div>
            <div class="card-body card-block">
            <div class="row form-group">
                        
                        <div class="col-12 col-md-9">
                            <form  action="viewresume.php" >
                            <p class="form-control-static"> <input class="btn btn-outline-warning" type="submit" value="Go Back"></p>
                            </form>
                        </div>
                        
                    </div>
                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Username</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?php echo strtoupper($username); ?></p>
                           
                        </div>
                        
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>Personal</strong> Information
                        </div>
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Full Name</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" value="<?php echo $resumearry['fullname'] ?>" name="fullname" placeholder="Your Name" class="form-control"><small class="form-text text-muted">Enter You full name</small></div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="birth-input" class=" form-control-label">Birth Date</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="email-input" name="birthdate" value="<?php echo $resumearry['birthdate'] ?>" placeholder="Enter Birth Date" class="form-control"><small class="help-block form-text">Please enter your Birth Date</small></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
                                <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" value="<?php echo $resumearry['email'] ?>" placeholder="Enter Email" class="form-control"><small class="help-block form-text">Please enter your email</small></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="Phone-input" class=" form-control-label">Phone</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="Phone-input" name="phone" value="<?php echo $resumearry['phone'] ?>" placeholder="Enter Phone" class="form-control"><small class="help-block form-text">Please enter your phone</small></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">About you</label></div>
                                <div class="col-12 col-md-9"><textarea name="aboutyou" id="textarea-input" rows="9" placeholder="tell us more about you ,Content..." class="form-control"><?php echo $resumearry['aboutyou'] ?></textarea></div>


                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input class="btn btn-outline-success" type="submit" name="updateinfo" value="Update">
                        <input class="btn btn-outline-warning" type="reset" value="Back">
       
                    </div>
             
                </form>
            </div>
      
<div class="card">
                <div class="card-header">
                    <strong>Profile</strong> Image
                </div>
                <div class="card-body card-block">
                   <?php if(isset($resumearry['img0']) >0) { ?>
                    <img src="<?php echo $resumearry['img0']['img'];  ?>" width="150" height="150" />
                    <?php } else echo "You don't add any image yet , please add a one to Make a PDF file" ; ?>
                </div>
                   <form method="POST" enctype="multipart/form-data" >
                    <div class="card-body card-block">
                        <div class="row form-group">
                        Select image to upload:
                         <input type="file"  name="fileToUpload" id="fileToUpload" >
        </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-outline-success" name="img" type="submit" value="Upload Image">


                        </div>
                    </form>

               

            </div>
            <div class="card">
                <div class="card-header">
                    <strong>Skill</strong> Highlights
                </div>

                <table class="table" style="width:400px;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Skills</th>
                            <th scope="col">Tool</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        // echo  $resumearry[1]['skill'];
                        if (isset($resumearry['skillnum'])) {
                            $skillsnumber = $resumearry['skillnum'];

                            for ($i = 0; $i < $skillsnumber; $i++) {
                                $no = $i + 1;
                                $skilldeleid = $resumearry['skill' . $i]['id'];

                                echo '<tr>
                                            <th scope="row">' . $no . '</th>
                                            <td>' . $resumearry['skill' . $i]['skill'] . '</td>
                                            <td><div class="fa-hover col-lg-3 col-md-6"><a href="?hashid=' . $hashid . '&skilldelete=' . $skilldeleid . '"><i class="fa fa-times-circle"></i></a></div></td>
                                            
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

                

                    <form method="POST">
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Skill</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="skill" placeholder="Your skill" class="form-control"><small class="form-text text-muted">Enter your skill</small></div>
                        </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-outline-success" type="submit" value="Save">


                        </div>
                    </form>

               

            </div>
                 
            <div class="card">
                <div class="card-header">
                    <strong>Languages</strong>
                </div>
                <table class="table" style="width:400px;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Language</th>
                            <th scope="col">Tool</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        // echo  $resumearry[1]['skill'];
                        if (isset($resumearry['languagesnum'])) {
                            $languagesnum = $resumearry['languagesnum'];
                            if ($languagesnum > 0) {
                                for ($i = 0; $i < $languagesnum; $i++) {
                                    $no = $i + 1;
                                    $languagedeleid = $resumearry['language' . $i]['id'];

                                    echo '<tr>
                                            <th scope="row">' . $no . '</th>
                                            <td>' . $resumearry['language' . $i]['language'] . '</td>
                                            <td><div class="fa-hover col-lg-3 col-md-6"><a href="?hashid=' . $hashid . '&languagedelete=' . $languagedeleid . '"><i class="fa fa-times-circle"></i></a></div></td>
                                            
                                            </tr>';
                                }
                            }
                        } else {
                            echo '<tr>
                                    <th scope="row">1</th>
                                    <td>Please add language to view</td>
                                    
                                    
                                    </tr>';
                        }
                        ?>

                    </tbody>
                </table>

                <form method="POST">
                    
                <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Language</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="Language" placeholder="Your Language" class="form-control"><small class="form-text text-muted">Enter your Language</small></div>
                        </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-outline-success" type="submit" value="Save">



                        </div>
                   
                </form>



            


        </div>

        <div class="card">
            <div class="card-header">
                <strong>Experience</strong>
            </div>
            <table class="table" style="width:400px;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Experience</th>
                            <th scope="col">Experience Year</th>
                            <th scope="col">Tools</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        // echo  $resumearry[1]['skill'];
                        if (isset($resumearry['experiencenum'])) {
                            $experiencenum = $resumearry['experiencenum'];
                            if ($experiencenum > 0) {
                                for ($i = 0; $i < $experiencenum; $i++) {
                                    $no = $i + 1;
                                    $experiencedeleid = $resumearry['experience' . $i]['id'];

                                    echo '<tr>
                                            <th scope="row">' . $no . '</th>
                                            <td>' . $resumearry['experience' . $i]['experience'] . '</td>
                                            <td>' . $resumearry['experience' . $i]['year'] . '</td>
                                            <td><div class="fa-hover col-lg-3 col-md-6"><a href="?hashid=' . $hashid . '&experiencedeleid=' . $experiencedeleid . '"><i class="fa fa-times-circle"></i></a></div></td>
                                            
                                            </tr>';
                                }
                            }
                        } else {
                            echo '<tr>
                                    <th scope="row">1</th>
                                    <td>Please add experience to view</td>
                                    
                                    
                                    </tr>';
                        }
                        ?>

                    </tbody>
                </table>
            <form method="POST">
                <div class="card-body card-block">

                    <div class="form-group"><label for="Description1id" class="pr-1  form-control-label">Description</label><input type="text" name="Experience" id="Description1id" placeholder="Description" required="" class="form-control"></div>
                    <div class="form-group"><label for="Description1id" class="px-1  form-control-label">Experience Year</label><input type="text" id="Experience1id" name="Experienceyear" placeholder="form XX to XX" required="" class="form-control"></div>

                </div>
                <div class="card-footer">
                    <input class="btn btn-outline-success" type="submit" value="Save">


                </div>
            </form>

        </div>
        <div class="card">
            <div class="card-header">
                <strong>Education</strong>
            </div>
            <table class="table" style="width:400px;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Education</th>
                            <th scope="col">Education Year</th>
                            <th scope="col">Tools</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        // echo  $resumearry[1]['skill'];
                        if (isset($resumearry['educationnum'])) {
                            $educationnum = $resumearry['educationnum'];
                            if ($educationnum > 0) {
                                for ($i = 0; $i < $educationnum; $i++) {
                                    $no = $i + 1;
                                    $educationdeleid = $resumearry['education' . $i]['id'];

                                    echo '<tr>
                                            <th scope="row">' . $no . '</th>
                                            <td>' . $resumearry['education' . $i]['education'] . '</td>
                                            <td>' . $resumearry['education' . $i]['year'] . '</td>
                                            <td><div class="fa-hover col-lg-3 col-md-6"><a href="?hashid=' . $hashid . '&educationdeleid=' . $educationdeleid . '"><i class="fa fa-times-circle"></i></a></div></td>
                                            
                                            </tr>';
                                }
                            }
                        } else {
                            echo '<tr>
                                    <th scope="row">1</th>
                                    <td>Please add education to view</td>
                                    
                                    
                                    </tr>';
                        }
                        ?>

                    </tbody>
                </table>
            <form method="POST">
            <div class="card-body card-block">

                <div class="form-group"><label for="Description1id" class="pr-1  form-control-label">Description</label><input type="text" name="Education" id="Description1id" placeholder="Description" required="" class="form-control"></div>
                <div class="form-group"><label for="Description1id" class="px-1  form-control-label">Education Year</label><input type="text" id="Educationyears" name="Educationyear" placeholder="form XX to XX" required="" class="form-control"></div>

            </div>
            <div class="card-footer">
                    <input class="btn btn-outline-success" type="submit" value="Save">


                </div>
            </form>


        </div>
        <div class="card">
            <div class="card-header">
                <strong>Certifications</strong>
            </div>
            <table class="table" style="width:400px;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Certifications</th>
                            <th scope="col">Certifications Year</th>
                            <th scope="col">Tools</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        // echo  $resumearry[1]['skill'];
                        if (isset($resumearry['certificationsnum'])) {
                            $Certificationsnum = $resumearry['certificationsnum'];
                            if ($Certificationsnum > 0) {
                                for ($i = 0; $i < $Certificationsnum; $i++) {
                                    $no = $i + 1;
                                    $Certificationsdeleid = $resumearry['certifications' . $i]['id'];

                                    echo '<tr>
                                            <th scope="row">' . $no . '</th>
                                            <td>' . $resumearry['certifications' . $i]['certifications'] . '</td>
                                            <td>' . $resumearry['certifications' . $i]['year'] . '</td>
                                            <td><div class="fa-hover col-lg-3 col-md-6"><a href="?hashid=' . $hashid . '&certificationsdeleid=' . $Certificationsdeleid . '"><i class="fa fa-times-circle"></i></a></div></td>
                                            
                                            </tr>';
                                }
                            }
                        } else {
                            echo '<tr>
                                    <th scope="row">1</th>
                                    <td>Please add Certifications to view</td>
                                    
                                    
                                    </tr>';
                        }
                        ?>

                    </tbody>
                </table>
            <form method="POST">
            <div class="card-body card-block">

                <div class="form-group"><label for="Description1id" class="pr-1  form-control-label">Description</label><input type="text" name="certification" id="Description1id" placeholder="Description" required="" class="form-control"></div>
                <div class="form-group"><label for="Description1id" class="px-1  form-control-label">Certification Year</label><input type="text" id="Certification" name="certificationyear" placeholder="form XX to XX" required="" class="form-control"></div>

            </div>
            <div class="card-footer">
                    <input class="btn btn-outline-success" type="submit" value="Save">


                </div>
            </form>


        </div>

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
<?php } else {
    echo 'لا يمكن الوصول لهذه المعلومات   ';
} ?>