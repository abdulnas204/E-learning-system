<?php

include('../../config/db_connect.php');
if(isset($_POST['prog_id']))
{
    echo '<option value=""> Select course </option>';
    $get_course = $conn->query("SELECT * FROM course WHERE prog_id = '$_POST[prog_id]' ORDER BY course_name ASC");
    while($course = mysqli_fetch_assoc($get_course))
    {
        ?>
        <option value="<?php echo $course['course_id'];?>"> <?php echo $course['course_name'];?> </option>
        <?php
    }
}
elseif(isset($_POST['course_id']))
{
    echo '<option value=""> Select topic </option>';
    $get_topic = $conn->query("SELECT * FROM course_topic WHERE course_id = '$_POST[course_id]' ORDER BY topic_name ASC");
    while($topic = mysqli_fetch_assoc($get_topic))
    {
        ?>
        <option value="<?php echo $topic['topic_id'];?>"> <?php echo $topic['topic_name'];?> </option>
        <?php
    }
}
else
{
    echo "<script> window.location.href='../index';  </script>";
    exit();
}

?>