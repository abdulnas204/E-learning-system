<?php
require_once('inc_stude/stude_header.php');
$code=$_GET['code'];
$s=$conn->query("SELECT course.*, course_topic.topic_id, course_topic.topic_name
                FROM cti.course
                INNER JOIN cti.course_topic
                ON (course.course_id = course_topic.course_id) WHERE course_topic.course_id='$code'");
                $r=mysqli_fetch_assoc($s);
                $course_nam=$r['course_name'];
                $c_code=$r['course_id'];
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
                        <div class="col-md-8">
                            <div class="panel panel-primary" style="border-radius: 6px;">
                                <div class="panel-heading"><?php echo $course_nam; ?> Topics</div>
                                <div class="panel-body">
                                    <form method="post">
                                        <?php

                                        if(isset($_POST['submit'])){
                                            $topics=$_POST['topics'];
                                            if($topics){
                                                foreach($topics AS $t){
                                                    $sql=$conn->query("INSERT INTO student_topic(student_id,topic_id) VALUES('$student_id','$t') ");
                                                    if($sql){
                                                        //echo"<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>success.</div>";
                                                    }
                                                    else{
                                                        echo"<div class='alert alert-warning'><button class='close' data-dismiss='alert'>&times;</button>failed.</div>";
                                                    }
                                                }
                                            }
                                            echo"<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>Course registration successful.</div>";
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label">Course Name:</label>
                                                <input class="form-control" value="<?php echo $course_nam; ?>" readonly>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="control-label">Select Topics:</label>
                                                <?php
                                                $sql_query=$conn->query("SELECT * FROM student_topic");
                                                while($r1=mysqli_fetch_assoc($sql_query)){

                                                    $top_id=$r1['topic_id'];
                                                }
                                                ?>
                                                <select class="selectpicker form-control" multiple data-live-search="true" name="topics[]">
                                                    <?php
//                                                    $top=$_POST['topics[]'];
//                                                    $confirm=$conn->query("SELECT * FROM student_topic WHERE student_id='$student_id' AND topic_id='$top'");
//                                                    $con=$confirm->fetch_array();
//                                                    $count=$confirm->num_rows;
//                                                    if($count==0){
                                                        $stmt=$conn->query("SELECT * FROM course_topic WHERE course_id='$code' AND topic_id !='$top_id'");
                                                        while($row=mysqli_fetch_assoc($stmt)){
                                                            ?>
                                                            <option value="<?php echo $row['topic_id'];?>"><?php echo $row['topic_name'];?></option>
                                                            <?php
                                                        }
                                                    //}

                                                    ?>
                                                </select>
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button class="btn btn-primary" type="submit" name="submit">Register <i class="fa fa-send"></i></button>
                                                <a class="btn btn-warning" href="all_courses">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="row">
                                    <div class="span12">
                                        <table class="table-condensed table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th colspan="7">
                                            <span class="btn-group">
                                                <a class="btn"><i class="icon-chevron-left"></i></a>
                                                <a class="btn active">February 2012</a>
                                                <a class="btn"><i class="icon-chevron-right"></i></a>
                                            </span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Su</th>
                                                <th>Mo</th>
                                                <th>Tu</th>
                                                <th>We</th>
                                                <th>Th</th>
                                                <th>Fr</th>
                                                <th>Sa</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="muted">29</td>
                                                <td class="muted">30</td>
                                                <td class="muted">31</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>6</td>
                                                <td>7</td>
                                                <td>8</td>
                                                <td>9</td>
                                                <td>10</td>
                                                <td>11</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>13</td>
                                                <td>14</td>
                                                <td>15</td>
                                                <td>16</td>
                                                <td>17</td>
                                                <td>18</td>
                                            </tr>
                                            <tr>
                                                <td>19</td>
                                                <td class="btn-primary"><strong>20</strong></td>
                                                <td>21</td>
                                                <td>22</td>
                                                <td>23</td>
                                                <td>24</td>
                                                <td>25</td>
                                            </tr>
                                            <tr>
                                                <td>26</td>
                                                <td>27</td>
                                                <td>28</td>
                                                <td>29</td>
                                                <td class="muted">1</td>
                                                <td class="muted">2</td>
                                                <td class="muted">3</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        </div>

                    </div>

                </div>

            </div><!-- /st-content-inner -->

        </div><!-- /st-content -->

    </div><!-- /st-pusher -->

    <!-- Footer -->
<?php require_once('inc_stude/stude_footer.php');?>