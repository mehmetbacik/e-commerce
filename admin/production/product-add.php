<?php 
error_reporting(0);
require_once 'header.php'; 
$sql=$db->prepare("SELECT * FROM product WHERE product_id=:id");
$sql->execute(['id' => $_GET['product_id']]);
$producteditbring=$sql->fetch(PDO::FETCH_ASSOC);
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Product Add</h2>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category</label>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <?php  
                                        $product_id=$producteditbring['category_id']; 
                                        $categorycontrol=$db->prepare("SELECT * FROM categories WHERE category_top=:category_top order by category_order");
                                        $categorycontrol->execute(
                                            [
                                                'category_top' => 0
                                            ]                                           
                                        );
                                    ?>
                                    <select class="select2_multiple form-control" required="" name="category_id" >
                                        <?php 
                                            while($categorybring=$categorycontrol->fetch(PDO::FETCH_ASSOC)) {
                                            $category_id=$categorybring['category_id'];
                                        ?>
                                        <option value="<?php echo $categorybring['category_id']; ?>"><?php echo $categorybring['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="product_name" placeholder="Product Name" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="product_price" placeholder="Product Price" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stock">Stock</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="product_stock" placeholder="Product Stock" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail">Detail</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea required id="editor" name="product_detail" class="form-control col-md-7 col-xs-12"></textarea>
                                </div>
                            </div>
                            <script>
                                    ClassicEditor
                                            .create( document.querySelector( '#editor' ) )
                                            .then( editor => {
                                                    console.log( editor );
                                            } )
                                            .catch( error => {
                                                    console.error( error );
                                            } );
                            </script>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="video">Video</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="product_video" placeholder="Product Video" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword">Keyword</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="product_keyword" placeholder="Product Keyword" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="product_order" placeholder="Product Order" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="showcase">Showcase</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="product_homeshowcase" required>
                                        <?php echo $producteditbring['product_homeshowcase'] == '1' ? 'selected=""' : ''; ?>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="product_status" required>
                                        <?php echo $producteditbring['product_status'] == '1' ? 'selected=""' : ''; ?>
                                        <option value="1">Active</option>
                                        <option value="0">Passive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="productadd" class="btn btn-primary">Add</button>
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