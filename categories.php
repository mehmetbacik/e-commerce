	<?php 
		require_once 'header.php';
		if(isset($_GET['sef'])) {
			$categorycontrol=$db->prepare("SELECT * FROM categories WHERE category_seourl=:seourl");
			$categorycontrol->execute(
				[
					'seourl' => $_GET['sef']
				]
			);
			$categorybring=$categorycontrol->fetch(PDO::FETCH_ASSOC);
			$category_id=$categorybring['category_id'];

			$productcontrol=$db->prepare("SELECT * FROM product WHERE category_id=:category_id order by product_order ASC");
			$productcontrol->execute(
				[
					'category_id' => $category_id
				]
			);
		} else {
			$productcontrol=$db->prepare("SELECT * FROM product order by product_order ASC");
			$productcontrol->execute();
		}
	?>
	
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
					?>
					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="product-<?=seo($productbring["product_name"]).'-'.$productbring["product_id"]?>"><img src="http://via.placeholder.com/250x250" alt="" class="img-responsive"></a>
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
