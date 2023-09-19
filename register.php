<?php require_once 'header.php'; ?>
<head>
	<title>Register - <?php echo $settingbring['setting_title']; ?></title>
</head>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Register</div>
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
                if (isset($_GET['status'])) {
				if ($_GET['status']=="differentpassword") {?>

				<div class="alert alert-danger">
					<strong>Error!</strong> Passwords do not match.
				</div>
					
				<?php } elseif ($_GET['status']=="missingpassword") {?>

				<div class="alert alert-danger">
					<strong>Error!</strong> Password must be at least 6 characters long.
				</div>
					
				<?php } elseif ($_GET['status']=="duplication") {?>

				<div class="alert alert-danger">
					<strong>Error!</strong> This user has already been registered.
				</div>
					
				<?php } elseif ($_GET['status']=="unsuccessful") {?>

				<div class="alert alert-danger">
					<strong>Error!</strong> Failed to Register Consult the System Administrator.
				</div>
					
				<?php }}
				 ?>

				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="user_name" placeholder="Name">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="email" class="form-control" required="" name="user_mail" placeholder="E-Mail">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-6">
						<input type="password" class="form-control" name="user_passwordone" placeholder="Password">
					</div>
					<div class="col-sm-6">
						<input type="password" class="form-control" name="user_passwordtwo" placeholder="Password again">
					</div>
				</div>



				<button type="submit" name="usersave" class="btn btn-default btn-red">Register</button>
			</div>
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title">Forgot Your Password?</div>
				</div>
				<center><img width="400" src="https://via.placeholder.com/500x300"></center>
			</div>
		</div>
	</div>
</form>
<div class="spacer"></div>
</div>

<?php require_once 'footer.php'; ?>