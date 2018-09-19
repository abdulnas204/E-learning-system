<?php
session_start();
require_once('config/db_connect.php');
?>
<!DOCTYPE html>
<html class="transition-navbar-scroll top-navbar-xlarge bottom-footer" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CTI E-Learning</title>

    <link href="css/vendor/bootstrap.css" rel="stylesheet">
    <link href="css/vendor/font-awesome.css" rel="stylesheet">
    <link href="css/vendor/picto.css" rel="stylesheet">
    <link href="css/vendor/material-design-iconic-font.css" rel="stylesheet">
    <link href="css/vendor/datepicker3.css" rel="stylesheet">
    <link href="css/vendor/jquery.minicolors.css" rel="stylesheet">
    <link href="css/vendor/railscasts.css" rel="stylesheet">
    <link href="css/vendor/owl.carousel.css" rel="stylesheet">
    <link href="css/vendor/slick.css" rel="stylesheet">
    <link href="css/vendor/daterangepicker-bs3.css" rel="stylesheet">
    <link href="css/vendor/jquery.bootstrap-touchspin.css" rel="stylesheet">
    <link href="css/vendor/select2.css" rel="stylesheet">
    <link href="css/vendor/jquery.countdown.css" rel="stylesheet">

    <!-- App CSS CORE
    This variant is to be used when loading the separate styling modules -->
    <link href="css/app/main.css" rel="stylesheet">

    <link href="css/app/essentials.css" rel="stylesheet" />
    <link href="css/app/material.css" rel="stylesheet" />
    <link href="css/app/layout.css" rel="stylesheet" />
    <link href="css/app/sidebar.css" rel="stylesheet" />
    <link href="css/app/sidebar-skins.css" rel="stylesheet" />
    <link href="css/app/navbar.css" rel="stylesheet" />
    <link href="css/app/messages.css" rel="stylesheet" />
    <link href="css/app/media.css" rel="stylesheet" />
    <link href="css/app/charts.css" rel="stylesheet" />
    <link href="css/app/maps.css" rel="stylesheet" />
    <link href="css/app/colors-alerts.css" rel="stylesheet" />
    <link href="css/app/colors-background.css" rel="stylesheet" />
    <link href="css/app/colors-buttons.css" rel="stylesheet" />
    <link href="css/app/colors-text.css" rel="stylesheet" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
    WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
    .required, .error{
        color: red;
    }
</style>
</head>
<body>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top navbar-size-large navbar-size-xlarge paper-shadow" data-z="0" data-animated role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand navbar-brand-logo">
                <a href="index.php">CTI E-Learning</a>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="nav navbar-nav navbar-nav-margin-left">
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="active"><a href="index">Home page</a></li>
                        <li><a href="">Pricing</a></li>
                        <li><a href="">Tutors</a></li>
                        <li><a href="">Survey</a></li>
                        <li><a href="">Forum Home</a></li>
                        <li><a href="">Forum Category</a></li>
                        <li><a href="">Forum Thread</a></li>
                        <li><a href="">Blog Listing</a></li>
                        <li><a href="">Blog Post</a></li>
                        <li><a href="website-contact">Contact</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Courses <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">Grid Directory</a></li>
                        <li><a href="">List Directory</a></li>
                        <li><a href="">Single Course</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Student <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">Dashboard</a></li>
                        <li><a href="">My Courses</a></li>
                        <li><a href="">Take Course</a></li>
                        <li><a href="">Course Forums</a></li>
                        <li><a href="">Take Quiz</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Instructor <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">Dashboard</a></li>
                        <li><a href="">My Courses</a></li>
                        <li><a href="">Edit Course</a></li>
                        <li><a href="">Earnings</a></li>
                        <li><a href="">Statement</a></li>
                        <li><a href="">Messages</a></li>
                        <li><a href="">Private Profile</a></li>
                    </ul>
                </li>
                <li><a href="">Contact Us</a></li>
            </ul>
            <div class="navbar-right">
                <a href="index" class="navbar-btn btn btn-primary">Log In</a>
                <a href="registration_form" class="navbar-btn btn btn-primary">Sign Up</a>
            </div>
        </div><!-- /.navbar-collapse -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="input-group">
                        <!--<span class="input-group-btn">
								<select class="form-control btn btn-grey-800" style="width: 150px; height: 50px;">
                                    <option>COURSES</option>
                                </select>
							  </span>-->
                        <input type="text" class="form-control" style="height: 50px" placeholder="Search Courses">
								<span class="input-group-btn">
								<button class="btn btn-grey-800" style="height: 50px" type="button">Subscribe</button>
							  </span>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

    </div>
</div>