<?php

class resume
{

    function Operatins($connectdb, $hashid)
    {

        $skills = $this->getskills($connectdb, $hashid);
        $languages = $this->getlanguage($connectdb, $hashid);
        $resume = $this->getresume($connectdb, $hashid);
        $experience = $this->getexperience($connectdb, $hashid);
        $education = $this->geteducation($connectdb, $hashid);
        $certifications = $this->getcertifications($connectdb, $hashid);
        $img = $this->getimg($connectdb, $hashid);

        if (empty($resume)) {
        } else {
            $info = $resume;

            if (empty($skills)) {
            } else {
                $info = $info + $skills;
            }
            if (empty($languages)) {
            } else {
                $info = $info + $languages;
            }
            if (empty($experience)) {
            } else {
                $info = $info + $experience;
            }
            if (empty($education)) {
            } else {
                $info = $info + $education;
            }
            if (empty($certifications)) {
            } else {
                $info = $info + $certifications;
            }
            if (empty($img))
            {}else 
            {
                $info = $info + $img;
            }
            // echo print_r($info);
            return $info;
        }
    }

    function getresume($connectdb, $hashid)
    {


        // Create a connection to database
        // Make a query

        $getquery = 'SELECT * FROM `resmue` WHERE `hashid`="' . $hashid . '"';
        $getresmue = mysqli_query($connectdb, $getquery) or die($getresmue);
        if ($getresmue) {

            // Connection Work
            if (mysqli_num_rows($getresmue) > 0) {
                // We found the resume data

                $fecthresume = mysqli_fetch_assoc($getresmue);
                $info = $fecthresume;
                // Make a new query for skills(Skill section)

                $info = array_merge($fecthresume);

                return $info;
            } else {
                return null;
            }
        } else {
            // Connection down
            die();
        }
    }
    function updateresume($connectdb, $hashid,$fullname,$birthdate,$phone,$email,$aboutyou)
    {


        // Create a connection to database
        // Make a query

        $getquery = 'SELECT * FROM `resmue` WHERE `hashid`="' . $hashid . '"';
        $getresmue = mysqli_query($connectdb, $getquery) or die($getresmue);
        if ($getresmue) {

            // Connection Work
            if (mysqli_num_rows($getresmue) > 0) {
                // We found the resume data
                 // make a update query here
                 $info_update_query = 'UPDATE `resmue` SET `fullname`="'.$fullname.'",`birthdate`="'.$birthdate.'"
                 ,`phone`="'.$phone.'",`email`="'.$email.'",`aboutyou`="'.$aboutyou.'" WHERE hashid="'.$hashid.'"';
                 $info_update = mysqli_query($connectdb,$info_update_query) or die(mysqli_error($info_update));
                 if($info_update)
                 {
                    // connection work data updated
                    header('Location: editresume.php?hashid='.$hashid.'');
                 }else { die(); }
                
                

            } else {
                return null;
            }
        } else {
            // Connection down
            die();
        }
    }
    function getskills($connectdb, $hashid)
    {

        $skillquery = 'SELECT * FROM `skills` WHERE `resumehashid`="' . $hashid . '"';
        $getskills = mysqli_query($connectdb, $skillquery) or die(mysqli_error($getskills));
        if ($getskills) {
            // Connection work
            // Check if there is a Skills for this resume
            if (mysqli_num_rows($getskills) > 0) {
                // Skills founded
                $i = 0;
                while ($fetchskills = mysqli_fetch_assoc($getskills)) {
                    $skills['skill' . $i] = $fetchskills;
                    $i++;
                }
                $numskill = array('skillnum' => $i);
                $skills = array_merge($skills, $numskill);
                //array_push($fecthresume,$numskill['sn']);
                // $info = array_merge($fecthresume,$skills);
                //echo print_r($info);
                return $skills;
            } else {
                // No skills
                return null;
            }
        } else {
            // Connection down
        }
    }
    function getlanguage($connectdb, $hashid)
    {

        // Make a new query for Languages(Languages section)
        $languagequery = 'SELECT * FROM `languages` WHERE `resumehashid`="' . $hashid . '"';
        $getlanguage = mysqli_query($connectdb, $languagequery) or die(mysqli_error($getlanguage));
        if ($getlanguage) {
            if (mysqli_num_rows($getlanguage) > 0) {
                // Language founded
                $l = 0;
                while ($fecthlanguage = mysqli_fetch_assoc($getlanguage)) {
                    $languages['language' . $l] = $fecthlanguage;
                    $l++;
                }
                $numlanguages = array('languagesnum' => $l);


                // array_push($fecthresume,$numlanguages);
                $languages =  array_merge($languages, $numlanguages);
                return $languages;
                //echo print_r($info);
            } else {
                return null;
            }
        } else {
            // Connection down
            die();
        }
    }
    function addskill($connectdb, $hashid, $skill)
    {
        // make a connection to database
        $addskillquery = 'INSERT INTO `skills`( `skill`, `resumehashid`) VALUES ("' . $skill . '","' . $hashid . '")';
        $addskill = mysqli_query($connectdb, $addskillquery) or die(mysqli_error($addskill));
        if ($addskill) {
            // Connection work
            echo 'Skills Added';
            header('Location: editresume.php?hashid=' . $hashid . '');
        } else {
            // Connection down
            echo 'Connection error';
        }
    }

    function Deleteskill($connectdb, $skillid, $hashid)
    {
        // Make a connection to database to check skill id
        $checkskill = 'SELECT * FROM `skills` WHERE id="' . $skillid . '"';
        $skill = mysqli_query($connectdb, $checkskill) or die(mysqli_error($skill));
        if ($skill) {
            if (mysqli_num_rows($skill) > 0) {
                // Delete skill now
                $deleskillquery = 'DELETE FROM `skills` WHERE id="' . $skillid . '"';
                $deleteskill = mysqli_query($connectdb, $deleskillquery) or die(mysqli_error($deleteskill));
                if ($deleteskill) {
                    echo 'Skill deleted';
                    header('Location: editresume.php?hashid=' . $hashid . '');
                }
            }
        }
    }
    function AddLanguage($connectdb, $hashid, $language)
    {
        // make a connection to database

        $addlanguagequery = 'INSERT INTO `languages`( `language`, `resumehashid`) VALUES ("' . $language . '","' . $hashid . '")';
        $addlanguage = mysqli_query($connectdb, $addlanguagequery) or die(mysqli_error($addlanguage));
        if ($addlanguage) {
            // Connection work
            echo 'Language Added';
            header('Location: editresume.php?hashid=' . $hashid . '');
        } else {
            // Connection down
            echo 'Connection error';
        }
    }

    function DeleteLanguage($connectdb, $languageid, $hashid)
    {

        // Make a connection to database to check skill id
        $checkLanguage = 'SELECT * FROM `languages` WHERE id="' . $languageid . '"';
        $Language = mysqli_query($connectdb, $checkLanguage) or die(mysqli_error($Language));
        if ($Language) {
            if (mysqli_num_rows($Language) > 0) {
                // Delete Language now
                $delelanguagequery = 'DELETE FROM `languages` WHERE id="' . $languageid . '"';
                $deletelanguage = mysqli_query($connectdb, $delelanguagequery) or die(mysqli_error($deletelanguage));
                if ($deletelanguage) {
                    echo 'Skill deleted';
                    header('Location: editresume.php?hashid=' . $hashid . '');
                }
            }
        }
    }

    function AddExperience($connectdb, $hashid, $Experience, $Experienceyear)
    {
        // make a connection to database

        $addExperiencequery = 'INSERT INTO `experience`( `experience`,`year`, `resumehashid`) VALUES ("' . $Experience . '","' . $Experienceyear . '","' . $hashid . '")';
        $addExperience = mysqli_query($connectdb, $addExperiencequery) or die(mysqli_error($addExperience));
        if ($addExperience) {
            // Connection work
            echo 'Experience Added';
            header('Location: editresume.php?hashid=' . $hashid . '');
        } else {
            // Connection down
            echo 'Connection error';
        }
    }
    function getexperience($connectdb, $hashid)
    {

        // Make a new query for Languages(Languages section)
        $experiencequery = 'SELECT * FROM `experience` WHERE `resumehashid`="' . $hashid . '"';
        $gexperience = mysqli_query($connectdb, $experiencequery) or die(mysqli_error($gexperience));
        if ($gexperience) {
            if (mysqli_num_rows($gexperience) > 0) {
                // Language founded
                $l = 0;
                while ($fecthexperience = mysqli_fetch_assoc($gexperience)) {
                    $experience['experience' . $l] = $fecthexperience;
                    $l++;
                }
                $numexperience = array('experiencenum' => $l);


                // array_push($fecthresume,$numexperience);
                $experience =  array_merge($experience, $numexperience);
                return $experience;
                //echo print_r($info);
            } else {
                return null;
            }
        } else {
            // Connection down
            die();
        }
    }
    function Deleteexperience($connectdb, $experienceid, $hashid)
    {

        // Make a connection to database to check skill id
        $checkexperience = 'SELECT * FROM `experience` WHERE id="' . $experienceid . '"';
        $experience = mysqli_query($connectdb, $checkexperience) or die(mysqli_error($experience));
        if ($experience) {
            if (mysqli_num_rows($experience) > 0) {
                // Delete Language now
                $deleexperiencequery = 'DELETE FROM `experience` WHERE id="' . $experienceid . '"';
                $deleteexperience = mysqli_query($connectdb, $deleexperiencequery) or die(mysqli_error($deleteexperience));
                if ($deleteexperience) {
                    echo 'Skill deleted';
                    header('Location: editresume.php?hashid=' . $hashid . '');
                }
            }
        }
    }
    function AddEducation($connectdb, $hashid, $Education, $Educationeyear)
    {
        // make a connection to database

        $addEducationquery = 'INSERT INTO `education`( `education`,`year`, `resumehashid`) VALUES ("' . $Education . '","' . $Educationeyear . '","' . $hashid . '")';
        $addEducation = mysqli_query($connectdb, $addEducationquery) or die(mysqli_error($addEducation));
        if ($addEducation) {
            // Connection work
            echo 'Education Added';
            header('Location: editresume.php?hashid=' . $hashid . '');
        } else {
            // Connection down
            echo 'Connection error';
        }
    }
    function getEducation($connectdb, $hashid)
    {

        // Make a new query for Languages(Languages section)
        $educationquery = 'SELECT * FROM `education` WHERE `resumehashid`="' . $hashid . '"';
        $geducation = mysqli_query($connectdb, $educationquery) or die(mysqli_error($geducation));
        if ($geducation) {
            if (mysqli_num_rows($geducation) > 0) {
                // Language founded
                $l = 0;
                while ($fectheducation = mysqli_fetch_assoc($geducation)) {
                    $education['education' . $l] = $fectheducation;
                    $l++;
                }
                $numeducation = array('educationnum' => $l);


                // array_push($fecthresume,$numeducation);
                $education =  array_merge($education, $numeducation);
                return $education;
                //echo print_r($info);
            } else {
                return null;
            }
        } else {
            // Connection down
            die();
        }
    }
    function DeleteEducation($connectdb, $educationid, $hashid)
    {

        // Make a connection to database to check skill id
        $checkeducation = 'SELECT * FROM `education` WHERE id="' . $educationid . '"';
        $education = mysqli_query($connectdb, $checkeducation) or die(mysqli_error($education));
        if ($education) {
            if (mysqli_num_rows($education) > 0) {
                // Delete Language now
                $deleeducationquery = 'DELETE FROM `education` WHERE id="' . $educationid . '"';
                $deleteeducation = mysqli_query($connectdb, $deleeducationquery) or die(mysqli_error($deleteeducation));
                if ($deleteeducation) {
                    echo 'education deleted';
                    header('Location: editresume.php?hashid=' . $hashid . '');
                }
            }
        }
    }
    function Addcertification($connectdb, $hashid, $certification, $certificationeyear)
    {
        // make a connection to database

        $addcertificationquery = 'INSERT INTO `certifications`( `certifications`,`year`, `resumehashid`) VALUES ("' . $certification . '","' . $certificationeyear . '","' . $hashid . '")';
        $addcertification = mysqli_query($connectdb, $addcertificationquery) or die(mysqli_error($addcertification));
        if ($addcertification) {
            // Connection work
            echo 'certification Added';
            header('Location: editresume.php?hashid=' . $hashid . '');
        } else {
            // Connection down
            echo 'Connection error';
        }
    }
    function getcertifications($connectdb, $hashid)
    {

        // Make a new query for Languages(Languages section)
        $certificationsquery = 'SELECT * FROM `certifications` WHERE `resumehashid`="' . $hashid . '"';
        $gcertifications = mysqli_query($connectdb, $certificationsquery) or die(mysqli_error($gcertifications));
        if ($gcertifications) {
            if (mysqli_num_rows($gcertifications) > 0) {
                // Language founded
                $l = 0;
                while ($fecthcertifications = mysqli_fetch_assoc($gcertifications)) {
                    $certifications['certifications' . $l] = $fecthcertifications;
                    $l++;
                }
                $numcertifications = array('certificationsnum' => $l);


                // array_push($fecthresume,$numcertifications);
                $certifications =  array_merge($certifications, $numcertifications);
                return $certifications;
                //echo print_r($info);
            } else {
                return null;
            }
        } else {
            // Connection down
            die();
        }
    }
    function Deletecertifications($connectdb, $certificationsid, $hashid)
    {

        // Make a connection to database to check skill id
        $checkcertifications = 'SELECT * FROM `certifications` WHERE id="' . $certificationsid . '"';
        $certifications = mysqli_query($connectdb, $checkcertifications) or die(mysqli_error($certifications));
        if ($certifications) {
            if (mysqli_num_rows($certifications) > 0) {
                // Delete Language now
                $delecertificationsquery = 'DELETE FROM `certifications` WHERE id="' . $certificationsid . '"';
                $deletecertifications = mysqli_query($connectdb, $delecertificationsquery) or die(mysqli_error($deletecertifications));
                if ($deletecertifications) {
                    echo 'certifications deleted';
                    header('Location: editresume.php?hashid=' . $hashid . '');
                }
            }
        }
    }
    function Uploadimg($connectdb, $hashid)
    {
        $target_dir = "img/users/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . $target_dir . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                // make a connection to database to save a image dir
                $imgdir = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                // check if user has an img and replace it
                $checkimgquery = 'SELECT * FROM `img` WHERE hashid="' . $hashid . '"';
                $checkimg = mysqli_query($connectdb, $checkimgquery) or die($checkimg);
                if ($checkimg) {
                    // connection work
                    if (mysqli_num_rows($checkimg) > 0) {
                        // Update query
                        $update_img_query = 'UPDATE `img` SET `img`="' . $imgdir . '" WHERE hashid="' . $hashid . '"';
                        $update_img = mysqli_query($connectdb, $update_img_query) or die(mysqli_error($update_img));
                        if ($update_img) {
                            // connection work img updated
                            header('Location: editresume.php?hashid='.$hashid.'');
                        } else {
                            die();
                        }
                    } else {
                        // Insert query
                        $insert_img_query = 'INSERT INTO `img`(`img`, `hashid`) VALUES ("' . $imgdir . '","' . $hashid . '")';
                        $insert_img = mysqli_query($connectdb, $insert_img_query) or die(mysqli_error($insert_img));
                        if ($insert_img) {
                            // connection work img added
                            header('Location: editresume.php?hashid='.$hashid.'');
                        } else {
                            die();
                        }
                    }
                } else {
                    // connection down
                    die();
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    function getimg($connectdb, $hashid)
    {

        $imgquery = 'SELECT * FROM `img` WHERE `hashid`="' . $hashid . '"';
        $getimg = mysqli_query($connectdb, $imgquery) or die(mysqli_error($getimg));
        if ($getimg) {
            // Connection work
            // Check if there is a img for this resume
            if (mysqli_num_rows($getimg) > 0) {
                // img founded
                $i = 0;
                while ($fetchimg = mysqli_fetch_assoc($getimg)) {
                    $img['img' . $i] = $fetchimg;
                    $i++;
                }
                $numimg = array('imgnum' => $i);
                $img = array_merge($img, $numimg);
                //array_push($fecthresume,$numimg['sn']);
                // $info = array_merge($fecthresume,$img);
                //echo print_r($info);
                return $img;
            } else {
                // No img
                return null;
            }
        } else {
            // Connection down
        }
    }
    
}
