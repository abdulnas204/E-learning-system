
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="<?php if($page == 'Introduction'){echo 'active';}?>"><a data-toggle="tab" href="instructions?<?php if(isset($_GET['t_id'])){echo 't_id='.$_GET['t_id'];}elseif(isset($_GET['c_id'])){echo 'c_id='.$_GET['c_id'];}?>"><b>Introduction</b></a></li>
                <li class="<?php if($page == 'Test'){echo 'active';}?>"><a data-toggle="tab" href="take_test?<?php if(isset($_GET['t_id'])){echo 't_id='.$_GET['t_id'];}elseif(isset($_GET['c_id'])){echo 'c_id='.$_GET['c_id'];}?>"><b>Questions</b></a></li>
                <li class="<?php if($page == 'Support'){echo 'active';}?>"><a data-toggle="tab" href="support?<?php if(isset($_GET['t_id'])){echo 't_id='.$_GET['t_id'];}elseif(isset($_GET['c_id'])){echo 'c_id='.$_GET['c_id'];}?>"><b>Support</b></a></li>
            </ul>
        </div>
    </div>