<?php require_once('inc_stude/stude_header.php');?>

    <!-- content push wrapper -->
    <div class="st-pusher" id="content" >

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">
                    

	<div class="page-section">
		<h1 class="text-display-1 margin-none">Student Dashboard</h1>
	</div>

	<div class="panel panel-default">
    <div class="media v-middle">
        <div class="media-left">
            <div class="bg-green-400 text-white">
                <div class="panel-body">
                    <i class="fa fa-credit-card fa-fw fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="media-body">
            Your subscription ends on <span class="text-body-2">25 February 2015</span>
        </div>
        <div class="media-right media-padding">
            <a class="btn btn-white paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated href="#">
                Upgrade
            </a>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-3">
            <?php
            $query=$conn->query("SELECT * FROM student_course WHERE student_id='$student_id'");
            //$r=$query->fetch_array();
            $cnt=$query->num_rows;

            ?>
            <div class="well well-sm">
                <div align="center">
                    <a href="my_courses"><span class="fa fa-book" style="font-size:30px;color: #FF4747;"></span></a><hr>
                    <h4>
                        <a href="my_courses">Whole Course</a>
                        <br/>
                        <small class="badge badge-danger"><?php echo $cnt;?></small>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?php
            $query1=$conn->query("SELECT * FROM student_topic WHERE student_id='$student_id'");
            $cnt1=$query1->num_rows;
            ?>
            <div class="well well-sm">
                <div align="center">
                    <a href="specific_topics"><span class="fa fa-book" style="font-size:30px;color: #3F90C6;"></span></a><hr>
                    <h4>
                        <a href="specific_topics">Specific Topics</a>
                        <br/>
                        <small class="badge" style="background-color: #3F90C6;"><?php echo $cnt1;?></small>
                    </h4>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="pane panel-info">
				<div class="panel-heading"><i class="fa fa-question-circle"></i> Guidelines.</div>
				<div class="panel-body">
				<p>
					<h4>Welcome!</h4>
					We glad you you take this first step creating account with CTI online platform. This is an easy to use platform with very interactive user interfaces, there
					is provision of several learning materials which users can subscribe for and enjoy learning.
				</p>
					<p>
						The following are the instructions to guide your through CTI learning platform:
						<ol>
						<li>To access whole reading materials on a particular topic, you have to subscribe for the unit at a small cost which differs considering the scope of study.</li>
						<li>After the subscription, the materials concerning that particular course will be availed to you. You will have a tutor for that course whom you will be
						able to consult throught the course.</li>
						<li>Upon completion of a course, a student will be able to take a test on the course registered for to help evaluate his/her understanding of the course.</li>
						<li>To be continued...</li>
					</ol>
					</p>
				</div>
			</div>
		</div>
	</div>

<div class="row" data-toggle="isotope">
    <div class="item col-xs-12 col-lg-6">
        <div class="panel panel-default paper-shadow" data-z="0.5">
    <div class="panel-heading">
        <h4 class="text-headline margin-none">Courses</h4>
        <p class="text-subhead text-light">Your recent courses</p>
    </div>
    <ul class="list-group">
        <?php
        $stmt=$conn->query("SELECT * FROM course WHERE prog_id='$prog_id'");
        while($row=mysqli_fetch_assoc($stmt)){
            ?>
            <li class="list-group-item media v-middle">
                <div class="media-body">
                    <a href="" class="text-subhead list-group-link"><?php echo $row['course_name'];?></a>
                </div>
                <div class="media-right">
                    <div class="progress progress-mini width-100 margin-none">
                        <div class="progress-bar progress-bar-green-300" role="progressbar" aria-valuenow="<?php echo $row['duration'];?>" aria-valuemin="0" aria-valuemax="100" style="width:45%;">
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>

    </ul>
    <div class="panel-footer text-right">
        <a href="all_courses" class="btn btn-white paper-shadow relative" data-z="0" data-hover-z="1" data-animated href="#"> View all</a>
    </div>
</div>
    </div>


    <div class="item col-xs-12 col-lg-6">
        <div class="panel panel-default paper-shadow" data-z="0.5">
            <div class="panel-body">
                <h4 class="text-headline margin-none">Rewards</h4>
<p class="text-subhead text-light">Your latest achievements</p>
<div class="icon-block half img-circle bg-purple-300">
    <i class="fa fa-star text-white"></i>
</div>
<div class="icon-block half img-circle bg-indigo-300">
    <i class="fa fa-trophy text-white"></i>
</div>
<div class="icon-block half img-circle bg-green-300">
    <i class="fa fa-mortar-board text-white"></i>
</div>
<div class="icon-block half img-circle bg-orange-300">
    <i class="fa fa-code-fork text-white"></i>
</div>
<div class="icon-block half img-circle bg-red-300">
    <i class="fa fa-diamond text-white"></i>
</div>
            </div>
        </div>

    </div>

</div>

	<br/>

                </div>

            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_stude/stude_footer.php');?>