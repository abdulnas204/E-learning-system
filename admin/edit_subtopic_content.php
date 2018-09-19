<?php
require_once('inc_admin/admin_header.php');
    $subtopic_id = $_GET['id'];
    $confirm = mysqli_num_rows($conn->query("SELECT subtopic_id FROM course_subtopic WHERE subtopic_id = '$subtopic_id' "));
    if($confirm < 1)
    {
        echo "<script> alert('SORRY!!! The sub-topic does not exist.'); </script>";
        echo "<script> window.location.href='course_details?id=$subtopic_id';</script>";
    }
    $get_subtopic = $conn->query("SELECT * FROM course_subtopic WHERE subtopic_id = '$subtopic_id'");
    $subtopic = mysqli_fetch_assoc($get_subtopic);                            /*Get subtopic*/
    $get_topic = $conn->query("SELECT * FROM course_topic WHERE topic_id = '$subtopic[topic_id]' ");
    $topic = mysqli_fetch_assoc($get_topic);                                  /*Get Content*/
    $get_course = $conn->query("SELECT * FROM course WHERE course_id = '$topic[course_id]' ");
    $course = mysqli_fetch_assoc($get_course);                                  /*Get Course*/

    if(isset($_POST['save']))
    {
       $attachment = mysqli_real_escape_string($conn, trim($_FILES['attachment']['name']));
       $subtopic_name = trim(mysqli_real_escape_string($conn, $_POST['subtopic_name']));
       $subtopic_content = trim(mysqli_real_escape_string($conn, $_POST['content']));

       $update_subtopic = $conn->query("UPDATE course_subtopic SET subtopic_name = '$subtopic_name', subtopic_content = '$subtopic_content' WHERE subtopic_id = '$subtopic[subtopic_id]' ");
       if($update_subtopic)
       {
           /*check if there is a file uploaded and execute the query below else do not*/
           if($attachment != '')
           {
               $update_file = $conn->query("INSERT INTO files (subtopic_id, file_name) VALUES ('$subtopic_id','$attachment')");
               move_uploaded_file( $_FILES['attachment']['tmp_name'], "../files/".$_FILES['attachment']['name']);
           }
           $_SESSION['subtopic_update_success'] = 1;
           echo "<script> window.location='course_details?id=$course[course_id]'; </script>"; //go back to course_details page

       }
       else
       {
           $error = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Failed!!! Data not Saved. Kindly contact your administrator.</div>";
       }
    }
    if(isset($_POST['delete_confirm']))
    {
        $delete = $conn->query("DELETE FROM course_subtopic WHERE subtopic_id = '$subtopic[subtopic_id]' ");
        if($delete)
        {
            echo "<script> window.location='course_details?id=$course[course_id]'; </script>";
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
    </div>
    <div class="row" data-toggle="isotope">
        <div class="col-md-12">
            <?php

            if(isset($error))
            {
                echo $error;
            }
            ?>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary" style="border-radius: 6px;">
                <div class="panel-heading">
                    <span class="fa fa-edit"> EDIT SUB-TOPIC & CONTENT </span>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-control-material">
                            <input type="text" name="subtopic_name" id="" placeholder="Subtopic Name" class="form-control used" value="<?php echo $subtopic['subtopic_name'];?>" required/>
                            <label for="suntopic name">Subtopic Name</label> <br/>
                        </div>
                        <div class="form-group form-control-material">
                            <input type="file" name="attachment" id="" placeholder="Course Sub Topic" class="form-control used" />
                            <label for="attachment">Add an Attachment <span class="glyphicon glyphicon-save-file"></span></label> <br/>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="summernote"><?php echo $subtopic['subtopic_content'];?></textarea>
                        </div>
                        <div class="form-group">
                            <span class="fa fa-files-o">Files&nbsp;</span> <br/>
                            <?php
                            $get_files = $conn->query("SELECT * FROM files WHERE subtopic_id = '$subtopic_id' ORDER BY file_type ASC ");
                            while($files = mysqli_fetch_assoc($get_files))
                            {
                                if($files['file_type'] == 1)
                                {
                                    echo '<span class="glyphicon glyphicon-facetime-video"></span>&nbsp;&nbsp;';
                                }
                                elseif($files['file_type'] == 2)
                                {
                                    echo '<span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;';
                                }
                                elseif($files['file_type'] == 3)
                                {
                                    echo '<span class="fa fa-file-text"></span>&nbsp;&nbsp;';
                                }
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="save" class="btn btn-info"><span class="fa fa-save"> Save Changes</span></button>
                            <button type="button" name="delete" class="btn btn-danger" data-backdrop="static" data-toggle="modal" data-target="#delete_confirm" ><span class="fa fa-times">Delete</span></button>
                            <button type="button" class="btn btn-warning" onclick="window.location.href='course_details?id=<?php echo $course['course_id'];?>'" ><span class="fa fa-reply"> Cancel</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->

</div><!-- /st-pusher -->

  <!--Delete confirmation modal START-->
<div id="delete_confirm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm" style=" padding-top: 15%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h4 class="modal-title">Are you sure you want to delete?</h4>
                    <hr/><br/>
                    <form action="" method="post" enctype="multipart/form-data">
                        <button type="submit" name="delete_confirm" class="btn btn-danger btn-sm"><span class="fa fa-check">YES</span></button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><span class="fa fa-times">NO</span></button>
                    </form>
                </center>
            </div>
        </div>

    </div>
</div>
<!--Delete confirmation modal END-->


    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>