<?php
require_once('inc_instr/tutor_header.php');
//$topic_id=$_GET['id'];
//$top_id=@$_GET['id'];
//$y=@$_GET['act'];
//
//if(@$_GET['act']=="delete"){
//    $query=$conn->query("DELETE FROM tutor_course WHERE topic_id='$top_id'");
//    if($query){
//        $msg="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Course Successfully removed.</div>";
//    }
//    else{
//        $msg="<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Removing course failed.</div>";
//    }
//}
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
                        <h4>My Topics:</h4>
                    </div>
                    <div class="row" data-toggle="isotope">
                        <div class="col-md-12">
                            <div class="panel panel-primary" style="border-radius: 6px;">
                                <div class="panel-heading">All Topics: <?php// echo $row[''];?></div>
                                <div class="panel-body">
                                    <!--                                    <div>-->
                                    <!--                                        --><?php
                                    //                                        if(isset($msg)){
                                    //                                            echo $msg;
                                    //                                        }
                                    //                                        ?>
                                    <!--                                    </div>-->

                                        <div class="table-responsive">


                                                <table data-toggle="data-table" class="table" cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Course Name</th>
                                                        <th>Topic Name</th>
                                                        <th>Created Date</th>
                                                        <th>Registered Students</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $stmt=$conn->query("SELECT
                                            course.course_name
                                            , course_topic.topic_name
                                            , tutor_course.username
                                            , tutor_course.created_date
                                        FROM
                                            cti.course
                                            INNER JOIN cti.course_topic
                                                ON (course.course_id = course_topic.course_id)
                                            INNER JOIN cti.tutor_course
                                                ON (course_topic.topic_id = tutor_course.topic_id)");
                                                    $c=1;
                                                    while($r=mysqli_fetch_assoc($stmt)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $c;?></td>
                                                        <td><?php echo $r['course_name'];?></td>
                                                        <td><?php echo $r['topic_name'];?></td>
                                                        <td><?php echo $r['created_date'];?></td>
                                                        <td><?php //echo $r[''];?></td>
                                                        <td>
                                                            <a href="" class="btn btn-danger"><i class="fa fa-remove"></i> Remove</a>
                                                        </td>
                                                    </tr>
                                                        <?php
                                                        $c++;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                        </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_instr/tutor_footer.php');?>