<?php require_once('inc_admin/admin_header.php');?>
    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">


                    <div class="page-section">
                        <h3 class="">My Courses</h3>
                        <p>You are required to assign yourself a course to start tutoring your students.</p>
                    </div>
                    <div class="row" data-toggle="isotope">
                        <div class="col-md-12">
                            <div class="panel panel-primary" style="border-radius: 6px;">
                                <div class="panel-heading">My Courses</div>
                                <div class="panel-body">
                                <form method="post">
                                 <?php
                                 if(isset($_POST['test'])){
                                     $name=$_POST['names'];
                                     $sql=$conn->query("INSERT INTO test(test) VALUES('$name') ");
                                     if($sql){
                                         echo"<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>success.</div>";
                                     }
                                     else{
                                         echo"<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>failed.</div>";
                                     }
                                 }
                                 ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">test</label>
                                        <select class="selectpicker form-control" multiple data-max-options="2" data-live-search="true" name="names">
                                            <option value="1">Reagan</option>
                                            <option value="2">Isaiah</option>
                                            <option value="3">Otieno</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" name="test">Test</button>
                                    </div>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>