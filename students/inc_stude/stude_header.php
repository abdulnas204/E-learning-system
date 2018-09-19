<?php
require_once('../config/db_connect.php');
session_start();;
if(!isset($_SESSION['students'])  && (!isset($_SESSION['role_session'])))
{
    echo " <script> window.location.href='../index';  </script>";
}
elseif($_SESSION['role_session']!=3){
    echo " <script> window.location.href='../index';  </script>";
}
else{
    $session_id=$_SESSION['students'];
    $query=$conn->query("SELECT * FROM student WHERE email = (SELECT username FROM login WHERE username = '$session_id')");
    $row=mysqli_fetch_assoc($query);
    //$row=$query->fetch_array();
    $count=$query->num_rows;
    $fname=$row['fname'];
    $lname=$row['lname'];
    $prog_id=$row['prog_id'];
    $student_id=$row['student_id'];
    //$user=$row['username'];
}
?>
<!DOCTYPE html>
<html class="st-layout ls-top-navbar-large ls-bottom-footer show-sidebar sidebar-l3" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Learning</title>

    <link href="../css/vendor/bootstrap.css" rel="stylesheet">
    <link href="../css/vendor/font-awesome.css" rel="stylesheet">
    <link href="../css/vendor/picto.css" rel="stylesheet">
    <link href="../css/vendor/material-design-iconic-font.css" rel="stylesheet">
    <link href="../css/vendor/datepicker3.css" rel="stylesheet">
    <link href="../css/vendor/jquery.minicolors.css" rel="stylesheet">
    <link href="../css/vendor/railscasts.css" rel="stylesheet">
    <link href="../css/vendor/owl.carousel.css" rel="stylesheet">
    <link href="../css/vendor/slick.css" rel="stylesheet">
    <link href="../css/vendor/daterangepicker-bs3.css" rel="stylesheet">
    <link href="../css/vendor/jquery.bootstrap-touchspin.css" rel="stylesheet">
    <link href="../css/vendor/select2.css" rel="stylesheet">
    <link href="../css/vendor/jquery.countdown.css" rel="stylesheet">

    <link href="../css/app/main.css" rel="stylesheet">

    <link href="../css/app/essentials.css" rel="stylesheet" />
    <link href="../css/app/material.css" rel="stylesheet" />
    <link href="../css/app/layout.css" rel="stylesheet" />
    <link href="../css/app/sidebar.css" rel="stylesheet" />
    <link href="../css/app/sidebar-skins.css" rel="stylesheet" />
    <link href="../css/app/navbar.css" rel="stylesheet" />
    <link href="../css/app/messages.css" rel="stylesheet" />
    <link href="../css/app/media.css" rel="stylesheet" />
    <link href="../css/app/charts.css" rel="stylesheet" />
    <link href="../css/app/maps.css" rel="stylesheet" />
    <link href="../css/app/colors-alerts.css" rel="stylesheet" />
    <link href="../css/app/colors-background.css" rel="stylesheet" />
    <link href="../css/app/colors-buttons.css" rel="stylesheet" />
    <link href="../css/app/colors-text.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Wrapper required for sidebar transitions -->
<div class="st-container">

    <!-- Fixed navbar -->
    <div class="navbar navbar-size-large navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#sidebar-menu" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand navbar-brand-primary navbar-brand-logo navbar-nav-padding-left">
                    <a href="index">CTI E-Learning</a>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a><p><strong>WELCOME TO CTL ONLINE PLARTFORM</strong></p></a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-nav-bordered navbar-right">
                    <!-- notifications -->
                    <li class="dropdown notifications updates">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge badge-primary">0</span>
                        </a>
<!--                        <ul class="dropdown-menu" role="notification">-->
<!--                            <li class="dropdown-header">Notifications</li>-->
<!--                            <li class="media">-->
<!--                                <div class="pull-right">-->
<!--                                    <span class="label label-success">New</span>-->
<!--                                </div>-->
<!--                                <div class="media-left">-->
<!--                                    <img src="../images/people/50/guy-2.jpg" alt="people" class="img-circle" width="30">-->
<!--                                </div>-->
<!--                                <div class="media-body">-->
<!--                                    <a href="#">Adrian D.</a> posted <a href="#">a photo</a> on his timeline. <br/>-->
<!--                                    <span class="text-caption text-muted">5 mins ago</span>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            -->
<!--                        </ul>-->
                    </li>
                    <!-- // END notifications -->
                    <!-- User -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                            <img src="../images/students/<?php echo $row['image'];?>" alt="Photo" class="img-circle" width="40"/>
                            <?php echo $fname;?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="my_profile">Account</a></li>
                            <li><a href="../logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->

        </div>
    </div>

    <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
    <div class="sidebar left sidebar-size-3 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu" data-type="collapse">
        <div data-scrollable>

            <div class="sidebar-block">
                <div class="profile">
                    <a href="#">
                        <img src="../images/students/<?php echo $row['image'];?>" alt="Update Profile" class="img-circle width-80"/>
                    </a>
                    <h4 class="text-display-1 margin-none"><?php echo $fname.' '.$lname;?></h4>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li class="active"><a href="index"><i class="fa fa-bar-chart-o"></i><span>Dashboard</span></a></li>
                <li class="hasSubmenu">
                    <a href="#course-menu"><i class="fa fa-mortar-board"></i><span>Courses</span></a>
                    <ul id="course-menu">
                        <li><a href="all_courses"><span>All Courses</span></a></li>
                        <li><a href="my_courses"><span>My Courses</span></a></li>
                        <li><a href="specific_topics"><span>Specific_topics</span></a></li>
                    </ul>
                </li>

                <li class="hasSubmenu">
                    <a href="#account-menu"><i class="fa fa-user"></i><span>Account</span></a>
                    <ul id="account-menu">
                        <li ><a href="my_profile"><span>My Profile</span></a></li>
<!--                        <li ><a href="billing"><span>Subscriptions</span></a></li>-->
                    </ul>
                </li>
                <li class=""><a href="inbox"><i class="fa fa-envelope"></i><span>Message</span></a></li>
<!--                <li><a href="chart_platform"><i class="fa fa-comments"></i><span>Messages</span></a></li>-->
                <li><a href="../logout"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
            </ul>
        </div>
    </div>