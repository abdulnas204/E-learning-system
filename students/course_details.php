<?php
require_once('inc_stude/stude_header.php');

$course_id = @$_GET['course'];
$getTopic = mysqli_fetch_assoc($conn->query("SELECT * FROM course_topic WHERE course_id = '$course_id' "));
//$getTutor = mysqli_fetch_assoc($conn->query("SELECT
//    tutor.fname
//    , tutor.lname
//    , programme.prog_name
//    , programme.prog_id
//    , tutor_topic.tutor_id
//    , tutor_topic.topic_id
//FROM
//    cti.programme
//    INNER JOIN cti.tutor
//        ON (programme.prog_id = tutor.prog_id)
//    INNER JOIN cti.tutor_topic
//        ON (tutor.tutor_id = tutor_topic.tutor_id) WHERE tutor.tutor_id='$topic_id' AND programme.prog_id='$prog_id'")); /*Get tutor details*/
$getCourse = mysqli_fetch_assoc($conn->query("SELECT * FROM course WHERE course_id = '$course_id' ")); /*Get course details*/

?>

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">

                    <div class="media media-grid media-clearfix-xs">
                        <div class="media-body">
                            <div class="page-section">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="icon-block s60 bg-lightred"><i class="fa fa-github"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h1 class="text-display-1 margin-none"><?php echo $getCourse['course_name'];?></h1>
                                        <?php
                                        $get_programme = mysqli_fetch_assoc($conn->query("SELECT * FROM programme WHERE prog_id = '$prog_id' "));
                                        echo'<b>Programme: <small>'.$get_programme['prog_name'].'</small></b>';
                                        //echo '<b>Programme: <small>'.$get_programme['prog_name'].'</small></b> | <b>Tutor: </b>'.$getTutor['fname'].'';
                                        ?>
                                        <p class="small margin-none">
                                            <span class="fa fa-fw fa-star text-yellow-800"></span>
                                            <span class="fa fa-fw fa-star text-yellow-800"></span>
                                            <span class="fa fa-fw fa-star text-yellow-800"></span>
                                            <span class="fa fa-fw fa-star-o text-yellow-800"></span>
                                            <span class="fa fa-fw fa-star-o text-yellow-800"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="">
                                    <?php
                                    if(isset($alert))
                                    {
                                        echo $alert;
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="page-section">
                                <h3>Course objectives</h3>
                                <ol>
                                    <?php
                                    $get_objectives = $conn->query("SELECT * FROM course_objectives WHERE course_id = '$course_id' ORDER BY key_objective DESC ");
                                    if(mysqli_num_rows($get_objectives) < 1)
                                    {
                                        echo "<div class='alert alert-info'><button class='close' data-dismiss='alert'></button><span class='fa fa-info-circle'></span> Objectives are yet to be added.</div>";
                                    }
                                    else
                                    {
                                        while($getO = mysqli_fetch_assoc($get_objectives))
                                        {
                                            ?>
                                            <li>
                                                <?php
                                                if($getO['key_objective'] == 1)
                                                {
                                                    echo '<b>'.$getO['objective_name'].'</b>';
                                                }
                                                elseif($getO['key_objective'] == 0)
                                                {
                                                    echo $getO['objective_name'];
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ol>
                            </div>

                            <div class="page-section">
                                <h2 class="text-headline margin-none">
                                    Topics you'll learn
                                </h2>
                                <p class="text-subhead text-light">Below are topics in this course.</p>

                                <!--Course Details That Include Topics And Subtopics START-->

                                <?php
                                $get_topics = $conn->query("SELECT * FROM course_topic WHERE course_id = '$course_id' ORDER BY number ASC ");
                                if(mysqli_num_rows($get_topics) < 1)
                                {
                                    echo "<div class='alert alert-info'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-info-circle'></span> Topics are yet to be added.</div>";
                                }
                                else
                                {
                                    $num = 0;
                                    while($topics = mysqli_fetch_assoc($get_topics))
                                    {
                                        $num++;
                                        ?>
                                        <div class="panel panel-default curriculum paper-shadow" data-z="0.5">
                                            <div class="panel-heading panel-heading-gray" data-toggle="collapse" data-target="#topics<?php echo $topics['topic_id'];?>">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <span class="icon-block half img-circle bg-orange-300 text-white"><i class="fa fa-graduation-cap"></i></span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="text-headline"><?php echo $topics['topic_name'];?></h6>
                                                    </div>
                                                </div>
                                                <span class="collapse-status collapse-open">Open</span>
                                                <span class="collapse-status collapse-close">Close</span>
                                            </div>

                                            <div class="list-group collapse" id="topics<?php echo $topics['topic_id'];?>">
                                                <?php
                                                $get_subtopic = $conn->query("SELECT * FROM course_subtopic WHERE topic_id = '$topics[topic_id]' ORDER BY subtopic_number ASC ");
                                                //subtopics available, now view
                                                $subtopic_count = 0;
                                                while($subtopics = mysqli_fetch_assoc($get_subtopic))
                                                {
                                                    $subtopic_count++;
                                                    ?>
                                                    <div class="list-group-item media" data-toggle="collapse" data-target="#subtopic_content<?php echo $subtopics['subtopic_id'];?>">
                                                        <div class="media-left">
                                                            <div class="text-crt"><?php echo $subtopic_count;?>.</div>
                                                        </div>
                                                        <div class="media-body">
                                                            <i class="fa fa-fw fa-circle text-grey-200"></i>
                                                            <b><?php echo $subtopics['subtopic_name'];?></b>
                                                        </div>

                                                    </div>
                                                    <div id="subtopic_content<?php echo $subtopics['subtopic_id'];?>" class="collapse">
                                                        <div class="media-body" style="padding: 7px; ">
                                                            <p><?php echo $subtopics['subtopic_content']?></p>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="well well-sm">
                                                                        <?php
                                                                        $get_files = $conn->query("SELECT * FROM files WHERE subtopic_id = '$subtopics[subtopic_id]' ORDER BY file_type ASC ");
                                                                        while($files = mysqli_fetch_assoc($get_files))
                                                                        {
                                                                            if($files['file_type'] == 1)
                                                                            {
                                                                                echo '<span class="glyphicon glyphicon-facetime-video"></span>&nbsp;&nbsp;';
                                                                            }
                                                                            elseif($files['file_type'] == 2)
                                                                            {
                                                                                echo '<span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;';
                                                                            }
                                                                            elseif($files['file_type'] == 3)
                                                                            {
                                                                                echo '<span class="fa fa-file-text"></span>&nbsp;&nbsp;';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>

                                <!--Course Details That Include Topics And Subtopics END-->

                            </div>

                            <div class="pull-right">
                                <a class="btn btn-white btn-circle paper-shadow relative" data-z="1" href="#"><i class="md md-add"></i></a>
                            </div>

                            <h2 class="text-headline margin-none">Something will be here</h2>
                            <p class="text-subhead text-light">A few words from our past students</p>

                        </div>
                        <div class="media-right">

                            <div class="page-section width-270 width-auto-xs">

                                <!-- .panel -->
                                <div class="panel panel-default paper-shadow" data-z="0.5" data-hover-z="1" data-animated="">
                                    <div class="panel-heading">
                                        <h4 class="text-headline">Course</h4>
                                    </div>
                                    <div class="panel-body">
                                        <p class="text-caption margin-none">
                                            <i class="fa fa-clock-o fa-fw"></i> 4 hrs
                                            <i class="fa fa-user fa-fw"></i> Instructors: 3 <br>
                                            <i class="fa fa-mortar-board fa-fw"></i> Students: 50 <br>
                                            <i class="fa fa-check fa-fw"></i> Attending: 30
                                        </p>
                                    </div>
                                    <div class="panel-body text-center">
                                        <p><a href="" onClick="TEST=window.open('test/instructions?c_id=<?php echo $course_id;?>','CTI KENYA TEST WINDOW','status=1,width=800,height=600,scrollbars=1');  return false;" class="btn btn-info btn-lg paper-shadow relative" data-z="1" data-hover-z="2">Take Test</a></p>
                                    </div>
                                    <hr class="margin-none">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="#" class="text-light"><i class="fa fa-facebook fa-fw"></i> Share on facebook</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="#" class="text-light"><i class="fa fa-twitter fa-fw"></i> Tweet this course</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- // END .panel -->

                                <!-- .panel -->
                                <div class="panel panel-default paper-shadow" data-z="0.5" data-hover-z="1" data-animated="">
                                    <div class="panel-body">
                                        <h4 class="text-headline">Other Courses</h4>
                                    </div>
                                    <ul class="list-group">
                                        <?php
                                        $other_courses = $conn->query("SELECT
                                        course.course_name
                                        , course.prog_id
                                        , course_topic.topic_name
                                        , course_topic.course_id
                                    FROM
                                        cti.course_topic
                                        INNER JOIN cti.course
                                            ON (course_topic.course_id = course.course_id)
                                    WHERE course_topic.course_id !='$course_id' GROUP BY course.prog_id ");
                                        while($otherC = mysqli_fetch_assoc($other_courses))
                                        {
                                            ?>
                                            <li class="list-group-item">
                                                <div class="media v-middle">
                                                    <div class="media-left">
                                                        <div class="icon-block s30 bg-grey-400 text-white">
                                                            <i class="fa fa-mortar-board"></i>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <a href="register_course?code=<?php echo $otherC['course_id'];?>" class="link-text-color"><?php echo strtoupper($otherC['course_name']);?></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <!-- // END .panel -->

                            </div>
                            <!-- // END .page-section -->

                        </div>
                    </div>

                </div>

            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

    <!--MODALS START-->

    <div class="" id="subtopic_alert"></div>
    <!--MODALS END-->
<?php require_once('inc_stude/stude_footer.php');?>