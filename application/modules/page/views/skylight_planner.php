<section class="page-row bg-grey promotions">
    <header class="intro-statement intro-statement--squeezed">
        <h1>Add drama to your space with the VELUX Skylight Planner</h1>
        <p>Use our online tool to see the dramatic difference a skylight can make in your home, and share the images with family and friends.</p>
    </header>
</section>
<section class="page-row page-row--planner centered">
	<?php
		if($display_saved_image) {
			$url = 'http://skylightapps.com/room/?u=' . urlencode($image_var) . '&d=ss&dealer=' . $installer_url;
			echo '<iframe src="' . $url . '" frameborder="0" scrolling="no" width="733" height="960"></iframe>';
		} else {
			$url = 'http://skylightapps.com/planner.php?d=ss&dealer=' . $installer_url;
			echo '<iframe src="' . $url . '" frameborder="0" scrolling="no" width="960" height="462"></iframe>';
		}
	?>
</section>
