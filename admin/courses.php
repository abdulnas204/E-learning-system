<?php
require_once('inc_admin/admin_header.php');
if(isset($_POST['remove']))     /*remoe programme*/
{
    $id = $_POST['remove'];
    $query=$conn->query("DELETE FROM course WHERE course_id='$id'");
    if($query){
        $msg="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Course Successfully removed.</div>";
    }
    else{
        $msg="<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Removing course failed.</div>";
    }
}

if(isset($_POST['add'])) /*add programme*/
{
    $programme = trim(mysqli_real_escape_string($conn, $_POST['programme']));
    $course = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $duration = trim(mysqli_real_escape_string($conn, $_POST['duration']));
    $insert = $conn->query("INSERT INTO course (prog_id, course_name, duration) VALUES ('$programme','$course','$duration')");
    if($insert)
    {
        $msg="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Course successfully inserted.</div>";
    }
    else
    {
        $msg="<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Adding programme failed.</div>";
    }
}


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
        <a class="btn btn-success" data-backdrop="false" data-toggle="modal" data-target="#addCourse" href=""><i class="fa fa-plus-square"></i> Add a Course</a>
    </div>
    <div class="row" data-toggle="isotope">
    <div class="col-md-12">
    <div class="panel panel-primary" style="border-radius: 6px;">
        <div class="panel-heading">Courses</div>
        <div class="panel-body">
            <div>
                <?php
                if(isset($msg)){
                    echo $msg;
                }
                ?>
            </div>
            <?php
            $stmt=$conn->query("SELECT * FROM course ORDER BY course_name ASC");
            while($row=mysqli_fetch_assoc($stmt)){
                $prog=mysqli_fetch_assoc($conn->query("SELECT prog_name FROM programme WHERE prog_id='$row[prog_id]'"));
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
                            <h4 class="text-headline margin-v-0-10"><a href=""><?php echo $row['course_name'];?></a></h4>
                            <h5><b>Programme:</b> <?php echo $prog['prog_name'];?></h5>
                        </div>
                        <hr class="margin-none">
                        <div class="panel-body">
                            <form action="" method="post">
                                <!--<a class="btn btn-success btn-flat paper-shadow relative" data-z="0" data-hover-z="1" data-animated="" href="app-instructor-course-edit-course.html"><i class="fa fa-fw fa-pencil"></i> Edit</a>-->
                                <a href="course_details?id=<?php echo $row['course_id'];?>" class="btn btn-sm btn-info btn-flat paper-shadow relative" data-z="0" data-hover-z="1" data-animated=""><i class="fa fa-fw fa-users"></i> Details</a>
                                <button type="submit" class="btn btn-danger btn-sm btn-flat paper-shadow relative" name="remove" data-animated="" value="<?php echo $row['course_id']; ?>"><i class="fa fa-fw fa-remove"></i>Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
</div>

</div>
<ul class="pagination margin-top-none">
    <li class="disabled"><a href="#">&laquo;</a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">&raquo;</a></li>
</ul>


<!--Add course modal start-->
<!-- Modal -->
<div id="addCourse" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Course</h4>
            </div>
            <form action="" role="form" id="addProgramme" method="POST" ecnctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Programme Name</label>
                                <select name="programme" class="form-control selectpicker" id="programme" data-live-search="true">
                                    <option>~~Select a programme~~</option>
                                    <?php
                                    $getProgramme = $conn->query("SELECT * FROM programme ORDER BY prog_name ASC");
                                    while($prog = mysqli_fetch_assoc($getProgramme))
                                    {
                                        echo '<option value="'.$prog['prog_id'].'"> '.$prog['prog_name'].' <option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Course Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Course name" maxlenth="100" min="5" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="">Duration</label>
                                <input type="number" name="duration" class="form-control" placeholder="In hours" min="10" required="required" />
                            </div>
                            <div class="button-group">
                                <button type="button" class="btn btn-warning btn-sm pull-right" data-dismiss="modal">Close</button>
                                <input type="submit" name="add" class="btn btn-success btn-sm pull-right" value="Add">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!--Add course modal end-->


</div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->

</div><!-- /st-pusher -->
    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>