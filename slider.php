       <div class="main-slide">
			<div id="sync1" class="owl-carousel">
                <?php 
                    $slidercontrol=$db->prepare("SELECT * FROM slider");
                    $slidercontrol->execute();
                    while($sliderbring=$slidercontrol->fetch(PDO::FETCH_ASSOC)) {
                ?>
				<div class="item">
					<div class="slide-desc">
						<div class="inner">
							<h1><?php echo $sliderbring['slider_name'] ?></h1>
							<p>
								Nunc non fermentum nunc. Sed ut ante eget leo tempor consequat sit amet eu orci. Donec dignissim dolor eget..
							</p>
							<button class="btn btn-default btn-red btn-lg">Add to cart</button>
						</div>
						<div class="inner">
							<div class="pro-pricetag big-deal">
								<div class="inner">
										<span class="oldprice">$314</span>
										<span>$199</span>
										<span class="ondeal">Best Deal</span>
								</div>
							</div>
						</div>
					</div>
					<div class="slide-type-1">
						<a href="http://<?php echo $sliderbring['slider_link'] ?>"><img src="<?php echo $sliderbring['slider_imgurl'] ?>" alt="" class="img-responsive"></a>
					</div>
				</div>
                <?php } ?>
			</div>
		</div>

        <!--<div class="bar"></div>
		<div id="sync2" class="owl-carousel">
			<div class="item">
				<div class="slide-type-1-sync">
					<h3>Stylish Jacket</h3>
					<p>Description here here here</p>
				</div>
			</div>
			<div class="item">
				<div class="slide-type-1-sync">
					<h3>Stylish Jacket</h3>
					<p>Description here here here</p>
				</div>
			</div>
			<div class="item">
				<div class="slide-type-1-sync">
					<h3>Nike Airmax</h3>
					<p>Description here here here</p>
				</div>
			</div>
			<div class="item">
				<div class="slide-type-1-sync">
					<h3>Unique smaragd ring</h3>
					<p>Description here here here</p>
				</div>
			</div>
			<div class="item">
				<div class="slide-type-1-sync">
					<h3>Stylish Jacket</h3>
					<p>Description here here here</p>
				</div>
			</div>
			<div class="item">
				<div class="slide-type-1-sync">
					<h3>Nike Airmax</h3>
					<p>Description here here here</p>
				</div>
			</div>
		</div>-->