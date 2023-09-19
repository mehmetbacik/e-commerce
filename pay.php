	<?php 
		require_once 'header.php';
	?>
	<head>
		<title>Pay - <?php echo $settingbring['setting_title']; ?></title>
	</head>
	<div class="container">
		<div class="clearfix"></div>
		<div class="lines"></div>
	</div>
	
	<div class="container">
		<div class="title-bg">
			<div class="title">Pay</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-bordered chart">
				<thead>
					<tr>
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
					<!--<input type="hidden" name="product_id[]" value="<?php echo $productbring['product_id'] ?>">-->
					<tr>
						<td><img src="images\demo-img.jpg" width="100" alt=""></td>
						<td><?php echo $productbring['product_name'] ?></td>
						<td><?php echo $productbring['product_id'] ?></td>
						<td><?php echo $basketbring['product_unit'] ?></td>
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
				<!--<a href="" class="btn btn-default btn-yellow">Pay</a>-->
			</div>
			<div class="clearfix"></div>
			</div>
		</div>
        <div class="tab-review">
            <ul id="myTab" class="nav nav-tabs shop-tab">
				<li class="active"><a href="#bank" data-toggle="tab">Bank Payment</a></li>
				<li class=""><a href="#card" data-toggle="tab">Credit Card</a></li>
			</ul>
			<div id="myTabContent" class="tab-content shop-tab-ct">
				<div class="tab-pane fade active in" id="bank">
					<form action="admin/system/work.php" method="POST">
						<p>
							Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
							Nam quasi quis sed tempora nisi odio sint error aspernatur 
							magni illum dignissimos perspiciatis veritatis incidunt, 
							minus at dolorem fugit, mollitia quisquam!
						</p>
						<?php
							$bankcontrol=$db->prepare("SELECT * FROM bank order by bank_id ASC");
							$bankcontrol->execute();
							while($bankbring=$bankcontrol->fetch(PDO::FETCH_ASSOC)) {
						?>
							<div>
								<input type="radio" name="order_bank" value="<?php echo $bankbring['bank_name']?>">
								<label><?php echo $bankbring['bank_name']?> - <?php echo $bankbring['bank_iban']?></label>
							</div>
						<?php
							}
						?>
						<input type="hidden" name="user_id" value="<?php echo $userbring['user_id'] ?>">
						<input type="hidden" name="order_total" value="<?php echo $total_price ?>">
						<hr>
						<button class="btn btn-success" type="submit" name="bank_orderadd">Order</button>
					</form>
				</div>
    			<div class="tab-pane fade" id="card">
					Credit Card
				</div>
			</div>
		</div>
		<div class="spacer"></div>
	</div>
	
	<?php 
		require_once 'footer.php';
	?>
