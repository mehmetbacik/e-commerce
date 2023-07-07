<?php 
require_once 'header.php'; 
$commentcontrol=$db->prepare("SELECT * FROM comments order by comment_status DESC");
$commentcontrol->execute();
?>
<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Comments<small>
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
                <a href="comment-add.php"><button class="btn btn-success btn-xs">New Add</button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>C.No</th>
                  <th>Comment Detail</th>
                  <th>User</th>
                  <th>Product</th>
                  <th>Comment Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $cno=0;
                while($commentbring=$commentcontrol->fetch(PDO::FETCH_ASSOC)) { $cno++?>
                <tr>
                  <td><?php echo $cno ?></td>
                  <td><?php echo $commentbring['comment_detail'] ?></td>
                  <td><?php
                    $user_id=$commentbring['user_id'];
                    $usercheck=$db->prepare("SELECT * FROM user WHERE user_id=:id");
                    $usercheck->execute(['id' => $user_id]);
                    $userbring=$usercheck->fetch(PDO::FETCH_ASSOC);
                    echo $userbring['user_name'];
                  ?></td>
                  <td><?php
                    $product_id=$commentbring['product_id'];
                    $productcheck=$db->prepare("SELECT * FROM product WHERE product_id=:id");
                    $productcheck->execute(['id' => $product_id]);
                    $productbring=$productcheck->fetch(PDO::FETCH_ASSOC);
                    echo $productbring['product_name'];
                  ?></td>
                  <td>
                    <center>
                      <?php 
                        if ($commentbring['comment_status']==0) {
                      ?>
                        <a href="../system/work.php?comment_id=<?php echo $commentbring['comment_id'] ?>&comment_st=1&comment_status=active">
                          <button class="btn btn-xs btn-warning">Passive</button>
                        </a>
                      <?php  
                        } elseif ($commentbring['comment_status']==1) {
                      ?>
                        <a href="../system/work.php?comment_id=<?php echo $commentbring['comment_id'] ?>&comment_st=0&comment_status=passive">
                          <button class="btn btn-xs btn-primary">Active</button>
                        </a>
                      <?php
                        }
                      ?>
                    </center>
                  </td>
                  <td><center><a href="../system/work.php?comment_id=<?php echo $commentbring['comment_id'] ?>&commentremove=approval"><button class="btn btn-danger btn-xs">Remove</button></a></center></td>
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