<?php
require_once('inc_admin/admin_header.php');
?>
<?php
    /*
    ** If you reference from course_tests file: then isset(c-id)
    ** else
    ** If you reference from topic_tests file: then isset(t-id)
    ** else: go back to home page
    */
    if(isset($_GET['c_id']))
    {
        /*from course_test table*/
        $id = $_GET['c_id'];
        $get_test = mysqli_fetch_assoc($conn->query("SELECT * FROM test WHERE test_id = '$_GET[c_id]' "));
        $get_course = mysqli_fetch_assoc($conn->query("SELECT course_name FROM course WHERE course_id = '$get_test[course_id]' "));
    }
    elseif(isset($_GET['t_id']))
    {
        /*from topic_test table*/
        $id = $_GET['t_id'];
        $get_test = mysqli_fetch_assoc($conn->query("SELECT * FROM test WHERE test_id = '$_GET[t_id]' "));
        $get_topic = mysqli_fetch_assoc($conn->query("SELECT topic_name FROM course_topic WHERE topic_id = '$get_test[topic_id]' "));
    }
    else
    {
        echo "<script> window.location.href='index';  </script>";
    }


    /*Other queries*/
    if(isset($_POST['add_quiz1']))
    {
        /*
        **This code inserts the values for yes-no quiz type
        **Option 1 for yes-no
        **The choices data(Yes/No) is not being inserted into the answers table because it is absolute
        */
        $quiz1 = mysqli_real_escape_string($conn, trim($_POST['quiz_description']));
        $answer1 = mysqli_real_escape_string($conn, trim($_POST['yes-no']));

        $insert1 = $conn->query("INSERT INTO questions (test_id, question_description, question_type, answer) VALUES ('$id','$quiz1','1','$answer1') ");
        if($insert1)
        {
            $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-check'></span> Success: Test Question Successfully Added.</div>";
        }
        else
        {
            $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-danger'></span> Sorry!!! Test Question Addition failed.</div>";
            //$alert = mysqli_error($conn);
        }
    }
    if(isset($_POST['add_quiz2']))
    {
        /*
        **This code inserts the values for multiple-coices quiz type
        **Option 2 for multiple choices
        **The choices are inserted into the table 'answers'
        */
        $quiz2 = mysqli_real_escape_string($conn, trim($_POST['quiz_description']));
        $answer2 = mysqli_real_escape_string($conn, trim($_POST['multiple']));
        $choice_a = mysqli_real_escape_string($conn, trim($_POST['a']));
        $choice_b = mysqli_real_escape_string($conn, trim($_POST['b']));
        $choice_c = mysqli_real_escape_string($conn, trim($_POST['c']));
        $choice_d = mysqli_real_escape_string($conn, trim($_POST['d']));

        $alphanumeric = '1234567890AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqZzSsTtUuVvWwXxYyZz'; /*Unique code for to help in the insertion on questions*/
        $code = substr(str_shuffle($alphanumeric),50);     //62-12 = 50

        $insert2 = $conn->query("INSERT INTO questions (test_id, question_description, question_type, answer, unique_code) VALUES ('$id','$quiz2','2','$answer2','$code') ");
        if($insert2)
        {
            /*Get the question_id first from the inserted data*/
            $quiz_id = mysqli_fetch_assoc($conn->query("SELECT question_id FROM questions WHERE test_id = '$id' AND unique_code = '$code' "));
            /*insert now the choices in the 'answer' table*/
            $insert_answers = $conn->query("INSERT INTO answers (question_id, answer_choice, answer_description)
                                            VALUES
                                            ('$quiz_id[question_id]','A','$choice_a'),
                                            ('$quiz_id[question_id]','B','$choice_b'),
                                            ('$quiz_id[question_id]','C','$choice_c'),
                                            ('$quiz_id[question_id]','D','$choice_d')
                                            ");
            if($insert_answers)
            {
                $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-check'></span> Success: All Data Successfully Added.</div>";
            }
            else
            {
                $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-danger'></span> Sorry!!! Answers Not Added.</div>";
            }
        }
        else
        {
            $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-danger'></span> Sorry!!! Test Question Addition failed.</div>";
        }
    }

    if(isset($_POST['delete']))
    {
        /*Delete question*/
        $delete = $conn->query("DELETE FROM  questions WHERE question_id = '$_POST[delete]' ");
        if($delete)
        {
            $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-success'></span> Success: Question successfully deleted.</div>";
        }
        else
        {
            $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-danger'></span> Sorry!!! Deletion failed.</div>";
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
        <h3>Test Details</h3>
        <div class="row">
            <div class="col-md-5">
                <?php
                if(isset($alert))
                {
                    echo $alert;
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Test: <u><?php echo $get_test['test_name'];?></u></h4>
                 <strong>
                 Test on
                 <?php
                    if(isset($_GET['t_id']))
                    {
                        echo 'topic: '.' '.$get_topic['topic_name'];
                    }
                    elseif(isset($_GET['c_id']))
                    {
                        echo 'course: '.' '.$get_course['course_name'];
                    }
                 ?>
                 </strong>
            </div>
            <div class="col-md-5">
                <div class="panel panel-primary" style="border-radius: 6px">
                    <div class="panel-heading">Add your questions below...</div>
                    <div class="panel-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Question description</label>
                                <textarea name="quiz_description" class="form-control" id="" cols="" rows="" required placeholder="Type your question here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Question type</label>
                                <select name="quiz_type" class="form-control" onchange="myValue()" id="quiz_type" required>
                                    <option value="">Select type</option>
                                    <option value="1">Yes/No</option>
                                    <option value="2">Multiple choices</option>
                                </select>
                            </div>
                            <div class="" id="question_type">
                                <!--All question types are pasted in this division using the ajax below-->
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-default paper-shadow" data-z="0.5">
                    <div class="panel-heading">
                        <h4 class="text-headline margin-none">
                            Questions
                            <a href="edit_questions?<?php if(isset($_GET['c_id'])){echo 'c_id='.$id;}if(isset($_GET['t_id'])){echo 't_id='.$id;}?>" data-toggle="tooltip" title="Update Questions" class="btn btn-primary btn-sm pull-right"><span class="fa fa-pencil"> Edit Questions</span></a>
                        </h4>
                    </div>
                    <ul class="list-group">
                        <?php
                        $get_question = $conn->query("SELECT * FROM questions WHERE test_id = '$id' ORDER BY time_stamp");
                        if(mysqli_num_rows($get_question) == 0)
                        {
                            echo "<div class='alert alert-info'><span class='fa fa-info-circle'> There aren't questions available. Kindly add questions.</span></div>";
                        }
                        $xx = 1;
                        while($question = mysqli_fetch_assoc($get_question))
                        {
                            if($question['question_type'] == 1)
                            {
                                /*yes-no type, so fetch from questions table only*/
                                ?>
                                <li class="list-group-item media v-middle">
                					<div class="media-body">
                						<?php echo $xx++.'. '.$question['question_description'];?>
                                        (<b><i>type: Yes/No</i></b>&nbsp;Answer: <b><i><?php echo $question['answer'];?></i></b>)
                                        <button class="btn btn-danger btn-xs"><span class="fa fa-close"></span></button>
                					</div>
                				</li>
                                <?php
                            }
                            elseif($question['question_type'] == 2)
                            {
                                /** Echo first the question then the answers below */
                                ?>
                                <li class="list-group-item media v-middle">
                					<div class="media-body">
                						<?php echo $xx++.'. '.$question['question_description'];?>
                                        (<b><i>type: Multiple choices</i></b>&nbsp;Answer: <b><i><?php echo $question['answer'];?></i></b>)
                                        <form action="" method="POST">
                                            <button type="submit" name="delete" value="<?php echo $question['question_id'];?>" data-toggle="tooltip" title="Delete Question" class="btn btn-default btn-xs"><span class="fa fa-close" style="color: red;"></span></button>
                                        </form>
                                        <br/>
                                        <p style="padding-left: 15px;">
                                            <?php
                                            /*multiple choices, so fetch from answers table*/
                                            $get_answers = $conn->query("SELECT * FROM answers WHERE question_id = '$question[question_id]' ORDER BY answer_choice ASC ");
                                            while($answer = mysqli_fetch_assoc($get_answers))
                                            {
                                                /* echo answers... */
                                                echo $answer['answer_choice'].'. '.$answer['answer_description'].'<br/>';
                                            }
                                            ?>
                                        </p>
                					</div>
                				</li>
                                <?php
                            }
                            ?>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->

</div><!-- /st-pusher -->

<script type="text/javascript">
    function myValue(e)
    {
        var myVal = document.getElementById('quiz_type').value;
        //alert(myVal);
        $('#question_type').html('');
        $.ajax({
            type:'POST',
            url:'queries/get_question_type',
            data:'type_id='+myVal,
            cache: false,
            success:function(html){
                $('#question_type').html(html);
            }
        });
    }
</script>

    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>