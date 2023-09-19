	<?php 
		require_once 'header.php';
	?>
	<head>
		<title>Basket - <?php echo $settingbring['setting_title']; ?></title>
	</head>
	<div class="container">
		<div class="clearfix"></div>
		<div class="lines"></div>
	</div>
	
	<div class="container">
		<div class="title-bg">
			<div class="title">Shopping Cart</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-bordered chart">
				<thead>
					<tr>
						<th>Remove</th>
						<th>Image</th>
						<th>Name</th>
						<th>Item No.</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$user_id=$userbring['user_id'];
						$basketcheck=$db->prepare("SELECT * FROM basket WHERE user_id=:id");
						$basketcheck->execute(['id' => $user_id]);
						while ($basketbring=$basketcheck->fetch(PDO::FETCH_ASSOC)) {
							$product_id=$basketbring['product_id'];
							$productcheck=$db->prepare("SELECT * FROM product WHERE product_id=:product_id");
							$productcheck->execute(['product_id' => $product_id]);
							$productbring=$productcheck->fetch(PDO::FETCH_ASSOC);
							$total_price+=$productbring['product_price']*$basketbring['product_unit']; 
					?>
					<tr>
						<td><form><input type="checkbox"></form></td>
						<td><img src="images\demo-img.jpg" width="100" alt=""></td>
						<td><?php echo $productbring['product_name'] ?></td>
						<td><?php echo $productbring['product_id'] ?></td>
						<td><form><input type="text" class="form-control quantity" value="<?php echo $basketbring['product_unit'] ?>"></form></td>
						<td>$ <?php echo $productbring['product_price'] ?></td>
						<td>$ <?php echo $productbring['product_price']*$basketbring['product_unit'] ?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-6">
				<form class="form-horizontal coupon" role="form">
					<div class="form-group">
						<label for="coupon" class="col-sm-3 control-label">Coupon Code</label>
						<div class="col-sm-7">
							<input type="email" class="form-control" id="coupon" placeholder="Email">
						</div>
						<div class="col-sm-2">
							<button class="btn btn-default btn-red btn-sm">Apply</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-3 col-md-offset-3">
			<div class="subtotal-wrap">
				<!--<div class="subtotal">
					<p>Sub Total : $00.00</p>
					<p>Vat 17% : $00.00</p>
				</div>-->
				<div class="total">Total : <span class="bigprice">$ <?php echo $total_price ?></span></div>
				<div class="clearfix"></div>
				<a href="pay" class="btn btn-default btn-yellow">Continue Shopping</a>
			</div>
			<div class="clearfix"></div>
			</div>
		</div>
		<div class="spacer"></div>
	</div>
	
	<?php 
		require_once 'footer.php';
	?>
