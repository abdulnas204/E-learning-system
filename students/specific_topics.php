<?php
require_once('inc_stude/stude_header.php');

?>
    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">
                    <div class="page-section">
                        <!--<h1 class="text-display-1">My Courses</h1>-->
                    </div>
                    <div class="row" data-toggle="isotope">
                        <div class="col-md-12">
                            <div class="panel panel-primary" style="border-radius: 6px;">
                                <div class="panel-heading">My Topics</div>
                                <div class="panel-body">
                                    <?php
                                    $stmt=$conn->query("SELECT course.course_name , course_topic.topic_name , student_topic.topic_id
                                    , student_topic.student_id
                                     FROM
                                    cti.course
                                    INNER JOIN cti.course_topic
                                        ON (course.course_id = course_topic.course_id)
                                    INNER JOIN cti.student_topic
                                        ON (course_topic.topic_id = student_topic.topic_id) WHERE student_topic.student_id='$student_id'");
                                    while($row=mysqli_fetch_assoc($stmt)){
                                        //$code=$row['course_id'];
                                        ?>
                                        <div class=" col-md-4">
                                            <div class="panel panel-default paper-shadow" data-z="0.5">

                                                <div class="cover overlay cover-image-full hover">
                                                    <span class="img icon-block height-70 bg-default"></span>
                                                    <a href="" class="padding-none overlay overlay-full icon-block bg-info">
                                                    <span class="v-center">
                                                        <i class="fa fa-book"></i>
                                                    </span>
                                                    </a>
                                                </div>

                                                <div class="panel-body">
                                                    <h4 class="text-headline margin-v-0-10"><?php echo $row['course_name'];?></h4>
                                                    <h4><?php echo $row['topic_name'];?></h4>
                                                    <h5><strong>Days left:</strong> <span class="badge badge-danger">5</span> days</h5>
                                                </div>
                                                <hr class="margin-none">
                                                <div class="panel-body">
                                                    <a href="topic_details?topic=<?php echo $row['topic_id'];?>" class="btn btn-info" data-toggle="modal" data-backdrop="static"> <i class="fa fa-file"></i> Course Details</a>

                                                </div>
                                            </div>
                                        </div>
                                        <!--modal-->
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->
    </div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_stude/stude_footer.php');?>