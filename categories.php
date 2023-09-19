	<?php 
		require_once 'header.php';
		$onpage = 3; // Amount of content to be displayed on the page
		$sqlsquery=$db->prepare("SELECT * FROM categories");
		$sqlsquery->execute();
		$total_content=$sqlsquery->rowCount();
		$total_page = ceil($total_content / $onpage);
		 // If the page is not entered, assume 1.
		$pages = isset($_GET['pages']) ? (int) $_GET['pages'] : 1;
		 // If a page number less than 1 is entered, make it 1.
		if($pages < 1) $pages = 1; 
		   // If more than our total number of pages are written, assume the last page.
		if($pages > $total_page) $pages = $total_page; 
		$limit = ($pages - 1) * $onpage;

		if(isset($_GET['sef'])) {
			$categorycontrol=$db->prepare("SELECT * FROM categories WHERE category_seourl=:seourl");
			$categorycontrol->execute(
				[
					'seourl' => $_GET['sef']
				]
			);
			$categorybring=$categorycontrol->fetch(PDO::FETCH_ASSOC);
			$category_id=$categorybring['category_id'];

			$productcontrol=$db->prepare("SELECT * FROM product WHERE category_id=:category_id order by product_order ASC limit $limit,$onpage");
			$productcontrol->execute(
				[
					'category_id' => $category_id
				]
			);
		} else {
			$productcontrol=$db->prepare("SELECT * FROM product order by product_order ASC limit $limit,$onpage");
			$productcontrol->execute();
		}		

		$check=$productcontrol->rowCount();
		if ($check==0) {
			echo "<div class='col-md-12'>No products found in this category.</div>";
		}	
	?>
	<head>
		<title>Categories <?php echo $categorybring['category_name'] ?> - <?php echo $settingbring['setting_title']; ?></title>
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

					<!--pagination-->
						<div align="right" class="col-md-12">
                     		<ul class="pagination">
                     			<?php
                     			$s=0;
                     			while ($s < $total_page) {
                     				$s++; ?>
                     				<?php 
                     				if ($s==$pages) { ?>
                     				<li class="active">
                     					<a href="categories?pages=<?php echo $s; ?>"><?php echo $s; ?></a>
                     				</li>
                     				<?php } else { ?>
                     				<li>
                     					<a href="categories?pages=<?php echo $s; ?>"><?php echo $s; ?></a>
                     				</li>
                     				<?php   }
                     			}
                     			?>
                     		</ul>
                     	</div>
					<!--pagination-->

				</div><!--Products-->
			</div>
			<?php require_once 'sidebar.php'; ?>
		</div>
		<div class="spacer"></div>
	</div>
	
	<?php 
		require_once 'footer.php';
	?>
