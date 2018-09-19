<?php

$page = 'Introduction';

require_once('../../config/db_connect.php');
session_start();;
if(!isset($_SESSION['students'])  && (!isset($_SESSION['role_session'])))
{
    echo " <script> window.close();   </script>";
}
elseif($_SESSION['role_session']!=3){
    echo " <script> window.close();  </script>";
}

if(!isset($_GET['t_id']) && !isset($_GET['c_id']))
{
    echo " <script> window.close();   </script>";
}
/*Get test using the topic_id after validating it*/
if(isset($_GET['t_id']))
{
    /*then get only the topic test*/
    $t = $conn->query("SELECT * FROM test WHERE topic_id = '$_GET[t_id]' ");
    $test =  mysqli_fetch_assoc($t);
}
if(isset($_GET['c_id']))
{
    /*then get only the topic test*/
    $t = $conn->query("SELECT * FROM test WHERE course_id = '$_GET[c_id]' ");
    $test =  mysqli_fetch_assoc($t);
}

/*Timer Start*/
$_SESSION['duration'] = $test['test_duration'];
$_SESSION['start_time'] = date('Y-m-d H:i:s');

$end_time = date('Y-m-d H:i:s', strtotime('+'.$_SESSION["duration"].'minutes', strtotime($_SESSION['start_time'])));


$_SESSION['end_time'] = $end_time;
/*Timer End*/


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

    <link href="../../css/vendor/bootstrap.css" rel="stylesheet">
    <link href="../../css/vendor/font-awesome.css" rel="stylesheet">
    <link href="../../css/vendor/picto.css" rel="stylesheet">
    <link href="../../css/vendor/material-design-iconic-font.css" rel="stylesheet">
    <link href="../../css/vendor/datepicker3.css" rel="stylesheet">
    <link href="../../css/vendor/jquery.minicolors.css" rel="stylesheet">
    <link href="../../css/vendor/railscasts.css" rel="stylesheet">
    <link href="../../css/vendor/owl.carousel.css" rel="stylesheet">
    <link href="../../css/vendor/slick.css" rel="stylesheet">
    <link href="../../css/vendor/daterangepicker-bs3.css" rel="stylesheet">
    <link href="../../css/vendor/jquery.bootstrap-touchspin.css" rel="stylesheet">
    <link href="../../css/vendor/select2.css" rel="stylesheet">
    <link href="../../css/vendor/jquery.countdown.css" rel="stylesheet">

    <link href="../../css/app/main.css" rel="stylesheet">

    <link href="../../css/app/essentials.css" rel="stylesheet" />
    <link href="../../css/app/material.css" rel="stylesheet" />
    <link href="../../css/app/layout.css" rel="stylesheet" />
    <link href="../../css/app/sidebar.css" rel="stylesheet" />
    <link href="../../css/app/sidebar-skins.css" rel="stylesheet" />
    <link href="../../css/app/navbar.css" rel="stylesheet" />
    <link href="../../css/app/messages.css" rel="stylesheet" />
    <link href="../../css/app/media.css" rel="stylesheet" />
    <link href="../../css/app/charts.css" rel="stylesheet" />
    <link href="../../css/app/maps.css" rel="stylesheet" />
    <link href="../../css/app/colors-alerts.css" rel="stylesheet" />
    <link href="../../css/app/colors-background.css" rel="stylesheet" />
    <link href="../../css/app/colors-buttons.css" rel="stylesheet" />
    <link href="../../css/app/colors-text.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Wrapper required for sidebar transitions -->
<div class="st-container">

    <!-- content push wrapper -->
    <div class="st-pusher" >

        <!-- sidebar effects INSIDE of st-pusher: -->
        <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-top-none">
                <?php require_once('inc/nav.php');?>

                <div class="page-section equal">
                    <div class="container-fluid">
                        <div class="text-subhead-2 text-light">Hello</div>
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-heading">
                                <p class="text-headline">Welcome to CTI E-Learning Platform <?php echo date('Y');?> for students</p>
                            </div>
                            <div class="panel-body">
                                <p class="text-body-2">
                                    
                                    <?php
                                    /*Gets if the test exist or not*/
                                    if(mysqli_num_rows($t) < 1)
                                    {
                                        echo "<div class='alert alert-warning'>Sorry!!! The test currently not been updated. Kindly, keep on checking with us. Thank you.</div>";
                                    }

                                    ?>
                                    
                                    <b>Read the instructions below before you start</b>
                                    <br>
                                    You have a <?php echo $test['test_duration'];?> minutes to complete this test. There are <?php echo $test['questions_limit'];?> questions. The pass mark is <?php echo $test['pass_mark'];?>%.
                                    <br>
                                    There are no limits on the number of attempts
                                    <br>
                                    Never refresh the page containing the question once you load into the page. Else you may restart your work.
                                    <br>
                                    Never close this window once you've started taking the exams.
                                    <br>
                                    You work will be automatically submitted once the stipulated time for the test shall have ellapsed.
                                    <br>
                                    You may click the submit button once you feel you have finished the test
                                    <br>
                                    Are you ready? Click the 'Questions' button above to begin your test.
                                    <br>
                                    <b><i>Good luck</i></b>
                                     <br>
                                    <strong>CTI E-Learning</strong> &copy; Copyright <?php echo date('Y');?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

<?php require_once('../inc_stude/stude_footer.php');?>