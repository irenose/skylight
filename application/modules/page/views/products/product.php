<?php 
    /******************************* BREADCRUMB *************************/ 
?>
<?=$this->load->view('partials/_breadcrumb')?>
<section>
	<?php 
		echo '<img src="' . $this->config->item('product_images_dir') . $product_info_array[0]->product_image . '.' . $product_info_array[0]->extension . '" alt="' . $product_info_array[0]->product_name . '">';
	?>
</section>
<section>
	<?php
		echo '<h1>' . filter_page_content($product_info_array[0]->product_name) . '</h1>' . "\n";
		echo filter_page_content($product_info_array[0]->product_description) . "\n";
		echo '<p><a href="' . $installer_base_url . '/contact" data-modal-open data-ajax-vars="{\'view\':\'partials/_modal-content\', \'content-type\':\'contact\'}">Contact Us (Modal)</a></p>';
	?>
</section>
<section>
	FEATURE HEADLINE - TBD IF STATIC OR NOT
</section>
<section>
	FEATURE HEADLINE - TBD IF STATIC OR NOT
</section>
<section>
	FEATURE HEADLINE - TBD IF STATIC OR NOT
</section>
<section>
	FEATURE HEADLINE - TBD IF STATIC OR NOT
</section>
<section>
	RATINGS
</section>