<?php
require_once('inc_admin/admin_header.php');
$id=@$_GET['id'];
$y=@$_GET['act'];

if(@$_GET['act']=="delete"){
    $query=$conn->query("DELETE FROM student_admin_chat WHERE id='$id'");
    if($query){
        $msg="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Message Successfully removed.</div>";
    }
    else{
        $msg="<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Failed!! Removing course failed.</div>";
    }
}
else{

}
//$msg="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Message Successfully removed.</div>";
?>
    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">
                    <div class="page-section">
                        <a class="btn btn-info" data-toggle="modal" data-target="#compose" data-backdrop="static" href=""><i class="fa fa-envelope"></i> Compose</a>
                        <a class="btn btn-default" href="inbox"><i class="fa fa-envelope"></i> Inbox</a>
                        <a class="btn btn-primary" href="sent_messages"><i class="fa fa-envelope"></i> Sent Messages</a>
                    </div>
                    <div>
                        <?php
                        if(isset($alert)){
                            echo $alert;
                        }
                        ?>
                    </div>
                    <div class="row" data-toggle="isotope">
                        <div class="col-md-10">
                            <div class="panel panel-info" style="border-radius: 6px;">
                                <div class="panel-heading"></div>
                                <?php
                                $stmt=$conn->query("SELECT * FROM student_admin_chat WHERE reply !='NULL'");

                                if(mysqli_num_rows($stmt) < 1){
                                    echo '<div class="alert alert-warning"><i class="fa fa-warning"></i> No sent messages.</div>';
                                }
                                else{
                                    while($row=mysqli_fetch_assoc($stmt)){
                                        ?>
                                        <div class="panel-body">
                                            <!--                                        --><?php
                                            //                                        if($count<1){
                                            //                                            echo '<div class="alert alert-warning"><i class="fa fa-warning"></i> No sent messages.</div>';
                                            //                                        }
                                            //                                        else{
                                            //                                            ?>
                                            <!--                                            <div>-->
                                            <!--                                                --><?php
                                            //                                                if(isset($msg)){
                                            //                                                    echo $msg;
                                            //                                                }
                                            //                                                ?>
                                            <!--                                            </div>-->
                                            <div class=" col-md-12">
                                                <div class="panel panel-default paper-shadow" data-z="0.5">
                                                    <div class="cover overlay cover-image-full hover">
                                                        <a href="" class="padding-none overlay overlay-full icon-block bg-info"></a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <h4 class="text-headline margin-v-0-10"><a href=""><?php //echo $row['course_name'];?></a></h4>
                                                        <h5>Sent to: <?php echo $row['receiver'];?></h5>
                                                    </div>
                                                    <hr class="margin-none">
                                                    <div class="panel-body">
                                                        <p><span class="pull-left"><strong>Message:</strong> <?php echo $row['reply'];?></span> <span class="pull-right"><strong>Replied at: <?php echo $row['reply_time'];?></strong></span></p><br/>
                                                        <a href="?action=trans&id=<?php echo $row['id']; ?>&act=delete" class="btn btn-sm btn-danger btn-flat paper-shadow relative" data-z="0" data-hover-z="1" data-animated="" onclick="return confirm('This message will be deleted permanently!?')"><i class="fa fa-fw fa-remove"></i>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--                                            --><?php
                                            //                                        }
                                            //                                        ?>
                                        </div>

                                        <?php
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Compose message modal-->
                <div id="compose" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                <h4 class="modal-title"><i class="fa fa-envelope"></i> Create Admin a Message</h4>
                            </div>
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <?php
                                            if(isset($_POST['send'])){
                                                $mess=$_POST['message'];
                                                $receiver='Admin';
                                                $stmt=$conn->query("INSERT INTO student_admin_chat(sender,receiver,message) VALUES('$_SESSION[admin]','$receiver','$mess')");
                                                if($stmt){
                                                    $alert="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Message sent successfully.</div>";
                                                }
                                                else{
                                                    $alert="<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Failed!!</div>";
                                                }
                                            }
                                            ?>
                                            <div class="row">
                                                <label class="control-label">Message:</label> <span class="required">*</span>
                                                <textarea class="form-control" rows="5" name="message" required="required"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="send"><i class="fa fa-send"></i> Send</button>
                                    <button type="reset" class="btn btn-warning"><i class="fa fa-remove"></i> Clear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /st-content-inner -->
        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>