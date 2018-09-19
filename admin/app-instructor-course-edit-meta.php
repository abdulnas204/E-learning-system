<?php require_once('inc_admin/admin_header.php');?>
    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

        <!-- sidebar effects INSIDE of st-pusher: -->
        <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">
                    

    <div class="page-section">
        <h1 class="text-display-1">Create New Course</h1>
    </div>

    <!-- Tabbable Widget -->
<div class="tabbable paper-shadow relative" data-z="0.5">

    <!-- Tabs -->
    <ul class="nav nav-tabs">
        <li><a href="app-instructor-course-edit-course.html"><i class="fa fa-fw fa-lock"></i> <span class="hidden-sm hidden-xs">Course</span></a></li>
        <li class="active"><a href="app-instructor-course-edit-meta.html"><i class="fa fa-fw fa-credit-card"></i> <span class="hidden-sm hidden-xs">Meta</span></a></li>
        <li><a href="app-instructor-course-edit-lessons.html"><i class="fa fa-fw fa-credit-card"></i> <span class="hidden-sm hidden-xs">Lessons</span></a></li>
    </ul>
    <!-- // END Tabs -->

    <!-- Panes -->
    <div class="tab-content">

        

        
        <div id="meta" class="tab-pane active">
            <form class="form-horizontal">
    <div class="form-group">
        <label for="select" class="col-sm-3 control-label">Category</label>
        <div class="col-sm-9 col-md-9">
            <select id="select" class="form-control select2">
                <option value="#">HTML</option>
                <option value="#">Angular JS</option>
                <option value="#">CSS / LESS</option>
                <option value="#">Design / Concept</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="duration" class="col-sm-3 control-label">Course Duration</label>
        <div class="col-sm-4 col-md-2">
            <input type="text" class="form-control" placeholder="No. of Days" value="10">
        </div>
    </div>
    <div class="form-group">
        <label for="start" class="col-sm-3 control-label">Start Date</label>
        <div class="col-sm-9 col-md-4">
            <input id="datepicker" type="text" class="form-control datepicker">
        </div>
    </div>
    <div class="form-group">
        <label for="end" class="col-sm-3 control-label">End Date</label>
        <div class="col-sm-9 col-md-4">
            <input id="datepicker" type="text" class="form-control datepicker">
        </div>
    </div>
</form>
        </div>
        

        

    </div>
    <!-- // END Panes -->

</div>
<!-- // END Tabbable Widget -->


                </div>

            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

 <?php require_once('inc_admin/admin_footer.php');?>