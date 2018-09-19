<?php
require_once('inc_admin/admin_header.php');
?>
<?php

    /*Before insert, confirm whether the test on this topic already exist
        *if yes, do not add,
        *a test cannot have two tests,
        *so, just update the test details on that topic, remove and add more/different questions
    */
    if(isset($_POST['add_test1']))
    {
        $test_name = mysqli_real_escape_string($conn, trim($_POST['test_name']));
        $test_duration = mysqli_real_escape_string($conn, trim($_POST['test_duration']));
        $pass_mark = mysqli_real_escape_string($conn, trim($_POST['pass_mark']));
        $questions_limit = mysqli_real_escape_string($conn, trim($_POST['questions_limit']));
        $course_id = mysqli_real_escape_string($conn, trim($_POST['course_id']));

        //confirm 1
        $confirm1 = mysqli_num_rows($conn->query("SELECT test_id FROM test WHERE course_id = '$course_id' "));
        if($confirm1 > 0)
        {
            /*Do not add test. Update test details instead, on test-courses*/
            $alert = "<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Sorry!!!: The Course already has a test added to it. You can <a href='course_tests'>click here</a> to view the course and update the test details. Thank you</div>";
        }
        else
        {
            /*Add the test*/
            $insert1 = $conn->query("INSERT INTO test (test_name, course_id, test_duration, pass_mark, questions_limit) VALUES ('$test_name','$course_id','$test_duration','$pass_mark','$questions_limit') ");
            if($insert1)
            {
                $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Success: Course Test Successfully Added.</div>";
            }
            else
            {
                $alert=mysqli_error($conn);
                //$alert ="<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Sorry!!!: Something went wrong with the server connection.</div>";
            }
        }

    }
    if(isset($_POST['add_test2']))
    {
        $test_name = mysqli_real_escape_string($conn, trim($_POST['test_name']));
        $test_duration = mysqli_real_escape_string($conn, trim($_POST['test_duration']));
        $pass_mark = mysqli_real_escape_string($conn, trim($_POST['pass_mark']));
        $questions_limit = mysqli_real_escape_string($conn, trim($_POST['questions_limit']));
        $topic_id = mysqli_real_escape_string($conn, trim($_POST['topic_id']));

        //confirm 2
        $confirm2 = mysqli_num_rows($conn->query("SELECT test_id FROM test WHERE topic_id = '$topic_id' "));
        if($confirm2 > 0)
        {
            /*Do not add test. Update test details instead, on test-topics*/
            $alert = "<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Sorry!!!: The Topic already has a test added to it. You can <a href='topic_tests'>click here</a> to view the topic and update the test details. Thank you</div>";
        }
        else
        {
            /*Add test*/
            $insert2 = $conn->query("INSERT INTO test (test_name, topic_id, test_duration, pass_mark, questions_limit) VALUES ('$test_name','$topic_id','$test_duration','$pass_mark','$questions_limit') ");
            if($insert2)
            {
                $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Success: Topic Test Successfully Added.</div>";
            }
            else
            {
                $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Sorry!!!: Something went wrong with the server connection.</div>";
            }
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
        <h2 class="">Test</h2>
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="panel panel-primary" style="border-radius: 6px;">
                        <div class="panel-heading"><strong>Add Test</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <?php
                                        if(isset($alert))
                                        {
                                            echo $alert;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Test Name</label>
                                    <input type="text" name="test_name" class="form-control" placeholder="test name..." required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Test Duration</label>
                                    <input type="number" name="test_duration" class="form-control" placeholder="test duration..." required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Test Pass Mark</label>
                                    <input type="number" name="pass_mark" class="form-control" placeholder="pass mark..." required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Number of Questions(Limit)</label>
                                    <input type="number" name="questions_limit" class="form-control" placeholder="questions limit..." required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Test Area</label>
                                    <select required name="test_area" class="form-control" onchange="getValue()" id="test_area">
                                        <option value="">Select test area</option>
                                        <option value="1">Course</option>
                                        <option value="2">Topic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="type_selection">
                                <!--
                                **Depending on the value selected in the test area,
                                **options to be displayed will include either:
                                ** 1. Programme & Course : for course selection
                                **Or
                                ** 2. Programme & Course & Topic : for topic selection
                                -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->

</div><!-- /st-pusher -->

<script type="text/javascript">
    /*Get values to be selected*/
    function getValue(e)
    {
        var myValue = document.getElementById('test_area').value;
        //alert(myValue);
        $.ajax({
            type:'POST',
            url:'queries/test_area',
            data:'id='+myValue,
            cache: false,
            success:function(html){
                $('#type_selection').html(html);
            }
        });
    }
</script>
<script type="text/javascript">
function getCourse(e)
    {
        var prog_id = document.getElementById('prog_id').value;
        //alert(prog_id);
        $.ajax({
            type:'POST',
            url:'queries/get_course_or_topic',
            data:'prog_id='+prog_id,
            cache: false,
            success:function(html){
                $('#course_id').html(html);
            }
        });
    }
</script>
<script type="text/javascript">
function getTopic(e)
    {
        var course_id = document.getElementById('course_id').value;
        //alert(course_id);
        $.ajax({
            type:'POST',
            url:'queries/get_course_or_topic',
            data:'course_id='+course_id,
            cache: false,
            success:function(html){
                $('#topic_id').html(html);
            }
        });
    }
</script>
    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>