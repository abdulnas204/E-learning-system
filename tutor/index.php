<?php require_once('inc_instr/tutor_header.php');?>
    <!-- content push wrapper -->
    <div class="st-pusher" id="content" >

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">
                    

	<div class="page-section">
		<h5 class="text-display-1">Tutor Dashboard</h5>
	</div>
		<div class="row">
			<div class="col-md-12">
				<?php
				$stmt=$conn->query("SELECT * FROM tutor_topic WHERE tutor_id='$tutor_id'");
				$r=mysqli_num_rows($stmt);
				?>
				<div class="col-md-4">
					<div class="well well-sm" style="">
					<h4>Total: <?php echo $r;?></h4><hr>
						My Courses <i class="fa fa-book"></i>
						<a class="btn btn-info btn-flat paper-shadow relative" data-z="0" data-hover-z="1" data-animated="" href="my_courses"><i class="fa fa-fw fa-eye"></i> View Courses</a>
					</div>
				</div>
				<?php
				$stmt=$conn->query("SELECT * FROM tutor_topic WHERE tutor_id='$tutor_id'");
				$rr=mysqli_num_rows($stmt);
				?>
				<div class="col-md-4">
					<div class="well well-sm" style="">
					<h4>Total: <?php echo $rr;?></h4><hr>
						My Topics <i class="fa fa-book"></i>
						<a class="btn btn-info btn-flat paper-shadow relative" data-z="0" data-hover-z="1" data-animated="" href="my_topics"><i class="fa fa-fw fa-eye"></i> View Topics</a>
					</div>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading"><i class="fa fa-question"></i> Guidelines</div>
					<div class="panel-body">
						<p><h3>Requirements</h3> As a tutor to proceed to taking particular topics to take students through, you must have met all the requirements:<br/>
						<ol>
							<li>After taking the first step which is the registration part, upon login to the system a tutor is expected to update his or her needails to stand
							a chance as a potential tutor.<br/>
								<ul>You have to upload a copy of your original national ID as either an image or PDF document.</ul>
								<ul>Also you have to upload your updated CV for confirmation of your area of interest as a tutor.</ul>
							</li>
						</ol>
						</p>
					</div>
				</div>
			</div>
		</div>

    <div class="row" data-toggle="isotope">
	<div class="col-md-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-heading">
				<div class="media v-middle">
					<div class="media-body">
						<h4 class="text-headline margin-none">Analysis</h4>
						<p class="text-subhead text-light">This Month</p>
					</div>
					<div class="media-right">
						<a class="btn btn-white btn-flat" href="app-instructor-earnings.html">Reports</a>
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
	<!--<div class="item col-xs-12 col-lg-6">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-heading">
                <h4 class="text-headline margin-none">My Courses</h4>
                <p class="text-subhead text-light">Your recent courses</p>
			</div>
            <ul class="list-group">
				<li class="list-group-item media v-middle">
					<div class="media-body">
						<a href="app-instructor-course-edit-course.html" class="text-subhead list-group-link">Basics of HTML</a>
					</div>
					<div class="media-right">
						<div class="progress progress-mini width-100 margin-none">
							<div class="progress-bar progress-bar-green-300" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
							</div>
						</div>
					</div>
				</li>
				<li class="list-group-item media v-middle">
					<div class="media-body">
						<a href="app-instructor-course-edit-course.html" class="text-subhead list-group-link">Angular in Steps</a>
					</div>
					<div class="media-right">
						<div class="progress progress-mini width-100 margin-none">
							<div class="progress-bar progress-bar-green-300" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
							</div>
						</div>
					</div>
				</li>
				<li class="list-group-item media v-middle">
					<div class="media-body">
						<a href="app-instructor-course-edit-course.html" class="text-subhead list-group-link">Bootstrap Foundations</a>
					</div>
					<div class="media-right">
						<div class="progress progress-mini width-100 margin-none">
							<div class="progress-bar progress-bar-green-300" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
							</div>
						</div>
					</div>
				</li>
			</ul>
			<div class="panel-footer text-right">
				<a href="my_courses.php" class="btn btn-white paper-shadow relative" data-z="0" data-hover-z="1" data-animated>View all</a>
                <a href="app-instructor-course-edit-course.html" class="btn btn-primary paper-shadow relative" data-z="0" data-hover-z="1" data-animated>CREATE COURSE <i class="fa fa-plus"></i></a>
			</div>
		</div>
	</div>-->

</div>


                </div>

            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_instr/tutor_footer.php');?>