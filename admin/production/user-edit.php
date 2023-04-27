<?php 
require_once 'header.php'; 
$sql=$db->prepare("SELECT * FROM user WHERE user_id=:id");
$sql->execute(['id' => $_GET['user_id']]);
$usereditbring=$sql->fetch(PDO::FETCH_ASSOC);
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Edit</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?php
                            if (isset($_SESSION['status'])) {
                            if ($_SESSION['status']=="success") {
                        ?>
                            <div class="alert alert-success">
                                <p>Update successful</p>
                            </div>
                        <?php
                            unset($_SESSION['status']);
                            } else if ($_SESSION['status']=="error") {
                        ?>
                            <div class="alert alert-danger">
                                <p>Update error</p>
                            </div>
                        <?php
                            unset($_SESSION['status']);
                            }}
                        ?>
                        <form action="../system/work.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            <?php $datetime=explode(" ",$usereditbring['user_time']); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Date</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" name="user_time" value="<?php echo $datetime[0]; ?>" disabled class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Time</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="time" name="user_time" value="<?php echo $datetime[1]; ?>" disabled class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="user_name" value="<?php echo $usereditbring['user_name']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Mail</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="user_mail" value="<?php echo $usereditbring['user_mail']; ?>" disabled class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">GSM</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="user_gsm" value="<?php echo $usereditbring['user_gsm']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Adress</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="user_adress" value="<?php echo $usereditbring['user_adress']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Country</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="user_country" value="<?php echo $usereditbring['user_country']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">District</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="user_district" value="<?php echo $usereditbring['user_district']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="user_status" required>
                                        <?php echo $usereditbring['user_status'] == '1' ? 'selected=""' : ''; ?>
                                        <option value="1" <?php echo $usereditbring['user_status'] == '1' ? 'selected=""' : ''; ?>>Active</option>
                                        <option value="0" <?php if ($usereditbring['user_status'] == 0) { echo 'selected=""'; } ?>>Passive</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $usereditbring['user_id']; ?>">
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="useredit_save" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php require_once 'footer.php'; ?>