<?php 
require_once 'header.php';
$sql=$db->prepare("SELECT * FROM about WHERE about_id=:id");
$sql->execute(['id' => 1]);
$aboutbring=$sql->fetch(PDO::FETCH_ASSOC);
?>
	<head>
		<title><?php echo $settingbring['setting_title']; ?></title>
	</head>
	<div class="container">

		<div class="clearfix"></div>
		<div class="lines"></div>

		<?php require_once 'slider.php'; ?>


	</div>
	<div class="f-widget featpro">
		<div class="container">
			<div class="title-widget-bg">
				<div class="title-widget">Featured Products</div>
				<div class="carousel-nav">
					<a class="prev"></a>
					<a class="next"></a>
				</div>
			</div>
			<div id="product-carousel" class="owl-carousel owl-theme">

				<?php 
					$productcheck=$db->prepare("SELECT * FROM product WHERE product_status=:product_status and product_homeshowcase=:product_homeshowcase");
					$productcheck->execute([
						'product_status' => 1,
						'product_homeshowcase' => 1,
						]);
					while ($productbring=$productcheck->fetch(PDO::FETCH_ASSOC)) {
						$product_id=$productbring['product_id'];
						$productphoto_control=$db->prepare("SELECT * FROM product_photo where product_id=:product_id order by productphoto_order ASC limit 1");
						$productphoto_control->execute([
							'product_id' => $product_id
						]);
						$productphoto_bring=$productphoto_control->fetch(PDO::FETCH_ASSOC);
				?>

				<div class="item">
					<div class="productwrap">
						<div class="pr-img">
							<div class="hot"></div>
							<a href="product-<?=seo($productbring["product_name"]).'-'.$productbring["product_id"]?>"><img src="<?php echo $productphoto_bring['productphoto_path']; ?>" alt="" class="img-responsive"></a>
							<div class="pricetag blue"><div class="inner"><span><?php echo $productbring['product_price']; ?></span></div></div>
						</div>
							<span class="smalltitle"><a href="product-<?=seo($productbring["product_name"]).'-'.$productbring["product_id"]?>"><?php echo $productbring['product_name']; ?></a></span>
							<span class="smalldesc">Item no.: <?php echo $productbring['product_id']; ?></span>
					</div>
				</div>

				<?php } ?>

			</div>
		</div>
	</div>
	
	
	
	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title"><?php echo $aboutbring['about_title']; ?></div>
				</div>
				<p class="ct">
					<?php echo substr($aboutbring['about_content'],0,1000); ?>
				</p>
				<a href="about" class="btn btn-default btn-red btn-sm">Read More</a>
				
				<div class="title-bg">
					<div class="title">Lastest Products</div>
				</div>
				<div class="row prdct"><!--Products-->
					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<a href="product.htm"><img src="images\sample-2.jpg" alt="" class="img-responsive"></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice">$314</span>$199</span></div></div>
							</div>
							<span class="smalltitle"><a href="product.htm">Black Shoes</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Nikon Camera</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Red T- Shirt</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Nikon Camera</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-2.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Black Shoes</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="productwrap">
						<div class="pr-img">
							<a href="product.htm"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag"><div class="inner">$199</div></div>
						</div>
							<span class="smalltitle"><a href="product.htm">Red T-Shirt</a></span>
							<span class="smalldesc">Item no.: 1000</span>
						</div>
					</div>
				</div><!--Products-->
				<div class="spacer"></div>
			</div><!--Main content-->
			<?php require_once 'sidebar.php'; ?>
		</div>
	</div>

<?php 
require_once 'footer.php';
?>