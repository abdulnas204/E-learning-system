<?php require_once('inc/header.php');?>

<?php
    if(isset($_POST['submit']))
    {
        $fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
        $mname = trim(mysqli_real_escape_string($conn, $_POST['mname']));
        $lname = trim(mysqli_real_escape_string($conn, $_POST['lname']));
        $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
        $phone = trim(mysqli_real_escape_string($conn, $_POST['phone']));
        $gender = trim(mysqli_real_escape_string($conn, $_POST['gender']));
        $dob = trim(mysqli_real_escape_string($conn, $_POST['dob']));
        $country = trim(mysqli_real_escape_string($conn, $_POST['country']));
        $code = trim(mysqli_real_escape_string($conn, $_POST['code']));
        $referee = trim(mysqli_real_escape_string($conn, $_POST['referee']));
        $account_type = trim(mysqli_real_escape_string($conn, $_POST['account_type']));
        $programme = trim(mysqli_real_escape_string($conn, $_POST['programme']));
        $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

        $phone2 = $code.''.$phone;

        if($account_type == 1)
        {
            /*insert into student table*/
            $count = mysqli_num_rows($conn->query("SELECT email FROM student WHERE email = '$email' "));
            if($count > 0)
            {
                $msg = "<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>User already exist</div>";
            }
            else
            {
                $insert1 = $conn->query("INSERT INTO student (email,prog_id,fname,mname,lname,dob,gender,phone,country_code)
                            VALUES ('$email','$programme','$fname','$mname','$lname','$dob','$gender','$phone2','$country')");
                if($insert1)
                {
                    $insertLogin = $conn->query("INSERT INTO login (username, password, role) VALUES ('$email','$password','3') ");
                    $msg =  "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Account successfully created. Please login</div>";
                }
                else
                {
                    $msg = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Sorry!!! Account creation failed.</div>";
                }
            }
        }
        elseif($account_type == 2)
        {
            /*insert into tutor table*/
            $count2 = mysqli_num_rows($conn->query("SELECT email FROM tutor WHERE email = '$email' "));
            if($count2 > 0)
            {
                $msg = "<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>User already exist</div>";
            }
            else
            {
                $insert2 = $conn->query("INSERT INTO tutor (email,prog_id,fname,mname,lname,dob,gender,phone,country_code)
                            VALUES ('$email','$programme','$fname','$mname','$lname','$dob','$gender','$phone2','$country')");
                if($insert2)
                {
                    $insertLogin2 = $conn->query("INSERT INTO login (username, password, role) VALUES ('$email','$password','2') ");
                    $msg =  "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Account successfully created. Please login</div>";
                }
                else
                {
                    $msg = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Sorry!!! Account creation failed.</div>";
                }
            }
        }

    }
?>

<br>
<div class="page-section bg-white">
    <div class="container">

        <div class="text-center">
            <h3 class="text-display-1">Tutor/Student Registration</h3>
            <p class="lead text-muted">
            <span class="fa fa-mortar-board" style="font-size:30px;color: #0E454E;"></span>&nbsp;
            Welcome to CTI Online Learning Platform. Start Learning Today&nbsp;
            <span class="fa fa-mortar-board" style="font-size:30px;color: #0E454E;"></span>
            </p>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary" style="border-radius: 6px;">
                    <div class="panel-heading">Registration:</div>
                    <div class="panel-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div id="alert">
                            <?php
                            if(isset($msg))
                            {
                                echo $msg;
                            }
                            ?>
                        </div>
                       <div class=" row">
                           <div class="col-md-4">
                               <label class="control-label">First Name</label> <span class="required">*</span>
                               <input type="text" class="form-control" name="fname" id="test" placeholder="First Name" required="required">
                           </div>
                           <div class="col-md-4">
                               <label class="control-label">Middle Name</label>
                               <input type="text" class="form-control" name="mname" id="test" placeholder="Middle Name">
                           </div>
                           <div class="col-md-4">
                                <label class="control-label">Last Name</label> <span class="required">*</span>
                                <input type="text" class="form-control" name="lname" id="test" placeholder="Last Name" required="required">
                            </div>
                       </div>
                        <div class=" row">
                            <div class="col-md-4">
                                <label class="control-label">Username:</label> <span class="required">*</span>
                                <input type="email" class="form-control" name="email" id="test" placeholder="Email Address" required="required">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Gender:</label> <span class="required">*</span>
                                <select name="gender" class="form-control" id="" required="required">
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Date of Birth:</label> <span class="required">*</span>
                                <input type="date" class="form-control" name="dob" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Country:</label> <span class="required">*</span>
                                <select name="country" id="country" onchange="setCode(this)" data-live-search="true" class="form-control selectpicker" required="required">
                                    <option></option>
                                    <?php
                                    $get_country = $conn->query("SELECT * FROM countries ORDER BY country_name ASC ");
                                    while($country = mysqli_fetch_assoc($get_country))
                                    {
                                        ?>
                                        <option value="<?php echo $country['country_code'];?>"> <?php echo $country['country_name'];?> </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="col-xs-3">
                                    <label class="control-label">Code</label> <span class="required">*</span>
                                    <input type="text" name="code" id="code" class="form-control" placeholder="+254" readonly="readonly" />
                                </div>
                                <div class="col-xs-9">
                                    <label class="control-label">Phone</label> <span class="required">*</span>
                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="707866136" required="required">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Programme</label> <span class="required">*</span>
                                <select class="form-control selectpicker" name="programme" data-live-search="true" required="required">
                                    <option>~~Select Program~~</option>
                                    <?php
                                    $get_prog = $conn->query("SELECT * FROM programme ORDER BY prog_name ASC");
                                    while($prog = mysqli_fetch_assoc($get_prog))
                                    {
                                        ?>
                                        <option value="<?php echo $prog['prog_id'];?>"> <?php echo $prog['prog_name'];?> </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label">Account Type:</label> <span class="required">*</span>
                                    <select class="form-control" name="account_type">
                                        <option>~~Select account type~~</option>
                                        <option value="1">Student</option>
                                        <option value="2">Tutor</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">How did you know about us?</label>
                                    <select class="form-control" name="referee" required="required">
                                        <option>~~Select referee~~</option>
                                        <option value="friends">Friends</option>
                                        <option value="social sites">Social sites</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Password:</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required">
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Confirm Password:</label>
                                <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm Password" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <h4>Terms and Conditions:</h4>
                                <h5>Definitions:</h5>
                                <ul>
                                    <li>Tutor(s) - Anyone who is providing teaching services through CTI platform by enrolling students.</li>
                                    <li>Paying Student(s) - Students who have paid fees to CTL for using CTI's premium products.</li>
                                    <li>Free Students(s) - Students who are using basic CTI web products for no-cost.</li>
                                    <li>Free web platform - CTI's basic platform that is available at no costs.</li>
                                    <li>Enrolled students - Each teacher shall be enrolling the students via excel uploads or by providing student data in an excel.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="checkbox" id="myCheck" onchange="myFunction()" name="myCheck"> <label>Agree to terms and conditions?</label> <span class="required">*</span>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" id="register" disabled  name="submit"><i class="fa fa-send"></i> Register</button>
                                <a type="reset" class="btn btn-warning" href="index"><i class="fa fa-lock"></i> Login</a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="text-center">-->
<!--            <br/>-->
<!--            <a class="btn btn-lg btn-primary" href="website-directory-grid.html">Browse Courses</a>-->
<!--        </div>-->

    </div>
</div>

<script type="text/javascript">
function setCode(e)
{
    var code = document.getElementById('country').value;
    document.getElementById('code').value = code;
}
</script>

<script type="text/javascript">
function myFunction()
{
    if(document.getElementById("myCheck").checked == true)
    {
        document.getElementById("register").disabled = false;
    }
    else if(document.getElementById("myCheck").checked == false)
    {
        document.getElementById("register").disabled = true;
    }
}
</script>

<?php require_once('inc/footer.php');?>

