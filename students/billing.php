﻿<?php require_once('inc_stude/stude_header.php');?>

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

        <!-- sidebar effects INSIDE of st-pusher: -->
        <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

        <!-- this is the wrapper for the content -->
        <div class="st-content">

            <!-- extra div for emulating position:fixed of the menu -->
            <div class="st-content-inner padding-none">

                <div class="container-fluid">
                    
	<div class="page-section third">
        <!-- Tabbable Widget -->
<div class="tabbable paper-shadow relative" data-z="0.5">

    <!-- Tabs -->
    <ul class="nav nav-tabs">
        <li><a href="profile.php"><i class="fa fa-fw fa-lock"></i> <span class="hidden-sm hidden-xs">Manage Account</span></a></li>
        <li class="active"><a href="app-student-billing.html"><i class="fa fa-fw fa-credit-card"></i> <span class="hidden-sm hidden-xs">Billing Details</span></a></li>
    </ul>
    <!-- // END Tabs -->

    <!-- Panes -->
    <div class="tab-content">

        

        
        <div id="billing" class="tab-pane active">
            <form action="#" class="form-horizontal">
    <div class="form-group">
        <label for="name" class="col-md-2 control-label">Name on Invoice</label>
        <div class="col-md-6">
            <div class="form-control-material">
                <input type="text" class="form-control used" id="name" value="Adrian Demian">
                <label for="name">Name on Invoice</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="address" class="col-md-2 control-label">Address</label>
        <div class="col-md-6">
            <div class="form-control-material">
                <textarea class="form-control used" id="address">Sunny Street 21, MI</textarea>
                <label for="address">Address</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="country" class="col-md-2 control-label">Country</label>
        <div class="col-md-6">
            <select id="country" data-toggle="select2" class="width-100">
                <option value="1" selected="">USA</option>
                <option value="2">Country</option>
            </select>
        </div>
    </div>
    <div class="form-group margin-bottom-none">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-success paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated="">Update Billing</button>
        </div>
    </div>
</form>
<hr>

<div class="media v-middle s-container">
    <div class="media-body">
        <h5 class="text-subhead">Payment details</h5>
    </div>
    <div class="media-right">
        <a href="#modal-update-credit-card" data-toggle="modal" class="btn btn-white paper-shadow relative" data-animated="" data-z="0.5" data-hover-z="1" href="">Add Credit Card</a>
    </div>
</div>
<div class="list-group margin-none">
    <div class="list-group-item media v-middle">
        <div class="media-left">
            <div class="icon-block half img-circle bg-primary">
                <i class="fa fa-credit-card"></i>
            </div>
        </div>
        <div class="media-body">
            <h4 class="text-title media-heading">
                <a href="#modal-update-credit-card" data-toggle="modal" class="link-text-color">**** **** **** 2422</a>
            </h4>
            <div class="text-caption">updated 1 month ago</div>
        </div>
        <div class="media-right">
            <a href="#modal-update-credit-card" data-toggle="modal" class="btn btn-white btn-flat"><i class="fa fa-pencil fa-fw"></i> Edit</a>
        </div>
    </div>
    <div class="list-group-item media v-middle">
        <div class="media-left">
            <div class="icon-block half img-circle bg-grey-100 text-light">
                <i class="fa fa-credit-card"></i>
            </div>
        </div>
        <div class="media-body">
            <h4 class="text-title media-heading">
                <a href="#modal-update-credit-card" data-toggle="modal" class="link-text-color">**** **** **** 3365</a>
            </h4>
            <div class="text-caption">updated 1 year ago</div>
        </div>
        <div class="media-right">
            <a href="#modal-update-credit-card" data-toggle="modal" class="btn btn-white btn-flat"><i class="fa fa-pencil fa-fw"></i> Edit</a>
        </div>
    </div>
</div>
        </div>
        

    </div>
    <!-- // END Panes -->

</div>
<!-- // END Tabbable Widget -->


<div class="modal grow modal-backdrop-white fade" id="modal-update-credit-card">
    <div class="modal-dialog modal-sm">
        <div class="v-cell">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Update Credit Card</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group form-control-material">
                            <input type="text" class="form-control" id="credit-card" placeholder="**** **** **** 2422">
                            <label for="credit-card">Credit Card</label>
                        </div>
                        <div class="form-group">
                            <label for="exp">Expiration Date:</label><br>
                            <select id="exp" data-toggle="select2">
                                <option value="1" selected="">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select data-toggle="select2">
                                <option value="2015" selected="">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                            </select>
                        </div>
                        <div class="form-group form-control-material">
                            <input type="text" class="form-control" id="cvv" placeholder="123">
                            <label for="cvv">CVV</label>
                        </div>
                        <button type="submit" class="btn btn-success paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated="" data-dismiss="modal">Update Credit Card</button>
                    </form>
                </div>
            </div>
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