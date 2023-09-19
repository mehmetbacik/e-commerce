<?php require_once 'header.php' ?>
<head>
	<title>Contact - <?php echo $settingbring['setting_title']; ?></title>
</head>
<div class="container">
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>
<div class="container">
	<div class="row">
	</div>
	<div class="title-bg">
		<div class="title">Contact</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<p class="page-content">
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis architecto corrupti, 
				cupiditate dolores eaque in molestiae officia vero impedit? Ipsum, tempora ipsa corporis 
				aliquid sed amet qui numquam distinctio explicabo.
			</p>
			<ul class="contact-widget">
				<li class="fphone"><?php echo  $settingbring['setting_tel'] ?></li>
				<li class="fmobile"><?php echo  $settingbring['setting_gsm'] ?></li>
				<li class="fmail lastone"><?php echo  $settingbring['setting_mail'] ?></li>
			</ul>
		</div>
		<div class="col-md-7 col-md-offset-1">
			<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
			<div id="googlemaps" class="google-map google-map-footer">
				<iframe
				width="100%"
				height="100%"
				frameborder="0" style="border:0"
				src="https://www.google.com/maps/embed/v1/place?key=<?php echo $settingbring['setting_goooglemap']; ?>
				&q=<?php echo $settingbring['setting_adress']; ?>" allowfullscreen>
			</iframe>
		</div>
	</div>
</div>
<div class="title-bg">
	<div class="title">Contact Form</div>
</div>
<div class="qc">
	<form action="http://www.domain.com.tr/folder/mailphp/mail.php" method="POST" role="form">
		<div class="form-group">
			<label for="name">Name Surname<span>*</span></label>
			<input type="text" name="namesurname" class="form-control" id="name">
		</div>
		<div class="form-group">
			<label for="email">Mail<span>*</span></label>
			<input type="email" name="email" class="form-control" id="email">
		</div>
		<div class="form-group">
			<label for="text">Message<span>*</span></label>
			<textarea name="mesaj" class="form-control" id="text"></textarea>
		</div>
		<?php 
		$n1=rand(10,30);
		$n2=rand(0,10);
		$total=$n1+$n2;
		?>
		<input type="hidden" value="<?php echo $total; ?>" name="total">
		<div class="form-group">
			<label for="name">Answer?<span>*</span></label>
			<input type="text" name="process"  placeholder="<?php echo $n1." + ".$n2. " = ?";  ?>" class="form-control" id="process">
		</div>
		<button type="submit" class="btn btn-default btn-red btn-sm">Send</button>
	</form>
</div>
<div class="spacer"></div>
</div>

<?php require_once 'footer.php' ?>