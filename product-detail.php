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
						<div class="dt-img">
							<div class="detpricetag"><div class="inner">$<?php echo $productbring['product_price']; ?></div></div>
							<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
						</div>
						<div class="thumb-img">
							<a class="fancybox" href="images\sample-4.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
						</div>
						<div class="thumb-img">
							<a class="fancybox" href="images\sample-5.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-5.jpg" alt="" class="img-responsive"></a>
						</div>
						<div class="thumb-img">
							<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
						</div>
					</div>
					<div class="col-md-6 det-desc">
						<div class="productdata">
							<div class="infospan">Code <span><?php echo $productbring['product_id']; ?></span></div>
							<div class="infospan">Price <span>$<?php echo $productbring['product_price']; ?></span></div>
							
							<form class="form-horizontal ava" role="form">
								<div class="form-group">
									<label for="qty" class="col-sm-2 control-label">Qty</label>
									<div class="col-sm-4">
										<select class="form-control" id="qty">
											<option>1
											<option>2
											<option>3
											<option>4
											<option>5
										</select>
									</div>
									<div class="col-sm-4">
										<button class="btn btn-default btn-red btn-sm"><span class="addchart">Add To Chart</span></button>
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

				<div class="tab-review">
					<ul id="myTab" class="nav nav-tabs shop-tab">
						<li class="active"><a href="#desc" data-toggle="tab">Description</a></li>
						<li class=""><a href="#rev" data-toggle="tab">Reviews (0)</a></li>
						<li class=""><a href="#video" data-toggle="tab">Video</a></li>
					</ul>
					<div id="myTabContent" class="tab-content shop-tab-ct">
						<div class="tab-pane fade active in" id="desc">
							<?php echo $productbring['product_detail']; ?>
						</div>
						<div class="tab-pane fade" id="rev">
							<p class="dash">
							<span>Jhon Doe</span> (11/25/2012)<br><br>
							Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
							</p>
							<?php
								if(isset($_SESSION['usercustomer_mail'])) { 
							?>
								<h4>Write Review</h4>
								<form role="form">
									<div class="form-group">
										<textarea class="form-control" id="text"></textarea>
									</div>
									<button type="submit" class="btn btn-default btn-red btn-sm">Submit</button>
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
