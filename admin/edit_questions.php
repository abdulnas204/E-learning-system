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
        exit;
    }


    /*Other queries*/
    if(isset($_POST['update_quiz1']))
    {
        /*
        **This code updates the values for yes-no quiz type
        **Option 1 for yes-no
        **The choices data(Yes/No) is not being inserted into the answers table because it is absolute
        */
        $quiz1 = mysqli_real_escape_string($conn, trim($_POST['quiz_description']));
        $answer1 = mysqli_real_escape_string($conn, trim($_POST['yes-no']));

        $update1 = $conn->query("UPDATE questions SET test_id = '$id', question_description = '$quiz1', question_type = '1', answer = '$answer1') WHERE question_id = '$_POST[update_quiz1]' ");
        if($update1)
        {
            $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-check'></span> Success: Question Successfully Updated.</div>";
        }
        else
        {
            $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-danger'></span> Sorry!!! Question Updation failed.</div>";
            //$alert = mysqli_error($conn);
        }
    }
    if(isset($_POST['update_quiz2']))
    {
        /*
        **This code updates the values for multiple-coices quiz type
        **Option 2 for multiple choices
        **The choices are inserted into the table 'answers'
        */
        $quiz2 = mysqli_real_escape_string($conn, trim($_POST['quiz_description']));
        $answer2 = mysqli_real_escape_string($conn, trim($_POST['multiple']));
        $choice_a = mysqli_real_escape_string($conn, trim($_POST['A']));
        $choice_b = mysqli_real_escape_string($conn, trim($_POST['B']));
        $choice_c = mysqli_real_escape_string($conn, trim($_POST['C']));
        $choice_d = mysqli_real_escape_string($conn, trim($_POST['D']));

        $update2 = $conn->query("UPDATE questions SET test_id = '$id', question_description = '$quiz2', question_type = '2', answer = '$answer2' WHERE question_id = '$_POST[update_quiz2]' ");
        if($update2)
        {
            /*Update answers too*/
            $update_answers_A = $conn->query("UPDATE answers SET answer_description = '$choice_a' WHERE question_id = '$_POST[update_quiz2]' AND answer_choice = 'A' ");
            $update_answers_B = $conn->query("UPDATE answers SET answer_description = '$choice_b' WHERE question_id = '$_POST[update_quiz2]' AND answer_choice = 'B' ");
            $update_answers_C = $conn->query("UPDATE answers SET answer_description = '$choice_c' WHERE question_id = '$_POST[update_quiz2]' AND answer_choice = 'C' ");
            $update_answers_D = $conn->query("UPDATE answers SET answer_description = '$choice_d' WHERE question_id = '$_POST[update_quiz2]' AND answer_choice = 'D' ");

            $alert = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-check'></span> Success: Question Successfully Updated.</div>";
        }
        else
        {
            $alert = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><span class='fa fa-danger'></span> Sorry!!! Test Question Updation failed.</div>";
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
        <a href="add_question?<?php if(isset($_GET['c_id'])){echo 'c_id='.$id;}if(isset($_GET['t_id'])){echo 't_id='.$id;}?>" class="btn btn-primary"><span class="fa fa-hand-o-left">&nbsp;Back</span></a>
        <h3>Edit Questions</h3>
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
            <div class="col-md-4">
                <div class="panel panel-default paper-shadow" data-z="0.5">
                    <div class="panel-body" id="questions">
                        <!--Display all the questions details here-->
                        <div class="alert alert-info">
                            <span class="glyphicon glyphicon-info-sign">
                                &nbsp;You can now update all the questions on <b><i><?php echo $get_test['test_name'];?></i></b> in this page.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default paper-shadow" data-z="0.5">
                    <div class="panel-heading">
                        <h4 class="text-headline margin-none">
                            Questions
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
                                        <form action="" method="POST">
                                            <button type="submit" name="delete" value="<?php echo $question['question_id'];?>" data-toggle="tooltip" title="Delete Question" class="btn btn-default btn-xs"><span class="fa fa-close" style="color: red;"></span></button>
                                            <button type="button" onclick="getQuestion(this)" id="1" data-toggle="tooltip" value="<?php echo $question['question_id'];?>" title="Update Question" class="btn btn-default btn-xs"><span class="fa fa-pencil" style="color: grey;"></span></button>
                                        </form>
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
                                            <button type="button" onclick="getQuestion(this)" id="2" data-toggle="tooltip" value="<?php echo $question['question_id'];?>" title="Update Question" class="btn btn-default btn-xs"><span class="fa fa-pencil" style="color: grey;"></span></button>
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
 function getQuestion(e)
 {
     /*Get the question and update*/
     var quiz_id = e.value;
     var type_id = e.id;
     //alert(quiz_id+' '+type_id);

     $('#questions').html('');
     $.ajax({
        type:'POST',
        url:'queries/get_edit_questions.php',
        data:'type_id='+type_id+'&quiz_id='+quiz_id,
        cache: false,
        success:function(html){
            $('#questions').html(html);
        }
     });
 }
</script>
    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>