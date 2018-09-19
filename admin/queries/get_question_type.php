<?php

    if(!isset($_POST['type_id']))
    {
        /*Go Back*/
        echo "<script> window.location.href='index';  </script>"; 
    }
    else
    {
        /*Get the divisions*/
        if($_POST['type_id'] == 1)
        {
            /*Yes-No*/
            ?>
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
                    <button type="submit" class="btn btn-primary" name="add_quiz1"><span class="fa fa-plus"> Add</span></button>
                </div> <br/>
            </div>
            <?php
        }
        elseif($_POST['type_id'] == 2)
        {
            /*Multiple choices*/
            ?>
            <div class="form-group">
                <label for="">Multiple answer</label>
                <div class="row">
                    <div class="col-xs-1"><h4>A.</h4></div>
                    <div class="col-xs-10"><input type="text" name="a" class="form-control input-sm" required="required"/></div>
                    <div class="col-xs-1"><input type="radio" name="multiple" value="A" required="required"/></div>
                </div> <br/>
                <div class="row">
                    <div class="col-xs-1"><h4>B.</h4></div>
                    <div class="col-xs-10"><input type="text" name="b" class="form-control input-sm" required="required"/></div>
                    <div class="col-xs-1"><input type="radio" name="multiple" value="B" required="required"/></div>
                </div> <br/>
                <div class="row">
                    <div class="col-xs-1"><h4>C.</h4></div>
                    <div class="col-xs-10"><input type="text" name="c" class="form-control input-sm" required="required"/></div>
                    <div class="col-xs-1"><input type="radio" name="multiple" value="C" required="required"/></div>
                </div> <br/>
                <div class="row">
                    <div class="col-xs-1"><h4>D.</h4></div>
                    <div class="col-xs-10"><input type="text" name="d" class="form-control input-sm" required="required"/></div>
                    <div class="col-xs-1"><input type="radio" name="multiple" value="D" required="required"/></div>
                </div> <br/>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="add_quiz2"><span class="fa fa-plus"> Add</span></button>
                </div> <br/>
            </div>
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