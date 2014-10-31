<?php 
	/******************************* INTRO COPY *************************/ 
?>
<section>
	<h1><?= $installer_array[0]->about_dealer_headline; ?></h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
	<p><a href="<?= $installer_base_url; ?>/contact">Schedule a consulation</a></p>
</section>

<?php 
	/******************************* ABOUT INSTALLER COPY *************************/ 
?>
<section>
	<?= $installer_array[0]->about_dealer_text; ?>
</section>

<?php 
	/******************************* IF INSTALLER HAS PHOTO GALLERY *************************/ 
?>
<section>

</section>

<?php 
	/******************************* IF INSTALLER HAS TESTIMONIALS *************************/ 
?>
<section>
	<?php
		if( isset($testimonials_array) && count($testimonials_array) > 0) {
			echo '<h2>Testimonials</h2>';
			foreach($testimonials_array as $testimonial) {
				echo '<p>"' . $testimonial->testimonial_copy . '"</p>';
			}
		}
	?>
</section>

<?php 
	/******************************* STATIC ABOUT VELUX *************************/ 
?>
<section>
	<h2>About VELUX</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est debitis natus at laboriosam molestiae recusandae architecto porro magni itaque esse necessitatibus molestias earum vel ipsam, ex explicabo nostrum dicta, facere culpa quos, dolores sed enim veniam aspernatur aliquam. Quibusdam eligendi quidem dignissimos, tempora fugit exercitationem ullam doloremque iure iste laboriosam modi vitae et, dolores sapiente ipsam quod, suscipit, nobis ipsum eveniet deserunt officia pariatur perspiciatis at ut? Doloribus nulla nam accusantium repellat, dolorem quibusdam porro aspernatur perferendis? Unde modi iusto autem nam tenetur! Blanditiis consectetur, perferendis asperiores est hic, tempora provident consequatur libero similique, saepe natus, cumque! Accusamus ut, dolorem?</p>
</section>

<?php 
	/******************************* STATIC OUR PRINCIPLES *************************/ 
?>
<section>
	<h2>Our Principles</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est debitis natus at laboriosam molestiae recusandae architecto porro magni itaque esse necessitatibus molestias earum vel ipsam, ex explicabo nostrum dicta, facere culpa quos, dolores sed enim veniam aspernatur aliquam. Quibusdam eligendi quidem dignissimos, tempora fugit exercitationem ullam doloremque iure iste laboriosam modi vitae et, dolores sapiente ipsam quod, suscipit, nobis ipsum eveniet deserunt officia pariatur perspiciatis at ut? Doloribus nulla nam accusantium repellat, dolorem quibusdam porro aspernatur perferendis? Unde modi iusto autem nam tenetur! Blanditiis consectetur, perferendis asperiores est hic, tempora provident consequatur libero similique, saepe natus, cumque! Accusamus ut, dolorem?</p>
</section>
