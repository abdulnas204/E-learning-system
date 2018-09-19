<?php
require_once('inc_instr/tutor_header.php');
$code=$_GET['code'];

$s=$conn->query("SELECT * FROM course WHERE course_id='$code'");
while($r=mysqli_fetch_assoc($s)){
    $n=$r['course_name'];
    $c_code=$r['course_id'];
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
    <h3 class="">Pick Topics of your Interest.</h3>
</div>
<div class="row" data-toggle="isotope">
    <div class="col-md-10">
        <div class="panel panel-primary" style="border-radius: 6px;">
            <div class="panel-heading"><?php echo $n; ?> Topics</div>
            <div class="panel-body">
    <form method="post">
     <?php
     if(isset($_POST['submit'])){
         $topics=trim($_POST['topics']);
         if($topics){
             foreach($topics AS $t){
                 if($t != '')
                 {
                     $sql=$conn->query("INSERT INTO tutor_topic(tutor_id,topic_id) VALUES('$tutor_id','$t') ");
                     if($sql){
                         echo"<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>success.</div>";
                     }
                     else{
                         echo"<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>failed.</div>";
                     }
                 }
                 
             }
         }
         echo"<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>success.</div>";
     }
     ?>
    <div class="row">
        <div class="col-md-12">
          <label class="control-label">Course Name:</label>
            <input class="form-control" value="<?php echo $n; ?>" readonly>
        </div>
        <div class="col-md-12">
            <label class="control-label">Select Topics:</label>
            <select class="selectpicker form-control" multiple data-live-search="true" name="topics[]" required="required">
                <?php
                $stmt=$conn->query("SELECT * FROM course_topic WHERE course_id='$code'");
                while($row=mysqli_fetch_assoc($stmt)){
                    ?>
                    <option value="<?php echo $row['topic_id'];?>"><?php echo $row['topic_name'];?></option>
                    <?php
                }

                ?>
            </select>
        </div>
    </div><br/>
    <div class="row">
        <div class="col-md-4">
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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
<?php require_once('inc_instr/tutor_footer.php');?>