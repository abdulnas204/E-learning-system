<?php
$page = 'Test';

require_once('../../config/db_connect.php');
    session_start();

    if(!isset($_SESSION['students']))
    {
        echo "<script> window.close(); </script>";
        exit;
    }
    if(!isset($_GET['test_id']))
    {
        echo "<script> window.close(); </script>";
        exit;
    }

    if(!isset($_SESSION['test_start']))
    {
        echo "<script> window.close(); </script>";
        unset($_SESSION['test_start']);
        exit;
    }

    $student_id = mysqli_fetch_assoc($conn->query("SELECT student_id FROM student WHERE email = '$_SESSION[students]' "));

    /*Get the test values*/
    $test =  mysqli_fetch_assoc($conn->query("SELECT * FROM test WHERE course_id = '$_GET[test_id]' "));
    $stmt = $conn->query("SELECT * FROM temp_result WHERE student_id = '$student_id[student_id]' AND test_id = '$_GET[test_id]' ORDER BY time_stamp DESC ");
    $correct_answers    =   0;
    $count              =   0;
    while($row = mysqli_fetch_assoc($stmt))
    {
        /*Get the values compaire the ones that match(correct answers) and the ones that doesn't(wrong answers)*/
        if($row['right_answer'] == $row['selected_answer'])
        {
            /*Add correct marks*/
            $correct_answers++;
        }
        /*Count total questions*/
        $count++;
    }
    /*calculate and send back the percentage*/
    $percentage = ($correct_answers / $count) * 100;
   // echo $percentage.'%';



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
    <script src="../../js/vendor/core/jquery.min.js"></script>
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

                <div class="page-section half bg-white">
                    <div class="container-fluid">
                        <div class="section-toolbar">
                            <div class="cell">
                                <div class="media width-120 v-middle margin-none">
                                    <div class="media-left">
                                        <div class="icon-block bg-grey-200 s30"><i class="fa fa-question"></i></div>
                                    </div>
                                    <div class="media-body">
                                        <p class="text-body-2 text-light margin-none">Questions</p>
                                        <p class="text-title text-primary margin-none"><?php echo $test['questions_limit']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="cell">
                                <div class="media width-120 v-middle margin-none">
                                    <div class="media-left">
                                        <div class="icon-block bg-grey-200 s30"><i class="fa fa-diamond"></i></div>
                                    </div>
                                    <div class="media-body">
                                        <p class="text-body-2 text-light margin-none">Score</p>
                                        <p class="text-title text-success margin-none"> <?php echo $percentage.'%';?> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="cell">
                                <div class="media width-120 v-middle margin-none">
                                    <div class="media-left">
                                        <div class="icon-block bg-grey-200 s30"><i class="glyphicon glyphicon-time"></i></div>
                                    </div>
                                    <div class="media-body">
                                        <p class="text-body-2 text-light margin-none">Timer</p>
                                        <p class="text-title text-primary margin-none" style="font: 50px; color: #CC0000;">00:00:00</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-section equal">
                    <div class="container-fluid">
                            <div class="text-subhead-2 text-light">Answer the questions below</div>
                            <div class="panel panel-default paper-shadow" data-z="0.5">
                                <div class="panel-body">
                                    <p class="text-body-2">
                                    <!--Display the questions below-->
                                        <ul class="list-group">
                                            <?php
                                            /*
                                            *Fetch the questions with the right answers then display them back
                                            *Looping backwords
                                            */
                                            $get1 = $conn->query("SELECT  * FROM temp_result WHERE test_id = '$_GET[test_id]' and student_id = '$student_id[student_id]' ORDER BY time_stamp DESC ");
                                            $xx = 1;
                                            while($get1A = mysqli_fetch_assoc($get1))
                                            {
                                                /*Get the questions now*/
                                                $get2 = mysqli_fetch_assoc($conn->query("SELECT * FROM questions WHERE question_id = '$get1A[question_id]' "));
                                                if($get2['question_type'] == 1)
                                                {
                                                    /*Yes-No Type*/
                                                    ?>
                                                    <li class="list-group-item media v-middle">
                                                        <div class="media-body">
                                                            <?php echo $xx++.'. '.$get2['question_description'];?>
                                                            <br/>
                                                            <p  style="padding-left: 15px;">
                                                                <div class="well well-sm">
                                                                    <div class="">
                                                                        <input type="radio" <?php if($get1A['selected_answer'] == "Yes"){ echo "checked";}else{ echo "disabled"; } ?> >
                                                                        <label for=""> Yes </label>&nbsp;&nbsp;
                                                                        <?php
                                                                        if($get1A['right_answer'] == 'Yes')
                                                                        {
                                                                            echo '<span class="fa fa-check" style="color: green;"></span>';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<span class="fa fa-close" style="color: red;"></span>';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="">
                                                                        <input type="radio" <?php if($get1A['selected_answer'] == "No"){ echo "checked";}else{ echo "disabled"; } ?>>
                                                                        <label for=""> No </label>&nbsp;&nbsp;
                                                                        <?php
                                                                        if($get1A['right_answer'] == 'No')
                                                                        {
                                                                            echo '<span class="fa fa-check" style="color: green;"></span>';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<span class="fa fa-close" style="color: red;"></span>';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <?php

                                                }
                                                elseif($get2['question_type'] == 2)
                                                {
                                                    /*Multiple Choice Type*/
                                                    ?>
                                                    <li class="list-group-item media v-middle">
                                                        <div class="media-body">
                                                            <?php echo $xx++.'. '.$get2['question_description'];?>
                                                            <br/>
                                                            <p style="padding-left: 15px;">
                                                                <div class="well well-sm">
                                                                <?php
                                                                    /*multiple choices, so fetch from answers table*/
                                                                    $get_answers = $conn->query("SELECT * FROM answers WHERE question_id = '$get2[question_id]' ORDER BY answer_choice ASC ");
                                                                    while($answer = mysqli_fetch_assoc($get_answers))
                                                                    {
                                                                        /* echo answers... */
                                                                        echo $answer['answer_choice'].'. ';
                                                                    ?>
                                                                        <input type="radio" <?php if($get1A['selected_answer'] == $answer['answer_choice'] ){ echo "checked";}else{ echo "disabled"; } ?>>
                                                                    <?php
                                                                    echo $answer['answer_description'].'&nbsp;&nbsp;';
                                                                    if($get1A['right_answer'] == $answer['answer_choice'])
                                                                    {
                                                                        echo '<span class="fa fa-check" style="color: green;"></span>';
                                                                    }
                                                                    else
                                                                    {
                                                                        echo '<span class="fa fa-close" style="color: red;"></span>';
                                                                    }
                                                                    echo '<br/>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                                                                              
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-body">
                                <b>Thank you for participating in this exercise</b>
                            </div>
                        </div>
                </div>
            </div>


            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->
<?php
    /*And now empty the temp_table with the students' individual exam record*/
    $delete = $conn->query("DELETE FROM temp_result WHERE student_id = '$student_id[student_id]' AND test_id = '$_GET[test_id]' ");
    /*Unset the session now to end the whole process*/
    unset($_SESSION['test_start']);
?>
<?php require_once('../inc_stude/stude_footer.php');?>