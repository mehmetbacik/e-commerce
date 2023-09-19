<?php 
require_once 'header.php';
$sql=$db->prepare("SELECT * FROM menu WHERE menu_seourl=:sef");
$sql->execute(['sef' => $_GET['sef']]);
$menubring=$sql->fetch(PDO::FETCH_ASSOC);
?>
	<head>
		<title><?php echo $menubring['menu_name'] ?> - <?php echo $settingbring['setting_title']; ?></title>
	</head>
	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title">Menu Detail</div>
				</div>
				<div class="page-content">
					<?php echo $menubring['menu_name']; ?>
				</div>
				<div class="title-bg">
					<div class="title">Content</div>
				</div>
				<div class="page-content">
					<?php echo $menubring['menu_detail']; ?>
				</div>
			</div>

			<!--Sidebar-->
			<?php require_once 'sidebar.php'; ?>
			<!--Sidebar-->

		</div>
		<div class="spacer"></div>
	</div>
	
<?php 
require_once 'footer.php';
?>
