<?php require_once('inc/header.php');?>
<br>
<div class="page-section bg-white">
    <div class="container">

        <div class="text-center">
            <h3 class="text-display-1">Login</h3>
            <p class="lead text-muted">CTI E-Learning</p>
        </div>
        <br/>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
       <div class="panel panel-primary" style="border-radius: 6px;">
           <div class="panel-heading">Login Form</div>
           <div class="panel-body">
                <form method="post" enctype="multipart/form-data">
                    <?php
                    if(isset($_POST['login'])){
                     $username=$_POST['username'];
                        $password=$_POST['password'];

                        $stmt=$conn->query("SELECT * FROM login WHERE username='$username' AND password='$password'");
                        $row=$stmt->fetch_array();
                        $count=$stmt->num_rows;

                        if($count==1){
                            if($row['role']==1){
                                $_SESSION['admin']= $row['username'];
                                $_SESSION['role_session']= $row['role'];
                                echo " <script> window.location.href='admin/index';  </script>";
                            }
                            elseif($row['role']==2){
                                $_SESSION['tutor']= $row['username'];
                                $_SESSION['role_session']= $row['role'];
                                echo " <script> window.location.href='tutor/index';  </script>";
                            }
                            elseif($row['role']==3){
                                $_SESSION['students']= $row['username'];
                                $_SESSION['role_session']= $row['role'];
                                echo " <script> window.location.href='students/index';  </script>";
                            }
                        }
                        else{
                            echo"<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Username or password incorrect!! kindly check and try again.</div>";
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <label class="control-label">Username:</label>
                            <input type="email" name="username" id="username" class="form-control" placeholder="Username" required="required">
                        </div>
                        <div class="col-md-1"></div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <label class="control-label">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
                        </div>
                        <div class="col-md-1"></div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <p>Forgot password?<a href=""> CLICK HERE</a></p>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <button type="submit" name="login" class="btn btn-info"><i class="fa fa-lock"></i> Login</button>
                            <a class="btn btn-warning" href="registration_form"><i class="fa fa-user"></i> Register</a>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </form>
           </div>
       </div>
    </div>
    <div class="col-md-3"></div>
</div>
<!--    <div class="text-center">-->
<!--        <br/>-->
<!--        <a class="btn btn-lg btn-primary" href="website-directory-grid.html">Browse Courses</a>-->
<!--    </div>-->

    </div>
</div>

<?php require_once('inc/footer.php');?>

