<?php
require_once('inc_stude/stude_header.php');
$course_code=@$_GET['id'];
$x=@$_GET['act'];

if($x=="subscribe"){
    $subscribe_course=$conn->query("INSERT INTO student_course(student_id, course_id) VALUES ('$student_id','$course_code')");
    if($subscribe_course){
        $alert="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>You successfully subscribe the course.</div>";
    }
    else{
        $alert="<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Subscription failed!!.</div>";
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
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($alert)){
                    echo $alert;
                }
                ?>
            </div>
        </div>
        <div class="row" data-toggle="isotope">
            <div class="col-md-12">
                <div class="panel panel-primary" style="border-radius: 6px;">
                    <div class="panel-heading">All Courses</div>
                    <div class="panel-body">
                        <?php
                        $stmt=$conn->query("SELECT course_name, course_description, prog_id, course_id FROM
                        cti.course WHERE prog_id='$prog_id'");
                        while($row=mysqli_fetch_assoc($stmt)){
                            $code=$row['course_id'];
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
                                        <p><?php //echo $row['course_description'];?></>
                                    </div>
                                    <hr class="margin-none">
                                    <div class="panel-body">
                                        <!--href="app-instructor-course-edit-course.html"-->
                                        <a href="" data-target="#subscribe_course<?php echo $row['course_id'];?>" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="static"><i class="fa fa-pencil"></i> Subscribe Whole</a>
                                        <a href="" data-target="#assign_course<?php echo $row['course_id'];?>" class="btn btn-success btn-sm" data-toggle="modal" data-backdrop="static"><i class="fa fa-pencil"></i> Select Topic</a>
                                    </div>
                                </div>
                            </div>

                            <!--subscribe course modal-->
                            <div id="subscribe_course<?php echo $row['course_id']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            <h4 class="modal-title"><?php echo $row['course_name']?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="" enctype="multipart/form-data">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p><?php echo $row['course_description'];?></p>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <a class="btn btn-success" href="?action=trans&id=<?php echo $code;?>&act=subscribe" onclick="return confirm('Confirm Your Subscription.')"><i class="fa fa-plus-square"></i>Subscribe Here</a>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--subscribe topic modal-->
                            <div id="assign_course<?php echo $row['course_id']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            <h4 class="modal-title"><?php echo $row['course_name']?></h4>
                                        </div>
                                        <div class="modal-body">
                                        <form method="post" action="" enctype="multipart/form-data">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p><?php echo $row['course_description'];?></p>
                                                    </div>
                                                </div>

                                            <div class="modal-footer">
                                                <a class="btn btn-success" href="register_topic?code=<?php echo $code;?>"><i class="fa fa-plus-square"></i>Subscribe Here</a>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                        </div>
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

    </div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->
</div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_stude/stude_footer.php');?>