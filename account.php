<?php require_once 'header.php'; ?>
	<head>
		<title>Account - <?php echo $settingbring['setting_title']; ?></title>
	</head>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">My Account</div>
							<p>Lorem ipsum dolor sit amet.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<form action="admin/system/work.php" method="POST" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title">Registration Information</div>
				</div>
                        <?php
                            if (isset($_SESSION['status'])) {
                            if ($_SESSION['status']=="success") {
                        ?>
                            <div class="alert alert-success">
                                <p>Update successful</p>
                            </div>
                        <?php
                            unset($_SESSION['status']);
                            } else if ($_SESSION['status']=="error") {
                        ?>
                            <div class="alert alert-danger">
                                <p>Update error</p>
                            </div>
                        <?php
                            unset($_SESSION['status']);
                            }}
                        ?>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="user_name" value="<?php echo $userbring['user_name']; ?>">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="user_gsm" value="<?php echo $userbring['user_gsm']; ?>">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="user_adress" value="<?php echo $userbring['user_adress']; ?>">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="user_country" value="<?php echo $userbring['user_country']; ?>">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="user_district" value="<?php echo $userbring['user_district']; ?>">
					</div>
				</div>
				<input type="hidden" name="user_id" value="<?php echo $userbring['user_id']; ?>">
				<button type="submit" name="usercustomer_update" class="btn btn-default btn-red">Update</button>
			</div>
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title">Password Change</div>
				</div>
				<center><a href="password-change"><img width="400" src="https://via.placeholder.com/500x300"></a></center>
			</div>
		</div>
	</div>
</form>
<div class="spacer"></div>
</div>

<?php require_once 'footer.php'; ?>