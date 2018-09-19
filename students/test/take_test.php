<?php
$page = 'Test';

require_once('../../config/db_connect.php');
session_start();

if(!isset($_SESSION['students']))
{
    echo "<script> window.close(); </script>";
    exit;
}

$student_id = mysqli_fetch_assoc($conn->query("SELECT student_id FROM student WHERE email = '$_SESSION[students]' "));
 /*
 **Set session when the exams start such that when one reloads the page, the test is submitted and results generated
 **But first check if the session isset
 */
 if(isset($_SESSION['test_start']))
 {
     /*This means the page is being reloaded or refreshed. Therefore, quit and generate results*/
     echo "<script> window.close(); </script>";
     unset($_SESSION['test_start']); 
     exit;
 }
 elseif(!isset($_SESSION['test_start']))
 {
     /*Then set the session and generate the questions*/
     $_SESSION['test_start'] = 'test_started';
 }

if(!isset($_SESSION['students'])  && (!isset($_SESSION['role_session'])))
{
    echo " <script> window.location.href='../../index';  </script>";
    exit;
}
elseif($_SESSION['role_session']!=3){
    echo " <script> window.location.href='../../index';  </script>";
    exit;
}

if(!isset($_GET['t_id']) && !isset($_GET['c_id']))
{
    echo " <script> window.close();   </script>";
    exit;
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

/*Gets if the test exist or not*/
if(mysqli_num_rows($t) < 1)
{
    $alert = "<div class='alert alert-warning'>Sorry!!! The test currently not been updated. Kindly, keep on checking with us. Thank you.</div>";
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
                                        <p class="text-title text-success margin-none" id="results"></p>
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
                                        <p class="text-title text-primary margin-none" id="timer_contdown" style="font: 50px;"></p>

                                         <div class="" id="alert"></div>

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
                                        <ul class="list-group" id="myTest">
                                            <?php

                                            $get_question = $conn->query("SELECT * FROM questions WHERE test_id = '$test[test_id]' ORDER BY time_stamp");
                                            if(mysqli_num_rows($get_question) < 1)
                                            {
                                                echo "<div class='alert alert-warning'>Sorry!!! Questions have currently not been updated. Kindly, keep on checking with us. Thank you.</div>";
                                            }
                                            $xx = 1;
                                            while($question = mysqli_fetch_assoc($get_question))
                                            {
                                                /** store the data first into the temp_result table before you display **/
                                                $insert_to_temp_result = $conn->query("INSERT INTO temp_result (student_id, test_id, question_id, right_answer) VALUES ('$student_id[student_id]','$test[test_id]','$question[question_id]','$question[answer]') ");

                                                if($question['question_type'] == 1)
                                                {
                                                    /* yes-no type, so fetch from questions table only */

                                                    ?>
                                                    <li class="list-group-item media v-middle">
                                    					<div class="media-body">
                                    						<?php echo $xx++.'. '.$question['question_description'];?>
                                                             <br/>
                                                            <p  style="padding-left: 15px;">
                                                                <div class="well well-sm">
                                                                    <div class="">
                                                                        <input type="radio" name="yes-no<?php echo $question['question_id'];?>" id="<?php echo $question['question_id'];?>" value="Yes" onclick="storeYesNo(this)" required="required" >
                                                                        <label for=""> Yes </label>
                                                                    </div>
                                                                    <div class="">
                                                                        <input type="radio" name="yes-no<?php echo $question['question_id'];?>" id="<?php echo $question['question_id'];?>" value="No" onclick="storeYesNo(this)" required="required" >
                                                                        <label for=""> No </label>
                                                                    </div>
                                                                </div>
                                                            </p>
                                    					</div>
                                    				</li>
                                                    <?php
                                                }
                                                elseif($question['question_type'] == 2)
                                                {
                                                    /** Echo first the question then the answers below */
                                                    ?>
                                                    <li class="list-group-item media v-middle">
                                    					<div class="media-body">
                                    						<?php echo $xx++.'. '.$question['question_description'];?>
                                                            <br/>
                                                            <p style="padding-left: 15px;">
                                                                <div class="well well-sm">
                                                                    <?php
                                                                    /*multiple choices, so fetch from answers table*/
                                                                    $get_answers = $conn->query("SELECT * FROM answers WHERE question_id = '$question[question_id]' ORDER BY answer_choice ASC ");
                                                                    while($answer = mysqli_fetch_assoc($get_answers))
                                                                    {
                                                                        /* echo answers... */
                                                                        echo $answer['answer_choice'].'. ';
                                                                        ?>
                                                                        <input type="radio" name="multiple<?php echo $answer['question_id'];?>" id="<?php echo $answer['question_id'];?>" value="<?php echo $answer['answer_choice'];?>" onchange="storeMultiple(this)" required="required" >
                                                                        <?php
                                                                        echo $answer['answer_description'].'<br/>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </p>
                                    					</div>
                                    				</li>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </p>
                                </div>
                            </div>

                        <div class="text-subhead-2 text-light">Finish Test</div>
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="panel-body">
                                You may cross-check your work and make any necessary changes. Once you feel comfortable to submit your work, you may press the 'Submit' button below.
                                <b>Remember: You can never make any changes once your work is submitted.</b>
                            </div>
                            <div class="panel-footer">
                                <form action="" methiod="POST" ecntype="multipart/form-data">
                                    <div class="text-right">
                                      <!--  <button type="button" name="submit" onclick="submitTest(this)" value="<?php echo $test['test_id'];?>" class="btn btn-success"><i class="fa fa-send fa-fw"></i> Submit</button>  -->
                                        <a href="result?test_id=<?php echo $test['test_id'];?>"><button type="button" class="btn btn-success"><i class="fa fa-send fa-fw"></i> Submit</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>


            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

 <!--Timer script start-->
 <script type="text/javascript">
 /*
 *it takes session that is set from the intruction page
 *it creates a session there then uses this script to call a page in timer/response.php
 *the response page calculate the difference in time and submits it back after an interval of 1 seconds/1000ms
 *the results are then set in the timer_countdown division/paragraph
 */
    setInterval(function(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","timer/response.php",false);
        xmlhttp.send(null);
        if(xmlhttp.responseText <= '00:05:00')
        {
            /*set timer color to be red when five minutes are left*/
            document.getElementById("timer_contdown").style.color = 'red';
        }
        if(xmlhttp.responseText == '00:00:00')
        {
            alert('Time is over. CTI is thanking you for taking your time to undertake this test. Bye');
            window.close();
        }
        document.getElementById("timer_contdown").innerHTML = xmlhttp.responseText;
        },1000);
    </script>
    <!--Timer script end-->

    <!--Save Yes-No answer START-->
    <script type="text/javascript">
    function storeYesNo(e)
    {
        var val_one = e.id;  //gets the id of the question
        var val_two = e.value; //gets the answer selected
        //alert(val_one+' '+val_two);
        //now update the temp_result table inserting this details
        $.ajax({
            //alert('reagan');
            type:'POST',
            url:'update_answer.php',
            data:'quiz_id='+val_one+"&quiz_answer="+val_two,
            cache: false,
            success:function(html){
                $('#alert').html(html);
            }
        });
    }
    </script>
    <!--Save Yes-No answer END-->
    <!--Save Multiple answer START-->
    <script type="text/javascript">
    function storeMultiple(e)
    {
        var val_1 = e.id;  //gets the id of the question
        var val_2 = e.value; //gets the answer selected
        //alert(val_1+' '+val_2);
        //now update the temp_result table inserting this details
        $.ajax({
            //alert('reagan');
            type:'POST',
            url:'update_answer.php',
            data:'quiz_multi_id='+val_1+"&chosen_answer="+val_2,
            cache: false,
            success:function(html){
                $('#alert').html(html);
            }
        });
    }
    </script>
    <!--Save Multiple answer END-->

    <!--Submit Test Start-->
    <script type="text/javascript">
        function submitTest(e)
        {
            var test_id = e.value;
            /*On clicking submit, go the get_results.php file then query the results which will be displayed in the #results paragraph above */
           /* $.ajax({
                type: 'POST',
                url: "get_results.php",
                data: 'test_id='+test_id,
                cache: false,
                success: function(html){
                    $("#results").html(html);
                }
             });*/
        }
    </script>
    <!--Submit Test End-->

<?php require_once('../inc_stude/stude_footer.php');?>