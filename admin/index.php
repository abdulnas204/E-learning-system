<?php require_once('inc_admin/admin_header.php');?>

<?php
    $all_programmes = mysqli_fetch_assoc($conn->query("SELECT COUNT(prog_id) AS progs FROM programme")); /*Count programmes*/
    $all_courses = mysqli_fetch_assoc($conn->query("SELECT COUNT(course_id) AS courses FROM course")); /*Count courses*/
    //$all_tutors = mysqli_fetch_assoc($conn->query("SELECT COUNT(tutor_id) AS tutors FROM tutor")); /*Count tutors*/
    $all_students = mysqli_fetch_assoc($conn->query("SELECT COUNT(email) AS students FROM student")); /*Count students*/
?>

<?php
if(isset($_POST['add'])) /*add course*/
{
    $programme = trim(mysqli_real_escape_string($conn, $_POST['programme']));
    $course = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $duration = trim(mysqli_real_escape_string($conn, $_POST['duration']));
    $confirm = mysqli_num_rows($conn->query("SELECT * FROM `course` WHERE `course_name` LIKE '%$course%' AND prog_id = '$programme' "));
    if($confirm > 1)
    {
        $msg = "<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Failed!!! Course already exist in the system.</div>";
    }
    else
    {
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
}
?>

    <!-- content push wrapper -->
    <div class="st-pusher" id="content" >

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">


    <div class="page-section">
        <h1 class="text-display-1">Dashboard</h1>
    </div>
    <div class="">
        <?php
        if(isset($msg))
        {
            echo $msg;
        }
        ?>
    </div>
    <div class="row" data-toggle="isotope">

    <div class="row">
        <div class="item col-xs-12 col-md-3">
            <div class="well well-md myHover" style="border-radius: 6px;">
                <div align="center">
                    <a href="programmes"><span class="fa fa-certificate" style="font-size:30px;color: #FF4747;"></span></a><hr>
                    <h4>
                        <a href="programmes">Programmes</a>
                        <br/>
                        <small class="badge badge-danger"><?php echo $all_programmes['progs'];?></small>
                    </h4>
                </div>
            </div>
        </div>
        <div class="item col-xs-12 col-md-3">
            <div class="well well- myHover" style="border-radius: 6px;">
                <div align="center">
                    <a href="courses"><span class="fa fa-book" style="font-size:30px;color: #67B6CC;"></span></a><hr>
                    <h4>
                        <a href="courses">Courses</a>
                        <br/>
                        <small class="badge" style="background-color: #36C942;"><?php echo $all_courses['courses'];?></small>
                    </h4>
                </div>
            </div>
        </div>
        <div class="item col-xs-12 col-md-3">
            <div class="well well-md myHover" style="border-radius: 6px;">
                <div align="center">
                    <a href=""><span class="fa fa-group" style="font-size:30px;color: #558BB4;"></span></a><hr>
                    <h4>
                        <a href="">Tutors</a>
                        <br/>
                        <small class="badge" style="background-color: #3F90C6;"><?php// echo $all_tutors['tutors'];?></small>
                    </h4>
                </div>
            </div>
        </div>
        <div class="item col-xs-12 col-md-3">
            <div class="well well-md myHover">
                <div align="center">
                    <a href=""><span class="fa fa-mortar-board" style="font-size:30px;color: #D6D56B;"></span></a><hr>
                    <h4>
                        <a href="">Students</a>
                        <br/>
                        <small class="badge badge-primary"><?php echo $all_students['students'];?></small>
                    </h4>
                </div>
            </div>
        </div>
    </div>

	<div class="item col-xs-12 col-lg-6">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-heading">
				<div class="media v-middle">
					<div class="media-body">
						<h4 class="text-headline margin-none">Earnings</h4>
						<p class="text-subhead text-light">This Month</p>
					</div>
					<div class="media-right">
						<a class="btn btn-white btn-flat" href="app-instructor-earnings">Reports</a>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div id="line-holder" data-toggle="flot-chart-earnings" class="flotchart-holder height-200"></div>
			</div>
			<hr/>
			<div class="panel-body">
				<div class="row text-center">
					<div class="col-md-6">
						<h4 class="margin-none">Gross Revenue</h4>
						<p class="text-display-1 text-warning margin-none">102.4k</p>
					</div>
					<div class="col-md-6">
						<h4 class="margin-none">Net Revenue</h4>
						<p class="text-display-1 text-success margin-none">55k</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="item col-xs-12 col-lg-6">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-heading">
                <h4 class="text-headline margin-none">Courses</h4>
                <p class="text-subhead text-light">Recent courses</p>
			</div>
            <ul class="list-group">
                <?php
                $get_course = $conn->query("SELECT * FROM course ORDER BY time_stamp DESC LIMIT 5");
                while($recent_cource = mysqli_fetch_assoc($get_course))
                {
                    /*Get recent course*/
                    ?>
                     <li class="list-group-item media v-middle">
    					<div class="media-body">
    						<a href="course_details?id=<?php echo $recent_cource['course_id'];?>" class="text-subhead list-group-link"><?php echo $recent_cource['course_name'];?></a>
    					</div>
    					<div class="media-right">
    						<div class="progress progress-mini width-100 margin-none">
    							<div class="progress-bar progress-bar-green-300" role="progressbar" aria-valuenow="<?php echo $recent_cource['duration']?>" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
    							</div>
    						</div>
    					</div>
    				</li>
                    <?php
                }
                ?>
			</ul>
			<div class="panel-footer text-right">
				<a href="courses" class="btn btn-white paper-shadow relative" data-z="0" data-hover-z="1" data-animated>View all</a>
                <a href="" class="btn btn-primary paper-shadow relative" data-backdrop="static" data-toggle="modal" data-target="#create_course" data-z="0" data-hover-z="1" data-animated>CREATE COURSE <i class="fa fa-plus"></i></a>
			</div>
		</div>
	</div>
	<div class="item col-xs-12 col-lg-6">
        <div class="panel panel-default paper-shadow" data-z="0.5">
            <div class="panel-heading">
                <div class="media v-middle">
                    <div class="media-body">
                        <h4 class="text-headline margin-none">Transactions</h4>
                        <p class="text-subhead text-light">Latest from statement</p>
                    </div>
                    <div class="media-right">
                        <a class="btn btn-white btn-flat" href="app-instructor-statement">Statement</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-subhead v-middle">
                    <tbody>
                        <tr>
                            <td class="width-100 text-caption"><div class="label label-grey-200 label-xs">12 Jan 2015</div></td>
                            <td>Adrian Demian</td>
                            <td class="width-80 text-center"><a href="#">#13034</a></td>
                            <td class="width-50 text-center">&dollar;26</td>
                        </tr>
                        <tr>
                            <td class="width-100 text-caption"><div class="label label-grey-200 label-xs">12 Jan 2015</div></td>
                            <td>Adrian Demian</td>
                            <td class="width-80 text-center"><a href="#">#7245</a></td>
                            <td class="width-50 text-center">&dollar;69</td>
                        </tr>
                        <tr>
                            <td class="width-100 text-caption"><div class="label label-grey-200 label-xs">12 Jan 2015</div></td>
                            <td>Adrian Demian</td>
                            <td class="width-80 text-center"><a href="#">#5079</a></td>
                            <td class="width-50 text-center">&dollar;18</td>
                        </tr>
                        <tr>
                            <td class="width-100 text-caption"><div class="label label-grey-200 label-xs">12 Jan 2015</div></td>
                            <td>Adrian Demian</td>
                            <td class="width-80 text-center"><a href="#">#4473</a></td>
                            <td class="width-50 text-center">&dollar;71</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>


                </div>

            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

<!--BEGINNING OF MODALS-->

<!--Add course modal begin-->
<div id="create_course" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Course</h4>
            </div>
            <form action="" role="form" id="create_course" method="POST" ecnctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Programme Name</label>
                                <select name="programme" class="form-control selectpicker" id="programme" data-live-search="true">
                                    <option disabled >Select a programme</option>
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
                                <button type="button" class="btn btn-warning btn-sm pull-right" data-dismiss="modal"><span class="fa fa-cross"> CLOSE</span></button>
                                <button type="submit" class="btn btn-success btn-sm pull-right"  name="add"><span class="fa fa-check">ADD</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!--Add course modal end-->

<!--END OF MODALS-->

    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>