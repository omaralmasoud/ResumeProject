<?php

    // Sigin up Page
    require 'header.php';
    
    if($_POST)
    {
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);
        $password =md5($_POST['password']);
        // check for empty values 
        if(empty($username) or empty($email) or empty($password))
        {
            // Empty Values
            echo '  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">خطأ</span>
            يرجى ملئ جميع الحقول
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }else 
        {
        // Make a connection to database
        $check = mysqli_query($connectdb,'SELECT  `email` FROM `users` WHERE `email`="'.$email.'"') or die(mysqli_error($check));
        if($check)
        {
            // connection work
            if(mysqli_num_rows($check)>0)
            {
                // There is a user with same email
                echo 'البريد الالكتروني المستخدم مسجل لدينا بالفعل';
            }else
            {
                $signup = mysqli_query($connectdb,'
                INSERT INTO `users`( `username`, `password`, `email`)
                 VALUES ("'.$username.'","'.$password.'","'.$email.'")
                ') or die(mysqli_error($signup));
                if($signup)
                {
                    // Connection work user added
                    echo '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                    <span class="badge badge-pill badge-primary">نجاح</span>
                    لقد تم تسجيل عضويتك بنجاح يرجى تسجيل الدخول
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }else 
                {
                    // connection down
                    echo 'حدث خطأ في عملية التسجيل يرجى المحاولة لاحقا';
                }
            }
            
            
        }else 
        {
            // connection down
        }
        }

        
    }

 ?>
 <body class="bg-dark">

<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    <img class="align-content" src="images/logo.png" alt="">
                </a>
            </div>
            <div class="login-form">
                <form method="POST" >
                <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Agree the terms and policy
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                    
                    <div class="register-link m-t-15 text-center">
                        <p>Already have account ? <a href="login.php"> Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>