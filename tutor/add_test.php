<?php
require_once('inc_instr/tutor_header.php');
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
                                <div class="panel-heading">My Courses</div>
                                <div class="panel-body">



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