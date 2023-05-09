<?php 
require_once 'header.php'; 
$menucontrol=$db->prepare("SELECT * FROM menu order by menu_order ASC");
$menucontrol->execute();
?>
<!-- page content -->
<div class="right_col" role="main">
  <div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Menu <small>
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
                <a href="menu-add.php"><button class="btn btn-success btn-xs">New Add</button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>M.No</th>
                  <th>Menu Name</th>
                  <th>Menu Url</th>
                  <th>Menu Order</th>
                  <th>Menu Status</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $mno=0;
                while($menubring=$menucontrol->fetch(PDO::FETCH_ASSOC)) { $mno++?>
                <tr>
                  <td><?php echo $mno ?></td>
                  <td><?php echo $menubring['menu_name'] ?></td>
                  <td><?php echo $menubring['menu_url'] ?></td>
                  <td><?php echo $menubring['menu_order'] ?></td>
                  <td>
                    <center>
                    <?php 
                        if ($menubring['menu_status']==1) { ?>
                            <button class="btn btn-success btn-xs">Active</button>
                        <?php } else { ?>
                            <button class="btn btn-danger btn-xs">Passive</button>
                        <?php }
                    ?>
                    </center>
                  </td>
                  <td><center><a href="menu-edit.php?menu_id=<?php echo $menubring['menu_id'] ?>"><button class="btn btn-primary btn-xs">Edit</button></a></center></td>
                  <td><center><a href="../system/work.php?menu_id=<?php echo $menubring['menu_id'] ?>&menuremove=approval"><button class="btn btn-danger btn-xs">Remove</button></a></center></td>
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