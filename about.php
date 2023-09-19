<?php 
require_once 'header.php';
$sql=$db->prepare("SELECT * FROM about WHERE about_id=:id");
$sql->execute(['id' => 1]);
$aboutbring=$sql->fetch(PDO::FETCH_ASSOC);
?>
	<head>
		<title>About - <?php echo $settingbring['setting_title']; ?></title>
	</head>
	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title"><?php echo $aboutbring['about_title']; ?></div>
				</div>
				<div class="page-content">
					<?php echo $aboutbring['about_content']; ?>
				</div>
				<div class="title-bg">
					<div class="title">Vision</div>
				</div>
				<div class="page-content">
					<?php echo $aboutbring['about_vision']; ?>
				</div>
				<div class="title-bg">
					<div class="title">Mission</div>
				</div>
				<div class="page-content">
					<?php echo $aboutbring['about_mission']; ?>
				</div>
				<div class="title-bg">
					<div class="title">Video</div>
				</div>
				<div class="page-content">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $aboutbring['about_video']; ?>" 
						title="YouTube video player" frameborder="0" 
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
						allowfullscreen>
					</iframe>
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
