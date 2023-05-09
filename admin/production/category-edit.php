<?php 
require_once 'header.php'; 
$sql=$db->prepare("SELECT * FROM categories WHERE category_id=:id");
$sql->execute(['id' => $_GET['category_id']]);
$categoryeditbring=$sql->fetch(PDO::FETCH_ASSOC);
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Category Edit</h2>
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
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="category_name" value="<?php echo $categoryeditbring['category_name']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="category_order" value="<?php echo $categoryeditbring['category_order']; ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="category_status" required>
                                        <?php echo $categoryeditbring['category_status'] == '1' ? 'selected=""' : ''; ?>
                                        <option value="1" <?php echo $categoryeditbring['category_status'] == '1' ? 'selected=""' : ''; ?>>Active</option>
                                        <option value="0" <?php if ($categoryeditbring['category_status'] == 0) { echo 'selected=""'; } ?>>Passive</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="category_id" value="<?php echo $categoryeditbring['category_id']; ?>">
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="categoryedit_save" class="btn btn-primary">Save</button>
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