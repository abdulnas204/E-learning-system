<?php
require_once('inc_admin/admin_header.php');

$id = $_GET['id'];
if(!isset($id))
{
    echo "<script> window.location='tutors'; </script>";
    exit();
}
else
{
    $get_tutor = $conn->query("SELECT * FROM tutor WHERE tutor_id = '$id' ");  /*Get tutor*/
    $tutor = mysqli_fetch_assoc($get_tutor);
    $count = mysqli_num_rows($get_tutor);
    $get_country = mysqli_fetch_assoc($conn->query("SELECT * FROM countries WHERE country_code = '$tutor[country_code]' "));  /*Get Country*/
    $get_prog = mysqli_fetch_assoc($conn->query("SELECT prog_name FROM programme WHERE prog_id = '$tutor[prog_id]' "));  /*Get Programme*/
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
        <h6 class="text-display-1">Tutor Profile</h6>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5">
                    <div class="panel panel-default" style="">
                        <div class="panel-body">
                            <img src="../images/tutors/<?php echo $tutor['image'];?>" class="img img-responsive" style=" width: 100%; height: 350px;" alt="" />
                            <br>
                            <div class="col-md-6">
                                <p style=" text-align: center;">
                                    <strong>Name</strong><br/>
                                    <?php echo $tutor['fname'].' '.$tutor['mname'].' '.$tutor['lname'];?> <br/> <br>
                                    <strong>Phone</strong><br/>
                                    <?php echo $tutor['phone'];?> <br/>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p style=" text-align: center;">
                                    <strong>Email</strong><br/>
                                    <?php echo $tutor['email'];?> <br/> <br>
                                    <strong>Country</strong><br/>
                                    <?php echo $get_country['country_name'];?> <br/>
                                </p>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><b>Other details</b></h4>
                            <hr>
                            <div class="col-md-12">
                                <strong>Programme :</strong>
                                <?php echo $get_prog['prog_name'];?><br/><br>
                                <strong>Registration date-time :</strong>
                                <?php echo $tutor['created_date'];?><br/><br>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <strong >Attachemnts</strong><br><br>
                                <div class="col-md-3">
                                    <iframe src="https://www.youtube.com/embed/lgzMQMp3aMQ?autoplay=0" width="100%;" style="background-color: #E5E3D7;" allowFullScreen='allowFullScreen' frameborder="0"></iframe>
                                </div>
                                <div class="col-md-3">
                                    <iframe src="https://www.youtube.com/embed/lgzMQMp3aMQ?autoplay=0" width="100%;" style="background-color: #E5E3D7;" allowFullScreen='allowFullScreen' frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="padding: 20px;">
                <div class="panel panel-primary" >
                    <div class="panel-heading">Course Topics</div>
                    <div class="panel-body">
                        <?php
                        $get_topic_ids = $conn->query("SELECT * FROM tutor_topic WHERE tutor_id = '$tutor[tutor_id]' "); /*get the topic-ids that the tutor handles*/
                        while($topic_ids = mysqli_fetch_assoc($get_topic_ids))
                        {
                            $topic = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM course_topic WHERE topic_id = '$topic_ids[topic_id]' ")); /*Get the topic details that the tutor handles*/
                            $course = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM course WHERE course_id = '$topic[course_id]' ")); /*Get the course that the topic belongs to*/
                            ?>
                            <div class="col-md-3">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><center><span class="fa fa-book" style=" font-size: large;"></span></center></div>
                                    <div class="panel-body">
                                        <p>
                                            <h3><a href=""><?php echo $course['course_name'];?></a></h3>
                                            <b>Topic:</b> <?php echo $topic['topic_name'];?> <br>
                                            <b>Registration date:</b> <?php echo $topic_ids['created_date'];?> <br>
                                            <b>Added by:</b> <?php echo $course['username'];?><br>
                                        </p>
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

</div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->

</div><!-- /st-pusher -->
    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>