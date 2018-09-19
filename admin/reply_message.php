<?php
require_once('../config/db_connect.php');
$mess_id=$_GET['mess_id'];
if(isset($_POST['reply'])){
    $reply_message=$_POST['reply_message'];
    //$time=NOW();
    $stmt=$conn->query("UPDATE student_admin_chat SET reply='$reply_message',reply_time=NOW() WHERE id='$mess_id'");
    if($stmt){
        //echo"<script>window.location.href='inbox'</script>";
        $alert="<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Success</div>";

    }
    else{
        echo"<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>Failed!!</div>";
    }
}

?>