<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php 
				$getlaptop= $pd->getLatestlaptop();
				if($getlaptop){
					while($result=$getlaptop->fetch_assoc()){
				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Laptop</h2>
						<p><?php echo $result['productName'];?></p>
						<div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
					<?php }}?>

				
				<?php 
				$getdesktop= $pd->getLatestDesktop();
				if($getdesktop){
					while($result=$getdesktop->fetch_assoc()){
				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Desktop</h2>
						<p><?php echo $result['productName'];?></p>
						<div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
					<?php }}?>	

				
			</div>
			<div class="section group">
			<?php 
				$getTablet= $pd->getLatestTablet();
				if($getTablet){
					while($result=$getTablet->fetch_assoc()){
				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Tablet</h2>
						<p><?php echo $result['productName'];?></p>
						<div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
					<?php }}?>
					<?php 
				$getMobile= $pd->getLatestMobile();
				if($getMobile){
					while($result=$getMobile->fetch_assoc()){
				
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Mobile</h2>
						<p><?php echo $result['productName'];?></p>
						<div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
					<?php }}?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	