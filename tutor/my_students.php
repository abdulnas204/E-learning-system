<?php
require_once('inc_instr/tutor_header.php');
$topic_id=$_GET['id'];
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
                        <a class="btn btn-success" href="all_courses"><i class="fa fa-plus-square"></i> Add a Course</a>
                    </div>
                    <div class="row" data-toggle="isotope">
                        <div class="col-md-12">
                            <div class="panel panel-primary" style="border-radius: 6px;">
                                <div class="panel-heading">My Students for: <?php// echo $row[''];?></div>
                                <div class="panel-body">
<!--                                    <div>-->
<!--                                        --><?php
//                                        if(isset($msg)){
//                                            echo $msg;
//                                        }
//                                        ?>
<!--                                    </div>-->
                                    <?php
                                    $stmt=$conn->query("SELECT
                                student.fname, student.lname, student.gender, student.phone
                                , course.course_name, course_topic.topic_name
                                , stude_lec_unit.stude_email
                                , stude_lec_unit.lec_email
                                , stude_lec_unit.course_id
                                , stude_lec_unit.topic_id
                                , stude_lec_unit.created_date
                            FROM
                                cti.student
                                INNER JOIN cti.course
                                    ON (student.prog_id = course.prog_id)
                                INNER JOIN cti.stude_lec_unit
                                    ON (student.email = stude_lec_unit.stude_email)
                                INNER JOIN cti.course_topic
                                    ON (course.course_id = course_topic.course_id) AND
                                    (course.course_id = stude_lec_unit.course_id) AND
                                    (course_topic.topic_id = stude_lec_unit.topic_id)
                                    WHERE lec_email='$user' AND stude_lec_unit.topic_id='$topic_id'");
                                    $count=1;
                                    while($row=mysqli_fetch_assoc($stmt)){
                                        ?>
                                        <div class="table-responsive">
                                            <table data-toggle="data-table" class="table" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Full Name</th>
                                                    <th>Phone</th>
                                                    <th>Gender</th>
                                                    <th>Registration Date</th>
                                                    <th>Salary</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><?php echo $count;?></td>
                                                    <td><?php echo $row['fname'].' '.$row['lname'];?></td>
                                                    <td><?php echo $row['phone'];?></td>
                                                    <td><?php echo $row['gender'];?></td>
                                                    <td><?php echo $row['created_date'];?></td>
                                                    <td>$320,800</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                        $count++;
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
<?php require_once('inc_instr/tutor_footer.php');?>