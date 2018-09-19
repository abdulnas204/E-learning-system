<?php

include('../../config/db_connect.php');
if(!isset($_POST['id']))
{
    echo "<script> window.location.href='../index';  </script>";
}
else
{
    /*
    ** If id is 1, then get course
    ** If id is 2, then get topic
    */
    if($_POST['id'] == 1)
    {
        //
        ?>
        <div class="form-group col-md-4">
            <label for="">Programme</label>
            <select required name="prog_id" class="form-control" onchange="getCourse()" id="prog_id">
                <option value=""> Select programme </option>
                <?php
                  $get_programme = $conn->query("SELECT * FROM programme ORDER BY prog_name ASC");
                  while($programme = mysqli_fetch_assoc($get_programme))
                  {
                      ?>
                      <option value="<?php echo $programme['prog_id'];?>"> <?php echo $programme['prog_name'];?> </option>
                      <?php
                  }
                ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="">Course</label>
            <select required name="course_id" class="form-control" id="course_id">
                <option value=""> Select programme first </option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <button type="submit" name="add_test1" class="btn btn-primary"><span class="fa fa-send"> Add Test</span></button>
        </div>

        <?php
    }
    elseif($_POST['id'] == 2)
    {
        ?>
        <div class="form-group col-md-4">
            <label for="">Programme</label>
            <select name="prog_id" class="form-control" onchange="getCourse()" id="prog_id" required>
                <option value=""> Select programme </option>
                <?php
                  $get_programme = $conn->query("SELECT * FROM programme ORDER BY prog_name ASC");
                  while($programme = mysqli_fetch_assoc($get_programme))
                  {
                      ?>
                      <option value="<?php echo $programme['prog_id'];?>"> <?php echo $programme['prog_name'];?> </option>
                      <?php
                  }
                ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="">Course</label>
            <select name="course_id" class="form-control" onchange="getTopic()" id="course_id" required>
                <option value=""> Select programme first </option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="">Topics</label>
            <select name="topic_id" class="form-control" id="topic_id" required>
                <option value=""> Select course first </option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <button type="submit" name="add_test2" class="btn btn-primary"><span class="fa fa-send"> Add Test</span></button>
        </div>

        <?php
    }
}

?>