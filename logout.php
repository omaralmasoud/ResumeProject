<?php
    require 'config.php';
    // Logout Page
    if($_GET)
    {
        $logout = strip_tags($_GET['action']);
        
        
        if($logout == 'logout')
        {
            // Delete token from database
            $token_cookie = strip_tags($_COOKIE['token']);
            // Make a connection to database
            $check = mysqli_query($connectdb,'
            SELECT * FROM `token` WHERE token="'.$token_cookie.'"
            ') or die(mysqli_error($check));
            if($check)
            {
                // Connection work
                if(mysqli_num_rows($check)>0)
                {
                    $delete = mysqli_query($connectdb,'
                    DELETE FROM `token` WHERE token="'.$token_cookie.'"
                    ') or die(mysqli_error($delete));

                    $cookie_name='token';
                    $cookie_value=null;
                    $cookie_exp = time() - 60*60*24*30;
                    setcookie($cookie_name,$cookie_value,$cookie_exp);
                    setcookie('isLogin',null,$cookie_exp);
                    header('Location: login.php');
                }else
                {
                    // fake cookies
                    $cookie_name='token';
                    $cookie_value=null;
                    $cookie_exp = time() - 60*60*24*30;
                    setcookie($cookie_name,$cookie_value,$cookie_exp);
                    setcookie('isLogin',null,$cookie_exp);
                    header('Location: login.php');
                }
            }else 
            {
                // connection down
                    $cookie_name='token';
                    $cookie_value=null;
                    $cookie_exp = time() - 60*60*24*30;
                    setcookie($cookie_name,$cookie_value,$cookie_exp);
                    setcookie('isLogin',null,$cookie_exp);
                    header('Location: login.php');
            }
            
        }
    }

 ?>