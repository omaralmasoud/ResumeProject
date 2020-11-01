<?php

    // Index page
    require 'header.php';
    require 'Class/viewresume.inc';
    // Check for Get method
    if($login == 0)
    {
        header('Location: login.php');
    }else {

        $viewresume = new viewresume();
        $getresume = $viewresume->viewresumes($connectdb,$userid);
        
    }
    
 ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-4">
                        <aside class="profile-nav alt">
                            <section class="card">
                                <div class="card-header user-header alt bg-dark">
                                    <div class="media">
                                        <a href="#">
                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                                        </a>
                                        <div class="media-body">
                                            <h2 class="text-light display-6"><?php echo strtoupper ($username); ?></h2>
                                            <p><?php echo strtoupper($email) ; ?></p>
                                            
                                        </div>
                                    </div>
                                </div>


                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#"> <i class="ti-view-list"></i> Number of Resumes <span class="badge badge-primary pull-right">   <?php if (isset($getresume['numeresume'])>0) {
            $resumenumber = $getresume['numeresume'];
            echo  $resumenumber;
        } else echo '0'; ?></span></a>
                                    </li>
                                    
                               
                                </ul>

                            </section>
                        </aside>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Add a new Resume</div>
                                        <div class="stat-digit">Unlimited</div>
                                        
                                    </div>
                                    <div class="stat-content dib">
                                    <div class="icon-container">
                                   <a href="addresume.php" > <span class="ti-pencil-alt"></span><span class="icon-name"> Add Resume</span></a>
                                </div></div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">View Your Resumes</div>
                                        <div class="stat-digit">

                                        <?php if (isset($getresume['numeresume'])>0) {
            $resumenumber = $getresume['numeresume'];
            echo  $resumenumber;
        } else echo '0'; ?>
                                        </div>
                                        
                                    </div>
                                    <div class="stat-content dib">
                                    <div class="icon-container">
                                   <a href="viewresume.php" >  <span class="ti-view-list"></span><span class="icon-name"> View Resume</span>
                               </a>
                                </div></div>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                </div><!-- .row -->
            </div><!-- .animated -->
        </div><!-- .content -->