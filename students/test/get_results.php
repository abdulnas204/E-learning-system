<?php

    require_once('../../config/db_connect.php');
    session_start();

    if(!isset($_SESSION['students']))
    {
        echo "<script> window.close(); </script>";
    }
    if(!isset($_POST['test_id']))
    {
        echo "<script> window.close(); </script>";
    }

    /*Get student_id*/
    $student_id = mysqli_fetch_assoc($conn->query("SELECT student_id FROM student WHERE email = '$_SESSION[students]' "));

    $stmt = $conn->query("SELECT * FROM temp_result WHERE student_id = '$student_id[student_id]' AND test_id = '$_POST[test_id]' ORDER BY time_stamp DESC ");
    $correct_answers    =   0;
    $count              =   0;
    while($row = mysqli_fetch_assoc($stmt))
    {
        /*Get the values compaire the ones that match(correct answers) and the ones that doesn't(wrong answers)*/
        if($row['right_answer'] == $row['selected_answer'])
        {
            /*Add correct marks*/
            $correct_answers++;
        }
        /*Count total questions*/
        $count++;
    }
    /*calculate and send back the percentage*/
    $percentage = ($correct_answers / $count) * 100;
    echo $percentage.'%';



    /*
    *Fetch the questions with the right answers then display them back
    *Looping backwords
    */
    $get1 = $conn->query("SELECT  * FROM temp_result WHERE test_id = '$_POST[test_id]' and student_id = '$student_id[student_id]' ORDER BY time_stamp DESC ");
    $xx = 1;
    while($get1A = mysqli_fetch_assoc($get1))
    {
        /*Get the questions now*/
        $get2 = mysqli_fetch_assoc($conn->query("SELECT * FROM questions WHERE question_id = '$get1A[question_id]' "));
        if($get2['question_type'] == 1)
        {
            /*Yes-No Type*/
            ?>
            <li class="list-group-item media v-middle">
                <div class="media-body">
                    <?php echo $xx++.'. '.$qet2['question_description'];?>
                    <br/>
                    <p  style="padding-left: 15px;">
                        <div class="well well-sm">
                            <div class="">
                                <input type="radio">
                                <label for=""> Yes </label>
                            </div>
                            <div class="">
                                <input type="radio">
                                <label for=""> No </label>
                            </div>
                        </div>
                    </p>
                </div>
            </li>
            <?php

        }
        elseif($get2['question_type'] == 2)
        {
            /*Multiple Choice Type*/
            ?>
            <li class="list-group-item media v-middle">
                <div class="media-body">
                    <?php echo $xx++.'. '.$get2['question_description'];?>
                    <br/>
                    <p style="padding-left: 15px;">
                        <div class="well well-sm">
                        <?php
                            /*multiple choices, so fetch from answers table*/
                            $get_answers = $conn->query("SELECT * FROM answers WHERE question_id = '$get2[question_id]' ORDER BY answer_choice ASC ");
                            while($answer = mysqli_fetch_assoc($get_answers))
                            {
                                /* echo answers... */
                                echo $answer['answer_choice'].'. ';
                            ?>
                                <input type="radio" name="multiple<?php echo $answer['question_id'];?>" id="<?php echo $answer['question_id'];?>" value="<?php echo $answer['answer_choice'];?>" onchange="storeMultiple(this)" required="required" >
                            <?php
                            echo $answer['answer_description'].'<br/>';
                            }
                            ?>
                        </div>
                    </p>
                </div>
            </li>
            <?php
        }
    }


?>