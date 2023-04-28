<?php 
require_once 'header.php';
$sql=$db->prepare("SELECT * FROM slider WHERE slider_id=:id");
$sql->execute(['id' => $_GET['slider_id']]);
$slidereditbring=$sql->fetch(PDO::FETCH_ASSOC); 
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Slider Edit</h2>
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
                        <form action="../system/work.php" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img width="200px" src="../../<?php echo $slidereditbring['slider_imgurl']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Image Choose</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="slider_imgurl"  name="slider_imgurl"  class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slider_name">Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="slider_name" value="<?php echo $slidereditbring['slider_name']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slider_url">URL</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="slider_link" value="<?php echo $slidereditbring['slider_link']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slider_order">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="slider_order" value="<?php echo $slidereditbring['slider_order']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slider_status">Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="slider_status" required>
                                        <?php echo $slidereditbring['slider_status'] == '1' ? 'selected=""' : ''; ?>
                                        <option value="1" <?php echo $slidereditbring['slider_status'] == '1' ? 'selected=""' : ''; ?>>Active</option>
                                        <option value="0" <?php if ($slidereditbring['slider_status'] == 0) { echo 'selected=""'; } ?>>Passive</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="slider_id" value="<?php echo $slidereditbring['slider_id']; ?>">
                            <input type="hidden" name="slider_imgurl" value="<?php echo $slidereditbring['slider_imgurl']; ?>">
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="slideredit" class="btn btn-primary">Update</button>
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