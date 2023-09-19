<?php require_once 'header.php'; ?>
<head>
	<title>Orders - <?php echo $settingbring['setting_title']; ?></title>
</head>
<div class="container">
	<form action="admin/system/work.php" method="POST" class="form-horizontal checkout" role="form">
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
								<th>Type</th>
								<th>Bank</th>
								<th>Status</th>
								<th>Price</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$user_id=$userbring['user_id'];
							$ordercheck=$db->prepare("SELECT * FROM orders WHERE user_id=:id");
							$ordercheck->execute(['id' => $user_id]);
							while ($orderbring=$ordercheck->fetch(PDO::FETCH_ASSOC)) {?>
								<tr>
									<td><?php echo $orderbring['order_id'] ?></td>
									<td><?php echo $orderbring['order_time'] ?></td>
									<td><?php echo $orderbring['order_type'] ?></td>
									<td><?php echo $orderbring['order_bank'] ?></td>
									<td><?php echo $orderbring['order_status'] ?></td>
									<td>$ <?php echo $orderbring['order_total'] ?></td>
									<td><a href="#"><button class="btn btn-primary btn-xs">Detail</button></a></td>
								</tr>
								<?php } ?>
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