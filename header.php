<?php
ob_start();
// Header Page
require 'config.php';
// Login Value form cookie
if (isset($_COOKIE['isLogin']) == 1) {
    define('logins', strip_tags($_COOKIE['isLogin']));
    $login = logins;
} else {
    $login = 0;
}
// check cookies
if (isset($_COOKIE['token'])) {
    $token_cookie = strip_tags($_COOKIE['token']);

    // check token in database 
    $checkcookie = mysqli_query($connectdb, '
        SELECT * FROM `token` WHERE token="' . $token_cookie . '"
        ') or die(mysqli_error($checkcookie));
    if ($checkcookie) {
        // Connection Work
        if (mysqli_num_rows($checkcookie) > 0) {
            // Get id from token
            $getid = mysqli_fetch_assoc($checkcookie);
            $userid = $getid['userid'];

            // Make a connecton to user table 
            $getuser = mysqli_query($connectdb, '
                SELECT * FROM `users` WHERE id="' . $userid . '"
                ') or die($getuser);
            if ($getuser) {
                //  Connection Work
                if (mysqli_num_rows($getuser) > 0) {


                    // fecth User Data
                    $userdata = mysqli_fetch_assoc($getuser);
                    $id = $userdata['id'];
                    $username = $userdata['username'];
                    $email = $userdata['email'];
                    $date = $userdata['date'];
                    $admin = $userdata['admin'];
                } else {
                    // Fake id Close connection immanidtly
                    mysqli_close($connectdb);
                }
            } else {
                // Connection Down
                echo 'فشل الاتصال بقواعد البيانات يرجى المحاولة لاحقا';
            }
        } else {
            // Fake cookies, Destroy it 
            $cookie_name = 'token';
            $cookie_value = null;
            $cookie_exp = time() - 60 * 60 * 24 * 7;
            setcookie($cookie_name, $cookie_value, $cookie_exp);
            header('Location: login.php');
        }
    } else {
        // Connection Down
        echo 'فشل الاتصال بقواعد البيانات يرجى المحاولة لاحقا';
    }
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CV</title>
    <meta name="description" content="Resume Project For HJORE">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>

<?php if ($login == 1) { ?>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Profile</li><!-- /.menu-title -->
                    <li class="menu-item-has-children">
                        <a href="index.php" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>View Profile</a>
                     
                    </li>
                  <!--  <li class="menu-item-has-children dropdown">
                        <a href="index.php" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-wrench"></i>Edit profile</a>
                        -->
                    

                    <li class="menu-title">Resume</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="addresume.php" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti ti-pencil-alt"></i>Add Resume</a>
                       
                    </li>
                    <li>
                        <a href="viewresume.php"> <i class="menu-icon fa fa-edit"></i>Edit Resume </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="viewresume.php" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti ti-view-list"></i>View Resume</a>
                        
                    </li>

                    
                    <li class="menu-title">Tools</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="logout.php?action=logout"> <i class="menu-icon fa fa-sign-out"></i>Logout</a>

                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <div class="card-header user-header alt bg-dark">
                    <div class="media">
                        <div class="top-right">
                            <div class="header-menu">
                              


                            </div>
                        </div>
                        <a href="#">
                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                        </a>

                        <div class="media-body">
                            <h2 class="text-light display-6">Resume</h2>
                            <p>Resume Project</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->
<?php }


?>