<?php 
require_once 'header.php';
error_reporting(E_ALL & ~E_NOTICE);
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
              <div align="left" class="col-md-6">
              <h2>Product Photos Page<small>
                <?php
                if ($_GET['status']=='success') {?> 
                <b style="color:green;">Success...</b>
                <?php } elseif ($_GET['status']=='error')  {?>
                <b style="color:red;">Error...</b>
                <?php } ?></small></h2><br>
              </div>
              <form  action="../system/work.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
                <div align="right" class="col-md-6">
                  <button type="submit" name="productphoto-remove"  class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
                  <a class="btn btn-success" href="product-photo-upload.php?product_id=<?php echo $_GET['product_id'];?>"><i class="fa fa-plus" aria-hidden="true"></i> Upload</a>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <?php
                $pages = 25;
                $sql=$db->prepare("SELECT * FROM product_photo");
                $sql->execute();
                $total_productphoto=$sql->rowCount();
                $total_page = ceil($total_productphoto / $pages);
                $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                if($page < 1) $page = 1; 
                if($page > $total_page) $page = $total_page; 
                $limit = ($page - 1) * $pages;
                $productphoto_check=$db->prepare("SELECT * FROM product_photo WHERE product_id=:product_id order by productphoto_id DESC limit $limit,$pages");
                $productphoto_check->execute(array(
                  'product_id' => $_GET['product_id']
                  ));
                  while($productphoto_bring=$productphoto_check->fetch(PDO::FETCH_ASSOC)) { ?>
                  <div class="col-md-55">
                    <label>
                    <div class="image view view-first">
                      <img style="width: 250px; height: 100px; display: block;" src="../../<?php echo $productphoto_bring['productphoto_path']; ?>" alt="image" />
                      <div class="mask">
                        <p><?php echo $productphoto_bring['productphoto_name']; ?> <?php echo $productphoto_bring['productphoto_id']; ?></p>
                        <div class="tools tools-bottom">
                          <!--<a href="#"><i class="fa fa-times"></i></a>-->
                        </div>
                      </div>
                    </div>
                    <?php  array("$productphoto_choose"); ?>
                    <input type="checkbox" name="productphoto_choose[]"  value="<?php echo $productphoto_bring['productphoto_id']; ?>" > Choose
                  </label>
                </div>
                <?php } ?>
                <div align="right" class="col-md-12">
                  <ul class="pagination">
                    <?php
                    $s=0;
                    while ($s < $total_page) {
                      $s++; ?>
                      <?php 
                      if ($s==$page) {?>
                      <li class="active">
                        <a href="product-photo.php?page=<?php echo $s; ?>"><?php echo $s; ?></a>
                      </li>
                      <?php } else {?>
                      <li>
                        <a href="product-photo.php?page=<?php echo $s; ?>"><?php echo $s; ?></a>
                      </li>
                      <?php   }
                    }
                    ?>
                  </ul>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<?php require_once 'footer.php'; ?>
