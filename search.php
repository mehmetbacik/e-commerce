    <?php 
		require_once 'header.php';
		if(isset($_POST['search'])) {
            $research=$_POST['research'];
			$productcontrol=$db->prepare("SELECT * FROM product WHERE product_name LIKE ?");
			$productcontrol->execute(
				array("%$research%")
			);
            $say=$productcontrol->rowCount();
		} else {
			header("Location:index.php?status=empty");
		}
	?>
	<head>
		<title>Search - <?php echo $settingbring['setting_title']; ?></title>
	</head>
	<div class="container">
		<div class="clearfix"></div>
		<div class="lines"></div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title">Products</div>
				</div>
				<div class="row prdct"><!--Products-->
					<?php 
						$check=$productcontrol->rowCount();
						if ($check==0) {
							echo "<div class='col-md-12'>No products found in this category.</div>";
						}	
											
						while($productbring=$productcontrol->fetch(PDO::FETCH_ASSOC)) { 
							$product_id=$productbring['product_id'];
							$productphoto_control=$db->prepare("SELECT * FROM product_photo where product_id=:product_id order by productphoto_order ASC limit 1");
							$productphoto_control->execute([
								'product_id' => $product_id
							]);
							$productphoto_bring=$productphoto_control->fetch(PDO::FETCH_ASSOC);
					?>
					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="product-<?=seo($productbring["product_name"]).'-'.$productbring["product_id"]?>"><img src="<?php echo $productphoto_bring['productphoto_path']; ?>" alt="" class="img-responsive"></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice">$<?php echo $productbring['product_price']*2 ?></span>$<?php echo $productbring['product_price'] ?></span></div></div>
							</div>
							<span class="smalltitle"><a href="#"><?php echo $productbring['product_name'] ?></a></span>
							<span class="smalldesc">Item no.: <?php echo $productbring['product_id'] ?></span>
						</div>
					</div>
					<?php } ?>
				</div><!--Products-->

				<ul class="pagination shop-pag"><!--pagination-->
					<li><a href="#"><i class="fa fa-caret-left"></i></a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
				</ul><!--pagination-->

			</div>
			<?php require_once 'sidebar.php'; ?>
		</div>
		<div class="spacer"></div>
	</div>
	
	<?php 
		require_once 'footer.php';
	?>
