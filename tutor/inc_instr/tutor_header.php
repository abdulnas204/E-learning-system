<?php
require_once('../config/db_connect.php');
session_start();

if(!isset($_SESSION['tutor']) && (!isset($_SESSION['role_session'])))
{
    echo " <script> window.location.href='../index';  </script>";
    exit();
}
elseif($_SESSION['role_session'] != 2)
{
    echo " <script> window.location.href='../index';  </script>";
    exit();
}

else{
$session_id=$_SESSION['tutor'];
    $query=$conn->query("SELECT * FROM tutor WHERE email = (SELECT username FROM login WHERE username = '$session_id')");
    $row=mysqli_fetch_assoc($query);
    //$row=$query->fetch_array();
    $count=$query->num_rows;
    $fname=$row['fname'];
    $lname=$row['lname'];
    $prog_id=$row['prog_id'];
    $tutor_id=$row['tutor_id'];
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
<style>
    .required,.error{
        color: red;
    }
</style>
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
                        <a><p><strong>WELCOME TO CTL ONLINE PLATFORM</strong></p></a>
                    </li>
                    <li class="dropdown">
                        <a href="my_courses"><i class="fa fa-book"></i> My Courses <span class="caret"></span></a>
                    </li>
                    <li class="dropdown">
                        <a href="inbox"><i class="fa fa-envelope"></i> Messages <span class="caret"></span></a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-nav-bordered navbar-right">
                    <!-- notifications -->
                    <li class="dropdown notifications updates">
                        <?php
                        $s=$conn->query("SELECT * FROM tutor_inquiries WHERE reply!='NULL'");
                        $c=mysqli_num_rows($s);
                        ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge badge-primary"><?php echo $c;?></span>
                        </a>
                        <ul class="dropdown-menu" role="notification">
                            <li class="dropdown-header">Notifications</li>
                            <li class="media">
                                <a href="inbox"><div class="pull-right">
                                        <span class="label label-success">View all notifications.</span>
                                    </div></a>
                            </li>
                        </ul>
                    </li>
                    <!-- // END notifications -->
                    <!-- User -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                            <img src="../images/tutors/<?php echo $row['image'];?>" alt="Photo" class="img-circle"  style="width: 45px; height: 35px"/>
                            <?php echo $fname;?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="my_profile">My Profile</a></li>
                            <!--<li><a href="../students/app-student-billing.html">Billing</a></li>-->
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
                        <img src="../images/tutors/<?php echo $row['image'];?>" alt="Photo" class="img-circle" style="width: 100px; height: 100px"/>
                    </a>
                    <h4 class="text-display-1 margin-none"><?php echo $fname.' '.$lname;?></h4>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li  class="active"><a href="index"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                <li ><a href="all_courses"><i class="fa fa-book"></i><span>All Courses</span></a></li>
                <li ><a href="my_courses"><i class="fa fa-mortar-board"></i><span>My Courses</span></a></li>
                <li ><a href="my_profile"><i class="fa fa-user"></i><span>Account</span></a></li>
                <li ><a href="inbox"><i class="fa fa-paper-plane"></i><span>Messages</span></a></li>
<!--                <li ><a href="app-tutor-earnings.html"><i class="fa fa-bar-chart-o"></i><span>Earnings</span></a></li>-->
<!--                <li ><a href="app-tutor-statement.html"><i class="fa fa-dollar"></i><span>Statement</span></a></li>-->
                <li><a href="../logout"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
            </ul>
        </div>
    </div>