<?php
require_once('inc_instr/tutor_header.php');
$top_id=@$_GET['id'];
$y=@$_GET['act'];

if(@$_GET['act']=="delete"){
    $query=$conn->query("DELETE FROM tutor_course WHERE topic_id='$top_id'");
    if($query){
        $msg="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Course Successfully removed.</div>";
    }
    else{
        $msg="<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Removing course failed.</div>";
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
        <a class="btn btn-success" href="all_courses"><i class="fa fa-plus-square"></i> Add a Course</a>
	</div>
    <div class="row" data-toggle="isotope">
    <div class="col-md-12">
    <div class="panel panel-primary" style="border-radius: 6px;">
        <div class="panel-heading">My Courses</div>
        <div class="panel-body">
            <div>
                <?php
                if(isset($msg)){
                    echo $msg;
                }
                ?>
            </div>
            <?php
            $stmt=$conn->query("SELECT
            course.course_name
            , course_topic.topic_name
            , tutor_topic.tutor_id
            , tutor_topic.topic_id
            FROM
            cti.course
            INNER JOIN cti.course_topic
                ON (course.course_id = course_topic.course_id)
            INNER JOIN cti.tutor_topic
                ON (course_topic.topic_id = tutor_topic.tutor_id) WHERE tutor_topic.tutor_id='$tutor_id' ORDER BY course_name ASC");
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
                            <h4 class="text-headline margin-v-0-10"><a href="app-instructor-course-edit-course.html"><?php echo $row['course_name'];?></a></h4>
                            <h5>Topic: <?php echo $row['topic_name'];?></h5>
                        </div>
                        <hr class="margin-none">
                        <div class="panel-body">
                            <!--<a class="btn btn-success btn-flat paper-shadow relative" data-z="0" data-hover-z="1" data-animated="" href="app-instructor-course-edit-course.html"><i class="fa fa-fw fa-pencil"></i> Edit</a>-->
                            <a href="my_students?id=<?php echo $row['topic_id'];?>" class="btn btn-sm btn-info btn-flat paper-shadow relative" data-z="0" data-hover-z="1" data-animated=""><i class="fa fa-fw fa-users"></i> Students</a>
                            <a class="btn btn-info btn-sm" href="add_test?id=<?php echo $row['topic_id'];?>"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Sure to quit this course!?')" href="?action=trans&id=<?php echo $row['topic_id']; ?>&act=delete"><i class="fa fa-fw fa-remove"></i>Remove</a>
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


</div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->

</div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_instr/tutor_footer.php');?>