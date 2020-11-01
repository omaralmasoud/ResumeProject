<?php

    // Login Page
    require 'header.php';

    if($login == 1)
    {
        header('Location: index.php');
    }
    else
    {
        // Post method to login
    if($_POST)
    {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        // check empty values

        if(empty($email) || empty($password))
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
            $password = md5($password);
            // make a connection to database
            $login = mysqli_query($connectdb,'
            SELECT * FROM `users` WHERE email="'.$email.'" AND password="'.$password.'"
            ') or die(mysqli_error($login));
            if($login)
            {
                // Connection Work
                if(mysqli_num_rows($login)>0)
                {
                    // Success Login
                    $fecthuser = mysqli_fetch_assoc($login);
                    $user_id = $fecthuser['id'];
                    $user_name = $fecthuser['username'];
                    
                    // Make a Random Cookies Value 
                    function GenerateAccessToken($length = 10) {
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        return $randomString;
                        
                    }
                    $token = GenerateAccessToken();
                    // Add Value to database token
                    $addtoken = mysqli_query($connectdb,'
                    INSERT INTO `token`(`userid`, `token`) VALUES ("'.$user_id.'","'.$token.'")
                    ') or die(mysqli_error($addtoken));
                    
                    
                    // Make a cookies 
                    $cookie_name='token';
                    $cookie_value=$token;
                    // Login Cookie
                    $cookie_login = 'isLogin';
                    // cookie expire 
                    $cookie_exp = time()+60*60*24*7;
                    // set cookies
                    setcookie($cookie_name,$cookie_value,$cookie_exp);
                    setcookie($cookie_login,1,$cookie_exp);
                    header('Location: index.php');
                }else 
                {
                    echo '  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">خطأ</span>
            البريد الالكتروني او اسم المستخدم غير متطابق
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                }
            }else
            {
                // Connection down
                echo 'فشل الاتصال بقواعد البيانات';
            }
            
        }
    }}
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
                    <form method="POST">
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
                                <input type="checkbox"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                       
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="signup.php"> Sign Up Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

 
