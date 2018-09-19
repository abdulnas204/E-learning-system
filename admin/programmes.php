<?php
require_once('inc_admin/admin_header.php');
if(isset($_POST['remove']))     /*remoe programme*/
{
    $prog_id = $_POST['remove'];
    $query=$conn->query("DELETE FROM programme WHERE prog_id='$prog_id'");
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
    $insert = $conn->query("INSERT INTO programme (prog_name) VALUES ('$programme')");
    if($insert)
    {
        $msg="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Programme successfully inserted.</div>";
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
        <a class="btn btn-success" data-backdrop="false" data-toggle="modal" data-target="#addProgramme" href=""><i class="fa fa-plus-square"></i> Add a Programme</a>
    </div>
    <div class="row" data-toggle="isotope">
    <div class="col-md-12">
    <div class="panel panel-primary" style="border-radius: 6px;">
        <div class="panel-heading">Programmes</div>
        <div class="panel-body">
            <div>
                <?php
                if(isset($msg)){
                    echo $msg;
                }
                ?>
            </div>
            <?php
            $stmt=$conn->query("SELECT * FROM programme ORDER BY prog_name");
            while($row=mysqli_fetch_assoc($stmt)){
                ?>
                <div class=" col-md-4">
                    <div class="panel panel-default paper-shadow" data-z="0.5">
                        <div class="cover overlay cover-image-full hover">
                            <span class="img icon-block height-70 bg-default"></span>
                            <a href="app-instructor-course-edit-course.html" class="padding-none overlay overlay-full icon-block bg-info">
                        <span class="v-center">
                            <i class="fa fa-book"></i>
                        </span>
                            </a>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-headline margin-v-0-10"><a href=""><?php echo $row['prog_name'];?></a></h4>
                        </div>
                        <hr class="margin-none">
                        <div class="panel-body" align="center">
                            <form action="" method="post">
                                <button type="submit" class="btn btn-danger btn-sm btn-flat paper-shadow relative" name="remove" data-animated="" value="<?php echo $row['prog_id']; ?>"><i class="fa fa-fw fa-remove"></i>Remove</button>
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

<!--Add programme modal start-->
<!-- Modal -->
<div id="addProgramme" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Programme</h4>
            </div>
            <form action="" role="form" id="addProgramme" method="POST" ecnctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Programme Name</label>
                                <input type="text" class="form-control" name="programme" id="programme" placeholder="e.g Information Technology" required />
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
<!--Add programme modal end-->


</div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->

</div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>