<?php
require_once('inc_admin/admin_header.php');
?>
<?php
if(isset($_POST['delete']))
{
    $delete = $conn->query("DELETE FROM test WHERE test_id = '$_POST[delete]' ");
    if($delete)
    {
        $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Success: Course Test Successfully Deleted.</div>";
    }
    else
    {
        $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Sorry!!!: Delete failed.</div>";
    }
}
if(isset($_POST['save']))
{
    $test_name = mysqli_real_escape_string($conn, trim($_POST['test_name']));
    $test_duration = mysqli_real_escape_string($conn, trim($_POST['test_duration']));
    $pass_mark = mysqli_real_escape_string($conn, trim($_POST['pass_mark']));
    $questions_limit = mysqli_real_escape_string($conn, trim($_POST['questions_limit']));
    $update = $conn->query("UPDATE test SET test_name = '$test_name', test_duration = '$test_duration', pass_mark = '$pass_mark', questions_limit = '$questions_limit' WHERE test_id = '$_POST[save]' ");
    if($update)
    {
        $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Success: Course Test Successfully Updated.</div>";
    }
    else
    {
        $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Sorry!!! Course Test Updation Failed.</div>";
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
        <a href="add_test" class="btn btn-primary"><span class="fa fa-send">Add Test</span></a>
        <h6 class="text-display-1">Topic Tests</h6>
        <div class="row">
            <div class="col-md-5">
                <?php
                if(isset($alert))
                {
                    echo $alert;
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="table-responsive">
                        <table data-toggle="data-table" class="table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><span class="fa fa-mortar-board"> Test Name</span></th>
                                <th><span class=""> Course</span></th>
                                <th><span class=""> Topic</span></th>
                                <th><span class=""> Duration</span></th>
                                <th><span class=""> Pass Marks</span></th>
                                <th><span class=""> Questions Limit</span></th>
                                <th><span class="fa  fa-calendar-o"> Creation Date</span></th>
                                <th><span class="fa fa-cogs"> Action</span></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th><span class="fa fa-mortar-board"> Test Name</span></th>
                                <th><span class=""> Course</span></th>
                                <th><span class=""> Topic</span></th>
                                <th><span class="fa fa-clock-o"> Duration</span></th>
                                <th><span class=""> Pass Marks</span></th>
                                <th><span class=""> Questions Limit</span></th>
                                <th><span class="fa  fa-calendar-o"> Creation Date</span></th>
                                <th><span class="fa fa-cogs"> Action</span></th>
                            </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $get_test = $conn->query("SELECT * FROM test WHERE topic_id != '' ORDER BY time_stamp DESC ");
                                $count = 1;
                                while($test = mysqli_fetch_assoc($get_test))
                                {
                                    $get_topic = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM course_topic WHERE topic_id = '$test[topic_id]' "));
                                    $get_course = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM course WHERE course_id = '$get_topic[course_id]' "));
                                    ?>
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td><?php echo $test['test_name'];?></td>
                                        <td><?php echo $get_course['course_name'];?></td>
                                        <td><?php echo $get_topic['topic_name'];?></td>
                                        <td><?php echo $test['test_duration'];?></td>
                                        <td><?php echo $test['pass_mark'];?></td>
                                        <td><?php echo $test['questions_limit'];?></td>
                                        <td><?php echo $test['time_stamp'];?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs btn-danger" name="delete" type="submit" value="<?php echo $test['test_id'];?>"><span class="fa fa-close">Delete</span></button>
                                                <button type="button" class="btn btn-xs btn-warning" data-backdrop="static" data-toggle="modal" data-target="#updateTest<?php echo $test['test_id'];?>"><span class="fa fa-pencil"></span></button>
                                                <a class="btn btn-xs btn-primary" href="add_question?t_id=<?php echo $test['test_id'];?>"><span class="fa fa-external-link"></span>Details</a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!--Update Test Name Modal Start-->
                                    <div id="updateTest<?php echo $test['test_id'];?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog" style="padding-top: 5%;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Update Test Details</h4>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <label for="">Test Name</label>
                                                                    <input type="text" name="test_name" class="form-control" required="required" value="<?php echo $test['test_name'];?>" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Test Duration</label>
                                                                    <input type="text" name="test_duration" class="form-control" required="required" value="<?php echo $test['test_duration'];?>" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Pass Marks</label>
                                                                    <input type="text" name="pass_mark" class="form-control" required="required" value="<?php echo $test['pass_mark'];?>" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Question Limit(To be displayed)</label>
                                                                    <input type="text" name="questions_limit" class="form-control" required="required" value="<?php echo $test['questions_limit'];?>" />
                                                                </div>
                                                                <br/>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary btn-sm" name="save" value="<?php echo $test['test_id'];?>"><span class="fa fa-save">Save Changes</span></button>
                                                                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><span class="fa fa-close">Close</span></button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--Update Test Name Modal END-->

                                    <?php
                                    $count++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->

</div><!-- /st-pusher -->
    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>