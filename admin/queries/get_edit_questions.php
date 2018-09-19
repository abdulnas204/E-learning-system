<?php

    include('../../config/db_connect.php');

    if(!isset($_POST['type_id']) && !isset($_POST['quiz_id']))
    {
        /*Go Back*/
        echo "<script> window.location.href='index';  </script>";
        exit;
    }
    else
    {
        /*Get Question*/
        $getQ = mysqli_fetch_assoc($conn->query("SELECT * FROM questions WHERE question_id = '$_POST[quiz_id]' "));

        /*Get the divisions*/
        if($_POST['type_id'] == 1)
        {
            /*Yes-No*/
            ?>
            <form action="" method="POST">
                <div class="from-group">
                    <label>Question</label>
                    <textarea name="quiz_description" class="form-control" id="" cols="" rows="" required="required"><?php echo $getQ['question_description']; ?></textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label for="">Yes/No</label>
                    <div class="">
                        <input type="radio" name="yes-no" value="Yes" required="required" >
                        <label for=""> Yes </label>
                    </div>
                    <div class="">
                        <input type="radio" name="yes-no" value="No" required="required" >
                        <label for=""> No </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" value="<?php echo $_POST['quiz_id'];?>" class="btn btn-primary" name="update_quiz1"><span class="fa fa-save"> Update</span></button>
                    </div> <br/>
                </div>
            </form>
            <?php
        }
        elseif($_POST['type_id'] == 2)
        {
            /*Multiple choices*/
            ?>
            <form action="" method="POST">
                <div class="from-group">
                    <label>Question</label>
                    <textarea name="quiz_description" class="form-control" id="" cols="" rows="" required="required"><?php echo $getQ['question_description']; ?></textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label for="">Multiple answer</label>
                    <?php
                    $getAnswers = $conn->query("SELECT * FROM answers WHERE question_id = '$_POST[quiz_id]' ORDER BY answer_choice ASC");
                    while($getRows = mysqli_fetch_assoc($getAnswers))
                    {
                        ?>
                        <div class="row">
                            <div class="col-xs-1"><h4><?php echo $getRows['answer_choice'];?>.</h4></div>
                            <div class="col-xs-10"><input type="text" name="<?php echo $getRows['answer_choice'];?>" value="<?php echo $getRows['answer_description'];?>" class="form-control input-sm" required="required"/></div>
                            <div class="col-xs-1"><input type="radio" name="multiple" value="<?php echo $getRows['answer_choice'];?>" required="required"/></div>
                        </div> <br/>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <button type="submit" value="<?php echo $_POST['quiz_id'];?>" class="btn btn-primary" name="update_quiz2"><span class="fa fa-save"> Update</span></button>
                    </div> <br/>
                </div>
            </form>
            <?php
        }
        else
        {
            /*Go back*/
            echo "<script> window.location.href='../index';  </script>";
            exit();
        }
    }

?>