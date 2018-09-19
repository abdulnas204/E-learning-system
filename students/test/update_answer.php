<?php

    session_start();
    require_once('../../config/db_connect.php');
    /*Get student_id first*/
    $get_student = mysqli_fetch_assoc($conn->query("SELECT student_id FROM student WHERE email = '$_SESSION[students]' "));

    /*
    *Get values from the test
    *compaire if the values sent are from the multiple choices or yes-no
    *then equate accordingly
    */
    if(isset($_POST['quiz_id']) && isset($_POST['quiz_answer']))
    {
        /*Now update the student answer in the temp_result table*/
        $update1 = $conn->query("UPDATE temp_result SET selected_answer = '$_POST[quiz_answer]' WHERE question_id = '$_POST[quiz_id]' AND student_id = '$get_student[student_id]' ");
        if($update1)
        {
            //echo "<script> alert('Update success'); </script>";
        }
        else
        {
            echo "<script> alert('Update failed'); </script>";
        }
    }
    elseif(isset($_POST['quiz_multi_id']) && isset($_POST['chosen_answer']))
    {
        /*Now update the student answer in the temp_result table*/
        $update2 = $conn->query("UPDATE temp_result SET selected_answer = '$_POST[chosen_answer]' WHERE question_id = '$_POST[quiz_multi_id]' AND student_id = '$get_student[student_id]' ");
        if($update2)
        {
            //echo "<script> alert('Update2 success'); </script>";
        }
        else
        {
            echo "<script> alert('Update2 failed'); </script>";
        }
    }
    else
    {
        echo "<script> window.close(); </script>";
    }


?>