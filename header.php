<?php
	ob_start();
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
    require_once 'admin/system/connect.php';
	require_once 'admin/production/function.php';

	$sql=$db->prepare("SELECT * FROM setting WHERE setting_id=:id");
	$sql->execute(['id' => 1]);
	$settingbring=$sql->fetch(PDO::FETCH_ASSOC);

	$usersql=$db->prepare("SELECT * FROM user WHERE user_mail=:mail");
    $usersql->execute(['mail' => $_SESSION['usercustomer_mail']]);
    $logincontrol=$usersql->rowCount();
    $userbring=$usersql->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="description" content="<?php echo $settingbring['setting_description']; ?>">
	<meta name="keywords" content="<?php echo $settingbring['setting_keywords']; ?>">
	<meta name="author" content="<?php echo $settingbring['setting_author']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='font-awesome\css\font-awesome.css' rel="stylesheet" type="text/css">
	<!-- Bootstrap -->
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
	
	<!-- Main Style -->
	<link rel="stylesheet" href="style.css">

	<!-- fancy Style -->
	<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">
	
	<!-- owl Style -->
	<link rel="stylesheet" href="css\owl.carousel.css">
	<link rel="stylesheet" href="css\owl.transitions.css">
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
	<div class="header"><!--Header -->
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-md-4 main-logo">
					<a href="index"><img src="<?php echo $settingbring['setting_logo']; ?>" alt="logo" class="logo img-responsive"></a>
				</div>
				<div class="col-md-8">
					<div class="pushright">
						<div class="top">
							<?php
								if(!isset($_SESSION['usercustomer_mail'])) {
							?>
								<a href="#" id="reg" class="btn btn-default btn-dark">Login<span>-- Or --</span>Register</a>

							<?php } else { ?>
								<a href="#" class="btn btn-default btn-dark">Welcome<span><?php echo $userbring['user_name']; ?> </span></a>
							<?php } ?>

							<div class="regwrap">
								<div class="row">
									<div class="col-md-6 regform">
										<div class="title-widget-bg">
											<div class="title-widget">Login</div>
										</div>
										<form action="admin/system/work.php" method="POST" role="form">
											<div class="form-group">
												<input type="text" class="form-control" name="user_mail" id="username" placeholder="E-Mail">
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="user_password" id="password" placeholder="Password">
											</div>
											<div class="form-group">
												<button type="submit" name="userlogin" class="btn btn-default btn-red btn-sm">Sign In</button>
											</div>
										</form>
									</div>
									<div class="col-md-6">
										<div class="title-widget-bg">
											<div class="title-widget">Register</div>
										</div>
										<p>
											New User? By creating an account you be able to shop faster, be up to date on an order's status...
										</p>
										<a href="register"><button class="btn btn-default btn-yellow">Register Now</button></a>
									</div>
								</div>
							</div>
							<div class="srch-wrap">
								<a href="#" id="srch" class="btn btn-default btn-search"><i class="fa fa-search"></i></a>
							</div>
							<div class="srchwrap">
								<div class="row">
									<div class="col-md-12">
										<form action="search.php" method="POST" class="form-horizontal" role="form">
											<div class="form-group">
												<button name="search" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
												<div class="col-sm-10">
													<input type="text" name="research" minlength="3" class="form-control" id="search">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="dashed"></div>
	</div><!--Header -->
	<div class="main-nav"><!--end main-nav -->
		<div class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="row">
					<div class="col-md-10">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse">
							<ul class="nav navbar-nav">
								<li><a href="index" class="active">Home</a><div class="curve"></div></li>
								<?php
									$menucontrol=$db->prepare("SELECT * FROM menu where menu_status=:mstatus order by menu_order ASC limit 5");
									$menucontrol->execute(
										[
											'mstatus' => 1
										]
									);
									while($menubring=$menucontrol->fetch(PDO::FETCH_ASSOC)) {
								?>
									<li><a href="<?php if(!empty($menubring['menu_url'])) { echo $menubring['menu_url']; } else { echo "page-".seo($menubring['menu_name']);} ?>"><?php echo $menubring['menu_name']?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>

					<div class="col-md-2 machart">
						<button id="popcart" class="btn btn-default btn-chart btn-sm "><span class="mychart">Cart</span>|<span class="allprice">$00.00</span></button>
						<div class="popcart">
							<table class="table table-condensed popcart-inner">
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
										$ctotal_price+=$productbring['product_price']*$basketbring['product_unit']; 
								?>
									<tr>
										<td>
										<a href="#"><img src="images\dummy-1.png" alt="" class="img-responsive"></a>
										</td>
										<td><a href="#"><?php echo $productbring['product_name'] ?></a></td>
										<td><?php echo $basketbring['product_unit'] ?></td>
										<td>$ <?php echo $productbring['product_price']*$basketbring['product_unit'] ?></td>
										<td><a href=""><i class="fa fa-times-circle fa-2x"></i></a></td>
									</tr>

								<?php } ?>
									
								</tbody>
							</table>
							<!--<span class="sub-tot">Sub-Total : <span>$277.60</span> | <span>Vat (17.5%)</span> : $36.00 </span>-->
							<br>
							<div class="btn-popcart">
								<a href="basket" class="btn btn-default btn-red btn-sm">Basket</a>
							</div>
							<div class="popcart-tot">
								<p>
									Total<br>
									<span>$ <?php echo $ctotal_price ?></span>
								</p>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>

					<?php
						if(isset($_SESSION['usercustomer_mail'])) { 
					?>
						<div class="container">
							<ul class="small-menu"><!--small-nav -->
								<li><a href="account" class="myacc">My Account</a></li>
								<li><a href="orders" class="myshop">My Orders</a></li>
								<li><a href="logout" class="mycheck">Logout</a></li>
							</ul><!--small-nav -->
						</div>
					<?php
						}
					?>

				</div>
			</div>
		</div>
	</div><!--end main-nav -->