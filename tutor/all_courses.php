<?php require_once('inc_instr/tutor_header.php');?>
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
                        <div class="panel-heading">All Courses</div>
                        <div class="panel-body">
                            <?php
                            $stmt=$conn->query("SELECT * FROM course WHERE prog_id='$prog_id'");
                            while($row=mysqli_fetch_assoc($stmt)){
                                ?>
                                <div class=" col-md-3">
                                    <div class="panel panel-default paper-shadow" data-z="0.5">

                                        <div class="cover overlay cover-image-full hover">
                                            <span class="img icon-block height-80 bg-default"></span>
                                            <a href="" class="padding-none overlay overlay-full icon-block bg-info">
                                    <span class="v-center">
                                        <i class="fa fa-book"></i>
                                    </span>
                                            </a>
                                        </div>

                                        <div class="panel-body">
                                            <h4 class="text-headline margin-v-0-10"><?php echo $row['course_name'];?></h4>

                                        </div>
                                        <hr class="margin-none">
                                        <div class="panel-body">
                                            <!--href="app-instructor-course-edit-course.html"-->
                                            <a class="btn btn-info btn-flat paper-shadow relative" data-z="0" data-hover-z="1" data-animated="" data-toggle="modal" data-target="#assign_course<?php echo $row['course_id']?>" data-backdrop="static"><i class="fa fa-fw fa-pencil"></i> Add course</a>
                                        </div>
                                    </div>
                                </div>
                                <!--modal-->
                                <div id="assign_course<?php echo $row['course_id']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                                <h4 class="modal-title"><?php echo $row['course_name']?></h4>
                                            </div>
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Test:</strong></label>
                                                                <textarea type="text" rows="10" class="form-control" value="<?php echo $row['course_description'];?>" id="" readonly><?php echo $row['course_description'];?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="assign_course?code=<?php echo $row['course_id'];?>" name="update" class="btn btn-info">Add Course</a>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
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

        </div>

    </div><!-- /st-content-inner -->

</div><!-- /st-content -->
    </div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_instr/tutor_footer.php');?>