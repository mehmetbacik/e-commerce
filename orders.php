<?php require_once 'header.php'; ?>

<div class="container">
	<form action="nedmin/netting/islem.php" method="POST" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-12">
				<div class="title-bg">
					<div class="title">Order Information</div>
				</div>

				<div class="table-responsive">
					<table class="table table-bordered chart">
						<thead>
							<tr>
								<th>Order No</th>
								<th>Date</th>
								<th>Price</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Some Camera</td>
								<td>PR - 2</td>
								<td>225883</td>
								<td><a href="#"><button class="btn btn-primary btn-xs">Detail</button></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="spacer"></div>
</div>

<?php require_once 'footer.php'; ?>