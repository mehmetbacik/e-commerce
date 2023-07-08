	<?php 
		require_once 'header.php';
	?>

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
						<th>Model</th>
						<th>Item No.</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><form><input type="checkbox"></form></td>
						<td><img src="images\demo-img.jpg" width="100" alt=""></td>
						<td>Some Camera</td>
						<td>PR - 2</td>
						<td>225883</td>
						<td><form><input type="text" class="form-control quantity"></form></td>
						<td>$94.00</td>
						<td>$94.00</td>
					</tr>
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
				<div class="subtotal">
					<p>Sub Total : $26.00</p>
					<p>Vat 17% : $54.00</p>
				</div>
				<div class="total">Total : <span class="bigprice">$255.00</span></div>
				<a href="" class="btn btn-default btn-red btn-sm">Checkout</a>
				<a href="" class="btn btn-default btn-red btn-sm">Update</a>
				<div class="clearfix"></div>
				<a href="" class="btn btn-default btn-yellow">Continue Shopping</a>
			</div>
			<div class="clearfix"></div>
			</div>
		</div>
		<div class="spacer"></div>
	</div>
	
	<?php 
		require_once 'footer.php';
	?>
