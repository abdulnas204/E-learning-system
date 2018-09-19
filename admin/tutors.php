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
        <h1 class="text-display-1">Tutors</h1>
        <div class="panel panel-default">
            <div class="table-responsive">
                <table data-toggle="data-table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><span class="fa fa-user"> Name</span></th>
                        <th><span class="fa fa-envelope"> Email</span></th>
                        <th><span class="fa fa-mobile-phone"> Phone</span></th>
                        <th><span class="fa fa-location-arrow"> Country</span></th>
                        <th><span class="fa  fa-calendar-o"> Joining Date</span></th>
                        <th><span class="fa fa-cogs"> Action</span></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th><span class="fa fa-user"> Name</span></th>
                        <th><span class="fa fa-envelope"> Email</span></th>
                        <th><span class="fa fa-mobile-phone"> Phone</span></th>
                        <th><span class="fa fa-location-arrow"> Country</span></th>
                        <th><span class="fa  fa-calendar-o"> Joining Date</span></th>
                        <th><span class="fa fa-cogs"> Action</span></th>
                    </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $get_tutors = $conn->query("SELECT * FROM tutor ORDER BY fname ASC ");
                        $count = 1;
                        while($tutor = mysqli_fetch_assoc($get_tutors))
                        {
                            $country = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM countries WHERE country_code = '$tutor[country_code]' "));
                            ?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $tutor['fname'].' '.$tutor['mname'].' '.$tutor['lname'];?></td>
                                <td><?php echo $tutor['email'];?></td>
                                <td><?php echo $tutor['phone'];?></td>
                                <td><?php echo $country['country_name'];?></td>
                                <td><?php echo $tutor['created_date'];?></td>
                                <td><a href="tutor_details?id=<?php echo $tutor['tutor_id'];?>"><span class="fa fa-external-link"></span>Details</a></td>
                            </tr>
                            <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div><!-- /st-content-inner -->

</div><!-- /st-content -->

</div><!-- /st-pusher -->
    <!-- Footer -->
<?php require_once('inc_admin/admin_footer.php');?>