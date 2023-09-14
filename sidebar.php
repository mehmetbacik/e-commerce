<div class="col-md-3"><!--sidebar-->
				<div class="title-bg">
					<div class="title">Categories</div>
				</div>
				<div class="categorybox">
					<ul>
						<?php 
							// pull data to pass it to the array.
							$query = "SELECT * FROM categories order by category_id";
							$show = $db->prepare($query);
							$show->execute(); //run query
 							$totalLineNumber = $show->rowCount(); //number of rows returned from the query
							$allResults = $show->fetchAll(); //pass all rows and columns from the DB as an array to the variable $allResults
							//number of categories without subcategories
							$subCategoryNumber = 0;
							for ($i = 0; $i < $totalLineNumber; $i++) {
								if ($allResults[$i]['category_top'] == "0") {
									$subCategoryNumber++;
								}
							}
							for ($i = 0; $i < $totalLineNumber; $i++) {
								if ($allResults[$i]['category_top'] == "0") {
									categories($allResults[$i]['category_id'], $allResults[$i]['category_name'], $allResults[$i]['category_top']);
								}
							}
							function categories($category_id, $category_name, $category_top) {
							global $allResults;
							global $totalLineNumber;
    						//category, number of subcategories
							$subCategoryNumber = 0;
							for ($i = 0; $i < $totalLineNumber; $i++) {
								if ($allResults[$i]['category_top'] == $category_id) {
									$subCategoryNumber++;
								}
							}
						?>
							<li>
								<a href="category-<?=seo($category_name) ?>"><?php echo $category_name ?></a>
									<?php 
										if ($subCategoryNumber > 0) {
											echo "( $subCategoryNumber )";
										}
									?>
								</a>
								<?php
									if ($subCategoryNumber > 0) { //if there are subcategories, list them too
										echo "<ul>";
											for ($i = 0; $i < $totalLineNumber; $i++) {
												if ($allResults[$i]['category_top'] == $category_id) {
												categories($allResults[$i]['category_id'], $allResults[$i]['category_name'], $allResults[$i]['category_top']);
											}
										}
										echo "</ul>";
									}
								?>
							</li>
						<?php 
							}
						?>
					</ul>
				</div>
				
				<div class="ads">
					<a href="product.htm"><img src="images\ads.png" class="img-responsive" alt=""></a>
				</div>
				
				<div class="title-bg">
					<div class="title">Best Seller</div>
				</div>
				<div class="best-seller">
					<ul>
						<li class="clearfix">
							<a href="#"><img src="images\demo-img.jpg" alt="" class="img-responsive mini"></a>
							<div class="mini-meta">
								<a href="#" class="smalltitle2">Panasonic M3</a>
								<p class="smallprice2">Price : $122</p>
							</div>
						</li>
						<li class="clearfix">
							<a href="#"><img src="images\demo-img.jpg" alt="" class="img-responsive mini"></a>
							<div class="mini-meta">
								<a href="#" class="smalltitle2">Panasonic M3</a>
								<p class="smallprice2">Price : $122</p>
							</div>
						</li>
						<li class="clearfix">
							<a href="#"><img src="images\demo-img.jpg" alt="" class="img-responsive mini"></a>
							<div class="mini-meta">
								<a href="#" class="smalltitle2">Panasonic M3</a>
								<p class="smallprice2">Price : $122</p>
							</div>
						</li>
					</ul>
				</div>
				
			</div><!--sidebar-->