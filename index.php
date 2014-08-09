<?php 
$pageTitle = "Shirts 4 Mike";
include('inc/products.php');
include('inc/header.php'); 
?>

		<div class="section banner">

			<div class="wrapper">

				<img class="hero" src="img/mike-the-frog.png" alt="Mike the Frog says:">
				<div class="button">
					<a href="shirts.php">
						<h2>Hey, I&rsquo;m Mike!</h2>
						<p>Check Out My Shirts</p>
					</a>
				</div>
			</div>

		</div>

		<div class="section shirts latest">

			<div class="wrapper">

				<h2>Mike&rsquo;s Latest Shirts</h2>
				
				<ul class="products">
					<?php foreach ($products as $product_id => $product) {
						echo get_list_view_html($product_id, $product);
					 } ?>		
				</ul>

			</div>

		</div>
<?php include('inc/footer.php'); ?>