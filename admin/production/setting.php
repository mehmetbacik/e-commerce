<?php 
require_once 'header.php'; 
$sql=$db->prepare("SELECT * FROM setting WHERE setting_id=:id");
$sql->execute(['id' => 1]);
$settingbring=$sql->fetch(PDO::FETCH_ASSOC);
/*echo "<pre>";
print_r($settingbring);
echo "</pre>";*/
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Settings</h2>
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
                        <form action="../system/work.php" method="POST" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Logo<br></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php 
                                if (strlen($settingbring['setting_logo'])>0) {?>
                                <img width="200"  src="../../<?php echo $settingbring['setting_logo']; ?>">
                                <?php } else {?>
                                <img width="200"  src="../../images/logo-none.png">
                                <?php } ?>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" id="setting_logo"  name="setting_logo"  class="form-control col-md-7 col-xs-12">
                            </div>
                            </div>
                            <input type="hidden" name="old_url" value="<?php echo $settingbring['setting_logo']; ?>">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <div class="text-right">
                                    <button type="submit" name="logoedit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <form action="../system/work.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_title" value="<?php echo $settingbring['setting_title']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea required name="setting_description" class="form-control col-md-7 col-xs-12"><?php echo $settingbring['setting_description']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keywords">Keywords</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea required name="setting_keywords" class="form-control col-md-7 col-xs-12"><?php echo $settingbring['setting_keywords']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author">Author</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_author" value="<?php echo $settingbring['setting_author']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone_number">Phone Number</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_tel" value="<?php echo $settingbring['setting_tel']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gsm">GSM</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_gsm" value="<?php echo $settingbring['setting_gsm']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax">Fax</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_fax" value="<?php echo $settingbring['setting_fax']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="mail" name="setting_mail" value="<?php echo $settingbring['setting_mail']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="district">District</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_district" value="<?php echo $settingbring['setting_district']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_country" value="<?php echo $settingbring['setting_country']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adress">Adress</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea required name="setting_adress" class="form-control col-md-7 col-xs-12"><?php echo $settingbring['setting_adress']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="time">Time</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_time" value="<?php echo $settingbring['setting_time']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="maps">Maps</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="setting_maps" class="form-control col-md-7 col-xs-12"><?php echo $settingbring['setting_maps']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="analystic">Analystic</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="setting_analystic" class="form-control col-md-7 col-xs-12"><?php echo $settingbring['setting_analystic']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desk">HelpDesk</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="setting_desk" class="form-control col-md-7 col-xs-12"><?php echo $settingbring['setting_desk']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_facebook" value="<?php echo $settingbring['setting_facebook']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twitter">Twitter</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_twitter" value="<?php echo $settingbring['setting_twitter']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="google">Google</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_google" value="<?php echo $settingbring['setting_google']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="youtube">Youtube</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_youtube" value="<?php echo $settingbring['setting_youtube']; ?>" required class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="smtphost">SMTP Host</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_smtphost" value="<?php echo $settingbring['setting_smtphost']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="smtppassword">SMTP Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" name="setting_smtppassword" value="<?php echo $settingbring['setting_smtppassword']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="smtpport">SMTP Port</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="setting_smtpport" value="<?php echo $settingbring['setting_smtpport']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="setting_save" class="btn btn-primary">Save</button>
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