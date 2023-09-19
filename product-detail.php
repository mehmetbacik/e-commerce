	<?php 
		require_once 'header.php';
		$sql=$db->prepare("SELECT * FROM product WHERE product_id=:product_id");
		$sql->execute(['product_id' => $_GET['product_id']]);
		$productbring=$sql->fetch(PDO::FETCH_ASSOC);
		$productcontrol=$sql->rowCount();
		if ($productcontrol==0) {
			header("Location:index.php?status=empty");
			exit;	
		}
	?>
	<head>
		<title><?php echo $productbring['product_name'] ?> - <?php echo $settingbring['setting_title']; ?></title>
	</head>
	<?php 
		if ($_GET['status']=="success") {
	?>
			<script type="text/javascript">
				alert("Comment Added Successfully");
			</script>
	<?php 
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
					<div class="title"><?php echo $productbring['product_name']; ?></div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?php
							$product_id=$productbring['product_id'];
							$productphoto_control=$db->prepare("SELECT * FROM product_photo where product_id=:product_id order by productphoto_order ASC limit 1");
							$productphoto_control->execute([
								'product_id' => $product_id
							]);
							$productphoto_bring=$productphoto_control->fetch(PDO::FETCH_ASSOC);
						?>
						<div class="dt-img">
							<div class="detpricetag"><div class="inner">$<?php echo $productbring['product_price']; ?></div></div>
							<a class="fancybox" href="<?php echo $productphoto_bring['productphoto_path']; ?>" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="<?php echo $productphoto_bring['productphoto_path']; ?>" alt="" class="img-responsive"></a>
						</div>

						<?php
							$product_id=$productbring['product_id'];
							$productphoto_control=$db->prepare("SELECT * FROM product_photo where product_id=:product_id order by productphoto_order ASC limit 1,6");
							$productphoto_control->execute([
								'product_id' => $product_id
							]);
							while($productphoto_bring=$productphoto_control->fetch(PDO::FETCH_ASSOC)) {
						?>
						<div class="thumb-img">
							<a class="fancybox" href="<?php echo $productphoto_bring['productphoto_path']; ?>" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="<?php echo $productphoto_bring['productphoto_path']; ?>" alt="" class="img-responsive"></a>
						</div>
						<?php } ?>

					</div>
					<div class="col-md-6 det-desc">
						<div class="productdata">
							<div class="infospan">Code <span><?php echo $productbring['product_id']; ?></span></div>
							<div class="infospan">Price <span>$<?php echo $productbring['product_price']; ?></span></div>
							
							
							<form action="admin/system/work.php" method="POST" class="form-horizontal ava" role="form">
								<div class="form-group">
									<label for="qty" class="col-sm-2 control-label">Qty</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" value="1" name="product_unit">
									</div>
									<input type="hidden" name="user_id" value="<?php echo $userbring['user_id'] ?>">
									<input type="hidden" name="product_id" value="<?php echo $productbring['product_id'] ?>">
									<div class="col-sm-4">
										<?php if(isset($_SESSION['usercustomer_mail'])) { ?>
											<button type="submit" name="addtocart" class="btn btn-default btn-red btn-sm"><span class="addchart">Add To Cart</span></button>
										<?php } else { ?>
											<button type="submit" disabled class="btn btn-default btn-red btn-sm"><span class="addchart">Login</span></button>
										<?php } ?>
									</div>
									<div class="clearfix"></div>
								</div>
							</form>
							
							<div class="sharing">
								<div class="share-bt">
									<div class="addthis_toolbox addthis_default_style ">
										<a class="addthis_counter addthis_pill_style"></a>
									</div>
									<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f0d0827271d1c3b"></script>
									<div class="clearfix"></div>
								</div>
								<div class="avatock"><span>
									<?php 
										if ($productbring['product_stock']>=1) {
											echo "In Stock : ".$productbring['product_stock'];
										} else {
											echo "Out Stock : ".$productbring['product_stock'];
										}
									?>
								</span></div>
							</div>
							
						</div>
					</div>
				</div>

				<?php
					$user_id=$userbring['user_id'];
					$product_id=$productbring['product_id'];
					$commentsql=$db->prepare("SELECT * FROM comments WHERE product_id=:product_id and comment_status=:comment_status");
					$commentsql->execute([
						'product_id' => $product_id,
						'comment_status' => 1
					]);
				?>
				
				<div class="tab-review">
					<ul id="myTab" class="nav nav-tabs shop-tab">
						<li <?php if ($_GET['status']!="success") {?> class="active" <?php } ?>><a href="#desc" data-toggle="tab">Description</a></li>
						<li <?php if ($_GET['status']=="success") {?> class="active" <?php } ?>><a href="#rev" data-toggle="tab">Reviews (<?php echo $commentsql->rowCount(); ?>)</a></li>
						<li class=""><a href="#video" data-toggle="tab">Video</a></li>
					</ul>
					<div id="myTabContent" class="tab-content shop-tab-ct">
						<div class="tab-pane fade <?php if ($_GET['status']!="success") {?> active in <?php } ?>" id="desc">
							<?php echo $productbring['product_detail']; ?>
						</div>
						<div class="tab-pane fade <?php if ($_GET['status']=="success") {?> active in <?php } ?>" id="rev">
							<?php
								while ($commentbring=$commentsql->fetch(PDO::FETCH_ASSOC)) {

								$commentuser_id=$commentbring['user_id'];
								$commentuser_check=$db->prepare("SELECT * FROM user where user_id=:id");
								$commentuser_check->execute(array(
									'id' => $commentuser_id
								));
								$commentuserbring=$commentuser_check->fetch(PDO::FETCH_ASSOC);
							?>
								<p class="dash">
								<span><?php echo $commentuserbring['user_name'] ?></span> (<?php echo $commentbring['comment_time'] ?>)<br><br>
								<?php echo $commentbring['comment_detail'] ?>
								</p>
							<?php 								
								};
							?>
							<?php
								if(isset($_SESSION['usercustomer_mail'])) { 
							?>
								<h4>Write Review</h4>
								<form action="admin/system/work.php" method="POST" role="form">
									<div class="form-group">
										<textarea name="comment_detail" class="form-control" id="text"></textarea>
									</div>
									<input type="hidden" name="user_id" value="<?php echo $userbring['user_id'] ?>">
									<input type="hidden" name="page_url" value="<?php echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."";?>">
									<input type="hidden" name="product_id" value="<?php echo $productbring['product_id'] ?>">
									<button type="submit" name="comment_save" class="btn btn-default btn-red btn-sm">Submit</button>
								</form>
							<?php
								} else {
							?>
								<h4>Write Review</h4>
								<div class="form-group">
									<span><a href="index">Login</a> to comment write</span>
								</div>
							<?php
								}
							?>
						</div>
						<div class="tab-pane fade" id="video">
							<?php
								$productvideo=strlen($productbring['product_video']);
								if($productvideo>0) { 
							?>
								<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $productbring['product_video']; ?>" 
									title="YouTube video player" frameborder="0" 
									allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
									allowfullscreen>
								</iframe>
							<?php } else { ?>
								<span>No video has been added</span>
							<?php } ?>
						</div>
					</div>
				</div>
				
				<div id="title-bg">
					<div class="title">Related Product</div>
				</div>
				<div class="row prdct"><!--Products-->
					<?php 
						$category_id=$productbring['category_id'];
						$productrelated_control=$db->prepare("SELECT * FROM product WHERE category_id=:category_id order by rand() ASC limit 3");
						$productrelated_control->execute(
							[
								'category_id' => $category_id
							]
						);			
						while($productrelated_bring=$productrelated_control->fetch(PDO::FETCH_ASSOC)) { 			
					?>
					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="product-<?=seo($productrelated_bring["product_name"]).'-'.$productrelated_bring["product_id"]?>"><img src="http://via.placeholder.com/250x250" alt="" class="img-responsive"></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice">$<?php echo $productrelated_bring['product_price']*2 ?></span>$<?php echo $productrelated_bring['product_price'] ?></span></div></div>
							</div>
							<span class="smalltitle"><a href="#"><?php echo $productrelated_bring['product_name'] ?></a></span>
							<span class="smalldesc">Item no.: <?php echo $productrelated_bring['product_id'] ?></span>
						</div>
					</div>
					<?php } ?>
				</div><!--Products-->
				<div class="spacer"></div>
			</div><!--Main content-->
			<?php require_once 'sidebar.php'; ?>
		</div>
	</div>
	
	<?php 
		require_once 'footer.php';
	?>
