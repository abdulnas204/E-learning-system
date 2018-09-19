<?php
require_once('inc_admin/admin_header.php');

$course_id = $_GET['id'];
$getCourse = $conn->query("SELECT * FROM course WHERE course_id = '$course_id' ");
$course = mysqli_fetch_assoc($getCourse);

/*Add Objective Start*/
if(isset($_POST['add_objective']))
{
    $objective_name = trim(mysqli_real_escape_string($conn, $_POST['objective_name']));
    $objective_type = trim(mysqli_real_escape_string($conn, $_POST['objective_type']));
    $search_objective = $conn->query("SELECT objective_name FROM course_objectives WHERE course_id = '$course_id' AND objective_name = '$objective_name' ");
    if(mysqli_num_rows($search_objective) > 0)
    {
        /*Topic already exist*/
        $alert = "<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Objctive already exist.</div>";
    }
    else
    {
        /*Topic does not exist therefore add the topic*/
        $insert_objective = $conn->query("INSERT INTO course_objectives (course_id,objective_name,key_objective) VALUES ('$course_id','$objective_name','$objective_type') ");
        if($insert_objective)
        {
            $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Objective successfully added.</div>";
        }
        else
        {
            $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Objective addition has not gone through.</div>";
        }
    }
}
/*Add Objective End*/

/*Add Topic Start*/
if(isset($_POST['add_topic']))
{
    $topic_name = trim(mysqli_real_escape_string($conn, $_POST['topic_name']));
    $topic_number = trim(mysqli_real_escape_string($conn, $_POST['topic_number']));
    $topic_duration = trim(mysqli_real_escape_string($conn, $_POST['topic_duration']));
    $search = $conn->query("SELECT topic_name FROM course_topic WHERE course_id = '$course_id' AND topic_name = '$topic_name' ");
    if(mysqli_num_rows($search) > 0)
    {
        /*Topic already exist*/
        $alert = "<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Topic already exist.</div>";
    }
    else
    {
        /*Topic does not exist therefore add the topic*/
        $insert_topic = $conn->query("INSERT INTO course_topic (course_id,number,topic_name,duration) VALUES ('$course_id','$topic_number','$topic_name','$topic_duration') ");
        if($insert_topic)
        {
            $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Topic successfully added.</div>";
        }
        else
        {
            $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Topic addition has not gone through.</div>";
        }
    }
}
/*Add Topic End*/

/*Add Sub-Topic Start*/
if(isset($_POST['add_subtopic']))
{
    $topic_id = trim(mysqli_real_escape_string($conn, $_POST['topic_id']));
    $subtopic_name = trim(mysqli_real_escape_string($conn, $_POST['subtopic_name']));
    $subtopic_number = trim(mysqli_real_escape_string($conn, $_POST['subtopic_number']));
    $search_subtopic = $conn->query("SELECT subtopic_name FROM course_subtopic WHERE topic_id = '$topic_id' AND subtopic_name = '$subtopic_name' ");
    if(mysqli_num_rows($search_subtopic) > 0)
    {
        /*Sub-Topic already exist*/
        $alert = "<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Sub-topic already exist.</div>";
    }
    else
    {
        /*Sub-Topic does not exist therefore add the sub-topic*/
        $insert_subtopic = $conn->query("INSERT INTO course_subtopic (topic_id,subtopic_name,subtopic_number) VALUES ('$topic_id','$subtopic_name','$subtopic_number') ");
        if($insert_subtopic)
        {
            $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Sub-Topic successfully added.</div>";
        }
        else
        {
            $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Sub-Topic addition has not gone through.</div>";
        }
    }
}
/*Add Sub-Topic End*/

?>

<!-- content push wrapper -->
<div class="st-pusher" id="content">

<!-- sidebar effects INSIDE of st-pusher: -->
<!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

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
                                        <h1 class="text-display-1 margin-none"><?php echo strtoupper($course['course_name']);?></h1>
                                        <?php
                                            $get_programme = mysqli_fetch_assoc($conn->query("SELECT * FROM programme WHERE prog_id = '$course[prog_id]' "));
                                            echo '<b>Programme: <small>'.$get_programme['prog_name'].'</small></b> | <b>Added by: </b>'.$course['username'].'';
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

                <div class="row  update_alert">
                    <div class="col-md-6">
                        <?php
                         /*Displays success message upon course subtopic content updates successfully*/
                         if(isset($_SESSION['subtopic_update_success']))
                         {
                             echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong><span class="fa fa-smile-o"> Success: Subtopic content updated successfully</strong>.</span></div>';
                             unset($_SESSION['subtopic_update_success']);
                         }
                        ?>
                    </div>
                </div>

                <div class="page-section">
                    <h3>
                        Course objectives
                        <button class="btn btn-info pull-right btn-sm" data-backdrop="false" data-toggle="modal" data-target="#add_course_objective" ><span class="fa fa-plus-square"></span> Add Objective</button>
                    </h3>
                    <ol>
                        <?php
                        $get_objectives = $conn->query("SELECT * FROM course_objectives WHERE course_id = '$course_id' ORDER BY key_objective DESC ");
                        if(mysqli_num_rows($get_objectives) < 1)
                        {
                            echo "<div class='alert alert-info'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-info-circle'></span> Objectives are yet to be added.</div>";
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
                            <button class="btn btn-info pull-right btn-sm" data-backdrop="false" data-toggle="modal" data-target="#add_topic" ><span class="fa fa-plus-square"></span> Add Topic</button>
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
                                                <button class="btn btn-default btn-xs pull-right" data-backdrop="false" data-toggle="modal" data-target="#add_subtopic<?php echo $topics['topic_id'];?>"><span class="fa fa-plus-square"></span>&nbsp;Add Sub-topic</button>
                                            </div>
                                        </div>
                                        <!--<span class="collapse-status collapse-open">Open</span>
                                        <span class="collapse-status collapse-close">Close</span>-->
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
                                                <div class="media-right">
                                                    <div class="width-100 text-right text-caption">
                                                       <!-- <a href="edit_subtopic_content?id=<?php echo $subtopics['subtopic_id'];?>"><button type="submit" class="btn btn-default btn-xs"><span class="fa fa-edit"> Edit</span></button></a>   -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="subtopic_content<?php echo $subtopics['subtopic_id'];?>" class="collapse">
                                                <div class="media-body" style="padding-left: 30px">
                                                    <p><?php echo $subtopics['subtopic_content']?></p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="well well-sm">
                                                                 <a href="edit_subtopic_content?id=<?php echo $subtopics['subtopic_id'];?>"><button type="submit" class="btn btn-default btn-xs pull-right"><span class="fa fa-edit"> Edit</span></button></a>
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

                                <!--Add Sub-Topic Modal Start-->
                                <div id="add_subtopic<?php echo $topics['topic_id'];?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">
                                                    Add a course topic<br/>
                                                    <small><?php echo $course['course_name']?></small><br/>
                                                    <small><?php echo $topics['topic_name']?></small>
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group" hidden="hidden">
                                                        <label for="">Topic Name <span style="color: red;">*</span></label>
                                                        <input type="text" name="topic_id" class="form-control" value="<?php echo $topics['topic_id']?>" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Sub-topic Name <span style="color: red;">*</span></label>
                                                        <input type="text" name="subtopic_name" class="form-control" placeholder="e.g Sub-introduction" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Sub-topic Number <span style="color: red;">*</span></label>
                                                        <input type="number" name="subtopic_number" class="form-control" placeholder="e.g. 1" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                        <button type="submit" class="btn btn-primary" name="add_subtopic"><span class="fa fa-plus-square"></span> Add Sub-Topic</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--Add Sub-Topic Modal End-->

                                <?php
                            }
                        }
                        ?>

                        <!--Course Details That Include Topics And Subtopics END-->

                </div>

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
                                    $other_courses = $conn->query("SELECT * FROM course WHERE course_id != '$course_id' ORDER BY RAND() LIMIT 4 ");
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
                                                    <a href="course_details?id=<?php echo $otherC['course_id'];?>" class="link-text-color"><?php echo strtoupper($otherC['course_name']);?></a>
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

        <!--Add Topic Modal Start-->
        <div id="add_topic" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Add a course topic<br/>
                            <small><?php echo $course['course_name']?></small>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Topic Name <span style="color: red;">*</span></label>
                                <input type="text" name="topic_name" class="form-control" placeholder="e.g Introduction" required />
                            </div>
                            <div class="form-group">
                                <label for="">Topic Number <span style="color: red;">*</span></label>
                                <input type="number" name="topic_number" class="form-control" placeholder="e.g. 1" required />
                            </div>
                            <div class="form-group">
                                <label for="">Topic Duration <span style="color: red;">*</span></label>
                                <input type="number" name="topic_duration" step=".01" class="form-control" placeholder="in Hours" required />
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                <button type="submit" class="btn btn-primary" name="add_topic"><span class="fa fa-plus-square"></span> Add Topic</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--Add Topic Modal End-->

        <!--Add Course Objective Start-->
        <div id="add_course_objective" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Add a course objective<br/>
                            <small><?php echo $course['course_name'];?></small>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Objective Name <span style="color: red;">*</span></label>
                                <input type="text" name="objective_name" class="form-control" placeholder="e.g Introduction" required />
                            </div>
                            <div class="form-group">
                                <label for="">Objective Type <span style="color: red;">*</span></label>
                                <select name="objective_type" class="form-control" id="" required>
                                    <option value=""></option>
                                    <option value="1">Key</option>
                                    <option value="0">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                <button type="submit" class="btn btn-primary" name="add_objective"><span class="fa fa-plus-square"></span> Add Objective</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--Add Course Objective Modal End-->
         <div class="" id="subtopic_alert"></div>
        <!--MODALS END-->

<?php require_once('inc_admin/admin_footer.php');?>