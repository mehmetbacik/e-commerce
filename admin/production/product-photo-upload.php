<?php 
require_once 'header.php';
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="col-md-12">
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <form action="" method="POST" >
            <div class="input-group">
              <input type="text" class="form-control" name="search_input" placeholder="Search...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="search">Search!</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Photos upload</h2>
                      <div align="right" class="col-md-9">
                        <a class="btn btn-success" href="product-galery.php?product_id=<?php echo $_GET['product_id'];?>"><i class="fa fa-plus" aria-hidden="true"></i> View Uploaded Images</a>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <p>You can go to the folder with the images to be uploaded and select all of them at once and upload them.</p>
                      <form action="../system/productgalery.php" class="dropzone" >
                        <input type="hidden" name="product_id" value="<?php echo $_GET['product_id'];  ?>">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /page content -->
<?php require_once 'footer.php'; ?>
