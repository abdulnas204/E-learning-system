<?php
require_once('inc_admin/admin_header.php');

?>
    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">
                    <div class="page-section">
                        <!--<h1 class="text-display-1">My Courses</h1>-->
                    </div>
                    <div class="row" data-toggle="isotope">
                        <div class="col-md-8">
                            <div class="panel panel-primary" style="border-radius: 6px;">
                                <div class="panel-heading">My Profile</div>
                                <div class="panel-body">
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                    $stmt=$conn->query("SELECT * FROM admin WHERE email='$_SESSION[admin]'");
                                    $row=mysqli_fetch_assoc($stmt);

                                    if(isset($_POST['update'])){
                                    $f_name=mysqli_real_escape_string($conn, trim($_POST['fname']));
                                    $m_name=mysqli_real_escape_string($conn, trim($_POST['mname']));
                                    $l_name=mysqli_real_escape_string($conn, trim($_POST['lname']));
                                    $p_no=mysqli_real_escape_string($conn, trim($_POST['phone']));
                                    $imgFile = mysqli_real_escape_string($conn, trim($_FILES['photo']['name']));

                                    if($imgFile != '')
                                    {
                                        /*if there exist an uploaded file then continue in updating the new image
                                        *otherwise do not update
                                        */
                                        $imageTmp = $_FILES['photo']['tmp_name'];
                                        $imageSize = $_FILES['photo']['size'];
                                        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
                                        $valid = array('jpeg','jpg','png','gif');
                                        if(in_array($imgExt,$valid))
                                        {
                                            /*if the image type and size is right then upload, else exit*/
                                            move_uploaded_file($imageTmp,"../images/admins/".$imgFile);
                                        }
                                        else
                                        {
                                            /*exit the program at this point and display the error*/
                                            echo "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>
                                                    <strong> Failed!!! </strong>Invalid image choosen</div>";
                                            exit();
                                        }
                                    }
                                    else
                                    {
                                        /*if there is no image uploaded, then take the value of the initial image and re-insert into the DB*/
                                        $imgFile = mysqli_real_escape_string($conn, trim($_POST['photo2']));
                                    }

                                        /*if all are OK, then proceed with the updation of the database*/
                                        $stmt3=$conn->query("UPDATE admin SET fname='$f_name', mname='$m_name', lname='$l_name',phone='$p_no',image='$imgFile' WHERE email='$_SESSION[admin]'");
                                        if($stmt3){
                                            echo"<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Details successfully updated.</div>";
                                            echo " <script> window.location.href='my_profile';  </script>";
                                        }
                                        else{
                                            echo"<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Details update failed!!..</div>";
                                        }

                                    }

                                    ?>
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <img src="../images/admins/<?php echo $row['image'];?>" style="width: 100%; height: 200px;" alt="Update profile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name:</label>
                                                <input type="text" name="fname" class="form-control" value="<?php echo $row['fname'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Middle Name:</label>
                                                <input type="text" name="mname" class="form-control" value="<?php echo $row['mname'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name:</label>
                                                <input type="text" name="lname" class="form-control" value="<?php echo $row['lname'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address:</label>
                                                <input type="email" readonly name="email" class="form-control" value="<?php echo $row['email'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone No:</label>
                                                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Account creation date:</label>
                                                <input type="text" readonly class="form-control" value="<?php echo $row['created_date'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="file" name="photo" class="form-control">
                                            <input type="hidden" name="photo2" readonly="readonly" value="<?php echo $row['image'];?>" class="form-control">
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="update" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
                                        </div>
                                    </div>
                                </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-primary" style="border-radius: 6px;">
                                <div class="panel-heading">Change Password</div>
                                <div class="panel-body">
                                <form method="post">
                                    <?php
                                    if(isset($_POST['update_password'])){
                                        $pass=$_POST['password'];

                                        $stmt2=$conn->query("UPDATE login SET password='$pass' WHERE username='$_SESSION[admin]'");
                                        if($stmt2){
                                            echo"<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Password successfully updated.</div>";
                                        }
                                        else{
                                            echo"<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Password update failed!!..</div>";
                                        }
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>New Password:</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Confirm New Password:</label>
                                                <input type="password" class="form-control" name="password2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" type="submit" name="update_password"><i class="fa fa-save"></i> Change Password</button>
                                            <button type="reset" class="btn btn-danger"><i class="fa fa-remove"></i> Cancel</button>
                                        </div>
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

    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>