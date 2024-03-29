<?php 
require_once 'header.php'; 
$productcontrol=$db->prepare("SELECT * FROM product order by product_id DESC");
$productcontrol->execute();
?>
<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Products <small>
              <?php 
              if (isset($_GET['remove'])) {
              if ($_GET['remove']=="success") {?>
                  <div class="alert alert-success">
                    <p>Update successful. User Deleted.</p>
                  </div>
              <?php } elseif ($_GET['remove']=="error") {?>
                <div class="alert alert-danger">
                    <p>Update error</p>
                </div>
              <?php }}
              ?>
            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
            <div class="text-right">
                <a href="product-add.php"><button class="btn btn-success btn-xs">New Add</button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>P.No</th>
                  <th>Product Name</th>
                  <th>Product Price</th>
                  <th>Product Stock</th>
                  <th>Product Order</th>
                  <th>Product Images</th>
                  <th>Product Showcase</th>
                  <th>Product Status</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $pno=0;
                while($productbring=$productcontrol->fetch(PDO::FETCH_ASSOC)) { $pno++?>
                <tr>
                  <td><?php echo $pno ?></td>
                  <td><?php echo $productbring['product_name'] ?></td>
                  <td><?php echo $productbring['product_price'] ?></td>
                  <td><?php echo $productbring['product_stock'] ?></td>
                  <td><?php echo $productbring['product_order'] ?></td>
                  <td><center><a href="product-galery.php?product_id=<?php echo $productbring['product_id'] ?>"><button class="btn btn-xs btn-info">Image</button></a></center></td>
                  <td>
                    <center>
                      <?php 
                        if ($productbring['product_homeshowcase']==0) {
                      ?>
                        <a href="../system/work.php?product_id=<?php echo $productbring['product_id'] ?>&product_hs=1&product_homeshowcase=active">
                          <button class="btn btn-xs btn-warning">Passive</button>
                        </a>
                      <?php  
                        } elseif ($productbring['product_homeshowcase']==1) {
                      ?>
                        <a href="../system/work.php?product_id=<?php echo $productbring['product_id'] ?>&product_hs=0&product_homeshowcase=passive">
                          <button class="btn btn-xs btn-primary">Active</button>
                        </a>
                      <?php
                        }
                      ?>
                    </center>
                  </td>
                  <td>
                    <center>
                    <?php 
                        if ($productbring['product_status']==1) { ?>
                            <button class="btn btn-success btn-xs">Active</button>
                        <?php } else { ?>
                            <button class="btn btn-danger btn-xs">Passive</button>
                        <?php }
                    ?>
                    </center>
                  </td>
                  <td><center><a href="product-edit.php?product_id=<?php echo $productbring['product_id'] ?>"><button class="btn btn-primary btn-xs">Edit</button></a></center></td>
                  <td><center><a href="../system/work.php?product_id=<?php echo $productbring['product_id'] ?>&productremove=approval"><button class="btn btn-danger btn-xs">Remove</button></a></center></td>
                </tr>
                <?php  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php require_once 'footer.php'; ?>